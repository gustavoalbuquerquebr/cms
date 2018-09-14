<?php

// verify if the user is logged
session_start();
if(!isset($_SESSION["auth"])) {
  header("Location: login.php");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

if(!empty($_POST)) {

  if($_POST["action"] === "delete") {
    $id = $_POST["id"];

    // open database connection
    $db_connection = new_db_connection();

    // delete comment
    $query = "DELETE FROM posts where id = \"$id\"";
    $result = mysqli_query($db_connection, $query);

    // closing database connection
    mysqli_close($db_connection);

    exit();
  }
}

// head variables
$page_title = "Manage posts";
$stylesheet = "end";

// open database connection
$db_connection = new_db_connection();

// fetch posts
$query = "SELECT id, `date`, title FROM posts ORDER BY id DESC";
$result = mysqli_query($db_connection, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// closing
mysqli_free_result($result);
mysqli_close($db_connection);

function edit_link($id) {
  echo "post_edit.php?id=" . $id;
}

?>

<?php require make_url("includes/templates/header.php"); ?>

  <h1>Manage posts</h1>

  <table style="width:100%; text-align:center;">
    <thead>
      <th></th>
      <th></th>
      <th>ID</th>
      <th>Date</th>
      <th>Title</th>
    </thead>
    <tbody>
      <?php foreach($posts as $post): ?>
        <tr>
          <td class="delete" data-id="<?php echo $post["id"]; ?>">&times;</td>
          <td class="edit"><a href="<?php echo edit_link($post["id"]); ?>">Edit</a></td>
          <td><?php echo $post["id"]; ?></td>
          <td><?php echo $post["date"]; ?></td>
          <td><?php echo $post["title"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    let tbody = document.querySelector("tbody");

    tbody.addEventListener("click", function(e) {

      if(e.target.classList.contains("delete")) {
        let row = e.target.parentElement;
        let id = e.target.dataset.id;

        let data = new FormData();

        data.append("action", "delete")

        data.append("id", id);

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "<?php echo $_SERVER["PHP_SELF"]?>", true);

        xhr.onload = function() {
          console.log(this.responseText);
          row.parentElement.removeChild(row);
        }

        xhr.send(data);
      }

    })
  </script>

<?php require make_url("includes/templates/footer.php"); ?>