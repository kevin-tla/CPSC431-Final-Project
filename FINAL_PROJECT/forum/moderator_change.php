<?php
session_start();
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
if(!isset($_SESSION['admin'])){
	echo "you do not have access";
	include 'finalproject.php';
	die();
}
else{
	$fname=$_POST['fname'];
	$mname=$_POST['mname'];
	include 'db_connect.php';
	$query="UPDATE `FORUM` SET Moderator='$mname' WHERE ForumName='$fname'";
	$result=mysql_query($query);
	include 'db_disconnect.php';
	echo "Moderator Changed";
	include 'admin_page.php';
	die();
}
?>