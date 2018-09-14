<?php

// verify if the user is logged
session_start();
if(!isset($_SESSION["auth"])) {
  header("Location: login.php");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

if(!empty($_POST)) {
  $id = $_POST["id"];

  // open database connection
  $db_connection = new_db_connection();

  // delete comment
  $query = "DELETE FROM comments where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  // closing database connection
  mysqli_close($db_connection);

  exit();
}

// head variables
$page_title = "Manage comments";
$stylesheet = "end";

// open database connection
$db_connection = new_db_connection();

// fetch comments
$query = "SELECT * FROM comments ORDER BY id";
$result = mysqli_query($db_connection, $query);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// closing
mysqli_free_result($result);
mysqli_close($db_connection);

?>

<?php require make_url("includes/templates/header.php"); ?>

  <h1>Manage comments</h1>

  <table style="width:100%; text-align:center;">
    <thead>
      <tr>
        <th></th>
        <th>ID</th>
        <th>Post</th>
        <th>User</th>
        <th>Comment</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($comments as $comment): ?>
        <tr>
          <td class="delete" data-id=<?php echo $comment["id"] ?>>&times;</td>
          <td><?php echo $comment["id"] ?></td>
          <td><?php echo $comment["post"] ?></td>
          <td><?php echo $comment["user"] ?></td>
          <td><?php echo $comment["comment"] ?></td>
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

        data.append("id", id);

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "<?php echo $_SERVER["PHP_SELF"]?>", true);

        xhr.onload = function() {
          row.parentElement.removeChild(row);
        }

        xhr.send(data);

      }
    })
  </script>

<?php require make_url("includes/templates/footer.php"); ?>