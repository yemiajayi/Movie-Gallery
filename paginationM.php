<?php

  //Get total num rows from db query
  $nr = mysqli_num_rows($data);
  //Get page num from URL vars if present
  if(isset($_GET['pn'])) {
  //filter all but numbers
  $pn = preg_replace('#[^0-9]#i','',$_GET['pn']); 
  }
  else {
  //if pn URL var isn't present force it to be value of page number 1
  $pn = 1;}
  //Limit db item displayed per page
  $itemsPerPage = 5;
  // Get value of last page in pagination result set
  $lastPage = ceil($nr/$itemsPerPage);
  //Be sure URL var $pn isn't lower than 1 and not higher than $lastpage
  if($pn < 1) {
    $pn = 1;
    }
    else if($pn > $lastPage) {
      $pn = $lastPage;
      }
    //create number to click btw next and back buttons
    $centerPages = ""; //initialize this variable
    $sub1 = $pn - 1;
    $sub2 = $pn - 2;
    $add1 = $pn + 1;
    $add2 = $pn + 2;
    
    if($pn == 1) {
      $centerPages .= '&nbsp; <span class="pageNumActive">' . $pn . '</span> &nbsp;';
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    }
    else if ($pn == $lastPage) {
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
      $centerPages .= '&nbsp; <span class="pageNumActive">' . $pn . '</span> &nbsp;';
    }
    else if ($pn > 2 && $pn < ($lastPage - 1)) {
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
      $centerPages .= '&nbsp; <span class="pageNumActive">' . $pn . '</span> &nbsp;';
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
      }
    else if ($pn > 1 && $pn < $lastPage) {
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
      $centerPages .= '&nbsp; <span class="pageNumActive">' . $pn . '</span> &nbsp;';
      $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    }
    //Set the limit range, placing two values to choose range of rows from db in query
    $limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
    $query2 = "SELECT title,image,category,movieDesc FROM movie order by movieCode DESC $limit";
    $data2 = mysqli_query($dbc, $query2);
    //Pagination Display setup
    $paginationDisplay = "";
    //runs only if last page is not equal to 1, no pagination is required if page is only 1
    if ($lastPage != 1) {
      $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '<img src"images/clearImage.gif" width="48" height="1" alt="Spacer" />';
      if ($pn != 1) {
      $previous = $pn - 1;
      $paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '">Back</a>';
      }
      //clickable numbers display here btw back and next links
      $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
      if ($pn != $lastPage) {
      $nextPage = $pn + 1;
      $paginationDisplay .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a>';
      }
    }

echo $paginationDisplay;

?>