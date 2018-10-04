<?php

function fetch_page_db($current_page) {

  $db_connection = new_db_connection();

  $query = "SELECT pages.id, pages.date, pages.user as user_id,
            pages.title, pages.body, users.username as user_name,
            pages.aside, pages.nav
            FROM pages
            JOIN users
            ON pages.user = users.id
            WHERE pages.id = \"$current_page\"";

  $result = mysqli_query($db_connection, $query);
  $page = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

  close_db_connection($db_connection, $result);

  return $page;
}


function generate_userlink_variable($user) {
  return make_url("user.php?id=", true) . $user;
}


function convert_nl2ptag_html($page) {
  return str_replace(["\n", "\r", "\r\n"], "</p><p>", $page);
}
