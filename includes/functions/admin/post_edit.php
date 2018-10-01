<?php

function fetch_post_db() {
  $id = $_GET["id"];
  
  $db_connection = new_db_connection();

  $query = "SELECT * FROM posts WHERE id = \"$id\"";
  $result = mysqli_query($db_connection, $query);
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $post;
}


function update_post_db() {
  $db_connection = new_db_connection();

  $id = $_POST["id"];
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);

  if (strlen($title) === 0 || strlen($body) === 0) {
    return ["error", 1];
  }

  $query = "UPDATE posts
            SET title = \"$title\", body = \"$body\"
            WHERE id = $id";

  $result = mysqli_query($db_connection, $query);

  if (!$result) {
    return ["error", 2];
  }

  mysqli_close($db_connection);

  return ["success"];
}


function generate_errormessage_variable($error) {
  switch ($error) {
    case 1:
    $message = "Neither one of the fields can be left blank.";
    break;
    case 2:
    $message = "Database error.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}
