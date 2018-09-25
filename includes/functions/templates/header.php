<?php

function custom_stylesheet() {
  if(isset($GLOBALS["stylesheet"])) {
    return "<link rel=\"stylesheet\" href=\"" . make_url("assets/css/", true) . $GLOBALS["stylesheet"] . ".css" . "\">";
  }
}


function verify_currentpage_url($menu_item) {

  if($_SERVER["PHP_SELF"] === "/cms/index.php") $current_page = "home";
  if($_SERVER["PHP_SELF"] === "/cms/contact.php") $current_page = "contact";
  if(strpos($_SERVER["PHP_SELF"], "/cms/admin/") === 0) $current_page = "admin";

  if($menu_item === "$current_page") echo "active";
}


function fetch_username_db($session_user) {

  $db_connection = new_db_connection();

  $query = "SELECT username FROM users WHERE id = \"$session_user\"";

  $result = mysqli_query($db_connection, $query);

  $username = mysqli_fetch_assoc($result)["username"];

  return $username;
}

?>