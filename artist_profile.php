<?php
//connect to db
require_once('connectdb.php');
require_once('header.php');

$artistId = intval($_GET['artistId']);
 $query = "SELECT firstName,lastName,dateOfBirth,nationality,image,otherInfo FROM artist WHERE artistId = '$artistId' ";
  $data = mysqli_query($dbc, $query);
  
  while ($row = mysqli_fetch_array($data)) {
    echo '<tr><td><a href=""><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="artist image" width="200px" height="250px" /></a></td>';
    echo '<td  id="artist"><a href="">' . $row['firstName'] . ' ' . $row['lastName'] . '<br />';
    echo $row['dateOfBirth'] . '<br />';
    echo $row['nationality'] . '<br />';
	  echo $row['otherInfo'] . '</td></tr>';
  }
  
require_once('footer.php');
?>