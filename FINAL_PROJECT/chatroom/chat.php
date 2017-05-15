<?php
//error_reporting(E_ERROR);
session_start();
$currentTime = time();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
ob_end_flush();
require_once('json.php');
$hostname = "ecs.fullerton.edu";
$database = "cs431s35";
$username = "cs431s35";
$password = "xeivaiqu";
$db = mysqli_connect($hostname, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo '<p>Error: Could not connect to database.<br/>
    Please try again later.</p>';
    exit;
}

//try {


    //$currentTime = $currentTime-1800;
    //$_SESSION['uname'] = $_POST['user'];

    $session_user = $_SESSION['uname'];


    $RoomNo = $_SESSION['RoomNo'];
    $firstpoll = $_POST['firstpoll'];

    $lastPoll = isset($_SESSION['last_poll']) ? $_SESSION['last_poll'] : $currentTime;

    $action = isset($_SERVER['REQUEST_METHOD']) &&
                ($_SERVER['REQUEST_METHOD'] == 'POST') ?
                'send' : 'poll';
    //echo $firstpoll;
    if($firstpoll == 'first') {
        //echo $firstpoll;
        $newChats = array();
        $message_id = 0;
        $query = "SELECT * FROM CHATLOG WHERE RoomNo = '$RoomNo' order by id desc limit 15 ";
        $result = $db->query($query);
        while($message = $result->fetch_assoc()){
            $newChats[$message_id] = $message;
            $message_id = $message_id + 1;
        }
        $res_json = array('success' => true, 'messages' => $newChats);
        print __json_encode($res_json);
        exit;
    }else{
        switch($action) {
            case 'poll':
                $query = "SELECT * FROM CHATLOG WHERE RoomNo = '$RoomNo' && date_created >= ?";
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $lastPoll);
                $stmt->execute();
                //var_dump($stmt->num_rows);
                $stmt->bind_result($roomno, $id, $message, $session_id, $date_created);
                $newChats = array();
                $message_id = 0;

                while($stmt->fetch()) {
                    $chat = array('RoomNo' => $roomno, 'id' => $id, 'message' => $message, 'sent_by' => $session_id, 'date_created' => $date_created, 'post'=>$session_user);
                    $newChats[$message_id] = $chat;
                    $message_id = $message_id + 1;
                }
                $_SESSION['last_poll'] = $currentTime;
                $res_json = array('success' => true, 'messages' => $newChats, 'times'=>$message_id);
                print __json_encode($res_json);
                exit;


            case 'send':
                $session_user = $_POST['user'];
                $message = isset($_POST['message']) ? $_POST['message'] : '';
                $message = strip_tags($message);
                $query = "INSERT INTO CHATLOG (RoomNo, message, sent_by, date_created) VALUES(?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('issi', $RoomNo, $message, $session_user, $currentTime);
                $stmt->execute();
                $res_json = array('success' => true);
                echo __json_encode($res_json);
                exit;
            }
    }
    /*} catch (\Exception $e) {
        $res_json = array('success' => false, 'error' => $e->getMessage());
        //var_dump($res_json);
        print ($res_json);
    }*/

// function from PHP Manul http://www.php.net/manual/en/function.json-encode.php#100835

?>
