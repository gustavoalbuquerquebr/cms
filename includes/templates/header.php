<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo isset($page_title) ? PROJECT_NAME . " - $page_title" : "CMS"; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo make_url("assets/css/global.css", true); ?>">
  <?php echo custom_stylesheet(); ?>
</head>
<body>

  <header class="mb-5">  
    <nav class="navbar navbar-dark bg-dark navbar-expand-md">
      <div class="container">
        <a href="<?php echo make_url(" ", true); ?>" class="navbar-brand"><?php echo PROJECT_NAME; ?></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar"><span class="navbar-toggler-icon"></span></button>

        <ul id="navbar" class="navbar-nav collapse navbar-collapse justify-content-end small">
          <li class="nav-item"><a href="<?php echo make_url(" ", true); ?>" class="nav-link <?php verify_currentpage_url("home"); ?>">Home</a></li>
          <li class="nav-item"><a href="<?php echo make_url("contact.php", true); ?>" class="nav-link <?php verify_currentpage_url("contact"); ?>">Contact</a></li>
          <li class="nav-item dropdown">
            <a href="<?php echo make_url("admin/index.php", true); ?>" class="nav-link dropdown-toggle <?php verify_currentpage_url("admin"); ?>" href="#" role="button" data-toggle="dropdown">Admin</a>
            <div class="dropdown-menu">
              <a href="<?php echo make_url("admin/", true); ?>" class="dropdown-item font-weight-bold">Dashboard</a>
              <a href="<?php echo make_url("admin/posts.php", true); ?>" class="dropdown-item pl-5">Posts</a>
              <a href="<?php echo make_url("admin/comments.php", true); ?>" class="dropdown-item pl-5">Comments</a>
              <a href="<?php echo make_url("admin/users.php", true); ?>" class="dropdown-item pl-5">Users</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>