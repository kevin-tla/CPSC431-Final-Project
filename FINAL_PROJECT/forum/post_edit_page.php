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
	include 'header.php';
	include 'db_connect.php';
	$query="SELECT Content FROM POST WHERE ForumName='$fname' AND ThreadNo='$tno' AND PostNo='$pno' AND User='$uname'";
	$result=mysql_query($query);
	$cont=mysql_result($result,0,'Content');
	include 'db_disconnect.php';
	echo "<form action='post_edit.php' method='POST'><div><label for = 'Content'>Post a reply:</label><textarea id = 'content' name = 'content'>$cont</textarea></div><input type='hidden' value='$pno' name='pno'><div class='button'><button type='submit'>Submit Edit</button></div></form>";
	include 'footer.php';
}
?>