<?php

function fetch_categories_db() {
  $db_connection = new_db_connection();

  $query = "SELECT id, `name` FROM categories";

  $result = mysqli_query($db_connection, $query);

  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $categories;
}


function check_duplicatename_db($name, $id) {
  $categories = fetch_categories_db();

  foreach ($categories as $category) {
    if ($category["name"] === $name) return true;
  }
  
  return false;
}


function insert_category_db() {
  
  $db_connection = new_db_connection();
  
  $name = mysqli_real_escape_string($db_connection, $_POST["name"]);
  
  if (strlen($name) === 0) {
    return ["error", 1];
  }
  
  // cannot insert if category already exists
  if (check_duplicatename_db($name, $id ?? "")) {
    return ["error", 2];
  }

  $query = "INSERT INTO categories (`name`) VALUES (\"$name\")";

  $result = mysqli_query($db_connection, $query);

  if ($result === false) {
    return ["error", 3];
  }

  $new_category_id = mysqli_insert_id($db_connection);

  close_db_connection($db_connection, $result);

  return ["success", $new_category_id];
}


function generate_errormessage_variable($db_insertion_error) {
  switch ($db_insertion_error){
    case 1: $message = "Neither one of the fields can be left blank.";
    break;
    case 2: $message = "Category already exists.";
    break;
    case 3: $message = "Database error.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}


function generate_successmessage_variable($new_category_id, $new_category_name) {
  $link = make_url("category.php?id=", true) . $new_category_id;
  $message = "<strong>Success:</strong> Category <span class=\"font-italic\">$new_category_name</span> was created.";

  return $message;
}