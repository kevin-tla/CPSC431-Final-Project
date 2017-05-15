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
	$banu=$_POST['banu'];
	include 'db_connect.php';
	$query="UPDATE `USER` SET Status='BANNED' WHERE UserName='$banu'";
	$result=mysql_query($query);
	echo 'User banned';
	include 'admin_page.php';
	die();
}
?>