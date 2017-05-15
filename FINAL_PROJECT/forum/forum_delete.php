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
	include 'db_connect.php';
	$query1="DELETE FROM `POST` WHERE ForumName='$fname'";
	$result1=mysql_query($query1);
	$query2="DELETE FROM `THREAD` WHERE ForumName='$fname'";
	$result2=mysql_query($query2);
	$query="DELETE FROM `FORUM` WHERE ForumName='$fname'";
	$result=mysql_query($query);
	echo 'Forum deleted';
	include 'admin_page.php';
	die();
}
?>