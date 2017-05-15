<?php
session_start();
include 'header.php';
if (isset($_SESSION['user'])){
	header("Location: finalproject.php");
	die();
}else{
	session_destroy();
}
?>

	<h4>Login</h4>
	<form action = "log_in.php" method = "POST">
	Username: <input type = "text" id = "uname" name = "uname"/>
	<br>
	Password: <input type = "password" id = "pword" name = "pword"/>
	<input type = "submit" value = "Login">
	</form>
<?php
include 'footer.php';
?>