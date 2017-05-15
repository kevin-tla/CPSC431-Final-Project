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
else{
	$fname=$_SESSION['fname'];
	$uname=$_SESSION['uname'];
	include 'db_connect.php';
	$mquery="SELECT Moderator FROM FORUM WHERE ForumName='$fname' AND Moderator='$uname'";
	$mresult=mysql_query($mquery);
	if(mysql_numrows($mresult)==0){
		include 'finalproject.php';
		echo "You do not have this privilege.";
		die();
	}
	else{
		$banu=$_POST['banu'];
		$query="INSERT INTO `BAN`(`ForumName`,`UserName`) VALUES('$fname','$banu')";
		$result=mysql_query($query);
		echo "User banned";
		include 'forum_view.php';
		die();
	}
}
?>