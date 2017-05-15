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
	$query="SELECT UserName, Status FROM USER WHERE UserName='$banu'";
	$result=mysql_query($query);
	if(mysql_numrows($result)==0){
		echo "User not found";
		include 'admin_page.php';
		die();
	}
	else{
		if(mysql_result($result,0,'Status')=='BANNED'){
			echo "User already banned";
			include 'admin_page.php';
			die();
		}
		else{
			include 'header.php';
			echo "Are you sure you want to ban user: ".$banu."?";
			echo "<form action='user_ban.php' method='POST'><input type='hidden' value='$banu' name='banu'><input type='submit' value='Ban user'></form>";
			echo "<form action='admin_page.php' method='POST'><input type='submit' value='Cancel'></form>";
			include 'footer.php';
		}
	}
}
?>