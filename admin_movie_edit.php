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
echo '<h3>Movie Edit/Delete</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Movie Edit/Delete</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
     
      // Connect to the database
      $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
      //retrieve movie data from MySQL
      
      $query = " SELECT * FROM movie ORDER BY movieCode DESC";
      $data = mysqli_query($dbc, $query);
      
      // Loop through the array of movie data, formatting it as HTML
      echo '<table>';
     
      while ($row = mysqli_fetch_array($data)) {
      // Display the movie data
      echo '<tr><td id="title"><strong>' . $row['title'] . '</strong></td>';
      echo '<td>' . $row['category'] . '</td>';
      echo '<td><a href="movie_edit.php?movieCode=' . $row['movieCode'].'">Edit</a></td>';
      echo '<td><a href="movie_delete.php?movieCode=' . $row['movieCode'] . '&amp;title=' . $row['title'] .
      '&amp;image=' . $row['image'] . '&amp;category=' . $row['category'] . '&amp;movieDesc=' .
      $row['movieDesc'] . '">Delete</a></td></tr>';
      }
      echo '</table>';
      
      mysqli_close($dbc);
      
}
require_once('admin_footer.php');     
?>
