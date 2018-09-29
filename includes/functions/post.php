<?php

function insert_comment_db() {
  
  $db_connection = new_db_connection();

  $post = mysqli_real_escape_string($db_connection, $_POST["current_post"]);
  $user = mysqli_real_escape_string($db_connection, $_POST["user"]);
  $comment = mysqli_real_escape_string($db_connection, $_POST["comment"]);

  $query = "INSERT INTO comments (post, author, body) VALUES (\"$post\", \"$user\", \"$comment\")";
  $result = mysqli_query($db_connection, $query);

  mysqli_close($db_connection);

  echo "success";

  exit();
}


function redirect_url_homepage() {
  $url = make_url("", true);
  header("Location: $url");
}


function fetch_post_db($current_post) {

  $db_connection = new_db_connection();

  $query = "SELECT posts.id, posts.date, posts.author as author_id,
            posts.category as category_id, posts.title,
            posts.body, users.username as author_name,
            categories.name as category_name
            FROM posts
            JOIN users
            ON posts.author = users.id
            JOIN categories
            ON posts.category = categories.id
            WHERE posts.id = \"$current_post\"";

  $result = mysqli_query($db_connection, $query);
  $post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $post;
}


function fetch_postsid_db() {
  $db_connection = new_db_connection();

  $query = "SELECT id FROM posts ORDER BY id";

  $result = mysqli_query($db_connection, $query);

  $posts_id = [];

  while ($row = mysqli_fetch_row($result)) {
    $posts_id[] = $row[0];
  }
  
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts_id;
}


function getid_prevpost_db($posts_id, $current_position) {
  if ($current_position !== 0) {
    return $posts_id[$current_position - 1];
  }
}


function getid_nextpost_db($posts_id, $current_position) {
  if ($current_position !== count($posts_id) - 1) {
    return $posts_id[$current_position + 1];
  }
}


function disable_prevpost_html($current_position) {
  return ($current_position === 0) ? "disabled" : "btn-primary";
}


function disable_nextpost_html($posts_id, $current_position) {
  return $current_position === count($posts_id) - 1 ? "disabled" : "btn-primary";
}


function fetch_comments_db($current_post) {
  
  $db_connection = new_db_connection();

  $query = "SELECT * FROM comments
            WHERE post = \"$current_post\"
            ORDER BY `date` DESC";

  $result = mysqli_query($db_connection, $query);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $comments;
}


function convert_nl2ptag_html($post) {
  return str_replace(["\n", "\r", "\r\n"], "</p><p>", $post);
}


function generate_categorylink_variable($category_id) {
  return make_url("category.php?id=" . $category_id, true);
}


function generate_authorlink_variable($author) {
  return make_url("author.php?id=", true) . $author;
}


function verify_ifmoderated_db($moderated) {
  if ($moderated) { 
    return " (moderated)"; 
  };
}