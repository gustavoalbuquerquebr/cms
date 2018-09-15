<?php

function count_posts_db() {
  
  $db_connection = new_db_connection();

  $query = "SELECT COUNT(id) FROM posts";

  $result = mysqli_query($db_connection, $query);
  $posts_total = mysqli_fetch_row($result)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts_total;
}


function fetch_posts_db($posts_per_page, $query_offset) {

  $db_connection = new_db_connection();

  $query = "SELECT * FROM posts
            ORDER BY id DESC
            LIMIT $posts_per_page
            OFFSET $query_offset";

  $result = mysqli_query($db_connection, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts;
}


function generate_btnnext_ui($current_page) {
  return "$_SERVER[PHP_SELF]?page=" . ($current_page + 1);
}

function generate_btnprev_ui($current_page) {
  return "$_SERVER[PHP_SELF]?page=" . ($current_page - 1);
}

function disable_btnnext_ui($current_page, $pages_total) {
  return $current_page == $pages_total ? "disabled" : "";
}

function disable_btnprevious_ui($current_page) {
  return $current_page == 1 ? "disabled" : "";
}

function generate_postlink_html($id) {
  return "post.php?id=" . $id;
}


?>