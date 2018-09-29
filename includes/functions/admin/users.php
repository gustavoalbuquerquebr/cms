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
  $query = "SELECT * FROM users ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $users;
}


function generate_editlink_html($user) {
  return make_url("admin/user_edit.php", true) . "?id=" . $user["id"] . "&username=" . $user["username"];
}


function count_postsbyuser_db() {
  $db_connection = new_db_connection();

  $query = "SELECT author, COUNT(id) as total
            FROM posts GROUP BY author";

  $result = mysqli_query($db_connection, $query);

  $total_posts_by_user = [];

  while($row = mysqli_fetch_assoc($result)) {
    $total_posts_by_user[$row["author"]] = $row["total"];
  }

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $total_posts_by_user;
}


function generate_authorlink_html($id) {
  return make_url("author.php?id=", true) . $id;
}
