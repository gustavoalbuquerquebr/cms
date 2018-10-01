<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comment_edit.php");

!is_logged() && redirect_to("admin/login.php") && exit;

empty($_GET) && empty($_POST) && redirect_to("admin/login.php") && exit;

// handle submition from this page form
if (!empty($_POST)) {

  $result = update_comment_db();

  if ($result[0] === "success") {
    $success_message = "<strong>Success:</strong> Comment was updated.";

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
$user = h($comment["user"]);
$date = $comment["date"];
$output_id = "<strong>ID: </strong>$id";
$output_post = "<strong>Post: </strong> $post";
$output_user = "<strong>user: </strong>$user";
$output_date = "<strong>Date: </strong>$date";
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
      <!-- not form inputs, are used only for display -->
      <div class="form-group">
        <p class="form-control disabled-input"> <?= $output_id; ?> </p>
      </div>
      <div class="form-group">
        <p class="form-control disabled-input"> <?= $output_date; ?> </p>
      </div>
      <div class="form-group">
        <p class="form-control disabled-input"> <?= $output_post; ?> </p>
      </div>
      <div class="form-group">
        <p class="form-control disabled-input"> <?= $output_user; ?> </p>
      </div>
      <!-- display none, are used only to send data with form submission -->
      <div class="form-group d-none">
        <input name="id" type="text" value="<?= $id; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="date" type="text" value="<?= $date; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="post" type="number" value="<?= $post; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="title" type="text" value="<?= $title; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="user" type="text" value="<?= $user; ?>" class="form-control">
      </div>
      <!--  -->
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" class="form-control"><?= $body; ?></textarea>
      </div>
      <input type="submit" id="submit" value="Save" class="btn btn-primary">
    </form>
    
  </main>

  <?= add_script($script_link); ?>

<?php includes_footer(); ?>
