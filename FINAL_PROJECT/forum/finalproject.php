<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['tno']);
include "header.php";
echo "<h2>Search the Forums</h2>";
echo "\n";
echo "<form action='forum_search.php' method='POST'><input type='text' id='search_term' name='search_term'><input type='submit' value='Search'></form><br>";

include "db_connect.php";
$query = "SELECT ForumName FROM FORUM";
$result = mysql_query($query);
if ($result){
if(mysql_num_rows($result) != 0){
	$cnter=0;
	while($values=mysql_fetch_array($result)){
		$fname[$cnter] =$values["ForumName"];
		$cnter++;
	}
	echo "<table border=1><tr><th>Forum Name</th><th></th></tr>";
for($cnt=sizeof($fname)-1;$cnt>=0;$cnt--){
	echo "<tr><td>$fname[$cnt]</td><td><form action ='forum_view.php' method='POST'><input type='hidden' value='$fname[$cnt]' name='f_name'/><input type='submit' value='View Forum'></form></td></tr>";
}
echo "</table>";
}
}
include "footer.php";
?>