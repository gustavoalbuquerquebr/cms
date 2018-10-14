<?php

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


function generate_pagetitle_html($page_title) {
  return (!empty($page_title)) ? PROJECT_NAME . " - $page_title" : PROJECT_NAME;
}


function fetch_loggedusername_db() {

  $db_connection = new_db_connection();

  $query = "SELECT username FROM users WHERE id = '" . $_SESSION["logged_user"] . "'";

  $result = mysqli_query($db_connection, $query);

  $username = mysqli_fetch_assoc($result)["username"];

  !$username && redirect_to("admin/logout.php?redirect=dashboard") && exit;

  return $username;
}
