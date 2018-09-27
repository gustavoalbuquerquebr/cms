<?php

function insert_contact_db() {

  // emulate slow server to show spinner.gif
  sleep(2);

  
  if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    
    $db_connection = new_db_connection();

    $name = mysqli_real_escape_string($db_connection, $_POST["name"]);
    $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
    $message = mysqli_real_escape_string($db_connection, $_POST["message"]);

    $query = "INSERT INTO contact (`name`, email, `message`)
              VALUES (\"$name\", \"$email\", \"$message\")";
    $result = mysqli_query($db_connection, $query);

    mysqli_close($db_connection);

    // echo to javascript/ajax as this.responseText
    echo $result ? "success" : "request_error";
  } else {
    // echo to javascript/ajax as this.responseText
    echo "invalid_email";
  }

  // return true, the short-circuit at contact page will continue and execute exit command
  return true;
}
