<?php
session_start();

if(!isset($_SESSION['uname']) && $_SESSION['uname']== NULL) {
  header('Location: http://ecs.fullerton.edu/~cs431s35/project/forum/login_page.php');
  exit;
}

$link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
if(!$link)
{
        die('Could not connect: '.mysql_error());
}

mysql_select_db("cs431s35", $link);


$link = $_SERVER['REQUEST_URI'];
$temp1 = explode('?', $link);
$temp2 = explode('=',$temp1[1]);


$query = "delete from MAILBOX where ".$temp2[0]."=".$temp2[1];

$commit = mysql_query($query);

ob_start();
header('Location: index.php');
ob_end_flush();
exit;
 ?>

