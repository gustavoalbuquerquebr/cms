<?php

function insert_contact_db() {

  // emulate slow server to show spinner.gif
  sleep(2);

  // put form data into variables
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

  if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // if email is valid
    
    $db_connection = new_db_connection();

    $query = "INSERT INTO contact (`name`, email, `message`)
              VALUES (\"$name\", \"$email\", \"$message\")";
    $result = mysqli_query($db_connection, $query);

    mysqli_close($db_connection);

    // check if query was successful
    echo $result ? "success" : "request_error";
  } else {
    // if email is invalid
    echo "invalid_email";
  }

  exit();
}

?>