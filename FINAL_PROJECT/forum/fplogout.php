<?php
session_start();
if (! isset($_SESSION['uname'])){
	header("Location: finalproject.php");
	die();
}

session_destroy();
//echo "Logged out.";
//include "finalproject.php";
header("Location: finalproject.php");
?>