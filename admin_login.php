<?php
session_start();  
require_once('connectdb.php');
 //clear the error message
 $error_msg = "";
 
//if user not logged in, try log them in
 if (!isset($_SESSION['userId'])) { 
    if (isset($_POST['submit']))  {
    
 
//Connect to db
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Grab login data
$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
 
if(!empty($user_username) && !empty($user_password)) {
//check username and password in the db
$query = "SELECT userId, username FROM user WHERE username = '$user_username' AND password = SHA1('$user_password')";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) == 1) {
//If login ok, set u-ID & username session vars (and cookies), then redirect h-page
$row = mysqli_fetch_array($result);
$_SESSION['userId'] = $row['userId'];
$_SESSION['username'] = $row['username'];

 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
 header('Location: ' . $home_url);
 }
 else {
        // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
      }
 }
 else {
  //Username or password wasn't entered, set an error message
  $error_msg = 'Sorry, you must enter your username and password to log in.';
   }
  }
 }
?>

<?php 
// If session variable is empty, show any error message and the log-in form; otherwise confirm the log-in
if (empty($_SESSION['userId'])) {
    include('header.php');
    echo '<h3>User - Log In</h3>'; 
    echo '<p>' . $error_msg . '</p>';
?>
<!--form for signing in-->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend>Log In</legend>
        <p><label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" autofocus /></p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <input id="toggleBtn" type="button" onclick="togglePassword()" value="Show">
      </fieldset><br />
      <input type="submit" value="Log In" name="submit" id="submit" />
    </form>

<?php
 }
  else {
     include('admin_header.php');
    //Confirm the successful log in
    echo('<p>You are logged in as ' . $_SESSION['username'] . '.</p>');
    echo '&#10084; <a href="admin_logout.php">Log Out</a>';
    }
include('footer.php');  
?>       