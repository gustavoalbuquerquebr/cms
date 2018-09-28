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
    if ($user["username"] === $username && $user["id"] !== $id) return true;
  }
  
  return false;
}


function update_user_db() {
  
  $db_connection = new_db_connection();
  
  $id = mysqli_real_escape_string($db_connection, $_POST["id"]);
  $username = mysqli_real_escape_string($db_connection, $_POST["username"]);
  $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);
  
  // username and password validation
  if (strlen($username) < 8 || strlen($username) > 25 || (strlen($password) > 0 && strlen($password) < 8) || strlen($password) > 25) return ["error", 1];
  
  // cannot insert if username already exists
  if (check_duplicateusername_db($username, $id)) return ["error", 2];

  // if the user didn't inserted a password (strlen === 0), the password won't change
  if (strlen($password) === 0) {
    $query = "UPDATE users SET username = \"$username\" WHERE id = \"$id\"";
  } else {
    $query = "UPDATE users SET username = \"$username\", `password` = \"$password_hashed\" WHERE id = \"$id\"";
  }

  $result = mysqli_query($db_connection, $query);

  if ($result === false) return ["error", 3];

  mysqli_close($db_connection);

  return ["success", $id];
}   


function redirect_url_newuserpage($user_id) {
  $url = make_url("author.php?id=", true) . $user_id;
  header("Location: $url");
}


function generate_errormessage_variable($db_insertion_error) {
  switch ($db_insertion_error){
    case 1: $message = "Username and password must be at least 8 characters long.";
    break;
    case 2: $message = "Username already exists.";
    break;
    case 3: $message = "Database connection failed.";
    break;
  }

  return $message . " Try again!";
}


function redirect_url_dashboard() {
  $url = make_url("admin", true);
  header("Location: $url");
}
