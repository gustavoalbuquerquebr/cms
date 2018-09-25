<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

!is_logged() && redirect_to_login();

?>

<?php includes_header("Dashboard", "back") ?>

  <main class="container mb-5">
    <h1 class="mb-4">Dashboard</h1>
    <ul>
      <li><a href="posts.php">Update post</a></li>
      <li><a href="comments.php">Comments</a></li>
      <li><a href="users.php">Users</a></li>
    </ul>
  </main>


<?php includes_footer(); ?>