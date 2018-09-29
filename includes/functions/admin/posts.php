<?php

function delete_post_db() {
  if ($_POST["action"] === "delete") {
    $id = $_POST["id"];

    // open database connection
    $db_connection = new_db_connection();

    // delete comment
    $query = "DELETE FROM posts where id = \"$id\"";
    $result = mysqli_query($db_connection, $query);

    // closing database connection
    mysqli_close($db_connection);

    exit($result);
  }
}

function fetch_posts_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch posts
  $query = "SELECT posts.id, posts.date, posts.title,
            posts.author AS author_id, users.username AS author_name
            FROM posts
            JOIN users ON posts.author = users.id
            ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts;
}

function generate_editlink_html($id) {
  return "post_edit.php?id=" . $id;
}


function generate_authorpage_html($author_id) {
  return make_url("author.php?id=", true) . $author_id;
}


function generate_postpage_html($post_id) {
  return make_url("post.php?id=", true) . $post_id;
}
