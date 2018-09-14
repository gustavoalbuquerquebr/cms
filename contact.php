<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

// head variables
$page_title = "Contact";
$stylesheet = "front";

// handle form submission
if(!empty($_POST)) {
  
  // emulate slow server
  sleep(2);

  // put form data into variables
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

  if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // if email is valid
    // open database connection
    
    $db_connection = new_db_connection();

    // insert comments into the database
    $query = "INSERT INTO contact (`name`, email, `message`) VALUES (\"$name\", \"$email\", \"$message\")";
    $result = mysqli_query($db_connection, $query);

    // close database connection
    mysqli_close($db_connection);

    // check if query was successful
    echo $result ? "success" : "request_error";
  } else {
    // if email is invalid
    echo "invalid_email";
  }

  // when fetch by post request, this page will end in the next line
  exit();
}

?>

<?php require make_url("includes/templates/header.php"); ?>

  <main>
    <form method="post" id="contact">
      <input type="text" name="name" id="name">
      <input type="name" name="email" id="email">
      <textarea name="message" cols="30" rows="10" id="message"></textarea>
      <input type="submit" id="submit">
    </form>
  </main>

  <div id="messageOutput"></div>

<script>

  // UI variables
  let form = document.querySelector("#contact");
  let nameInput = document.querySelector("#name");
  let emailInput = document.querySelector("#email");
  let messageInput = document.querySelector("#message");
  let submit = document.querySelector("#submit");
  let messageOutput = document.querySelector("#messageOutput");

  // form submit on this very page
  submit.addEventListener("click", function(e) {
    messageOutput.innerHTML = "<img src='<?php echo make_url("assets/images/spinner.gif", true); ?>' width='50' height='50'>";

    e.preventDefault();

    let data = new FormData(form);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "<?php echo $_SERVER["PHP_SELF"]?>", true);

    xhr.onload = function() {

        // output submit message
        let message;

        switch(this.responseText) {
          case "invalid_email": message = "Invalid email!"; break;
          case "request_error": message = "Something went wrong!"; break;
          case "success": message = "Message sent!"; break;
        }

        messageOutput.innerHTML = "<p>" + message + "</p>";

        // if successful, form inputs will be cleared
        if (this.responseText === "success") {
          nameInput.value = "";
          emailInput.value = "";
          messageInput.value = "";
        }
    };

    xhr.send(data);
  });
  
</script>

<?php require make_url("includes/templates/footer.php"); ?>
