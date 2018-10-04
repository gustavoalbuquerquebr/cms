<?php

function delete_user_db() {
  $id = $_POST["id"];

  // open database connection
  $db_connection = new_db_connection();

  // delete comment
  $query = "DELETE FROM users where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);

  exit($result);
}

function fetch_users_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch comments
  $query = "SELECT * FROM users ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $users;
}


function generate_editlink_html($user) {
  return make_url("admin/user_edit.php", true) . "?id=" . $user["id"] . "&username=" . $user["username"];
}


function count_postsbyuser_db() {
  $db_connection = new_db_connection();

  $query = "SELECT user, COUNT(id) as total
            FROM posts GROUP BY user";

  $result = mysqli_query($db_connection, $query);

  $total_posts_by_user = [];

  while($row = mysqli_fetch_assoc($result)) {
    $total_posts_by_user[$row["user"]] = $row["total"];
  }

  close_db_connection($db_connection, $result);

  return $total_posts_by_user;
}


function generate_userlink_html($id) {
  return make_url("user.php?id=", true) . $id;
}
