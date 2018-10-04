<?php

function delete_page_db() {
  if ($_POST["action"] === "delete") {
    $id = $_POST["id"];

    // open database connection
    $db_connection = new_db_connection();

    // delete comment
    $query = "DELETE FROM pages where id = \"$id\"";
    $result = mysqli_query($db_connection, $query);

    close_db_connection($db_connection, $result);

    exit($result);
  }
}

function fetch_pages_db() {
  $db_connection = new_db_connection();

  $query = "SELECT pages.id, pages.date, pages.title,
            pages.user AS user_id, users.username AS user_name
            FROM pages
            JOIN users ON pages.user = users.id
            ORDER BY id DESC";
  $result = mysqli_query($db_connection, $query);
  $pages = mysqli_fetch_all($result, MYSQLI_ASSOC);

  close_db_connection($db_connection, $result);

  return $pages;
}

function generate_editlink_html($id) {
  return "page_edit.php?id=" . $id;
}


function generate_userpage_html($user_id) {
  return make_url("user.php?id=", true) . $user_id;
}


function generate_pagepage_html($page_id) {
  return make_url("page.php?id=", true) . $page_id;
}
