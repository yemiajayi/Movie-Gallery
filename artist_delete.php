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
echo '<h3>Delete Artist</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Delete Artist</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="admin_logout.php">Log out</a>.</p>');

  
  if (isset($_GET['artistId']) && isset($_GET['firstName']) && isset($_GET['lastName'])
  && isset($_GET['dateOfBirth']) && isset($_GET['nationality']) && isset($_GET['otherInfo'])) {
  
  //Grab artist data from the GET
  $artistid = $_GET['artistId'];
  $firstname = $_GET['firstName'];
  $lastname = $_GET['lastName'];
  $dateofbirth = $_GET['dateOfBirth'];
  $nationality = $_GET['nationality'];
  $otherinfo = $_GET['otherInfo'];
  }
   elseif (isset($_POST['artistId']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
   //Grab artist data from the POST
    $artistid = $_POST['artistId'];
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
   }
   else {
    echo '<p>Sorry, no Artist was specified for deletion.</p>';
    }
    
    if (isset($_POST['submit'])) {
    
      if ($_POST['confirm'] == 'Yes' ) {
      
      // Connect to the database
      $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
      //Delete artist data from the database
      
      $query = " DELETE FROM artist WHERE artistId = $artistid LIMIT 1";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);
      
      //Confirm success with the admin
      echo '<p>Artist ' . $firstname . ' ' . $lastname . ' was successfully removed from the list.</p>';
      }
      else {
        echo '<p>Artist was not removed.</p>';
      }
  }
  
  else if (isset($artistid) && isset($firstname) && isset($lastname) && isset($dateofbirth) && isset($nationality) && isset($otherinfo)) {
  echo '<p>Are you sure you want to delete the following artist?</p>';
  echo '<p><strong>Name: </strong>' . $firstname . ' ' . $lastname . '</p>';
  echo '<form method="post" action="artist_delete.php">';
  echo '<input type="radio" name="confirm" value="Yes"> Yes';
  echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
  echo '<input type="submit" name="submit" value="Proceed" />';
  
  echo '<input type="hidden" name="artistId" value=' . $artistid . ' />';
  
  echo '<input type="hidden" name="firstName" value="' . $firstname . '" />';
  echo '<input type="hidden" name="lastName" value="' . $lastname . '" />';
  echo '</form>';
}

  echo '<p><a href="admin_artist_edit.php">&lt;&lt; Bact to Edit/Delete page</a></p>';
}
 require_once('admin_footer.php');   
?>
