<?php
session_start();
unset($_SESSION['tno']);
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
if(!isset($_SESSION['fname'])){
    include "finalproject.php";
    echo "Pick a forum first";
}
else{
	include 'header.php';
?>
<form action='thread_create.php' method='POST'>
<div>
        <label for = "Title">Thread Title:</label>
        <input type = "text" id = "new_title" name = "new_title">
    </div>
    <div class="button">
  <button type="submit">Create Thread</button>
</div>
</form>

<?php
	include 'footer.php';
}
?>