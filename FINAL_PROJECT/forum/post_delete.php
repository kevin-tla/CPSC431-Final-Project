<?php
session_start();
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
if(!isset($_SESSION['fname'])){
    include "finalproject.php";
    echo "Pick a forum first";
    die();
}
if(!isset($_SESSION['tno'])){
    include "forum_view.php";
    echo "Pick a thread first";
    die();
}
else{
	$pno=$_POST['pno'];
	$fname=$_SESSION['fname'];
	$tno=$_SESSION['tno'];
	$uname=$_SESSION['uname'];
	include 'db_connect.php';
	$mquery="SELECT Moderator FROM FORUM WHERE ForumName='$fname'";
	$mresult=mysql_query($mquery);
	$uquery="SELECT UserName FROM POST WHERE ForumName='$fname' AND ThreadNo='$tno' AND PostNo='$pno'";
	$uresult=mysql_query($uquery);
	if(mysql_result($uresult,0,'UserName')==$uname || mysql_result($mresult,0,'Moderator')==$uname || isset($_SESSION['admin'])){
	$query="DELETE FROM `POST` WHERE ForumName='$fname' AND ThreadNo='$tno' AND PostNo='$pno'";
	$result=mysql_query($query);
	}
	else{
		echo "you don't have access";
		include 'thread_view.php';
	}
	include 'db_disconnect.php';
	header("Location: thread_view.php");
	die();
}
?>