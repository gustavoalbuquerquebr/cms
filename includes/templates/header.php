<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/templates/header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Page title -->
  <title><?= generate_pagetitle_html($page_title); ?></title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Global stylesheet -->
  <link rel="stylesheet" href="<?= generate_globalcsslink_html(); ?>">
  <!-- Add custom stylesheet, if there's any -->
  <?= custom_stylesheet($stylesheet); ?>
</head>
<body>

  <header class="mb-5">  

    <nav class="navbar navbar-dark bg-dark navbar-expand-md">
      <div class="container">
        
        <a href="<?= make_url(" ", true); ?>" class="navbar-brand">
          <?= PROJECT_NAME; ?>
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar"><span class="navbar-toggler-icon"></span></button>

        <ul id="navbar" class="navbar-nav collapse navbar-collapse justify-content-end small">

          <li class="nav-item">
            <a href="<?= make_url(" ", true); ?>" class="nav-link <?= verify_iscurrentpage_url("home"); ?>">Home</a>
          </li>
          
          <li class="nav-item">
            <a href="<?= make_url("contact.php", true); ?>" class="nav-link <?= verify_iscurrentpage_url("contact"); ?>">Contact</a>
          </li>

          <!-- If logged, display "Admin" dropdown, otherwise "Log In" link -->
          <?php if (is_logged()): ?>
            <li class="nav-item dropdown">
              <a href="<?= make_url("admin/index.php", true); ?>" class="nav-link dropdown-toggle <?= verify_iscurrentpage_url("admin"); ?>" href="#" role="button" data-toggle="dropdown">Admin</a>
              <div class="dropdown-menu">
                <a href="<?= make_url("user.php?id=", true) . $_SESSION["session_user"]; ?>" class="dropdown-item"><?= fetch_currentusername_db(); ?></a>
                <div class="dropdown-divider"></div>
                <a href="<?= make_url("admin/", true); ?>" class="dropdown-item font-weight-bold">Dashboard</a>
                <a href="<?= make_url("admin/posts.php", true); ?>" class="dropdown-item pl-5">Posts</a>
                <a href="<?= make_url("admin/comments.php", true); ?>" class="dropdown-item pl-5">Comments</a>
                <a href="<?= make_url("admin/users.php", true); ?>" class="dropdown-item pl-5">Users</a>
                <div class="dropdown-divider"></div>
                <a href="<?= make_url("admin/logout.php", true); ?>" class="dropdown-item">Logout</a>
              </div>
            </li>
          <?php else: ?>
            <li class="nav-item"><a href="<?= make_url("admin/login.php", true); ?>" class="nav-link <?= verify_iscurrentpage_url("admin"); ?>">Log In</a></li>
          <?php endif; ?>

        </ul>

      </div>
    </nav>

  </header>
