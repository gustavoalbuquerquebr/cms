<?php

// verify if the user is logged
session_start();
if(!isset($_SESSION["auth"])) {
  header("Location: login.php");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

if(!empty($_POST)) {
  $id = $_POST["id"];
  $title = $_POST["title"];
  $post = $_POST["post"];


  // open database connection
  $db_connection = new_db_connection();

  // fetch posts
  $query = "UPDATE posts SET title = \"$title\", post = \"$post\" WHERE id = $id";
  $result = mysqli_query($db_connection, $query);

  // closing
  mysqli_close($db_connection);

  // $redirect = make_url("posts/index.php?id=" . $id);
  $redirect = "../post.php?id=" . $id;
  header("Location: $redirect");

  exit();
}

$post_id = $_GET["id"];

// open database connection
$db_connection = new_db_connection();

// fetch posts
$query = "SELECT * FROM posts WHERE id = \"$post_id\"";
$result = mysqli_query($db_connection, $query);
$post = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

// closing
mysqli_free_result($result);
mysqli_close($db_connection);

?>

<?php require make_url("includes/templates/header.php"); ?>

  <form method="post" action="post_edit.php">
    <input type="number" name="id" value="<?php echo $post["id"]; ?>" style="display:none;">
    <input name="title" type="text" value="<?php echo $post["title"]; ?>">
    <textarea name="post" cols="30" rows="10"><?php echo $post["post"]; ?></textarea>
    <input type="submit" id="submit">
  </form>


<?php require make_url("includes/templates/footer.php"); ?>