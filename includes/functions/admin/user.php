<?php

function fetch_users_db() {
  $db_connection = new_db_connection();

  $query = "SELECT id, username FROM users";

  $result = mysqli_query($db_connection, $query);

  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connection);

  return $users;
}


function check_duplicateusername_db($username, $id) {
  $users = fetch_users_db();

  if(empty($id)) {
    foreach($users as $user) {
      if($user["username"] === $username) return true;
    }
    
    return false;

  } else {
    foreach($users as $user) {
      if($user["username"] === $username && $user["id"] !== $id) return true;
    }
    
    return false;
  }

}


function insertorupdate_user_db() {
  
  $db_connection = new_db_connection();
  
  if(isset($_POST["id"])) $id = mysqli_real_escape_string($db_connection, $_POST["id"]);
  $username = mysqli_real_escape_string($db_connection, $_POST["username"]);
  $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);
  
  // username and password validation
  if(strlen($username) < 8 || (strlen($password) > 0 && strlen($password) < 8)) return ["error", 1];
  
  // cannot insert if username already exists
  // DANGER: null coalescing operator inside function call
  if(check_duplicateusername_db($username, $id ?? "")) return ["error", 2];

  if(strlen($password) === 0) {
    if(isset($id)) {
    $query = "UPDATE users
              SET username = \"$username\"
              WHERE id = \"$id\"";
    } else {
    $query = "INSERT INTO users (username)
              VALUES (\"$username\")";
    }
  } else {
    
      if(isset($id)) {
      $query = "UPDATE users
                SET username = \"$username\", `password` = \"$password_hashed\"
                WHERE id = \"$id\"";
      } else {
      $query = "INSERT INTO users (username, `password`)
                VALUES (\"$username\", \"$password_hashed\")";
      }
  }


  $result = mysqli_query($db_connection, $query);

  if($result === false) return ["error", 3];

  $this_post_id = $id ? $id : mysqli_insert_id($db_connection);

  mysqli_close($db_connection);

  return ["success", $this_post_id];
}   


function redirect_url_newuserpage($user_id) {
  $url = make_url("user.php?id=", true) . $user_id;
  header("Location: $url");
}


function generate_errormessage_variable($db_insertion_error) {
  switch($db_insertion_error){
    case 1: return "Username and password must be at least 8 characters long.";
    break;
    case 2: return "Username already exists.";
    break;
    case 3: return "Database connection failed.";
    break;
  }
}

?>