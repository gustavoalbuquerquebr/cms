<?php

function update_post_db() {
  // $id = $_POST["id"];
  // $title = $_POST["title"];
  // $post = $_POST["post"];

  // open database connection
  $db_connection = new_db_connection();

  $id = $_POST["id"];
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $post = mysqli_real_escape_string($db_connection, $_POST["post"]);

  // fetch posts
  $query = "UPDATE posts SET title = \"$title\", body = \"$post\" WHERE id = $id";
  $result = mysqli_query($db_connection, $query);

  // closing
  mysqli_close($db_connection);

  // $redirect = make_url("posts/index.php?id=" . $id);
  $url = make_url("post.php?id=", true) . $id;
  header("Location: $url");

  exit();
}

function fetch_post_db($id) {
  // open database connection
  $db_connection = new_db_connection();

  // fetch posts
  $query = "SELECT * FROM posts WHERE id = \"$id\"";
  $result = mysqli_query($db_connection, $query);
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $post;
}

?>