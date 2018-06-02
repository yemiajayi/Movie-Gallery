<?php
 require_once('connectdb.php');
 //connect to the database
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 if (isset($_POST['submit'])) {
 //Grab profile data from the POST
 
 $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
 $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
 $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
 $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
 $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
 
 if (!empty($firstname) && !empty($lastname) && !empty($username) &&
    !empty($password1) && !empty($password2) && ($password1 == $password2)) {
    
    //Be sure username hasn't already been used
    
    $query = "SELECT * FROM user WHERE username = '$username'";
    
    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 0) {
    //Username is unique, insert the data into the database
    $query = "INSERT INTO user (firstName, lastName, username, password)" .
    "VALUES('$firstname', '$lastname', '$username', sha1('$password1'))";
    
    mysqli_query($dbc, $query);
    
    //confirm success with the user
    echo '<p>new account has been successfully created. <a href="edit_profile.php"> ' .
    'Edit profile</a>.</p>';
    
    mysqli_close($dbc);
    exit();
    }
    else {
      //An account already exists for this username, so display error message
      echo '<p>This username has been used. Please try another username</p>';
      $username = "";
      }
    }
    else {
      echo '<p>Please enter the missing data(a), including the desired password twice.</p>';
      } 
 }
 
 mysqli_close($dbc);
 require_once('admin_header.php');
 echo '<h3>Sign-up Admin</h3>';
?>

<p>Please fill the following fields to sign up a new user.</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <fieldset>
    <legend>Sign-up</legend>
    
    <p><label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="<?php if (!empty($firstname)) echo $firstname;?>" /></p>
    
    <p><label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="<?php if (!empty($lastname)) echo $lastname;?>" /></p>
    
    <p><label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username;?>" /></p>
    
    <p><label for="password1">Password:</label>
    <input type="password" id="password1" name="password1" /></p>
    
    <p><label for="password2">Confirm Password:</label>
    <input type="password" id="password2" name="password2" /></p>  
  </fieldset>
   <input type="submit" name="submit" value="sign up" id="submit" />
</form>

<?php
require_once('admin_footer.php');
?>