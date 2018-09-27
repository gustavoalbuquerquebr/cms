<?php

function custom_stylesheet($stylesheet) {
  if (!empty($stylesheet)) {
    return '<link rel="stylesheet" href="'
            . make_url("assets/css/", true)
            . $stylesheet
            . ".css" . '">';
  }
}


function verify_iscurrentpage_url($menu_item) {

  if ($_SERVER["PHP_SELF"] === "/cms/index.php") {
    $current_page = "home";

  } elseif ($_SERVER["PHP_SELF"] === "/cms/contact.php") {
    $current_page = "contact";

  } elseif (strpos($_SERVER["PHP_SELF"], "/cms/admin/") === 0) {
    $current_page = "admin";
  }

  if ($menu_item === "$current_page") return "active";
}


function fetch_username_db($session_user) {

  $db_connection = new_db_connection();

  $query = "SELECT username FROM users WHERE id = '" . $session_user . "'";

  $result = mysqli_query($db_connection, $query);

  $username = mysqli_fetch_assoc($result)["username"];

  return $username;
}


function generate_pagetitle_html($page_title) {
  return !empty($page_title) ? PROJECT_NAME . " - $page_title" : PROJECT_NAME;
}


function generate_globalcsslink_html() {
  return make_url("assets/css/global.css", true);
}


function fetch_currentusername_db() {
  return fetch_username_db($_SESSION["session_user"]) ?? "user deleted!";
}
