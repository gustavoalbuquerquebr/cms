<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/users.php");

!is_logged() && redirect_to_login() && exit;

!empty($_POST) && delete_user_db();

$users = fetch_users_db();

?>


<?php includes_header("Manage users"); ?>

  <div id="deleteModal" class="modal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this post?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
      </ol>
    </nav>

    <h1 class="mb-4">Manage users</h1>

    <a href="<?= make_url("admin/user_create.php", true); ?>" class="btn btn-primary mb-4 create-page-link-white">Create user</a>

    <div class="table-responsive">
      <table class="table table-hover" style="width:100%; text-align:center;">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>(edit)</th>
            <th>(delete)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user["id"] ?></td>
              <td><?= $user["username"] ?></td>
              <td><?= $user["password"] ?></td>
              <td><a href="<?= generate_editlink_html($user); ?>" class="edit-link"></a></td>
              <td class="text-danger" data-id=<?= $user["id"] ?>><span class="delete-link"></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </main>

  <script>
    let self = "<?= $_SERVER["PHP_SELF"]; ?>";
  </script>

  <script src="<?= make_url("assets/js/admin/users.js", true); ?>"></script>

<?php includes_footer(); ?>
