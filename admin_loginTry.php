<?php
session_start();  
require_once('connectdb.php');
 //clear the error message
 $error_msg = "";
 
//if user not logged in, try log them in
 if (!isset($_SESSION['userId'])) {
    if (isset($_POST['submit'])) { 
    
 
//Connect to db
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Grab login data
$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
 
if(!empty($user_username) && !empty($user_password)) {
//check username and password in the db
$query = "SELECT userId, username FROM user WHERE username = '$user_username' AND password = SHA1('$user_password')";
$data = mysqli_query($dbc, $query);


if (mysqli_num_rows($data) == 1) {
//If login ok, set u-ID & username session vars (and cookies), then redirect h-page
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
    echo '<p>' . $error_msg . '</p>';
   }
  else {
    //Confirm the successful log in
    echo('<p>You are logged in as ' . $_SESSION['username'] . '.</p>');
    }
?>

<!doctype html>
<html>
<head>
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/new3.js"></script>
<script type="text/javascript" src="js/new4.js"></script>
<script>
function login() {
var username = $("username").value;
var password = $("password").value;
if (username == "" || password == ""){
_("response").innerHTML = "Please fill all fields";
} else {
_("loginbutton").style.display = "none";
_("response").innerHTML = "Processing...";
var ajax = ajaxObj("POST", "admin_login.php");
ajax.onreadystatechange = function() {
if(ajaxReturn(ajax) == true) {
if (ajax.responseText == "login_ok") {
window.location = "index.php";
} else {
_("response").innerHTML = "Login failed";

_("loginbutton").style.display = "block";

}

}
}
}
ajax.send("username="+username+"&password="+password);
}
function emptyElement(x){

 _(x).innerHTML = "";

}
</script>

</head>
<body>
<?php include_once('header.php'); ?>
<h3>User - Log In</h3>  

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend>Log In</legend>
        <p><label for="username">Username:</label>
        <input type="text”  id="username" name="username" /></p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" /><br >
      </fieldset>
      <button id="loginbutton" onclick="login()">Log In</button>
    </form>
<span id="response"></span>
<? php include_once("footer.php");  ?>
</body>
</html>