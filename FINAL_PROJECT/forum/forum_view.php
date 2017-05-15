<?php

session_start();
unset($_SESSION['tno']);
if(isset($_SESSION['fname'])){
	$f_name=$_SESSION['fname'];
}
else{
	$f_name=$_POST['f_name'];
}
$uname=$_SESSION['uname'];
include 'db_connect.php';
$query1= "SELECT ForumName FROM BAN WHERE ForumName='$f_name' AND UserName='$uname'";
$bancheck=mysql_query($query1);
if(mysql_numrows($bancheck) != 0){
	include "finalproject.php";
	echo "You are banned from that forum.";
	die();
}
else{
$_SESSION['fname']=$f_name;
include 'header.php';
echo "<h2>$f_name</h2>";
$mquery="SELECT Moderator FROM FORUM WHERE ForumName='$f_name'";
$mresult=mysql_query($mquery);
$modname=mysql_result($mresult,0,'Moderator');
if($uname==$modname && $status!='CLOSE'){
	echo "<div ALIGN=RIGHT><form action='forum_ban_page.php' method='POST'><input type='text' id='banu' name='banu'><input type='hidden' value='$f_name' name='fname'><input type='submit' value='Ban user from this forum'></form></div>";
}
echo "<HR NOSHADE>";
$query = "SELECT Title, ThreadNo FROM THREAD WHERE ForumName='$f_name'";
$result=mysql_query($query);

if(mysql_numrows($result) != 0){
	$cnter=0;
	while($values=mysql_fetch_array($result)){
		$tname[$cnter] =$values["Title"];
		$tno[$cnter]=$values["ThreadNo"];
		$cnter++;
	}
	echo "<table border=1><tr><th>Thread Name</th><th></th></tr>";
for($cnt=sizeof($tname)-1;$cnt>=0;$cnt--){
	echo "<tr><td>$tname[$cnt]</td><td><form action ='thread_view.php' method='POST'><input type='hidden' value='$tno[$cnt]' name='t_no'/><input type='submit' value='View Thread'></form></td></tr>";
}
echo "</table>";
}
else{
	echo "No threads in this forum.  Start one of your own!";
}
}
include "footer.php";

//<input type='hidden' value='$f_name' name='f_name'/>
?>