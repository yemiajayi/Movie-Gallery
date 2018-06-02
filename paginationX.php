<?php
include_once('connectdb.php');
//Query to get the total count of rows
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from Database
  $query = "SELECT title,image,category,movieDesc FROM movie order by movieCode DESC";
  $data = mysqli_query($dbc, $query);
  $row = mysqli_fetch_row($data);
  //total row count
  $rows = $row[0];
  //Number of result displayed per page
  $page_rows = 5;
  //tell the page number of last page
  $last = ceil($rows/$page_rows);
  //make sure last can't be less than 1
  if($last < 1) {
      $last = 1
  }
  //Establish the $pagenum var
  $pagenum = 1;
  // get pagenum from url vars if it is present, else it is = 1
  if (isset($_GET['pn'])) {
  pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
  }
  //make sure the page isn't below 1 or more than the last page
  if($pagenum < 1) {
    $pagenum = 1;
    }
    else if($pagenum > $last) {
      $pagenum = $last;
      }
  //sets range of rows to query for chosen $pagenum
  $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
  //query again here
  $query2 = "SELECT firstName,lastName,dateOfBirth,nationality,image,otherInfo FROM artist order by artistId DESC";
  $data2 = mysqli_query($dbc, $query2);
  //show the user what page tey are on
  $textlines1 = "Testimonials (<b>$rows</b>)";
  $textlines2 = "Page <b>$pagenum</b> of <b>$last</b>";
  //if there is more than 1 page worth of results
  if ($last != 1) {
   /* check if on page 1. If no, generate links to 1st page, and to previous page. */
      if ($pagenum > 1) { 
        $previous = $pagenum - 1;
      } 
  }
  
?>