<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/page_create.php");

!is_logged() && redirect_to("admin/login.php") && exit;

// handle page creation
if (!empty($_POST)) {
  $result = insert_page_db();

  // if creation successful, redirect to new page
  $result[0] === "success" && redirect_to("page.php?id=" . $result[1]) && exit;
    
  // if creation unsuccessful, render page with error alert
    $db_insertion_error = $result[1];
    $error_message = generate_errormessage_variable($db_insertion_error);
}

// HTML output
$dashboard_link = make_url("admin/", true);
$pages_link = make_url("admin/pages.php", true);
$self = $_SERVER["PHP_SELF"];
$title = $_POST["title"] ?? "";
$body = $_POST["body"] ?? "";
$nav = !empty($_POST) ? (isset($_POST["nav"]) ? "checked" : "") : "checked";
$aside = !empty($_POST) ? (isset($_POST["aside"]) ? "checked" : "") : "checked";

?>


<?php includes_header("Create page"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $pages_link ?>">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create page</li>
      </ol>
    </nav>

    <h1 class="mb-4">Create page</h1>

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
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" placeholder="Body" class="form-control"><?= $body; ?></textarea>
      </div>
      <input type="submit" value="Create" class="btn btn-primary">
    </form>

  </main>

<?php includes_footer(); ?>
