<?php
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
ob_end_flush();
require_once("json.php");
require_once "connect.php";
if (mysqli_connect_errno()) {
    echo '<p>Error: Could not connect to database.<br/>
    Please try again later.</p>';
    exit;
}


$session_user = $_SESSION['uname'];
$RoomNo = $_POST['RoomNo'];
$Content = $_POST['Content'];
$_SESSION['RoomNo'] = $RoomNo;
$_SESSION['Content'] = $Content;
//echo 1+$_POST['Content'];
$query = "INSERT INTO CHATUSER (RoomNo, UserName) VALUES ('$RoomNo','$session_user')";
//$query_RoomNo = "SELECT RoomNo From CHATROOM WHERE Content ='$content' && StartUser = '$session_user'";
$conn->query($query);
//$result = $conn->query($query_RoomNo);
//$row = $result->fetch_assoc();
$res_json = array('success'=>true);
echo __json_encode($res_json);
exit;


?>
