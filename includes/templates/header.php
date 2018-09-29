<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/templates/header.php");


// HTML output
$homepage_link = make_url(" ", true);
$dashboard_link = make_url("admin/index.php", true);
$author_page_link = is_logged() ? make_url("author.php?id=", true) . $_SESSION["logged_user"] : "";
$manage_posts_link = make_url("admin/posts.php", true);
$manage_comments_link = make_url("admin/comments.php", true);
$manage_users_link = make_url("admin/users.php", true);
$logout_link = make_url("admin/logout.php?redirect=homepage", true);
$login_link = make_url("admin/login.php", true);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Page title -->
  <title><?= generate_pagetitle_html($page_title); ?></title>
  <link href="<?= FONT_TITLE; ?>" rel="stylesheet">
  <link href="<?= FONT_BODY; ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= STYLESHEET_BOOTSTRAP; ?>">
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
            <a href="<?= $homepage_link; ?>" class="nav-link <?= verify_iscurrentpage_url("home"); ?>">Home</a>
          </li>
          
          <li class="nav-item">
            <a href="<?= make_url("contact.php", true); ?>" class="nav-link <?= verify_iscurrentpage_url("contact"); ?>">Contact</a>
          </li>

          <!-- If logged, display "Admin" dropdown, otherwise "Log In" link -->
          <?php if (is_logged()): ?>
            <li class="nav-item dropdown">
              <a href="<?= $dashboard_link; ?>" class="nav-link dropdown-toggle <?= verify_iscurrentpage_url("admin"); ?>" href="#" role="button" data-toggle="dropdown">Admin</a>
              <div class="dropdown-menu">
                <a href="<?= $author_page_link; ?>" class="dropdown-item"><?= fetch_loggedusername_db(); ?></a>
                <div class="dropdown-divider"></div>
                <a href="<?= $dashboard_link; ?>" class="dropdown-item font-weight-bold">Dashboard</a>
                <a href="<?= $manage_posts_link; ?>" class="dropdown-item pl-5">Posts</a>
                <a href="<?= $manage_comments_link; ?>" class="dropdown-item pl-5">Comments</a>
                <a href="<?= $manage_users_link; ?>" class="dropdown-item pl-5">Users</a>
                <div class="dropdown-divider"></div>
                <a href="<?= $logout_link; ?>" class="dropdown-item">Logout</a>
              </div>
            </li>
          <?php else: ?>
            <li class="nav-item"><a href="<?= $login_link; ?>" class="nav-link <?= verify_iscurrentpage_url("admin"); ?>">Log In</a></li>
          <?php endif; ?>

        </ul>

      </div>
    </nav>

  </header>
