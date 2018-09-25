<?php

function fetch_usernames_db() {
  $db_connection = new_db_connection();

  $query = "SELECT username FROM users";

  $result = mysqli_query($db_connection, $query);

  $usernames = [];

  while($row = mysqli_fetch_assoc($result)) {
    $usernames[] = $row["username"];
  }

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $usernames;
}

function insert_user_db() {

  $usernames = fetch_usernames_db();

  $db_connection = new_db_connection();


  $username = mysqli_real_escape_string($db_connection, $_POST["username"]);
  $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  // username and password validation
  if(strlen($username) < 8 || strlen($password) < 8) {
    return ["error", 1];
  } elseif(in_array($username, $usernames)) {
    return ["error", 2];
  }

  $query = "INSERT INTO users (username, `password`)
            VALUES (\"$username\", \"$password_hashed\")";

  mysqli_query($db_connection, $query);

  $new_post_id = mysqli_insert_id($db_connection);

  mysqli_close($db_connection);

  return ["success", $new_post_id];
}

?>