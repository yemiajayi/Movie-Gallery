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
echo '<h3>Add Movie Record</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Add Movie Record</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');


  
  if (isset($_POST['submit'])) {
    // Grab movie data from the POST
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];
    $category = $_POST['category'];
    $moviedesc = $_POST['moviedesc'];

    if (!empty($title) && !empty($image) && !empty($category)) {
      if ((($image_type == 'image/gif') || ($image_type == 'image/jpeg') ||
       ($image_type == 'image/pjeg') || ($image_type == 'image/png')) &&
       ($image_size > 0) && ($image_size <= MG_MAXFILESIZE)) {

      // Move the file to the target upload folder
      $target = MG_UPLOADPATH . $image;
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);   

      // Write the data to the database
      $query = "INSERT INTO movie VALUES (0, '$title', '$image', '$category', '$moviedesc')";
      
      mysqli_query($dbc, $query);

      // Confirm success with adding movie
      echo '<p>Movie record added successfully!</p>';
      echo '<p><strong>Title:</strong> ' . $title . '<br />';
      echo '<strong>Category:</strong> ' . $category . '</p>';
      echo '<img src="' . MG_UPLOADPATH . $image . '" alt="movie image" /></p>';
      echo '<p><a href="admin_movie_list.php">&lt;&lt; Back to Movie list</a></p>';

      // Clear movie data to clear the form
      $title = "";
      $image = "";
      $category = "";
      $moviedesc = "";

      mysqli_close($dbc);
    }
    else {
      echo '<p class="error">Sorry, there was a problem uploading movie image.</p>';
      }
    
  }
  else {
    echo '<p class="error">The image must be a GIF, JPEG, or PNG image file no ' .
        'greater than ' . (MG_MAXFILESIZE / 102400) . ' KB in size.</p>';
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
    <p><input type="text" id="title" name="title" value="<?php if (!empty($title)) echo $title; ?>" placeholder="required" required autofocus /></p>
    
    <label for="image">Image:</label>
    <p><input type="file" id="image" name="image" /></p>
    
    <label for="category">Category:</label>
    <p><select id="category" name="category" />
      <option value="<?php if (!empty($category)) echo $category; ?>">Action</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Comedy</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Drama</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Cartoon</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Classic</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Horror</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">Triller</option>
      <option value="<?php if (!empty($category)) echo $category; ?>">War</option>
    </select>
    </p>
    
     <label for="Description">Description:</label>
    <textarea name="moviedesc" rows="8" cols="40" value="<?php echo $moviedesc; ?>" placeholder="about the movie..."
    onKeyDown="textCounter(this.form.moviedesc,this.form.countDisplay);" onKeyUp="textCounter(this.form.moviedesc,this.form.countDisplay)" /></textarea></p>
      
       <p><label>Characters Remaining:</label>
      <input readonly type="text" name="countDisplay" size="3" maxlength="3" value="500" /></p>
    
    <hr />
    <input type="submit" value="Add Movie" name="submit" id="submit" />
  </form>

<?php
require_once('admin_footer.php');
?>