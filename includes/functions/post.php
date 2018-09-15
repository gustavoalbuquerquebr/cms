<?php

function insert_comment_db() {

  $post = $_POST["current_post"];
  $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
  $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);

  $db_connection = new_db_connection();

  $query = "INSERT INTO comments (post, author, body) VALUES (\"$post\", \"$user\", \"$comment\")";
  $result = mysqli_query($db_connection, $query);

  mysqli_close($db_connection);

  echo "success";

  exit();
}

function fetch_post_db($current_post) {

  $db_connection = new_db_connection();

  $query = "SELECT * FROM posts WHERE id = \"$current_post\"";

  $result = mysqli_query($db_connection, $query);
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $post;
}

function fetch_comments_db($current_post) {
  
  $db_connection = new_db_connection();

  $query = "SELECT * FROM comments WHERE post = \"$current_post\" ORDER BY `date` DESC";

  $result = mysqli_query($db_connection, $query);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $comments;
}

?>