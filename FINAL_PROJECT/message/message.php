<?php
session_start();
if(!isset($_SESSION['uname']) && $_SESSION['uname']== NULL) {

  header('Location: http://ecs.fullerton.edu/~cs431s35/project/forum/login_page.php');
  exit;
}

  $user = $_SESSION['uname'];
  if(isset($user))
  {
  $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
  if(!$link)
  {
  die('Could not connect: '.mysql_error());
  }

  mysql_select_db("cs431s35", $link);

  $correctbuttonpushed = $_POST['sending'];

  if($correctbuttonpushed == 'Send')
  {
  $inputEmail1 = $_POST['inputEmail1'];
  $subjectTitle = $_POST['subjectTitle'];
  $textmsg = $_POST['textmsg'];
  $currenttime = date("Y-m-d");


  $query = "insert into MAILBOX(MsgTime, MsgText, Subject, Status, Receiver, Sender) values('$currenttime', '$textmsg', '$subjectTitle', 'new', '$inputEmail1', '$user')";

  $commit = mysql_query($query);

  }


  ob_start();
  header('Location: index.php');
  ob_end_flush();

  exit;
  }


?>

