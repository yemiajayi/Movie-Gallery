<?php
session_start();
   
  // If session variables aren't set, try setting them
    if (!isset($_SESSION['userId'])) {
    if (isset($_COOKIE['userId']) && isset($_COOKIE['username'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
    }
?>   
<?php
  // Generate the header and navigation menu
  if (isset($_SESSION['userId'])) {
  
	require_once('admin_header.php');
	require_once('connectdb.php');
    //echo '&#10084; <a href="admin_artist_list.php">View Artist</a><br />';
    //echo '&#10084; <a href="admin_movie_list.php">View Movies</a><br />';
   // echo '&#10084; <a href="admin_logout.php">Log Out (' . '<b>' . $_SESSION['username'] . '</b>' . ')</a>';
  }
  else {
	require_once('header.php');
	require_once('connectdb.php');
    //echo '&#10084; <a href="admin_login.php">Log In as Admin</a><br />';
  }
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the movie data from MySQL
  $query = "SELECT movieCode, title, image, category, movieDesc FROM movie WHERE title IS NOT NULL ORDER BY movieCode DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of movie data, formatting it as HTML
  echo '<header><h3>Latest Movies</h3></header>';
  echo '<hr>';
  echo '<table>';
  echo '<tr><th></th>';
  echo '<th>' . 'Title' . '</th>';
  echo '<th>' . 'Category' . '</th>';
  echo '<th>' . 'Description' . '</th></tr>';
  include_once('paginationM.php');    
  while ($row = mysqli_fetch_array($data2)) {
    if (is_file(MG_UPLOADPATH . $row['image']) && filesize(MG_UPLOADPATH . $row['image']) > 0) {
      echo '<tr><td><a href=""><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="artist image" width="170px" height="180px" /></a></td>';
      echo '<td id="title">' . $row['title'] . '</td>';
      echo '<td>' . $row['category'] . '</td>';
      echo '<td>' . $row['movieDesc'] . '</td>';
    }
    else {
      echo '<tr><td><img src="' . MG_UPLOADPATH . 'nopic.jpg' . '" /></td>';
       echo '<td>' . $row['title'] . '</td>';
      echo '<td>' . $row['category'] . '</td>';
      echo '<td>' . $row['movieDesc'] . '</td></tr>';
    }
  }
  echo '</table>';

  mysqli_close($dbc);
  require_once('footer.php');
?>                   
 