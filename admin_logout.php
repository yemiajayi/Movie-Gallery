<?php
//if user is logged in, log them out by deleting the session variables to log them out
session_start();
  if (isset($_SESSION['userId'])) {
  //Delete the session variables by clearing the $_SESSION array
  $_SESSION = array();
  
  //Delete the session cookies by setting its expirations to an hour ago (3600secs)
  if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(),'', time() - 3600);
  }
  
  //Destroy the session
  session_destroy();
  }
  
  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  setcookie('userId', '', time() - 3600);
  setcookie('username', '', time() - 3600);
  
  //Redirect to the homepage
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . ' /index.php';
  header('Location: ' . $home_url);

?>