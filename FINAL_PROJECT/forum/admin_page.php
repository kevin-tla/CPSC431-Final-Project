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
	include 'header.php';
	echo "<h2>Admin</h2>";
	echo "Enter a Forum to Delete: ";
	echo "<form action='forum_delete_page.php' method='POST'><input type='text' id='fname' name='fname'><input type='submit' value='Delete a Forum'></form>";
	echo "Enter a username to ban: ";
	echo "<form action='user_ban_page.php' method='POST'><input type='text' id='banu' name='banu'><input type='submit' value='Ban User from Site'></form>";
	echo "Enter a username to un-ban: ";
	echo "<form action='user_unban_page.php' method='POST'><input type='text' id='banu' name='banu'><input type='submit' value='Un-ban User from Site'></form>";
	echo "Enter a forum to change its moderator: ";
	echo "<form action='moderator_change_page.php' method='POST'><input type='text' id='fname' name='fname'>";
	echo "Enter the new moderator's username: ";
	echo "<input type='text' id='mname' name='mname'><input type='submit' value='Change a Moderator'></form>";
	include 'footer.php';
}
?>