<?php

function delete_post_db() {
  if($_POST["action"] === "delete") {
    $id = $_POST["id"];

    // open database connection
    $db_connection = new_db_connection();

    // delete comment
    $query = "DELETE FROM posts where id = \"$id\"";
    $result = mysqli_query($db_connection, $query);

    // closing database connection
    mysqli_close($db_connection);

    exit();
  }
}

function fetch_posts_db() {
  // open database connection
  $db_connection = new_db_connection();

  // fetch posts
  $query = "SELECT posts.id, posts.date, posts.title, posts.author AS authorid, users.username AS authorname
            FROM posts
            INNER JOIN users ON posts.author = users.id
            ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // closing
  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $posts;
}

function generate_link_html($id) {
  echo "post_edit.php?id=" . $id;
}

?>