<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comment_edit.php");

!is_logged() && redirect_to_login();

// handle request from edit links at "manage comments" page
if (!empty($_GET)) {
  $id = $_GET["id"];
  $comment = fetch_comment_db($id);
}

// handle submition from this page form
if (!empty($_POST)) {
  if (update_comment_db() === "success") {
    redirect_url_postpage() && exit;
  } else {
    // if submission fail, this page will be rendered with error alert
    $error = true;
  }
}

// if no comment is send in the request, redirect to dashboard page
empty($_GET) && empty($_POST) && redirect_url_dashboard();

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

    <?php if (isset($error)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Something went wrong. Try again!
      <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <a href="<?= generate_postlink_html($comment["post"]); ?>" class="btn btn-outline-primary mb-4" target="_blank">View post</a>

    <form method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
      <div class="form-group d-none">
        <input name="id" type="text" value="<?= $comment["id"]; ?>" class="form-control">
      </div>
      <div class="form-group d-none">
        <input name="post_id" type="number" value="<?= $comment["post"]; ?>" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" value="<?= h($comment["title"]); ?>" class="form-control" disabled>
      </div>
      <div class="form-group">
        <input type="text" value="<?= h($comment["author"]); ?>" class="form-control" disabled>
      </div>
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" class="form-control"><?= h($comment["body"]); ?></textarea>
      </div>
      <input type="submit" id="submit" value="Save" class="btn btn-primary">
    </form>
    
  </main>

<?php includes_footer(); ?>