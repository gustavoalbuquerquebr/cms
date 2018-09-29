<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/post_edit.php");

!is_logged() && redirect_to_login() && exit;

empty($_GET) && empty($_POST) && redirect_url_dashboard() && exit;

if (!empty($_POST)){
  $result = update_post_db();

  if($result[0] === "success") {
    $success_message = "<strong>Success:</strong> Post updated.";

  }  else {
    $db_update_error = $result[1];
    $error_message = generate_errormessage_variable($db_update_error);
  }
}

// HTML output
$post = empty($_POST) ? fetch_post_db() : $_POST;
$id = $_GET["id"] ?? $post["id"];
$view_post_link = make_url("post.php?id=", true) . $id;
$self = $_SERVER["PHP_SELF"];
$title = h($post["title"]);
$body = $post["body"];

?>


<?php includes_header("Edit post") ?>

  <main class="container mb-5">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= make_url("admin/posts.php", true); ?>">Posts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit post</li>
    </ol>
  </nav>

  <h1 class="mb-4">Edit post</h1>

    <?php if (!empty($_POST)): ?>
      <div class="alert alert-dismissible fade show <?= ($db_update_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
        <?= isset($db_update_error) ? $error_message : $success_message; ?>
      <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <a href="<?= $view_post_link; ?>" class="btn btn-outline-primary mb-4" target="_blank">View post &raquo;</a>

    <form method="post" action="<?= $self; ?>">
      <input type="number" name="id" value="<?= $id; ?>" class="d-none">
      <div class="form-group">
        <input name="title" type="text" value="<?= $title; ?>" class="form-control">
      </div>
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" class="form-control"><?= $body; ?></textarea>
      </div>
      <input type="submit" id="submit" value="Save" class="btn btn-primary">
    </form>
    
  </main>

<?php includes_footer(); ?>
