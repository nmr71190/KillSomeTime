register.php
 
<?php
require('config.php');
 
if (isset($_POST['submit']))
{
 $email1 = $_POST['email1'];
 $email2 = $_POST['email2'];
 $pass1 = $_POST['pass1'];
 $pass2 = $_POST['pass2'];
 
 if($email1 == $email2 && $pass1 == $pass2)
 {
   //All good
   $name = mysql_escape_string($_POST['name']);
   $lname = mysql_escape_string($_POST['lname']);
   $uname = mysql_escape_string($_POST['uname']);
   $email1 = mysql_escape_string($_POST['email1']);
   $email2 = mysql_escape_string($_POST['email2']);
   $pass1 = mysql_escape_string($_POST['pass1']);
   $pass2 = mysql_escape_string($_POST['pass2']);
 
   $pass1 = md5($pass1);
   //Check if username is taken
   $check = mysql_query("SELECT * FROM users WHERE uname = '$uname'")or die(mysql_error());
   if (mysql_num_rows($check)>=1) echo "Username already taken";
   //Put everyting in DB
   else{
   mysql_query("INSERT INTO `users` (`id`, `name`, `lname`, `uname`, `email`, `pass`) VALUES (NULL, '$name', '$lname', '$uname', '$email1', '$pass1')") or die(mysql_error());
   echo "Registration Successful";
   }
 }
 else{
  echo "Sorry, your email's or your passwords do not match. <br />";
 }
 
 
 
 
}
else{
$form = <<<EOT
<form action="register.php" method="POST">
First Name: <input type="text" name="name" /><br />
Last Name: <input type="text" name="lname" /><br />
Username: <input type="text" name="uname" /><br />
Email: <input type="text" name="email1" /><br />
Confirm Email: <input type="text" name="email2" /><br />
Password: <input type="password" name="pass1" /><br />
Confirm Password: <input type="password" name="pass2" /><br />
<input type="submit" value="Register" name="submit" />
</form>
EOT;
 
echo $form;
 
}
 
?>