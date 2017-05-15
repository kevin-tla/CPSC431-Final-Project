<?php
session_start();
if(!isset($_SESSION['fname'])){
	include 'finalproject.php';
	echo "Choose a forum first.";
	die();
}
else{
	//echo $_SESSION['fname'];

	//echo $_POST['t_no'];
	
	if(isset($_SESSION['tno'])){
		//echo "session: ".$_SESSION['tno'];
		$t_no=$_SESSION['tno'];
	}
	else{
		//echo "Post: ".$_POST['t_no'];
		$t_no=$_POST['t_no'];
		
	}
	$f_name=$_SESSION['fname'];
	$_SESSION['tno']=$t_no;
	$uname=$_SESSION['uname'];
	//echo $_SESSION['tno'];
	include "header.php";
	include 'db_connect.php';
	
	$tquery="SELECT Title, Status FROM THREAD WHERE ForumName='$f_name' AND ThreadNo='$t_no'";
	$tresult=mysql_query($tquery);
	echo "<h2>".mysql_result($tresult,0,'Title')."</h2>";
	$status=mysql_result($tresult,0,'Status');
	if($status=='CLOSE'){
		echo "<p><h4>Thread Closed</h4></p>";
	}

	$mquery="SELECT Moderator FROM FORUM WHERE ForumName='$f_name'";
	$mresult=mysql_query($mquery);
	$modname=mysql_result($mresult,0,'Moderator');
	if(($uname==$modname || isset($_SESSION['admin'])) && $status!='CLOSE'){
		echo "<div ALIGN=RIGHT><form action='thread_close.php' method='POST'><input type='hidden' value='$t_no' name='tno'><input type='submit' value='Close Thread'></form></div>";
	}
	if($uname==$modname || isset($_SESSION['admin'])){
		echo "<div ALIGN=RIGHT><form action='thread_delete.php' method='POST'><input type='hidden' value='$t_no' name='tno'><input type='submit' value='Delete Thread'></form></div>";
	}

	$query = "SELECT PostNo, User, Content FROM POST WHERE ForumName='$f_name' AND ThreadNo='$t_no'";
	$result=mysql_query($query);

	if(mysql_numrows($result) != 0){
	$cnter=0;
	while($values=mysql_fetch_array($result)){
		$postnum[$cnter] =$values["PostNo"];
		$poster[$cnter]=$values["User"];
		$postdata[$cnter]=$values["Content"];
		$cnter++;
	}

	echo "<HR NOSHADE>";
	for ($cnt=0;$cnt<sizeof($postnum);$cnt++){
		//echo "<tr><td>$poster[$cnt]";
		if ($poster[$cnt]==$uname && $status!='CLOSE'){
			echo "<div ALIGN=RIGHT><form action='post_edit_page.php' method='POST'><input type='hidden' value='$postnum[$cnt]' name='pno'><input type='submit' value='Edit Post'></form></div>";
		}
		if (($poster[$cnt]==$uname || $uname==$modname || isset($_SESSION['admin'])) && $status!='CLOSE'){
			echo "<div ALIGN=RIGHT><form action='post_delete.php' method='POST'><input type='hidden' value='$postnum[$cnt]' name='pno'><input type='submit' value='Delete Post'></form></div>";
		}
		echo "$poster[$cnt]";
		
		echo "<p>$postdata[$cnt]</p>";
		echo "<HR NOSHADE>";
		
	}
	//echo "</table>";
}
else{
	echo "No posts in this thread. Be the first one!";
}
if($status=='CLOSE'){
	echo "<br>Thread is closed. No new posts can be made.";
}
else{
if (!isset($_SESSION['uname'])){
	echo "<br>Sign in or register to post in this thread.";
}
else{
echo "<br><form action='post_create.php' method='POST'><div><label for = 'Content'>Post a reply:</label><textarea id = 'content' name = 'content'></textarea></div><div class='button'><button type='submit'>Submit Post</button></div></form>";
}
}
include "footer.php";
}
?>