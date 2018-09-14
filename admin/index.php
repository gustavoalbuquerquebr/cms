<?php

// verify if the user is logged
session_start();
if(!isset($_SESSION["auth"])) {
  header("Location: login.php");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

// head variables
$page_title = "Dashboard";
$stylesheet = "end";

?>

<?php require make_url("includes/templates/header.php"); ?>

<ul>
  <li><a href="posts.php">Create/update post</a></li>
  <li><a href="comments.php">Comments</a></li>
  <li><a href="users.php">Users</a></li>
</ul>

<?php require make_url("includes/templates/footer.php"); ?>