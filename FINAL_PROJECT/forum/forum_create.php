<?php
session_start();
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
$new_name=$_POST['new_name'];
$description=$_POST['description'];
$uname=$_SESSION['uname'];
include 'db_connect.php';
$query="SELECT ForumName FROM FORUM WHERE ForumName='$new_name'";
$result=mysql_query($query);
if(mysql_numrows($result)==0){
	$insert="INSERT INTO `FORUM`(`ForumName`,`Description`,`Status`,`Moderator`) VALUES('$new_name','$description','OPEN','$uname')";
	$result=mysql_query($insert);
	include 'db_disconnect.php';
	$_SESSION['fname']=$new_name;
	header("Location: forum_view.php");
}
else{
	include 'forum_create_page.php';
	echo "Forum name is already taken.";
}
?>