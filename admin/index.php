<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

!is_logged() && redirect_to_login();

?>

<?php includes_header("Dashboard", "back") ?>

  <main class="container mb-5">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row justify-content-between">
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Posts</a>
        <a href="<?php echo make_url("admin/posts.php", true); ?>" class="list-group-item manage-page-link">Manage</a>
        <a href="<?php echo make_url("admin/post_create.php", true); ?>" class="list-group-item create-page-link">Create</a>
      </ul>
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Comments</a>
        <a href="<?php echo make_url("admin/comments.php", true); ?>" class="list-group-item manage-page-link">Manage</a>
      </ul>
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Users</a>
        <a href="<?php echo make_url("admin/users.php", true); ?>" class="list-group-item manage-page-link">Manage</a>
        <a href="<?php echo make_url("admin/users_create.php", true); ?>" class="list-group-item create-page-link">Create</a>
      </ul>
    </div>


    <!--
    <ul class="list-group list-group-flush dashboard-list">
      <a class="list-group-item bg-dark text-white font-weight-bold">Posts</a>
      <a href="<?php echo make_url("admin/post_create.php", true); ?>" class="list-group-item pl-5">Create</a>
      <a href="<?php echo make_url("admin/posts.php", true); ?>" class="list-group-item pl-5">Manage</a>
      <a class="list-group-item bg-dark text-white font-weight-bold">Comments</a>
      <a href="<?php echo make_url("admin/comment_create.php", true); ?>" class="list-group-item pl-5">Create</a>
      <a href="<?php echo make_url("admin/comments.php", true); ?>" class="list-group-item pl-5">Manage</a>
      <a class="list-group-item bg-dark text-white font-weight-bold">Users</a>
      <a href="<?php echo make_url("admin/users_create.php", true); ?>" class="list-group-item pl-5">Create</a>
      <a href="<?php echo make_url("admin/users.php", true); ?>" class="list-group-item pl-5">Manage</a>
    </ul>
    -->
  </main>


<?php includes_footer(); ?>