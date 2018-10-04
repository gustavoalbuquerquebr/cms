<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/page_edit.php");

!is_logged() && redirect_to("admin/login.php") && exit;

empty($_GET) && empty($_POST) && redirect_to("admin/login.php") && exit;

if (!empty($_POST)){
  $result = update_page_db();

  if ($result[0] === "success") {
    $success_message = "<strong>Success:</strong> Page was updated.";

  }  else {
    $db_update_error = $result[1];
    $error_message = generate_errormessage_variable($db_update_error);
  }
}

// HTML output
$page = empty($_POST) ? fetch_page_db() : $_POST;
$id = $_GET["id"] ?? $page["id"];
$output_id = "<strong>ID: </strong> $id";
$view_page_link = make_url("page.php?id=", true) . $id;
$self = $_SERVER["PHP_SELF"];
$title = h($page["title"]);
$body = $page["body"];
// if set to 1 (in get requests) or on (in post requests), check
$nav = isset($page["nav"]) ? ($page["nav"] ? "checked" : "") : "";
$aside = isset($page["aside"]) ? ($page["aside"] ? "checked" : "") : "";

?>


<?php includes_header("Edit page") ?>

  <main class="container mb-5">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= make_url("admin/pages.php", true); ?>">Pages</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit page</li>
    </ol>
  </nav>

  <h1 class="mb-4">Edit page</h1>

    <?php if (!empty($_POST)): ?>
      <div class="alert alert-dismissible fade show <?= ($db_update_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
        <?= isset($db_update_error) ? $error_message : $success_message; ?>
      <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <a href="<?= $view_page_link; ?>" class="btn btn-outline-primary mb-4" target="_blank">View page &raquo;</a>

    <form method="post" action="<?= $self; ?>">
      <!-- not form inputs, are used only for display -->
      <div class="form-group">
        <p class="form-control disabled-input"> <?= $output_id; ?> </p>
      </div>
      <div class="input-group mb-3">
        <p class="form-control disabled-input">Aside</p>
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" name="aside" <?= $aside; ?>>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <p class="form-control disabled-input">Nav</p>
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" name="nav" <?= $nav; ?>>
          </div>
        </div>
      </div>
      <!-- display none, are used only to send data with form submission -->
      <div class="form-group d-none">
        <input name="id" type="number" value="<?= $id; ?>" class="form-control">
      </div>
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
