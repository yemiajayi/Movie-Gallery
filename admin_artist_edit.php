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
echo '<h3>Edit/Delete Artist</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Edit/Delete Artist</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
      
      // Connect to the database
      $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      
      //retrieve the artist data from MySQL
      
      $query = " SELECT * FROM artist ORDER BY artistId DESC";
      $data = mysqli_query($dbc, $query);
      
      // Loop through the array of artist data, formatting it as HTML
      echo '<table>';
      
      while ($row = mysqli_fetch_array($data)) {
      // Display artist data
      echo '<tr><td id="artist">' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
      echo '<td>' . $row['dateOfBirth'] . '</td>';
      echo '<td>' . $row['nationality'] . '</td>';
      echo '<td><a href="artist_edit.php?artistId=' . $row['artistId'] . '&amp;firstName=' . $row['firstName'] .
      '&amp;lastName=' . $row['lastName'] . '&amp;nationality=' . $row['nationality'] . '&amp;otherInfo=' .
      $row['otherInfo'] . '">Edit</a></td>';
      echo '<td><a href="artist_delete.php?artistId=' . $row['artistId'] . '&amp;firstName=' . $row['firstName'] .
      '&amp;lastName=' . $row['lastName'] . '&amp;nationality=' . $row['nationality'] . '&amp;otherInfo=' .
      $row['otherInfo'] . '">Delete</a></td></tr>';
      }
      echo '</table>';
      
      mysqli_close($dbc);
}
 require_once('admin_footer.php');     
?>