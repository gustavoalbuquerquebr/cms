<?php

function verify_auth_db() {
  
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  
  // open database connection
  $db_connection = new_db_connection();
  
  // fetch user
  $query = "SELECT * FROM users WHERE username = \"$user\"";
  $result = mysqli_query($db_connection, $query);
  $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0] ?? "";
  mysqli_free_result($result);
  mysqli_close($db_connection);
  
  if(empty($user)) {
    
    $GLOBALS["error"] = 1;
    
  } elseif(!password_verify($pass, $user["password"])) {
    
    $GLOBALS["error"] = 2;
    
  } else {
    session_start();
    $_SESSION["auth"] = true;
    header("Location: index.php");
  }
}

?>