<?php

function update_post_db() {
  $db_connection = new_db_connection();

  $id = $_POST["id"];
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $post = mysqli_real_escape_string($db_connection, $_POST["post"]);

  $query = "UPDATE posts
            SET title = \"$title\", body = \"$post\"
            WHERE id = $id";

  $result = mysqli_query($db_connection, $query);

  mysqli_close($db_connection);

  $url = make_url("admin/post_edit.php?id=", true) . $id;
  header("Location: $url");

  exit();
}

function fetch_post_db($id) {
  $db_connection = new_db_connection();

  $query = "SELECT * FROM posts WHERE id = \"$id\"";
  $result = mysqli_query($db_connection, $query);
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $post;
}


function redirect_url_dashboard() {
  $url = make_url("admin", true);
  header("Location: $url");
}
