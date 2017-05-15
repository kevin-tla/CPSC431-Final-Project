<?php
$fullname = $_POST['fullname'];
$username = $_POST['uname'];
$pword = $_POST['pword'];

session_start(); // Has a session been initiated previously? 
if (! isset($_SESSION['uname'])) {
   if (isset($_POST['uname'])) { 
     include "db_connect.php";
     $query = "SELECT USER.UserName FROM USER WHERE USER.UserName='$username'";
     $result = mysql_query($query);
    if (mysql_numrows($result) == 1) {
     include "db_disconnect.php";
     echo "Username taken";
     include "registration_page.php";
     die();
      }
    else { 
    	$insert = "INSERT INTO `USER`(`UserName`,`Password`,`FullName`,`Status`,`Admin`)
					VALUES ('$username','$pword','$fullname','NOT BAN','UNDERLING')";
    	$result = mysql_query($insert);
    	include "db_disconnect.php";
        //$_SESSION['user'] = $fullname;
     	$_SESSION['uname'] = $username;
        header("Location: finalproject.php");
        die();
    } 
    }
    } else { 
    	echo "Someone else is already signed in.";
    	include "finalproject.php"; }

//session_destroy();
?>

