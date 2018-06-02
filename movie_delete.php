<?php
session_start();
  // If session variables aren't set, try setting them with a cookie
  if (!isset($_SESSION['userId'])) {
    if (isset($_COOKIE['userId']) && isset($_COOKIE['username'])) {
      $_SESSION['userId'] = $_COOKIE['userId'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
<?php
if (!isset($_SESSION['userId'])) {
require_once('header.php');
echo '<h3>Delete Movie</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Delete Movie</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="admin_logout.php">Log out</a>.</p>');
  
  if (isset($_GET['movieCode']) && isset($_GET['title']) && isset($_GET['image'])
  && isset($_GET['category']) && isset($_GET['movieDesc'])) {
  
  //Grab the movie data from the GET
  $movieCode = $_GET['movieCode'];
  $title = $_GET['title'];
  $image = $_GET['image'];
  $category = $_GET['category'];
  $movieDesc = $_GET['movieDesc'];
  }
   else if (isset($_POST['movieCode']) && isset($_POST['title']) && isset($_POST['category'])) {
   //Grab the movie data from the POST
    $movieCode = $_POST['movieCode'];
    $title = $_POST['title'];
  $category = $_POST['category'];
   }
   else {
    echo '<p>Sorry, no movie was specified for deletion.</p>';
    }
    
    if (isset($_POST['submit'])) {
    
      if ($_POST['confirm'] == 'Yes' ) {
      
      //Delete the image file from the server
      @unlink(MG_UPLOADPATH . $image);
      
      // Connect to the database
      $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
      //Delete the score data from the database
      
      $query = " DELETE FROM movie WHERE movieCode = $movieCode LIMIT 1";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);
      
      //Confirm success with the admin
      echo '<p>The movie ' . $title . ' was successfully removed from the list.</p>';
      }
      else {
        echo '<p>The movie was not removed.</p>';
      }
  }
  
  else if (isset($movieCode) && isset($title) && isset($image) && isset($category) && isset($movieDesc)) {
  echo '<p>Are you sure you want to delete the following movie?</p>';
  echo '<p><strong>Title: </strong>' . $title . '<br /><strong>Category: </strong>' . $category . '</p>';
  echo '<form method="post" action="movie_delete.php">';
  echo '<input type="radio" name="confirm" value="Yes"> Yes';
  echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
  echo '<input type="submit" name="submit" value="Proceed" />';
  
  echo '<input type="hidden" name="movieCode" value="' . $movieCode . '" />';
  
  echo '<input type="hidden" name="title" value="' . $title . '" />';
  echo '<input type="hidden" name="category" value="' . $category . '" />';
  echo '</form>';
}

  echo '<p><a href="admin_movie_edit.php">&lt;&lt; Bact to Edit/Delete page</a></p>';
}  
?>

</body> 
</html>