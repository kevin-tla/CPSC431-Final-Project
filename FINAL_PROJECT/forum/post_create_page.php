<?php
session_start();
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
if(!isset($_SESSION['fname'])){
    include "finalproject.php";
    echo "Pick a forum first";
    die();
}
if(!isset($_SESSION['tno'])){
    include "forum_view.php";
    echo "Pick a thread first";
    die();
}
else{
	include 'header.php';
?>
<form action='post_create.php' method='POST'>
    <div>
        <label for = "Content">Description:</label>
        <textarea id = "content" name = "content"></textarea
>    </div>
    <div class="button">
  <button type="submit">Submit Post</button>
</div>
</form>

<?php
	include 'footer.php';
}