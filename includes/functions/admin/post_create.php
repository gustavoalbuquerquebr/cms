<?php

function fetch_categories_db() {

  $db_connection = new_db_connection();

  $query = "SELECT id, `name`
            FROM categories
            ORDER BY id";

  $result = mysqli_query($db_connection, $query);

  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $categories;
}


function insert_post_db() {
  
  $db_connection = new_db_connection();

  empty($_SESSION) && session_start();

  $user = mysqli_real_escape_string($db_connection, $_SESSION["session_user"]);
  $category = mysqli_real_escape_string($db_connection, $_POST["category"]);
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);

  // post title and body cannot be blank
  if ($title === "" || $body === "") {
    return false;
  }

  $query = "INSERT INTO posts (author, category, title, body)
            VALUES (\"$user\", \"$category\", \"$title\", \"$body\")";

  mysqli_query($db_connection, $query);

  $new_post_id = mysqli_insert_id($db_connection);

  mysqli_close($db_connection);

  return $new_post_id;
}


function redirect_url_newpostpage($new_post_id) {
    $url = make_url("post.php?id=", true) . $new_post_id;
    header("Location: $url");
}
