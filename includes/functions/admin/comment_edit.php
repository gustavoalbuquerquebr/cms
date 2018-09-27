<?php

function fetch_comment_db($id) {
  $db_connection = new_db_connection();

  $query = "SELECT comments.id, comments.author, comments.post, comments.body, posts.title FROM comments
            LEFT JOIN posts ON comments.post = posts.id WHERE comments.id = \"$id\"";

  $result = mysqli_query($db_connection, $query);

  $comment = mysqli_fetch_assoc($result);

  // mysqli_free_result($result);
  mysqli_close($db_connection);

  return $comment;
}


function update_comment_db() {
  $db_connection = new_db_connection();

  $id = mysqli_real_escape_string($db_connection, $_POST["id"]);
  $body = mysqli_real_escape_string($db_connection, $_POST["body"]);

  $query = "UPDATE comments SET body = \"$body\", moderated = 1 WHERE id = \"$id\"";

  if (mysqli_query($db_connection, $query)) {
    mysqli_close($db_connection);
    return "success";
  } else {
    return "error";
  }

}


function redirect_url_postpage() {
  $url = make_url("post.php?id=", true) . $_POST["post_id"];
  header("Location: $url");
}


function generate_postlink_html($post) {
  return make_url("post.php?id=", true) . $post;
}


function redirect_url_dashboard() {
  $url = make_url("admin", true);
  header("Location: $url");
}
