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

  $user = mysqli_real_escape_string($db_connection, $_SESSION["logged_user"]);
  $category = mysqli_real_escape_string($db_connection, $_POST["category"]);
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);

  if ($title === "" || $body === "") {
    return ["error", 1];
  }

  $query = "INSERT INTO posts (author, category, title, body)
            VALUES (\"$user\", \"$category\", \"$title\", \"$body\")";

  $result = mysqli_query($db_connection, $query);

  if (!$result) {
    return ["error", 2];
  }

  $new_post_id = mysqli_insert_id($db_connection);

  mysqli_free_result($query);
  mysqli_close($db_connection);

  return ["success", $new_post_id];
}


function redirect_url_newpostpage($new_post_id) {
    $url = make_url("post.php?id=", true) . $new_post_id;
    header("Location: $url");
}


function generate_errormessage_variable($error) {
  switch ($error) {
    case 1:
    $message = "Neither one of the fields can be left blank.";
    break;
    case 2 :
    $message = "Database error.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}


function select_option_html($category) {
  // default category is "uncategorized" except, for pages with error alert (previous submit failed)

  if (isset($_POST["category"])) {
    if ($category["id"] === $_POST["category"]) return "selected";
  } else {
    if (strtolower($category["name"]) === "uncategorized") return "selected";
  }
}
