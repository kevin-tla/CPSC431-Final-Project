<?php
session_start();
if(!isset($_SESSION['uname']) && $_SESSION['uname']== NULL) {
  header('Location: http://ecs.fullerton.edu/~cs431s35/project/forum/login_page.php');
  exit;
}
 ?>

<html>
<!--Ref: https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_ref_btn-info&stacked=h-->
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="row">
    <div class="col-md-1">
  <a href="index.php"><button type="button" class="btn btn-info">Inbox</button></a>
</div>
</div>


</body>


</html>


<?php
$link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
if(!$link)
{
        die('Could not connect: '.mysql_error());
}



mysql_select_db("cs431s35", $link);

$link = $_SERVER['REQUEST_URI'];
$temp1 = explode('?', $link);
$temp2 = explode('=',$temp1[1]);

$query = "update MAILBOX set Status='read' where ".$temp2[0]."=".$temp2[1];
$commit = mysql_query($query);


$query = "select * from MAILBOX where ".$temp2[0]."=".$temp2[1];
$commit = mysql_query($query);


$results = mysql_fetch_assoc($commit);



echo '
<div class="container" style="background-color: rgba(51, 122, 183, 0.25);
vertical-align: middle;
 border-width: 1px;
 border-style: solid;
 horizontal-align: middle;
 border-radius: 5px;
 border: 1px solid black;
 border-color: #2e6da4;
 color: #286090;">
            <div class="col-sm-12" style="margin-top: 10%;
            margin-left: 10%;
            margin-right: 10%;
            margin-bottom: 10%;">
                <div class="bs-calltoaction bs-calltoaction-primary">
                    <div class="row">
                        <div class="col-md-9 cta-contents">
                            <h1 class="cta-title">Subject: '.$results['Subject'].'</h1>
                            <div class="cta-desc">
                                <p>To: '.$results['Receiver'].'</p>
                                <p>From: '.$results['Sender'].'</p>
                                Message:
                                <p style="text-align: center">'.$results['MsgText'].'</p>

                            </div>
                        </div>

                     </div>
                </div>



            </div>
        </div>

';





 ?>

