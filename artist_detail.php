<?php
require_once('connectdb.php');
require_once('header.php');
echo '<h3>Artist List</h3><hr>';
  
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
    echo '<td  id="artist"><a href="artist_profile.php?artistId=' . $row['artistId'] . '&amp;firstName=' . $row['firstName'] .
      '&amp;lastName=' . $row['lastName'] . '&amp;nationality=' . $row['nationality'] . '&amp;otherInfo=' .
      $row['otherInfo'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</a></td>';
    echo '<td>' . $row['dateOfBirth'] . '</td>';
    echo '<td>' . $row['nationality'] . '</td>';
	echo '<td>' . $row['otherInfo'] . '</td></tr>';
    }           
  echo '</table>';

  mysqli_close($dbc);

 require_once('footer.php');
?>
  