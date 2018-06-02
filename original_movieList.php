<?php
 require_once('admin_header.php');

echo '<h3>Movie List</h3>';
echo '<p><a href="admin_movie_add.php">Add Movies</a></p><hr />';

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from Database
  $query = "SELECT title,image,category,movieDesc FROM movie order by movieCode DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of movie data, formatting it as HTML 
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the movie data
    echo '<tr><td>';
    echo '<strong>Title:</strong> ' . $row['title'] . '<br />';
    echo '<strong>Category:</strong> ' . $row['category'] . '<br />';
    echo '<strong>Description:</strong> ' . $row['movieDesc'] . '</td>';
  
    if (is_file(MG_UPLOADPATH . $row['image']) && filesize(MG_UPLOADPATH . $row['image']) > 0) {
    echo '<td><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="movie image" height="140px" width="140px" /></td></tr>';
    }
    else {
      echo '<td><img src="' . MG_UPLOADPATH . 'unverified.gif' .
      '" alt="unverified image" /></td></tr>';
      }
    }
  echo '</table>';

  mysqli_close($dbc);
require_once('admin_footer.php');
?>