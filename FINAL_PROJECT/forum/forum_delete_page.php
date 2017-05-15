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
	$query="SELECT ForumName FROM FORUM WHERE ForumName='$fname'";
	$result=mysql_query($query);
	if(mysql_numrows($result)==0){
		echo "Forum not found";
		include 'admin_page.php';
		die();
	}
	else{
		include 'header.php';
		echo "Are you sure you want delete forum: ".$fname."?";
		echo "<form action='forum_delete.php' method='POST'><input type='hidden' value='$fname' name='fname'><input type='submit' value='Delete Forum'></form>";
		echo "<form action='admin_page.php' method='POST'><input type='submit' value='Cancel'></form>";
		include 'footer.php';
	}
}
?>