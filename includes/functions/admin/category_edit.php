<?php

function fetch_categories_db() {
  $db_connection = new_db_connection();

  $query = "SELECT id, `name` FROM categories";

  $result = mysqli_query($db_connection, $query);

  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $categories;
}


function check_duplicatename_db($id, $name) {
  $categories = fetch_categories_db();

  foreach ($categories as $category) {
    if ($category["name"] === $name && $category["id"] !== $id) return true;
  }
  
  return false;
}


function update_category_db() {
  
  $db_connection = new_db_connection();
  
  $id = $_POST["id"];
  $name = mysqli_real_escape_string($db_connection, $_POST["name"]);
  
  if (strlen($name) === 0 ) {
    return ["error", 1];
  }
  
  // cannot rename category with the same name of another category
  if (check_duplicatename_db($id, $name)) {
    return ["error", 2];
  }

  $query = "UPDATE categories SET name = \"$name\" WHERE id = \"$id\"";

  $result = mysqli_query($db_connection, $query);

  if ($result === false) {
    return ["error", 3];
  }

  close_db_connection($db_connection, $result);

  return ["success", $id];
}


function generate_errormessage_variable($db_update_error) {
  switch ($db_update_error){
    case 1: $message = "Neither one of the fields can be left blank.";
    break;
    case 2: $message = "Category already exists.";
    break;
    case 3: $message = "Database connection failed.";
    break;
  }

  return "<strong>Error:</strong> " . $message . " Try again!";
}
