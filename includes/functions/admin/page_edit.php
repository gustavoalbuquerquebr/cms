<?php

function fetch_page_db() {
  $id = $_GET["id"];
  
  $db_connection = new_db_connection();

  $query = "SELECT * FROM pages WHERE id = \"$id\"";
  $result = mysqli_query($db_connection, $query);
  $page = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  close_db_connection($db_connection, $result);

  return $page;
}


function update_page_db() {
  $db_connection = new_db_connection();

  $id = $_POST["id"];
  $title = mysqli_real_escape_string($db_connection, $_POST["title"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);
  $nav = isset($_POST["nav"]) ? 1 : 0;
  $aside = isset($_POST["aside"]) ? 1 : 0;

  if ($title === "" || $body === "") {
    return ["error", 1];
  }

  $query = "UPDATE pages
            SET title = \"$title\", body = \"$body\",
            nav = \"$nav\", aside = \"$aside\"
            WHERE id = $id";

  $result = mysqli_query($db_connection, $query);

  if (!$result) {
    return ["error", 2];
  }

  close_db_connection($db_connection, $result);

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
