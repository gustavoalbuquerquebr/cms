<?php

// ALIASES

function h($html) {
  return htmlspecialchars($html);
}

function u($url_parameter) {
  return htmlspecialchars($url_parameter);
}


// INCLUDES

function includes_header($page_title = "", $stylesheet = "") {
  require_once make_url("includes/templates/header.php");
}

function includes_footer() {
  require_once make_url("includes/templates/footer.php");
}


// DATABASE

define("DB_HOST", "localhost");
define("DB_USER", "gustavo");
define("DB_PASS", "123");
define("DB_NAME", "cms");

function new_db_connection() {
  return mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}


// URL

// $_SERVER['DOCUMENT_ROOT'] returns the document root directory
// is a server-side path, and so it won't work client-side
// for client side code (css, js, redirects...),
// don't use this superglobal, instead start links with / to indicate the root

define("ROOT", $_SERVER["DOCUMENT_ROOT"] . "/cms");

function make_url($path, $client_side = false) {
  
  $path = trim($path);

  // avoid duplicate slashes
  if ($path !== "" && $path[0] === "/") {
    $path = substr($path, 1);
  }

  if ($client_side) {
    return "/" . PROJECT_FOLDER_NAME . "/" . $path;
  } else {
    return ROOT . "/" . $path;
  }
}


// SESSION

function is_logged() {
  !isset($_SESSION) && session_start();

  if(isset($_SESSION["logged_user"])) {

    // if session has not expire, update last_active and return true
    if (($_SESSION["last_active"] + LOGOUT_AUTOMATICALLY_AFTER) > time()) {
      $_SESSION["last_active"] = time();
      return true;

      // if session has expired, logout
    } else {
      $url = make_url("admin/logout.php?redirect=dashboard", true);
      header("Location: $url");
    }
  } else {
    // if session doesn't exist
    return false;
  }

  // return isset($_SESSION["logged_user"]);
}

function redirect_to_login() {
    $url = make_url("admin/login.php", true);
    header("Location: " . $url);
}


// SCRIPTS

function add_script($script_link) {
  return "<script src=\"$script_link\"></script>";
}