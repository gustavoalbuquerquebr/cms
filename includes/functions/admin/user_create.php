<?php

function fetch_users_db() {
  $db_connection = new_db_connection();

  $query = "SELECT id, username FROM users";

  $result = mysqli_query($db_connection, $query);

  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $users;
}


function check_duplicateusername_db($username, $id) {
  $users = fetch_users_db();

  foreach ($users as $user) {
    if ($user["username"] === $username) return true;
  }
  
  return false;
}


function insert_user_db() {
  
  $db_connection = new_db_connection();
  
  $username = mysqli_real_escape_string($db_connection, $_POST["username"]);
  $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);
  
  // username and password validation
  if (strlen($username) < 8 || strlen($username) > 25 || strlen($password) < 8 || strlen($password) > 25) return ["error", 1];
  
  // cannot insert if username already exists
  if (check_duplicateusername_db($username, $id ?? "")) return ["error", 2];

  $query = "INSERT INTO users (username, `password`)
            VALUES (\"$username\", \"$password_hashed\")";

  $result = mysqli_query($db_connection, $query);

  if ($result === false) return ["error", 3];

  $new_post_id = mysqli_insert_id($db_connection);

  mysqli_close($db_connection);

  return ["success", $new_post_id];
}   


function redirect_url_newuserpage($user_id) {
  $url = make_url("author.php?id=", true) . $user_id;
  header("Location: $url");
}


function generate_errormessage_variable($db_insertion_error) {
  switch ($db_insertion_error){
    case 1: return "Username and password must have between 8 and 25 characters.";
    break;
    case 2: return "Username already exists.";
    break;
    case 3: return "Database error.";
    break;
  }
}


function generate_successmessage_variable($new_user_id, $new_user_name) {
  $link = make_url("author.php?id=", true) . $new_user_id;
  $message = "User <a href=\"$link\" class=\"alert-link\">$new_user_name</a> created!";

  return $message;
}