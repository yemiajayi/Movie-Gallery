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
echo '<h3>Artist List</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Artist List</h3><hr>';
    echo('<p class="login">You are logged in as ' . '<b>' . $_SESSION['username'] . '</b></p>');
  
echo '<p><a href="admin_artist_add.php">Add Artist   </a>|<a href="admin_artist_edit.php">   Edit Artist</a></p><hr>';
  
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from Database
  $query = "SELECT firstName,lastName,dateOfBirth,nationality,image,otherInfo FROM artist order by artistId DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of artist data, formatting it as HTML 
  echo '<table>';
  echo '<tr><th></th>';
  echo '<th>' . 'Name' . '</th>';
  echo '<th width="90px">' . 'Birthday' . '</th>';
  echo '<th>' . 'Nationality' . '</th>';
  echo '<th>' . 'Other Info' . '</th></tr>';
include_once('paginationA.php');
  while ($row = mysqli_fetch_array($data2)) { 
    // Display the artist data
	if (is_file(MG_UPLOADPATH . $row['image']) && filesize(MG_UPLOADPATH . $row['image']) > 0) {
    echo '<tr><td><a href=""><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="artist image" width="150px" height="180px" /></a></td>';
    }
    else {
      echo '<td><img src="' . MG_UPLOADPATH . 'unverified.gif' .
      '" alt="unverified image" width="160px" height="180px" /></td>';
      }
    echo '<td  id="artist"><a href="">' . $row['firstName'] . ' ' . $row['lastName'] . '</a></td>';
    echo '<td>' . $row['dateOfBirth'] . '</td>';
    echo '<td>' . $row['nationality'] . '</td>';
	echo '<td>' . $row['otherInfo'] . '</td></tr>';
    }           
  echo '</table>';

  mysqli_close($dbc);
  
}

 require_once('admin_footer.php');
?>
  