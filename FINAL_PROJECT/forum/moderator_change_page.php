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
	$query="SELECT ForumName FROM FORUM WHERE ForumName='$fname'";
	$result=mysql_query($query);
	//$uquery="SELECT UserName FROM USER WHERE UserName='$mname' AND Status='NOT BAN'";
	//$uresult=mysql_query($uquery);

	if(mysql_numrows($result)==0){
		echo "Forum not found";
		include 'admin_page.php';
		die();
	}
	elseif(mysql_numrows(mysql_query("SELECT UserName FROM USER WHERE UserName='$mname' AND Status='NOT BAN'"))==0){
		echo "Invalid username";
		include 'admin_page.php';
		die();
	}
	elseif(mysql_numrows(mysql_query("SELECT UserName FROM BAN WHERE UserName='$mname' AND ForumName='$fname'"))!=0){
		echo "User is banned from that forum";
		include 'admin_page.php';
		die();
	}
	else{
		include 'header.php';
		echo "Are you sure you want to make ".$mname." moderator of forum: ".$fname."?";
		echo "<form action='moderator_change.php' method='POST'><input type='hidden' value='$fname' name='fname'><input type='hidden' value='$mname' name='mname'><input type='submit' value='Change Moderator'></form>";
		echo "<form action='admin_page.php' method='POST'><input type='submit' value='Cancel'></form>";
		include 'footer.php';
	}
}
?>