<?php

function insert_page_db() {
  
  $db_connection = new_db_connection();

  empty($_SESSION) && session_start();

  $user = mysqli_real_escape_string($db_connection, $_SESSION["logged_user"]);
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);
  $nav = isset($_POST["nav"]) ? 1 : 0;
  $aside = isset($_POST["aside"]) ? 1 : 0;

  if ($title === "" || $body === "") {
    return ["error", 1];
  }

  $query = "INSERT INTO pages (user, nav, aside, title,  body)
            VALUES (\"$user\", \"$nav\", \"$aside\", \"$title\", \"$body\")";

  $result = mysqli_query($db_connection, $query);

  if (!$result) {
    return ["error", 2];
  }

  $new_page_id = mysqli_insert_id($db_connection);

  mysqli_free_result($query);
  mysqli_close($db_connection);

  return ["success", $new_page_id];
}


function redirect_url_newpagepage($new_page_id) {
    $url = make_url("page.php?id=", true) . $new_page_id;
    header("Location: $url");
}


function generate_errormessage_variable($error) {
  switch ($error) {
    case 1:
    // message here is different from those in other pages, because "aside" and "nav" inputs can be left blank
    $message = "Neither one of the text input fields can be left blank.";
    break;
    case 2 :
    $message = "Database error.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}
