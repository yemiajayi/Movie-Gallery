<?php
include('header.php');
require_once('connectdb.php');

$error_msg = "";
  if(isset($_POST['searchoption']) &&  isset($_POST['submit']) && $_POST['usersearch'] != "") {
  
  //connect to db
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  
  $word = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['usersearch']);
  
  if ($_POST['searchoption'] == 'All') {
  $query = "(SELECT firstName AS first, lastName AS last, image AS detail, otherInfo AS other FROM artist WHERE firstName LIKE '%$word%' OR lastName LIKE '%$word%' OR nationality LIKE '%$word%' OR otherInfo LIKE '%$word%')
   UNION
  (SELECT title AS first, category AS last, image AS detail, movieDesc AS other FROM movie WHERE title LIKE '%{$word}%' OR category LIKE '%{$word}%' OR movieDesc LIKE '%{$word}%')";  
  $result = mysqli_query($dbc, $query);
  while($row = mysqli_fetch_array($result)) {
  
  echo '<table>'; 
    echo '<tr><td id="title">' . $row['first'] . '</td>';
    echo '<td width="80px">' . $row['last'] . '</td>';
    echo '<td><img src="' . MG_UPLOADPATH . $row['detail'] . '" alt="artist image" width="160px" height="180px" /></td>';
    echo '<td>' . $row['other'] . '</td></tr>';
  echo '</table>';
    }
  }
  
  elseif ($_POST['searchoption'] == 'Artist') {
  //select the row that contains ANYTHING like the submitted string
  $query = "SELECT * FROM artist WHERE firstName LIKE '%$word%' OR lastName LIKE '%$word%' OR nationality LIKE '%$word%' OR otherInfo LIKE '%$word%' ";

  $result = mysqli_query($dbc, $query);
  echo '<table>';
  echo '<tr><th>' . 'Name' . '</th>';
  echo '<th width="90px">' . 'Birthday' . '</th>';
  echo '<th></th>';
  echo '<th>' . 'Other Info' . '</th></tr>';
  
        while($row = mysqli_fetch_array($result)) {

  echo '<tr>';
    echo '<td  id="artist">' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
    echo '<td>' . $row['dateOfBirth'] . '</td>';
    echo '<td><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="artist image" width="150px" height="180px" /></td>';
    echo '<td>' . $row['otherInfo'] . '</td>';
    echo '</tr>';
    }
    echo '</table>';
  }
  elseif ($_POST['searchoption'] == 'Movie') {
  
  //select the row that contains ANYTHING like the submitted string
  $query = "SELECT * FROM movie WHERE title LIKE '%{$word}%' OR category LIKE '%{$word}%' OR movieDesc LIKE '%{$word}%' ";
  $result = mysqli_query($dbc, $query);
  echo '<table>';
  echo '<tr><th>' . 'Title' . '</th>';
  echo '<th>' . 'Image' . '</th>';
  echo '<th>' . 'Category' . '</th>';
  echo '<th>' . 'Description' . '</th></tr>';

  while($row = mysqli_fetch_array($result)) {

  echo '<tr>';
    echo '<td  id="artist">' . $row['title'] . '</td>';
    echo '<td><img src="' . MG_UPLOADPATH . $row['image'] . '" alt="movie image" width="160px" height="180px" /></td>';
    echo '<td>' . $row['category'] . '</td>';
    echo '<td>' . $row['movieDesc'] . '</td>';
    echo '</tr>';
     }
      echo '</table>';    
    }
    else { $error_msg = "0 result found for";} 
     }
     else {$error_msg = "No search query was submitted!";}
    
include('footer.php');
?>

 