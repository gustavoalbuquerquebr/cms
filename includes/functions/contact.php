<?php

function insert_contact_db() {

  // emulate slow server to show spinner.gif
  sleep(2);

  
  if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    // if email is valid
    
    $db_connection = new_db_connection();

    // put form data into variables
    $name = mysqli_real_escape_string($db_connection, $_POST["name"]);
    $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
    $message = mysqli_real_escape_string($db_connection, $_POST["message"]);

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