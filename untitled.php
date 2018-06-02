<?php
session_start();
?>
 
<?php 
 require_once('untitledcon.php'); 

 //clear the error message
 $error_msg = "";
 
 //if user isn't logged in, try to log them in
 if (!isset($_SESSION['userId'])) { 
    if (isset($_POST['submit'])) { 
 
 //Connect to the database
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 //Grab the entered login data
 $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
 $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
 
 if(!empty($user_username) && !empty($user_password)) {
 //look up the username and password in the database
 $query = "SELECT userId, username FROM user WHERE username = '$user_username' AND password = SHA('$user_password')";
 $data = mysqli_query($dbc, $query);
 
 if (mysqli_num_rows($data) == 1) {
 //The login is ok, set user ID and username cookies, then redirect to the home page
 $row = mysqli_fetch_array($data);
 $_SESSION['userId'] = $row['userId'];
 $_SESSION['username'] = $row['username'];
 setcookie('userId', $row['userId'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
 setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
 header('Location: ' . $home_url);
 }
 else {
  //Username or password are incorrect, so set an error message
  $error_msg = 'Please enter a valid username and password to access this page.';
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
require_once('untitledheader.php'); 
echo '<h3>User - Log In</h3>';
?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend>Log In</legend>
        <p><label for="username">Username:</label>
        <input type="text id="username" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /></p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" /><br >
      </fieldset>
      <input type="submit" value="Log In" name="submit" id="submit" />
    </form>

<?php
// If session variable is empty, show any error message and the log-in form; otherwise confirm the log-in
if (empty($_SESSION['userId'])) {
  echo '<p>' . $error_msg . '</p>';
   }
  else {
    //Confirm the successful log in
    echo('<p>You are logged in as ' . $_SESSION['username'] . '.</p>');
    }
 require_once('admin_footer.php');  
?>