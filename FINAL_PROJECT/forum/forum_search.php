<?php

session_start();
unset($_SESSION['fname']);
unset($_SESSION['tno']);
$sterm = $_POST['search_term'];
if($sterm==NULL){
	include 'finalproject.php';
	echo "Please enter a search term.";
	die();
}

include 'db_connect.php';
$query = "SELECT ForumName FROM FORUM WHERE INSTR(ForumName,'{$sterm}')";
$result = mysql_query($query);
if ($result){
if(mysql_num_rows($result) != 0){
	include "header.php";
	$cnter=0;
	while($values=mysql_fetch_array($result)){
		$fname[$cnter] =$values["ForumName"];
	}
	echo "<table border=1><tr><th>Forum Name</th><th></th></tr>";
for($cnt=sizeof($fname)-1;$cnt>=0;$cnt--){
	echo "<tr><td>$fname[$cnt]</td><td><form action ='forum_view.php' method='POST'><input type='hidden' value='$fname[$cnt]' name='f_name'/><input type='submit' value='View Forum'></form></td></tr>";
}
echo "</table>";
include 'footer.php';
}

else{
	//include 'footer.php';
	include 'finalproject.php';
	echo "No Matches Found";
	die();
}	
}
?>