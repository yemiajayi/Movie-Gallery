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
echo '<h3>Edit Movie</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Edit Movie</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="admin_logout.php">Log out</a>.</p>');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$movieCode = intval($_GET['movieCode']);
 $query = "SELECT title, image, category, movieDesc FROM movie WHERE movieCode = '$movieCode' ";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
    
while ($row = mysqli_fetch_array($data)) {
      $title = $row['title'];
      $image = $row['image'];
      $category = $row['category'];
      $moviedesc = $row['movieDesc'];
      $movieCode = $row['movieCode'];
    }
     
  if (isset($_POST['submit'])) {
    // Grab movie data from the POST
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];
    $category = $_POST['category'];
    $moviedesc = $_POST['moviedesc'];
    $movieCode = $_POST['movieCode'];

    if (!empty($title) && !empty($image) && !empty($category)) {
      if ((($image_type == 'image/gif') || ($image_type == 'image/jpeg') ||
       ($image_type == 'image/pjeg') || ($image_type == 'image/png')) &&
       ($image_size > 0) && ($image_size <= MG_MAXFILESIZE)) {

      // Move the file to the target upload folder
      $target = MG_UPLOADPATH . $image;
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {  

      // Write the data to the database
      $query = "UPDATE movie SET title='$title', image='$image', category='$category', movieDesc='$moviedesc' WHERE movieCode= $movieCode ";
      mysqli_query($dbc, $query);

      // Confirm success with editing movie
      echo '<p>Movie record modified successfully!</p>';
      echo '<p><strong>Title:</strong> ' . $title . '<br />';
      echo '<strong>Category:</strong> ' . $category . '</p>';
      echo '<img src="' . MG_UPLOADPATH . $image . '" alt="movie image" /></p>';
      echo '<p><a href="admin_movie_list.php">&lt;&lt; Back to Movie Edit/Delete page</a></p>';

      mysqli_close($dbc);
    }
  }
      
      //Try to delete the temporary image file
      @unlink($_FILE['image']['tmp_name']);
    }
    else {  
      echo '<p class="error">Please add missing vital information.</p>';
    }
  }
}
?>

   <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
    
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $title; ?>" autofocus required /><br />
    
    <label for="image">Image:</label>
    <input type="file" id="image" name="image" /><br />
    
    <label for="category">Category:</label>
    <input type="text" id="category" name="category" value="<?php echo $category; ?>" /><br />
    
     <label for="Description">Description:</label>
    <textarea name="moviedesc" rows="8" cols="30" value="<?php echo $movieDesc; ?>" /></textarea><br />
    
    <input type="hidden" name="movieCode" value="<?php echo $movieCode; ?>" />
    
    <hr />
    <input type="submit" value="Save Changes" name="submit" id="submit" />
  </form>
</body> 
</html>
<?php
 require_once('admin_footer.php');
?>