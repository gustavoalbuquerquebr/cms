<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

// head variables
$page_title = "Login";
$stylesheet = "end";

if(isset($_POST["submit"])) {
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
    echo "user not found!";
  } elseif(!password_verify($pass, $user["password"])) {
    echo "wrong password!";
  } else {
    session_start();
    $_SESSION["auth"] = true;
    header("Location: index.php");
  }
}

?>

<?php require make_url("includes/templates/header.php"); ?>

  <form method="post">
    <input type="text" name="user">
    <input type="password" name="pass">
    <input type="submit" name="submit">
  </form>

<?php require make_url("includes/templates/footer.php"); ?>