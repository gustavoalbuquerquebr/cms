<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: regenerate_my_root.php");

require_once $init_path;
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
    $errors = $install[1];
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

      <?php if (isset($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          <?php if (count($errors) > 1): ?>
            <ul class="mb-0">
              <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <span><?= $errors[0]; ?></span>
          <?php endif; ?>
          <button class="close" type="button" data-dismiss="alert"><span>&times;</span></button>
        </div>
      <?php endif; ?>

      <form method="post" class="mb-5">
        <div class="form-group">
          <p>Create a database and a user with read and write privileges and fill in the fields bellow</p>
        </div>
        <div class="form-group mt-4">
          <p class="font-weight-bold">Database</p>
        </div>
        <div class="form-group">
          <input type="text" name="dbhost" placeholder="Host" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="dbuser" placeholder="User" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="dbpass" placeholder="Password" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="dbname" placeholder="Name" class="form-control">
        </div>
        <div class="form-group mt-5">
          <p class="font-weight-bold">Site</p>
        </div>
        <div class="form-group">
          <input type="text" name="name" placeholder="Name" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="form-group mt-5">
          <p class="font-weight-bold">Login</p>
        </div>
        <div class="form-group">
          <input type="text" name="username" placeholder="Username" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="custom-control custom-checkbox mt-4">
          <input type="checkbox" name="lorem" id="lorem" class="custom-control-input" checked>
          <label for="lorem" class="custom-control-label">Generate lorem ipsum posts, pages, comments and users</label>
        </div>
        <div class="form-group mt-4">
          <input type="submit" value="Create" class="btn btn-primary">
        </div>
      </form>

    </div>

  </main>

  <?php includes_footer(); ?>
