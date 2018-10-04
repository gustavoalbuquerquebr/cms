<?php

function verify_auth_db() {
  
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  
  $db_connection = new_db_connection();
  
  $query = "SELECT * FROM users WHERE username = \"$user\"";

  $result = mysqli_query($db_connection, $query);

  $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0] ?? "";

  close_db_connection($db_connection, $result);
  
  if (empty($user)) {
    
    $GLOBALS["error"] = 1;
    
  } elseif (!password_verify($pass, $user["password"])) {
    
    $GLOBALS["error"] = 2;
    
  } else {
    session_start();
    $_SESSION["logged_user"] = $user["id"];
    $_SESSION["last_active"] = time();
    redirect_to("admin/index.php");
  }
}
