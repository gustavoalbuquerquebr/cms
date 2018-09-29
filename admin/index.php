<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

!is_logged() && redirect_to_login() && exit;

// HTML output
$posts_link = make_url("admin/posts.php", true);
$post_create_link = make_url("admin/post_create.php", true);
$comments_link = make_url("admin/comments.php", true);
$users_link = make_url("admin/users.php", true);
$user_create_link = make_url("admin/user_create.php", true);
$categories_link = make_url("admin/categories.php", true);
$category_create_link = make_url("admin/category_create.php", true);

?>


<?php includes_header("Dashboard") ?>

  <main class="container mb-5">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row justify-content-between">
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Posts</a>
        <a href="<?= $posts_link; ?>" class="list-group-item list-group-item-action manage-page-link">Manage</a>
        <a href="<?= $post_create_link; ?>" class="list-group-item list-group-item-action create-page-link-blue">Create</a>
      </ul>
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item list-group-item-action bg-dark text-white font-weight-bold">Comments</a>
        <a href="<?= $comments_link; ?>" class="list-group-item list-group-item-action manage-page-link">Manage</a>
      </ul>
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Users</a>
        <a href="<?= $users_link; ?>" class="list-group-item list-group-item-action manage-page-link">Manage</a>
        <a href="<?= $user_create_link; ?>" class="list-group-item list-group-item-action create-page-link-blue">Create</a>
      </ul>
      <ul class="list-group mb-5 px-3 col-md-6 col-lg-4 dashboard-list">
        <a class="list-group-item bg-dark text-white font-weight-bold">Categories</a>
        <a href="<?= $categories_link; ?>" class="list-group-item list-group-item-action manage-page-link">Manage</a>
        <a href="<?= $category_create_link; ?>" class="list-group-item list-group-item-action create-page-link-blue">Create</a>
      </ul>
    </div>
  </main>

<?php includes_footer(); ?>
