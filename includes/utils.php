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

function test_db_connection() {
  
  // if DB_NAME is a empty string, test will fail
  if (DB_NAME === "") {
    return false;
  }

  // if DB_NAME exists, but contains no tables, test will fail
  $db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
  $db_name = DB_NAME;
  $query = "SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '$db_name'";
  $result = mysqli_query($db_connection, $query);
  $tables = (int) $result->fetch_array()[0];
  close_db_connection($db_connection, $query);
  if ($tables === 0) {
    return false;
  }

  // only if DB_NAME connects, test will pass
  try {
    mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return true;
    
  } catch (mysqli_sql_exception $e) {
    return false;
  }
}

function new_db_connection() {
  return mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}


function close_db_connection($db_connection, $result) {
  gettype($result) === "object" && mysqli_free_result($result);
  mysqli_close($db_connection);
}


// URL

// $_SERVER['DOCUMENT_ROOT'] returns the document root directory
// is a server-side path, and so it won't work client-side
// for client side code (css, js, redirects...),
// don't use this superglobal, instead start links with / to indicate the root

define("MY_ROOT", $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"]);

function make_url($path, $client_side = false) {
  
  $path = trim($path);

  // avoid duplicate slashes
  if ($path !== "" && $path[0] === "/") {
    $path = substr($path, 1);
  }

  if ($client_side) {
    return $_SERVER["HTTP_MY_ROOT"] . $path;
  } else {
    return MY_ROOT . "/" . $path;
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
      redirect_to("admin/logout.php?redirect=dashboard");
    }
  } else {
    // if session doesn't exist
    return false;
  }

  // return isset($_SESSION["logged_user"]);
}

function logout() {
  !isset($_SESSION) && session_start();
  session_destroy();
}


// STYLESHEETS

function generate_globalcsslink_html() {
  return make_url("assets/css/global.css", true);
}

function custom_stylesheet($stylesheet) {
  if (!empty($stylesheet)) {
    return '<link rel="stylesheet" href="'
            . make_url("assets/css/", true)
            . $stylesheet
            . ".css" . '">';
  }
}


// SCRIPTS

function add_script($script_link) {
  return "<script src=\"$script_link\"></script>";
}


function redirect_to($path) {
  $url = make_url($path, true);
  header("Location: $url");
}


// DATE

function instantiate_date($date, $format = "Y-m-d H:i:s") {
  $datetime = new DateTime($date);
  return $datetime->format($format);
}