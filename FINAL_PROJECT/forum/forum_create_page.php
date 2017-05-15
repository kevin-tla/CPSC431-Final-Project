<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['tno']);
if(!isset($_SESSION['uname'])){
	header("Location: login_page.php");
	die();
}
else{
	include 'header.php';
?>
<form action='forum_create.php' method='POST'>
<div>
        <label for = "name">Forum Name:</label>
        <input type = "text" id = "new_name" name = "new_name">
    </div>
    <div>
        <label for = "description">Description:</label>
        <textarea id = "description" name = "description"></textarea>
    </div>
    <div class="button">
  <button type="submit">Create Forum</button>
</div>
</form>

<?php
	include 'footer.php';
}
?>