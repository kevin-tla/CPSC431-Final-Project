<?php
include 'header.php';
?>
	<h4>Registration</h4>
	<form action = "register.php" method = "POST">
	Full Name: <input type = "text" id = "fullname" name = "fullname"/>
	<br>
	Username: <input type = "text" id = "uname" name = "uname"/>
	<br>
	Password: <input type = "password" id = "pword" name = "pword"/>
	<input type = "submit" value = "Register">
	</form>
<?php
include 'footer.php';
?>