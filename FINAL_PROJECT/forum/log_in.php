<?php 
session_start(); // Has a session been initiated previously? 
if (! isset($_SESSION['user'])) {
   if (isset($_POST['uname'])) { 
        $username = $_POST['uname']; 
        $pword = $_POST['pword']; 
        include "db_connect.php";
        //$query = "SELECT USER.FullName, USER.Status, USER.Admin FROM USER WHERE USER.UserName='$username' AND USER.Password='$pword'";
        $query = "SELECT USER.Status, USER.Admin FROM USER WHERE USER.UserName='$username' AND USER.Password='$pword'"; 
        $result = mysql_query($query); 
        if (mysql_numrows($result) == 1) {
            if(mysql_result($result,0,"Status")=="BANNED"){
                include 'finalproject.php';
                echo "<h2>You are banned from the site.</h2>";
                die();
            }
            else{
                if(mysql_result($result,0,'Admin')=='INCHARGE'){
                    $_SESSION['admin']='INCHARGE';
                }
                //$_SESSION['user'] = mysql_result($result,0,"FullName"); 
                $_SESSION['uname'] = $username;    
                include "db_disconnect.php";
                header("Location: finalproject.php");
                die();
            }
        }
        else { 
            include "db_disconnect.php";
            include "login_page.php";
            echo "incorrect combo";
            die();
        } 
    }
} 
else {
    include "finalproject.php"; 
    echo "not logged in";
}
//session_destroy();
?>