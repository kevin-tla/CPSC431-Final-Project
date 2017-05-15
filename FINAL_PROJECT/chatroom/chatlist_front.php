<?php
  session_start();
  require 'headerChatroom.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title>Chat List</title>
</head>

<body>
    <!--
    <div class="">
        <a href="../forum/finalproject.php"><-- Back to Homepage</a>
    </div>
    -->
    <div>
        User: <span id="username"><? echo isset($_SESSION['uname'])?$_SESSION['uname']:'Anonymous' ?></span>
    </div>
    <span>ChatRoom Name</span>
    <input type="text" id="chatroomName" name="chatroomName" value="">
    <button type="button" id="add" name="add">Start a Chatroom</button>
    <!--<div class="chatlist">


        </div>-->
    <table class="chatlist">
        <tr>
            <th>RoomId</th>
            <th>Content</th>
            <th>StartUser</th>
            <th>Join</th>
        </tr>
    </table>
</body>
<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="./chatlist.js">
</script>

</html>
