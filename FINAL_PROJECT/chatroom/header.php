<?php
session_start();
?>
<!DOCTYPE html>
<head>
	<title>431 Final</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>431 Final Website</h1>
	<div id="wrapper">
	<div id="menu">
		<a class="item" href="../forum/finalproject.php">Home</a> -
		<a class="item" href="../forum/forum_create_page.php">Create a Forum</a> -
		<?php
			if(isset($_SESSION['fname']) && isset($_SESSION['uname'])){
				echo "<a class='item' href='thread_create_page.php'>Create a Thread</a> -";
			} ?>
		<a class="item" href="../message/index.php">Mailbox</a> -
		<a class="item" href="../chatroom/chatlist_front.php">Chat</a>
		<?php
			if(isset($_SESSION['admin'])){
				echo " -<a class='item' href='../forum/admin_page.php'>Admin Page</a>";
			} ?>

		<div id="userbar">
		<?php
		if(!isset($_SESSION['uname'])){
			echo "<a class='item' href='../forum/login_page.php'>Login</a> -"."<a class='item' href='registration_page.php'>Register</a>"."</div>";
			//"<div id='userbar'>".
		}
		else{
			echo "Hello "."<b>".$_SESSION['uname']."</b>".". Not you?"."<a class='item' href='../forum/fplogout.php'>Log Out</a>"."</div>";
			//"<div id='userbar'>".
		} ?>
	</div>
		<div id="content">
