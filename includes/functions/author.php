<?php

function redirect_url_homepage() {
  $url = make_url("", true);
  header("Location: $url");
}

function count_posts_db($author) {
  
  $db_connection = new_db_connection();

  $query = "SELECT COUNT(id) FROM posts WHERE author = \"$author\"";

  $result = mysqli_query($db_connection, $query);
  $posts_total = mysqli_fetch_row($result)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts_total;
}


function fetch_posts_db($author, $posts_per_page, $query_offset) {

  $db_connection = new_db_connection();

  $query = "SELECT posts.id, posts.date, posts.title,
            posts.body, users.username as author
            FROM posts
            INNER JOIN users
            ON posts.author = users.id
            WHERE posts.author = \"$author\"
            ORDER BY posts.id DESC
            LIMIT  $posts_per_page
            OFFSET $query_offset";

  $result = mysqli_query($db_connection, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts;
}


function generate_nextlink_ui($author, $current_page) {
  return "$_SERVER[PHP_SELF]?id=" . $author . "&page=" . ($current_page + 1);
}


function generate_prevlink_ui($author, $current_page) {
  return "$_SERVER[PHP_SELF]?id=" . $author . "&page=" . ($current_page - 1);
}


function disable_nextlink_ui($current_page, $pages_total) {
  return ($current_page == $pages_total) ? "disabled" : "btn-primary";
}


function disable_previouslink_ui($current_page) {
  return ($current_page == 1) ? "disabled" : "btn-primary";
}


function generate_postlink_html($id) {
  return make_url("post.php?id=", true) . urlencode($id);
}


function generate_blogexcerpt_html($post) {
  if (strlen($post) > CHAR_PER_EXCERPT) {
    // get position of the first whitespace after CHAR_PER_EXCERPT
    $excerpt_length = strpos($post, " ", CHAR_PER_EXCERPT);
    // trim rigth before the the $excerpt_length
    $excerpt =  substr($post, 0, $excerpt_length);
    // if there is non-alphanumeric character(s) at the end, they will be removed
    // either way, append ellipsis
    return preg_replace("/\W{0,}$/", "...", $excerpt);
  } else {
    return $post;
  }
}
