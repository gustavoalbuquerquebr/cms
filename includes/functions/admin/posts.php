<?php

function delete_post_db() {
  if ($_POST["action"] === "delete") {
    $id = $_POST["id"];

    // open database connection
    $db_connection = new_db_connection();

    // delete comment
    $query = "DELETE FROM posts where id = \"$id\"";
    $result = mysqli_query($db_connection, $query);

    close_db_connection($db_connection, $result);

    exit($result);
  }
}

function fetch_posts_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch posts
  $query = "SELECT posts.id, posts.date, posts.title,
            posts.user AS user_id, users.username AS user_name
            FROM posts
            JOIN users ON posts.user = users.id
            ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $posts;
}

function generate_editlink_html($id) {
  return "post_edit.php?id=" . $id;
}


function generate_userpage_html($user_id) {
  return make_url("user.php?id=", true) . $user_id;
}


function generate_postpage_html($post_id) {
  return make_url("post.php?id=", true) . $post_id;
}
