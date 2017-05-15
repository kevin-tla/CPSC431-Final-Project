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
	$fname=$_SESSION['fname'];
	$uname=$_SESSION['uname'];
	$tno=$_SESSION['tno'];
	include 'db_connect.php';
	$mquery="SELECT Moderator FROM FORUM WHERE ForumName='$fname' AND Moderator='$uname'";
	$mresult=mysql_query($mquery);
	if(mysql_numrows($mresult)==0 || !isset($_SESSION['admin'])){
		include 'finalproject.php';
		echo "You do not have this privilege.";
		die();
	}
	else{
		$query1="DELETE FROM `POST` WHERE ForumName='$fname' AND ThreadNo='$tno'";
		$result1=mysql_query($query1);
		$query="DELETE FROM `THREAD` WHERE ForumName='$fname' AND ThreadNo='$tno'";
		$result=mysql_query($query);
	}









	include 'db_disconnect.php';
	header("Location: thread_view.php");
}
?>