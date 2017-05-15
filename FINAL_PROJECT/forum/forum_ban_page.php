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
		$query="SELECT UserName FROM USER WHERE UserName='$banu'";
		$result=mysql_query($query);
		if(mysql_numrows($result)==0){
			echo "User not found";
			include 'forum_view.php';
			die();
		}
		elseif(mysql_numrows(mysql_query("SELECT UserName FROM BAN WHERE UserName='$banu' AND ForumName='$fname'"))!=0){
			echo "User already banned";
			include 'forum_view.php';
			die();
		}
		else{
			include 'header.php';
			echo "Are you sure you want to ban <b>".$banu."</b> from forum: ".$fname."?";
			echo "<form action='forum_ban.php' method='POST'><input type='hidden' value='$banu' name='banu'><input type='submit' value='Ban User from Forum'></form>";
			echo "<form action='forum_view.php' method='POST'><input type='submit' value='Cancel'></form>";
			include 'footer.php';
		}
	}
}
?>