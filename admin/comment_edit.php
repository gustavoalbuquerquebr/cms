<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comment_edit.php");

!is_logged() && redirect_to_login() && exit;

empty($_GET) && empty($_POST) && redirect_url_dashboard() && exit;

// handle submition from this page form
if (!empty($_POST)) {

  $result = update_comment_db();

  if ($result[0] === "success") {
    $success_message = "<strong>Success:</strong> Comment updated.";

  } else {
    $db_update_error = $result[1];
    $error_message = generate_errormessage_variable($db_update_error);
  }
}

// HTML/JS output
$id = $_POST["id"] ?? $_GET["id"];
$comment = !empty($_POST) ? $_POST : fetch_comment_db($id);
$post_link = generate_postlink_variable($comment["post"]);
$self = $_SERVER["PHP_SELF"];
$post = $comment["post"];
$title = h($comment["title"]);
$author = h($comment["author"]);
$body = h($comment["body"]);
$script_link = make_url("assets/js/admin/comment_edit.js", true);

?>


<?php includes_header("Edit comment"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= make_url("admin/comments.php", true); ?>">Comments</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit comment</li>
      </ol>
    </nav>

    <h1 class="mb-4">Edit comment</h1>

    <?php if (!empty($_POST)): ?>
      <div class="alert alert-dismissible fade show <?= ($db_update_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
        <?= isset($db_update_error) ? $error_message : $success_message; ?>
      <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <a href="<?= $post_link; ?>" class="btn btn-outline-primary mb-4" target="_blank">View post &raquo;</a>

    <form method="post" action="<?= $self; ?>">
      <div class="form-group d-none">
        <input name="id" type="text" value="<?= $id; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="post" type="number" value="<?= $post; ?>" class="form-control">
      </div>
      <!-- two title form-group, one display and the other submit -->
      <div class="form-group">
        <input type="text" value="<?= $title; ?>" class="form-control" disabled>
      </div>
      <div class="form-group d-none">
        <input name="title" type="text" value="<?= $title; ?>" class="form-control">
      </div>
      <!-- two author form-group, one display and the other submit -->
      <div class="form-group">
        <input type="text" value="<?= $author; ?>" class="form-control" disabled>
      </div>
      <div class="form-group d-none">
        <input name="author" type="text" value="<?= $author; ?>" class="form-control">
      </div>
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" class="form-control"><?= $body; ?></textarea>
      </div>
      <input type="submit" id="submit" value="Save" class="btn btn-primary">
    </form>
    
  </main>

  <?= add_script($script_link); ?>

<?php includes_footer(); ?>
