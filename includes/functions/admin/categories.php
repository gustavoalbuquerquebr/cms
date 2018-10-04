<?php

function delete_category_db() {
  $id = $_POST["id"];

  // open database connection
  $db_connection = new_db_connection();

  // delete comment
  $query = "DELETE FROM categories where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);

  exit($result);
}

function fetch_categories_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch comments
  $query = "SELECT * FROM categories ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $categories;
}


function count_postsbycategory_db() {
  $db_connection = new_db_connection();

  $query = "SELECT category, COUNT(id) as total
            FROM posts GROUP BY category";

  $result = mysqli_query($db_connection, $query);

  $total_posts_by_category = [];

  while($row = mysqli_fetch_assoc($result)) {
    $total_posts_by_category[$row["category"]] = $row["total"];
  }

  close_db_connection($db_connection, $result);

  return $total_posts_by_category;
}


function generate_editlink_html($category) {
  return make_url("admin/category_edit.php", true) . "?id=" . $category["id"] . "&name=" . $category["name"];
}


function generate_categorylink_html($id) {
  return make_url("category.php?id=", true) . $id;
}
