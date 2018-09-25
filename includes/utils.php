<?php

// INCLUDES

function includes_header($page_title, $stylesheet = "") {

  if(!empty($stylesheet)) {
    $GLOBALS["stylesheet"] = $stylesheet;
  }

  require make_url("includes/templates/header.php");
}

function includes_footer() {
  require make_url("includes/templates/footer.php");
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
  // avoid duplicate slashes
  if($path[0] === "/") {
    $path = substr($path, 1);
  }

  if($client_side) {
    return "/" . PROJECT_FOLDER_NAME . "/" . $path;
  } else {
    return ROOT . "/" . $path;
  }
}


// SESSION

function is_logged() {
  !isset($_SESSION) && session_start();
  return isset($_SESSION["session_user"]);
}

function redirect_to_login() {
    $url = make_url("admin/login.php", true);
    header("Location: " . $url);
}

?>