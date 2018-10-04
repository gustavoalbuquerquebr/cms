<?php

function delete_comment_db() {
  $id = $_POST["id"];

  $db_connection = new_db_connection();

  $query = "DELETE FROM comments where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  close_db_connection($db_connection, $result);

  exit($result);
}

function fetch_comments_db() {
  $db_connection = new_db_connection();

  $query = "SELECT comments.id, comments.post,
            comments.user, comments.body,
            posts.title as post_title FROM comments 
            JOIN posts ON comments.post = posts.id
            ORDER BY comments.id DESC";
  $result = mysqli_query($db_connection, $query);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $comments;
}


function generate_postlink_html($post) {
  return make_url("post.php?id=", true) . $post;
}


function generate_editlink_html($comment_id) {
  return make_url("admin/comment_edit.php?id=", true). $comment_id;
}
