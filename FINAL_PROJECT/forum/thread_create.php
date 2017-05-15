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
$new_title=$_POST['new_title'];
$uname=$_SESSION['uname'];
$fname=$_SESSION['fname'];
include 'db_connect.php';
$query1="SELECT ThreadNo FROM THREAD WHERE ForumName='$fname' AND Title='$new_title' AND StartUser='$uname' AND Status='OPEN'";
$check=mysql_query($query1);
if(mysql_numrows($check) != 0){
	header("Location= thread_create_page.php");
	echo "Please do not create duplicate threads.";
	die();
}
else{
$insert="INSERT INTO `THREAD`(`ForumName`,`Title`,`DateTime`,`Status`,`StartUser`) VALUES('$fname','$new_title',now(),'OPEN','$uname')";
$result=mysql_query($insert);
$query="SELECT ThreadNo FROM THREAD WHERE ForumName='$fname' AND Title='$new_title' AND StartUser='$uname' AND Status='OPEN'";
$results=mysql_query($query);
$cnter=0;
while($values=mysql_fetch_array($results)){
	$tnum[$cnter]=$values['ThreadNo'];
	$cnter++;
}
include 'db_disconnect.php';
$_SESSION['tno']=$tnum[0];
header("Location: thread_view.php");
}
}
?>