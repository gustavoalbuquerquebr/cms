<?php

function delete_comment_db() {
  $id = $_POST["id"];

  // open database connection
  $db_connection = new_db_connection();

  // delete comment
  $query = "DELETE FROM comments where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  // closing database connection
  mysqli_close($db_connection);

  exit();
}

function fetch_comments_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch comments
  $query = "SELECT * FROM comments ORDER BY id";
  $result = mysqli_query($db_connection, $query);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $comments;
}

?>