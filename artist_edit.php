<?php
session_start();
  // If session variables aren't set, try setting them with a cookie
  if (!isset($_SESSION['userId'])) {
    if (isset($_COOKIE['userId']) && isset($_COOKIE['username'])) {
      $_SESSION['userId'] = $_COOKIE['userId'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
<?php
 if (!isset($_SESSION['userId'])) {
require_once('header.php');
echo '<h3>Edit Artist</h3><hr>';


    echo '<p class="login">Please <a href="admin_login.php">log in</a> to access this page.</p>';
    
    exit();
  }
  else {
require_once('connectdb.php');
require_once('admin_header.php');
echo '<h3>Edit Artist</h3><hr>';
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="admin_logout.php">Log out</a>.</p>');
    
    //Connet to db
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

    // Grab the profile data from the database
    $artistId = intval($_GET['artistId']);
    $query = "SELECT firstName, lastName, dateOfBirth, nationality, otherInfo FROM artist WHERE artistId = '$artistId' ";
    $data = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($data)) {
      $firstname = $row['firstName'];
      $lastname = $row['lastName'];
      $birthdate = $row['dateOfBirth'];
      $nationality = $row['nationality'];
      $otherinfo = $row['otherInfo'];
      
      }
      
     if (isset($_POST['submit'])) {  
    // Grab artist data from the POST
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $DOB = $_POST['DOB'];
    $nationality = $_POST['nationality'];
    $otherinfo = $_POST['otherinfo'];
    $artistId = $_POST['artistId'];
       
      // Update the database
      $query = "UPDATE artist SET firstName='$firstname', lastName='$lastname', dateOfBirth='$DOB', nationality='$nationality', otherInfo='$otherinfo' WHERE artistId =  '" . $artistId . "'";
      mysqli_query($dbc, $query);

      // Confirm success with artist update
      echo '<p>The following artist has been updated successfully!</p>';
      echo '<p><strong>Name:</strong> ' . $firstname . ' ' . $lastname . '<br />';
      echo '<strong>Date Of Birth:</strong> ' . $DOB . '<br />';
      echo '<strong>Nationality:</strong> ' . $nationality . '</p>';
      echo '<p><a href="admin_artist_edit.php">&lt;&lt; Bact to Artist Edit/Delete page</a></p>';
    }
}
?>

 <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <p><label for="firstname">First Name:</label>
    <input type="text" id="name" name="firstname" value="<?php echo $firstname; ?>" autofocus /></p>
    
     <p><label for="lastname">Last Name:</label>
    <input type="text" id="name" name="lastname" value="<?php echo $lastname; ?>" /></p>
    
    <p><label for="DOB">Date Of Birth:</label>
    <input type="date" id="DOB" name="DOB" value="<?php echo $DOB; ?>" /></p>
    
     <p><label for="nationality">Nationality:</label>
    <!--<input type="text" id="nationality" name="nationality" value="<?php echo $nationality; ?>" /></p>-->
    <select id="nationality" name="nationality" />
<option value="<?php echo $nationality; ?>">Afghanistan</option>
<option value="<?php echo $nationality; ?>">Aland Islands</option>
<option value="<?php echo $nationality; ?>">Albania</option>
<option value="<?php echo $nationality; ?>">Algeria</option>
<option value="<?php echo $nationality; ?>">American Samoa</option>
<option value="<?php echo $nationality; ?>">Andorra</option>
<option value="<?php echo $nationality; ?>">Angola</option>
<option value="<?php echo $nationality; ?>">Anguilla</option>
<option value="<?php echo $nationality; ?>">Antarctica</option>
<option value="<?php echo $nationality; ?>">Antigua and Barbuda</option>
<option value="<?php echo $nationality; ?>">Argentina</option>
<option value="<?php echo $nationality; ?>">Armenia</option>
<option value="<?php echo $nationality; ?>">Aruba</option>
<option value="<?php echo $nationality; ?>">Australia</option>
<option value="<?php echo $nationality; ?>">Austria</option>
<option value="<?php echo $nationality; ?>">Azerbaijan</option>
<option value="<?php echo $nationality; ?>">Bahamas</option>
<option value="<?php echo $nationality; ?>">Bahrain</option>
<option value="<?php echo $nationality; ?>">Bangladesh</option>
<option value="<?php echo $nationality; ?>">Barbados</option>
<option value="<?php echo $nationality; ?>">Belarus</option>
<option value="<?php echo $nationality; ?>">Belgium</option>
<option value="<?php echo $nationality; ?>">Belize</option>
<option value="<?php echo $nationality; ?>">Benin</option>
<option value="<?php echo $nationality; ?>">Bermuda</option>
<option value="<?php echo $nationality; ?>">Bhutan</option>
<option value="<?php echo $nationality; ?>">Bolivia</option>
<option value="<?php echo $nationality; ?>">Bosnia and Herzegovina</option>
<option value="<?php echo $nationality; ?>">Botswana</option>
<option value="<?php echo $nationality; ?>">Bouvet Island</option>
<option value="<?php echo $nationality; ?>">Brazil</option>
<option value="<?php echo $nationality; ?>">British Indian Ocean Territory</option>
<option value="<?php echo $nationality; ?>">Brunei Darussalam</option>
<option value="<?php echo $nationality; ?>">Bulgaria</option>
<option value="<?php echo $nationality; ?>">Burkina Faso</option>
<option value="<?php echo $nationality; ?>">Burundi</option>
<option value="<?php echo $nationality; ?>">Cambodia</option>
<option value="<?php echo $nationality; ?>">Cameroon</option>
<option value="<?php echo $nationality; ?>">Canada</option>
<option value="<?php echo $nationality; ?>">Cape Verde</option>
<option value="<?php echo $nationality; ?>">Cayman Islands</option>
<option value="<?php echo $nationality; ?>">Central African Republic</option>
<option value="<?php echo $nationality; ?>">Chad</option>
<option value="<?php echo $nationality; ?>">Chile</option>
<option value="<?php echo $nationality; ?>">China</option>
<option value="<?php echo $nationality; ?>">Christmas Island</option>
<option value="<?php echo $nationality; ?>">Cocos (Keeling) Islands</option>
<option value="<?php echo $nationality; ?>">Colombia</option>
<option value="<?php echo $nationality; ?>">Comoros</option>
<option value="<?php echo $nationality; ?>">Congo</option>
<option value="<?php echo $nationality; ?>">Congo, The Democratic Republic of The</option>
<option value="<?php echo $nationality; ?>">Cook Islands</option>
<option value="<?php echo $nationality; ?>">Costa Rica</option>
<option value="<?php echo $nationality; ?>">Cote D'ivoire</option>
<option value="<?php echo $nationality; ?>">Croatia</option>
<option value="<?php echo $nationality; ?>">Cuba</option>
<option value="<?php echo $nationality; ?>">Cyprus</option>
<option value="<?php echo $nationality; ?>">Czech Republic</option>
<option value="<?php echo $nationality; ?>">Denmark</option>
<option value="<?php echo $nationality; ?>">Djibouti</option>
<option value="<?php echo $nationality; ?>">Dominica</option>
<option value="<?php echo $nationality; ?>">Dominican Republic</option>
<option value="<?php echo $nationality; ?>">Ecuador</option>
<option value="<?php echo $nationality; ?>">Egypt</option>
<option value="<?php echo $nationality; ?>">El Salvador</option>
<option value="<?php echo $nationality; ?>">Equatorial Guinea</option>
<option value="<?php echo $nationality; ?>">Eritrea</option>
<option value="<?php echo $nationality; ?>">Estonia</option>
<option value="<?php echo $nationality; ?>">Ethiopia</option>
<option value="<?php echo $nationality; ?>">Falkland Islands (Malvinas)</option>
<option value="<?php echo $nationality; ?>">Faroe Islands</option>
<option value="<?php echo $nationality; ?>">Fiji</option>
<option value="<?php echo $nationality; ?>">Finland</option>
<option value="<?php echo $nationality; ?>">France</option>
<option value="<?php echo $nationality; ?>">French Guiana</option>
<option value="<?php echo $nationality; ?>">French Polynesia</option>
<option value="<?php echo $nationality; ?>">French Southern Territories</option>
<option value="<?php echo $nationality; ?>">Gabon</option>
<option value="<?php echo $nationality; ?>">Gambia</option>
<option value="<?php echo $nationality; ?>">Georgia</option>
<option value="<?php echo $nationality; ?>">Germany</option>
<option value="<?php echo $nationality; ?>">Ghana</option>
<option value="<?php echo $nationality; ?>">Gibraltar</option>
<option value="<?php echo $nationality; ?>">Greece</option>
<option value="<?php echo $nationality; ?>">Greenland</option>
<option value="<?php echo $nationality; ?>">Grenada</option>
<option value="<?php echo $nationality; ?>">Guadeloupe</option>
<option value="<?php echo $nationality; ?>">Guam</option>
<option value="<?php echo $nationality; ?>">Guatemala</option>
<option value="<?php echo $nationality; ?>">Guernsey</option>
<option value="<?php echo $nationality; ?>">Guinea</option>
<option value="<?php echo $nationality; ?>">Guinea-bissau</option>
<option value="<?php echo $nationality; ?>">Guyana</option>
<option value="<?php echo $nationality; ?>">Haiti</option>
<option value="<?php echo $nationality; ?>">Heard Island and Mcdonald Islands</option>
<option value="<?php echo $nationality; ?>">Holy See (Vatican City State)</option>
<option value="<?php echo $nationality; ?>">Honduras</option>
<option value="<?php echo $nationality; ?>">Hong Kong</option>
<option value="<?php echo $nationality; ?>">Hungary</option>
<option value="<?php echo $nationality; ?>">Iceland</option>
<option value="<?php echo $nationality; ?>">India</option>
<option value="<?php echo $nationality; ?>">Indonesia</option>
<option value="<?php echo $nationality; ?>">Iran, Islamic Republic of</option>
<option value="<?php echo $nationality; ?>">Iraq</option>
<option value="<?php echo $nationality; ?>">Ireland</option>
<option value="<?php echo $nationality; ?>">Isle of Man</option>
<option value="<?php echo $nationality; ?>">Israel</option>
<option value="<?php echo $nationality; ?>">Italy</option>
<option value="<?php echo $nationality; ?>">Jamaica</option>
<option value="<?php echo $nationality; ?>">Japan</option>
<option value="<?php echo $nationality; ?>">Jersey</option>
<option value="<?php echo $nationality; ?>">Jordan</option>
<option value="<?php echo $nationality; ?>">Kazakhstan</option>
<option value="<?php echo $nationality; ?>">Kenya</option>
<option value="<?php echo $nationality; ?>">Kiribati</option>
<option value="<?php echo $nationality; ?>">Korea, Democratic People's Republic of</option>
<option value="<?php echo $nationality; ?>">Korea, Republic of</option>
<option value="<?php echo $nationality; ?>">Kuwait</option>
<option value="<?php echo $nationality; ?>">Kyrgyzstan</option>
<option value="<?php echo $nationality; ?>">Lao People's Democratic Republic</option>
<option value="<?php echo $nationality; ?>">Latvia</option>
<option value="<?php echo $nationality; ?>">Lebanon</option>
<option value="<?php echo $nationality; ?>">Lesotho</option>
<option value="<?php echo $nationality; ?>">Liberia</option>
<option value="<?php echo $nationality; ?>">Libyan Arab Jamahiriya</option>
<option value="<?php echo $nationality; ?>">Liechtenstein</option>
<option value="<?php echo $nationality; ?>">Lithuania</option>
<option value="<?php echo $nationality; ?>">Luxembourg</option>
<option value="<?php echo $nationality; ?>">Macao</option>
<option value="<?php echo $nationality; ?>">Macedonia, The Former Yugoslav Republic of</option>
<option value="<?php echo $nationality; ?>">Madagascar</option>
<option value="<?php echo $nationality; ?>">Malawi</option>
<option value="<?php echo $nationality; ?>">Malaysia</option>
<option value="<?php echo $nationality; ?>">Maldives</option>
<option value="<?php echo $nationality; ?>">Mali</option>
<option value="<?php echo $nationality; ?>">Malta</option>
<option value="<?php echo $nationality; ?>">Marshall Islands</option>
<option value="<?php echo $nationality; ?>">Martinique</option>
<option value="<?php echo $nationality; ?>">Mauritania</option>
<option value="<?php echo $nationality; ?>">Mauritius</option>
<option value="<?php echo $nationality; ?>">Mayotte</option>
<option value="<?php echo $nationality; ?>">Mexico</option>
<option value="<?php echo $nationality; ?>">Micronesia, Federated States of</option>
<option value="<?php echo $nationality; ?>">Moldova, Republic of</option>
<option value="<?php echo $nationality; ?>">Monaco</option>
<option value="<?php echo $nationality; ?>">Mongolia</option>
<option value="<?php echo $nationality; ?>">Montenegro</option>
<option value="<?php echo $nationality; ?>">Montserrat</option>
<option value="<?php echo $nationality; ?>">Morocco</option>
<option value="<?php echo $nationality; ?>">Mozambique</option>
<option value="<?php echo $nationality; ?>">Myanmar</option>
<option value="<?php echo $nationality; ?>">Namibia</option>
<option value="<?php echo $nationality; ?>">Nauru</option>
<option value="<?php echo $nationality; ?>">Nepal</option>
<option value="<?php echo $nationality; ?>">Netherlands</option>
<option value="<?php echo $nationality; ?>">Netherlands Antilles</option>
<option value="<?php echo $nationality; ?>">New Caledonia</option>
<option value="<?php echo $nationality; ?>">New Zealand</option>
<option value="<?php echo $nationality; ?>">Nicaragua</option>
<option value="<?php echo $nationality; ?>">Niger</option>
<option value="<?php echo $nationality; ?>">Nigeria</option>
<option value="<?php echo $nationality; ?>">Niue</option>
<option value="<?php echo $nationality; ?>">Norfolk Island</option>
<option value="<?php echo $nationality; ?>">Northern Mariana Islands</option>
<option value="<?php echo $nationality; ?>">Norway</option>
<option value="<?php echo $nationality; ?>">Oman</option>
<option value="<?php echo $nationality; ?>">Pakistan</option>
<option value="<?php echo $nationality; ?>">Palau</option>
<option value="<?php echo $nationality; ?>">Palestinian Territory, Occupied</option>
<option value="<?php echo $nationality; ?>">Panama</option>
<option value="<?php echo $nationality; ?>">Papua New Guinea</option>
<option value="<?php echo $nationality; ?>">Paraguay</option>
<option value="<?php echo $nationality; ?>">Peru</option>
<option value="<?php echo $nationality; ?>">Philippines</option>
<option value="<?php echo $nationality; ?>">Pitcairn</option>
<option value="<?php echo $nationality; ?>">Poland</option>
<option value="<?php echo $nationality; ?>">Portugal</option>
<option value="<?php echo $nationality; ?>">Puerto Rico</option>
<option value="<?php echo $nationality; ?>">Qatar</option>
<option value="<?php echo $nationality; ?>">Reunion</option>
<option value="<?php echo $nationality; ?>">Romania</option>
<option value="<?php echo $nationality; ?>">Russian Federation</option>
<option value="<?php echo $nationality; ?>">Rwanda</option>
<option value="<?php echo $nationality; ?>">Saint Helena</option>
<option value="<?php echo $nationality; ?>">Saint Kitts and Nevis</option>
<option value="<?php echo $nationality; ?>">Saint Lucia</option>
<option value="<?php echo $nationality; ?>">Saint Pierre and Miquelon</option>
<option value="<?php echo $nationality; ?>">Saint Vincent and The Grenadines</option>
<option value="<?php echo $nationality; ?>">Samoa</option>
<option value="<?php echo $nationality; ?>">San Marino</option>
<option value="<?php echo $nationality; ?>">Sao Tome and Principe</option>
<option value="<?php echo $nationality; ?>">Saudi Arabia</option>
<option value="<?php echo $nationality; ?>">Senegal</option>
<option value="<?php echo $nationality; ?>">Serbia</option>
<option value="<?php echo $nationality; ?>">Seychelles</option>
<option value="<?php echo $nationality; ?>">Sierra Leone</option>
<option value="<?php echo $nationality; ?>">Singapore</option>
<option value="<?php echo $nationality; ?>">Slovakia</option>
<option value="<?php echo $nationality; ?>">Slovenia</option>
<option value="<?php echo $nationality; ?>">Solomon Islands</option>
<option value="<?php echo $nationality; ?>">Somalia</option>
<option value="<?php echo $nationality; ?>">South Africa</option>
<option value="<?php echo $nationality; ?>">South Georgia and The South Sandwich Islands</option>
<option value="<?php echo $nationality; ?>">Spain</option>
<option value="<?php echo $nationality; ?>">Sri Lanka</option>
<option value="<?php echo $nationality; ?>">Sudan</option>
<option value="<?php echo $nationality; ?>">Suriname</option>
<option value="<?php echo $nationality; ?>">Svalbard and Jan Mayen</option>
<option value="<?php echo $nationality; ?>">Swaziland</option>
<option value="<?php echo $nationality; ?>">Sweden</option>
<option value="<?php echo $nationality; ?>">Switzerland</option>
<option value="<?php echo $nationality; ?>">Syrian Arab Republic</option>
<option value="<?php echo $nationality; ?>">Taiwan, Province of China</option>
<option value="<?php echo $nationality; ?>">Tajikistan</option>
<option value="<?php echo $nationality; ?>">Tanzania, United Republic of</option>
<option value="<?php echo $nationality; ?>">Thailand</option>
<option value="<?php echo $nationality; ?>">Timor-leste</option>
<option value="<?php echo $nationality; ?>">Togo</option>
<option value="<?php echo $nationality; ?>">Tokelau</option>
<option value="<?php echo $nationality; ?>">Tonga</option>
<option value="<?php echo $nationality; ?>">Trinidad and Tobago</option>
<option value="<?php echo $nationality; ?>">Tunisia</option>
<option value="<?php echo $nationality; ?>">Turkey</option>
<option value="<?php echo $nationality; ?>">Turkmenistan</option>
<option value="<?php echo $nationality; ?>">Turks and Caicos Islands</option>
<option value="<?php echo $nationality; ?>">Tuvalu</option>
<option value="<?php echo $nationality; ?>">Uganda</option>
<option value="<?php echo $nationality; ?>">Ukraine</option>
<option value="<?php echo $nationality; ?>">United Arab Emirates</option>
<option value="<?php echo $nationality; ?>">United Kingdom</option>
<option value="<?php echo $nationality; ?>">United States</option>
<option value="<?php echo $nationality; ?>">United States Minor Outlying Islands</option>
<option value="<?php echo $nationality; ?>">Uruguay</option>
<option value="<?php echo $nationality; ?>">Uzbekistan</option>
<option value="<?php echo $nationality; ?>">Vanuatu</option>
<option value="<?php echo $nationality; ?>">Venezuela</option>
<option value="<?php echo $nationality; ?>">Viet Nam</option>
<option value="<?php echo $nationality; ?>">Virgin Islands, British</option>
<option value="<?php echo $nationality; ?>">Virgin Islands, U.S.</option>
<option value="<?php echo $nationality; ?>">Wallis and Futuna</option>
<option value="<?php echo $nationality; ?>">Western Sahara</option>
<option value="<?php echo $nationality; ?>">Yemen</option>
<option value="<?php echo $nationality; ?>">Zambia</option>
<option value="<?php echo $nationality; ?>">Zimbabwe</option>
    <select></p>
    
     <p><label for="otherInfo">Other Info:</label>
    <textarea name="otherinfo" row="50" col="80" value="<?php echo $otherinfo; ?>" /></textarea></p>
    
    <input type="hidden" name="artistId" value="<?php echo $artistId; ?>" />
    
    <hr />
    <input type="submit" value="Save changes" name="submit" id="submit" />
  </form>

<?php
 require_once('admin_footer.php'); 
?>