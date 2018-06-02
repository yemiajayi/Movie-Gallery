<?php
session_start();
  // If session variables aren't set, try setting them with a cookie
  if (!isset($_SESSION['userId'])) {
    if (isset($_COOKIE['userId']) && isset($_COOKIE['username'])) {
      $_SESSION['userId'] = $_COOKIE['userId'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }

if (!isset($_SESSION['userId'])) {
require_once('header.php');
echo '<h3>Movie List</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Movie List</h3><hr>';
    echo('<p class="login">You are logged in as ' . '<b>' . $_SESSION['username'] . '</b></p>');

echo '<p><a href="admin_movie_add.php">Add Movies    </a>|<a href="admin_movie_edit.php">   Edit Movies</a></p><hr />';

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from Database
  $query = "SELECT title,image,category,movieDesc FROM movie order by movieCode DESC";
  $data = mysqli_query($dbc, $query);
include_once('paginationM.php');
  // Loop through the array of movie data, formatting it as HTML 
  echo '<table>';
  while ($row = mysqli_fetch_array($data2)) { 
    // Display the movie data
    echo '<tr><td>';
    echo '<strong>Title:</strong> ' . $row['title'] . '<br /><br />';
    echo '<strong>Category:</strong> ' . $row['category'] . '<br /><br />';
    echo '<strong>Description:</strong> ' . $row['movieDesc'] . '</td>';
  
    if (is_file(MG_UPLOADPATH . $row['image']) && filesize(MG_UPLOADPATH . $row['image']) > 0) {
    echo '<td><a href=""><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="movie image" width="160px" height="180px" /></a></td></tr>';
    }
    else {
      echo '<td><img src="' . MG_UPLOADPATH . 'unverified.gif' .
      '" alt="unverified image" /></td></tr>';
      }
    }
  echo '</table>';

  mysqli_close($dbc);

}
require_once('admin_footer.php');
?>