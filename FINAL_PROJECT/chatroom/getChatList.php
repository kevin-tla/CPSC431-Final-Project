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
$query = "SELECT * FROM CHATROOM";
$result = $conn->query($query);
$res_json = array();
while($row = $result->fetch_assoc()){
    $res_json[$row['RoomNo']] = $row;
}

echo __json_encode($res_json);
exit;


?>
