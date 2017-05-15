<?php
session_start();
if(!isset($_SESSION['uname']) && $_SESSION['uname']== NULL) {
  header('Location: http://ecs.fullerton.edu/~cs431s35/project/forum/login_page.php');
  exit;
}
?>

<!--Ref: https://bootsnipp.com/snippets/featured/responsive-mail-inbox-and-compose -->

<html>

<head>
    <meta charset="utf-8">
    <title>message</title>

    <link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="scripts/styles.css">

</head>

<body>

    <div class="container">

        <div class="mail-box">
            <aside class="sm-side">
                <div class="user-head">
                  <div class="user-name" style="text-align:center;">
                      <h3>Hi, <?php echo $_SESSION['uname'].'!';?></h2>

                  </div>

                    <a class="mail-dropdown pull-right" href="javascript:;">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                </div>
                <div class="inbox-body">
                    <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-compose">
                                Compose
                            </a>
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Compose</h4>
                                </div>

                                <form method="post" action="message.php">

                                    <div class="modal-body">

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">To</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="Enter Username" name="inputEmail1" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Subject</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="Enter Title" name="subjectTitle" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Message</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="10" cols="30" class="form-control" placeholder="Enter Message" name="textmsg" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-send" type="submit" name="sending" value="Send">Send</button>
                                                </div>
                                            </div>

                                    </div>
                                </form>


                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>


                <ul class="inbox-nav inbox-divider">
                    <li>
                        <a id="displayInbox"><i class="fa fa-inbox"></i> Inbox 

                          <?php
                          $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
                          if(!$link)
                          {
                                  die('Could not connect: '.mysql_error());
                          }

                          mysql_select_db("cs431s35", $link);
                          $user = $_SESSION['uname'];

                          $query = "select * from MAILBOX where Receiver=\"".$user."\" and Status='new'";
                          $commit = mysql_query($query);

                          $numOfRows = mysql_num_rows($commit);
                          if($numOfRows > 0)
                          {
                            echo '<span class="label label-danger pull-right">';
                            echo $numOfRows;
                            echo '</span>';
                          }


                          ?>


                        </a>

                    </li>
                    <li>
                        <a id="displaySentMail"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                    </li>

                </ul>


            </aside>
            <aside class="lg-side">
                <div class="inbox-head">
                    <h3>Inbox</h3>
                    <form action="#" class="pull-right position">
                        <div class="input-append">
                        <!--    <input type="text" class="sr-input" placeholder="Search Mail">
                            <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>-->
                            <a href="http://ecs.fullerton.edu/~cs431s35/project/forum/finalproject.php"><button type="button" class="btn btn-warning">Forum</button></a>
                            <a href="http://ecs.fullerton.edu/~cs431s35/project/chatroom/chatlist_front.php"><button type="button" class="btn btn-warning">Chatroom</button></a>
                            <a href="http://ecs.fullerton.edu/~cs431s35/project/forum/fplogout.php"><button type="button" class="btn btn-warning">Log out</button></a>

                        </div>
                    </form>
                </div>
                <div class="inbox-body">
                    <div class="mail-option">
                      <!--
                        <div class="chk-all">
                            <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                           All
                                           <i class="fa fa-angle-down "></i>
                                       </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"> None</a></li>
                                    <li><a href="#"> Read</a></li>
                                    <li><a href="#"> Unread</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="btn-group">
                            <a data-toggle="dropdown" href="#" class="btn mini blue">
                                       Move to
                                       <i class="fa fa-angle-down "></i>
                                   </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                            </ul>
                        </div>-->


                        <ul class="unstyled inbox-pagination" id="inboxamount">
                            <li><span>
                              <?php

                              $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
                              if(!$link)
                              {
                                      die('Could not connect: '.mysql_error());
                              }

                              mysql_select_db("cs431s35", $link);
                              $user = $_SESSION['uname'];

                              $query = "select * from MAILBOX where Receiver=\"".$user."\"";
                              $commit = mysql_query($query);

                              $numOfRows = mysql_num_rows($commit);

                              echo '1-'.$numOfRows.' of '.$numOfRows;
                              ?>

                            </span></li>
                            <li>
                                <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                            </li>
                            <li>
                                <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                            </li>
                        </ul>

                      <!--  <ul class="unstyled inbox-pagination" id="sentamount">
                            <li><span>
                              <?php

                              $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
                              if(!$link)
                              {
                                      die('Could not connect: '.mysql_error());
                              }

                              mysql_select_db("cs431s35", $link);
                              $user = $_SESSION['uname'];

                              $query = "select * from MAILBOX where Sender=\"".$user."\"";
                              $commit = mysql_query($query);

                              $numOfRows = mysql_num_rows($commit);

                              echo '1-'.$numOfRows.' of '.$numOfRows;
                              ?>

                            </span></li>
                            <li>
                                <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                            </li>
                            <li>
                                <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                            </li>
                        </ul>-->
                    </div>
                    <table class="table table-inbox table-hover" id="displaymsg">
                        <tbody id="inbox">
                            <!-- Will messages will go-->
                            <?php
                            $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
                            if(!$link)
                            {
                                    die('Could not connect: '.mysql_error());
                            }

                            mysql_select_db("cs431s35", $link);

                            $user = $_SESSION['uname'];

                            $query = "select * from MAILBOX where Receiver=\"".$user."\"";


                            $commit = mysql_query($query);

                            $numOfRows = mysql_num_rows($commit);
                            $subjects = array();
                            $times = array();
                            $receivers = array();
                            $msgids = array();
                            $status = array();


                            for($i=0; $i < $numOfRows; $i++)
                            {
                              $results = mysql_fetch_assoc($commit);

                              $val = $results['Subject'];
                              array_push($subjects, $val);
                              $val = $results['MsgTime'];
                              array_push($times, $val);
                              $val = $results['Sender'];
                              array_push($receivers, $val);
                              $val = $results['MessageID'];
                              array_push($msgids, $val);
                              $val = $results['Status'];
                              array_push($status, $val);

                            }

                            for($i = 0; $i < $numOfRows; $i++)
                            {
                              if($status[$i] == 'new')
                              {
                              echo '<tr class="unread">';
                            }
                              else
                              {
                                echo '<tr class="read">';
                              }
                              echo '
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">From: '.$receivers[$i].'</td>
                                  <td class="view-message">Subject:
                                      <a href="http://ecs.fullerton.edu/~cs431s35/project/message/displaymsg.php?MessageID='.$msgids[$i].'">
                                      '.$subjects[$i].'
                                      </a>
                                  </td>

                                  <td class="view-message  inbox-small-cells">
                                  <a href="http://ecs.fullerton.edu/~cs431s35/project/message/delete.php?MessageID='.$msgids[$i].'">
                                    <i class="fa fa-trash-o">
                                    </i>
                                  </a>
                                  </td>
                                  <td class="view-message  text-right">'.$times[$i].'</td>
                                  </tr>';
                                  echo '  ';


                            }
                            ?>
                        </tbody>

                        <tbody id="sent">

                              <!-- Will messages will go-->
                              <?php
                              $link = mysql_connect('ecsmysql','cs431s35','xeivaiqu');
                              if(!$link)
                              {
                                      die('Could not connect: '.mysql_error());
                              }

                              mysql_select_db("cs431s35", $link);

                              $user = $_SESSION['uname'];

                              $query = "select * from MAILBOX where Sender=\"".$user."\"";


                              $commit = mysql_query($query);

                              $numOfRows = mysql_num_rows($commit);
                              $subjects = array();
                              $times = array();
                              $receivers = array();
                              $msgids = array();
                              $status = array();


                              for($i=0; $i < $numOfRows; $i++)
                              {
                                $results = mysql_fetch_assoc($commit);

                                $val = $results['Subject'];
                                array_push($subjects, $val);
                                $val = $results['MsgTime'];
                                array_push($times, $val);
                                $val = $results['Sender'];
                                array_push($receivers, $val);
                                $val = $results['MessageID'];
                                array_push($msgids, $val);
                                $val = $results['Status'];
                                array_push($status, $val);

                              }


                              for($i = 0; $i < $numOfRows; $i++)
                              {
                                if($status[$i] == 'new')
                                {
                                echo '<tr class="unread">';
                              }
                                else
                                {
                                  echo '<tr class="read">';
                                }
                                echo '
                                    <td class="inbox-small-cells">
                                        <input type="checkbox" class="mail-checkbox">
                                    </td>
                                    <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                    <td class="view-message  dont-show">From: '.$receivers[$i].'</td>
                                    <td class="view-message">Subject:
                                        <a href="http://ecs.fullerton.edu/~cs431s35/project/message/displaymsg.php?MessageID='.$msgids[$i].'">
                                        '.$subjects[$i].'
                                        </a>
                                    </td>

                                    <td class="view-message  inbox-small-cells">
                                    <a href="http://ecs.fullerton.edu/~cs431s35/project/message/delete.php?MessageID='.$msgids[$i].'">
                                      <i class="fa fa-trash-o">
                                      </i>
                                    </a>
                                    </td>
                                    <td class="view-message  text-right">'.$times[$i].'</td>
                                    </tr>';
                                    echo '  ';


                              }
                              ?>
                          </tbody>

                        </tbody>

                    </table>
                </div>
            </aside>
        </div>
    </div>

    <!-- Javs script -->
    <script src="scripts/main.js" charset="utf-8"></script>

</body>

</html>

