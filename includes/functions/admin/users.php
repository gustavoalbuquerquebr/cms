<?php

function delete_user_db() {
  $id = $_POST["id"];

  // open database connection
  $db_connection = new_db_connection();

  // delete comment
  $query = "DELETE FROM users where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  // closing database connection
  mysqli_close($db_connection);

  exit($result);
}

function fetch_users_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch comments
  $query = "SELECT * FROM users ORDER BY id";
  $result = mysqli_query($db_connection, $query);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $users;
}

?>