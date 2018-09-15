<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

!is_logged() && redirect_to_login();

?>

<?php includes_header("Dashboard", "end") ?>

  <ul>
    <li><a href="posts.php">Create/update post</a></li>
    <li><a href="comments.php">Comments</a></li>
    <li><a href="users.php">Users</a></li>
  </ul>

<?php includes_footer(); ?>