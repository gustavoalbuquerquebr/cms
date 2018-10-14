<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/install.php");

test_db_connection() && redirect_to("");

if (!empty($_POST)) {

  // make sure that there's no session leftovers from the last installation
  logout();

  $install = install_cms_db();

  if ($install[0] === "success") {
    redirect_to("");
    exit;
  }

  if ($install[0] === "error") {
    $error = $install[1];
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Install</title>
  <link href="<?= FONT_TITLE; ?>" rel="stylesheet">
  <link href="<?= FONT_BODY; ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= STYLESHEET_BOOTSTRAP; ?>">
  <link rel="stylesheet" href="<?= generate_globalcsslink_html(); ?>">
</head>
<body>

  <main class="container mt-5">

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">CMS Install</h1>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span><?= $error; ?></span>
          <button class="close" type="button" data-dismiss="alert"><span>&times;</span></button>
        </div>
      <?php endif; ?>

      <form method="post" class="mb-3">
        <div class="form-group">
          <input type="text" name="username" placeholder="user" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="password" class="form-control">
        </div>
        <div class="custom-control custom-checkbox mb-3">
          <input type="checkbox" name="lorem" id="lorem" class="custom-control-input" checked>
          <label for="lorem" class="custom-control-label">Generate lorem ipsum posts, pages, comments and users</label>
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
      </form>

    </div>

  </main>

  <?php includes_footer(); ?>
