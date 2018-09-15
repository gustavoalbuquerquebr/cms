<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/users.php");

!is_logged() && redirect_to_login();

!empty($_POST) && delete_user_db();

$users = fetch_users_db();

?>

<?php includes_header("Manage users", "end"); ?>

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
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/users.js", true); ?>"></script>

<?php includes_footer(); ?>