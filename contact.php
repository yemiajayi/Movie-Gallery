<?php
require_once('header.php');
echo '<h3>Contact Us</h3>';

  if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $to = 'yemi.oa@gmail.com';

if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
// Code to send the email
  
  mail($to, $subject, $message, 'From:' . $email);
  echo '<p>Thanks, your request has been successfully forwarded to us.</p>';
      $name = "";
      $email = "";
      $subject = "";
      $message = "";

   }
   else {echo 'Please fill the missing information(s).<br />'; }
 }
?>
   <hr />
   <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      
        <p><label for="name">Names: </label>
        <input type="text" id="name" name="name"  value="<?php if (!empty($name)) echo $name; ?>" autofocus></p>
      
        <p><label for="email adrress">Email Address: </label>
        <input type="text" id="email" name="email"  value="<?php if (!empty($email)) echo $email; ?>"></p>
      
        <p><label for="subject">Subject: </label>
        <input type="text" id="subject" name="subject"  value="<?php if (!empty($subject)) echo $subject; ?>"></p>
        
        <p><label for="message">Message: </label>
        <textarea id="message" name="message" row="50" col="80"><?php if (!empty($message)) echo $message; ?></textarea></p>
        
        <hr />
        <input type="submit" name="submit" value="send" id="submit">
    </fieldset>
      
    </form>  
<?php
require_once('footer.php');
?>