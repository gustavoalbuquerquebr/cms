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
  $query = "DELETE FROM users where id = \"$id\"";
  $result = mysqli_query($db_connection, $query);

  // closing database connection
  mysqli_close($db_connection);

  exit();
}

// head variables
$page_title = "Manage users";
$stylesheet = "end";

// open database connection
$db_connection = new_db_connection();

// fetch comments
$query = "SELECT * FROM users ORDER BY id";
$result = mysqli_query($db_connection, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// closing
mysqli_free_result($result);
mysqli_close($db_connection);

?>

<?php require make_url("includes/templates/header.php"); ?>

  <h1>Manage users</h1>

  <table style="width:100%; text-align:center;">
    <thead>
      <tr>
        <th></th>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $user): ?>
        <tr>
          <td class="delete" data-id=<?php echo $user["id"] ?>>&times;</td>
          <td><?php echo $user["id"] ?></td>
          <td><?php echo $user["username"] ?></td>
          <td><?php echo $user["password"] ?></td>
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