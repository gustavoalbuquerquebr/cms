<?php

function fetch_comment_db($id) {
  $db_connection = new_db_connection();

  $query = "SELECT comments.id, comments.user, comments.date, comments.post, comments.body, posts.title FROM comments
            JOIN posts ON comments.post = posts.id WHERE comments.id = \"$id\"";

  $result = mysqli_query($db_connection, $query);

  $comment = mysqli_fetch_assoc($result);

  close_db_connection($db_connection, $result);

  return $comment;
}


function update_comment_db() {
  $db_connection = new_db_connection();

  $id = mysqli_real_escape_string($db_connection, $_POST["id"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);

  if (strlen($body) === 0) {
    return ["error", 1];
  }

  $query = "UPDATE comments SET body = \"$body\", moderated = 1 WHERE id = \"$id\"";

  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);

  return $result ? ["success"] : ["error", 2];
}


function generate_postlink_variable($post) {
  return make_url("post.php?id=", true) . $post;
}


function generate_errormessage_variable($error) {
  
  switch ($error) {
    case 1: $message = "Neither one of the fields can be left blank.";
    break;
    case 2: $message = "Database error.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}
