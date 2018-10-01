<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/post_create.php");

!is_logged() && redirect_to("admin/login.php") && exit;

// handle post creation
if (!empty($_POST)) {
  $result = insert_post_db();

  // if creation successful, redirect to new post
  $result[0] === "success" && redirect_to("post.php?id=" . $result[1]) && exit;
    
  // if creation unsuccessful, render page with error alert
    $db_insertion_error = $result[1];
    $error_message = generate_errormessage_variable($db_insertion_error);
}

$categories = fetch_categories_db();

// HTML output
$dashboard_link = make_url("admin/", true);
$posts_link = make_url("admin/posts.php", true);
$self = $_SERVER["PHP_SELF"];
$title = $_POST["title"] ?? "";
$body = $_POST["body"] ?? "";

?>


<?php includes_header("Create post"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $posts_link ?>">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create post</li>
      </ol>
    </nav>

    <h1 class="mb-4">Create post</h1>

    <?php if (isset($db_insertion_error)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error_message; ?>
        <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <form action="<?= $self; ?>" method="post">
      <div class="form-group">
        <input type="text" name="title" placeholder="Title" class="form-control" value="<?= $title; ?>">
      </div>
      <div class="form-group">
        <select name="category" class="form-control">
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category["id"]; ?>" <?= select_option_html($category); ?>> <?= $category["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" placeholder="Body" class="form-control"><?= $body; ?></textarea>
      </div>
      <input type="submit" value="Create" class="btn btn-primary">
    </form>

  </main>

<?php includes_footer(); ?>
