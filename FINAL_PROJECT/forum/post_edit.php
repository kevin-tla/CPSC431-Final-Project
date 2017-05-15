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
$con=$_POST['content'];
$pno=$_POST['pno'];
$uname=$_SESSION['uname'];
$fname=$_SESSION['fname'];
$tno=$_SESSION['tno'];
include 'db_connect.php';
$query= "UPDATE `POST` SET Content='$con' WHERE ForumName='$fname' AND ThreadNo='$tno' AND PostNo='$pno' AND User='$uname'";
$result=mysql_query($query);
include 'db_disconnect.php';
header("Location: thread_view.php");
}
?>