<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/user_edit.php");

!is_logged() && redirect_to_login();

// handle requests sent by edit links at "manage users" page
if (!empty($_GET)) {
$user_id = $_GET["id"];
$user_username = $_GET["username"];
}

// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = update_user_db();
    
  // if user update was successful, redirect to new user page
  $result[0] === "success" && redirect_url_newuserpage($result[1]) && exit;
  
  // if user update wasn't successful, render this page with error warning
  $db_insertion_error = $result[1];
  $error_message = generate_errormessage_variable($db_insertion_error);
  // and continue trying to edit the same user
  $user_id = $_POST["id"];
  $user_username = $_POST["username"];
}

empty($_GET) && empty($_POST) && redirect_url_dashboard() && exit;

?>


<?php includes_header("Edit user"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= make_url("admin/users.php", true); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit user</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">Edit user</h1>

      <?php if (isset($db_insertion_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error_message; ?> Try again!
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
          <div class="form-group d-none">
            <input type="number" name="id" placeholder="id" class="form-control" value="<?= $user_id; ?>">
          </div>
        <div class="form-group">
          <input type="text" name="username" placeholder="username" class="form-control" value="<?= $user_username; ?>">
        </div>
        <div class="form-group">
          <div class="input-group">
            <input id="password-input" type="password" name="password" placeholder="password" class="form-control">
            <div class="input-group-append">
              <div class="input-group-text"><img id="pw-toggler" src="<?= make_url("assets/images/eye.svg", true); ?>" width=16></div>
            </div>
          </div>
            <small class="form-text pl-2">To let the password unchanged, leave the field above blank.</small>
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
      </form>

    </div>
    
  </main>

  <script>
    let eye = "<?= make_url("assets/images/eye.svg", true); ?>";
    let eyeSlash = "<?= make_url("assets/images/eye-slash.svg", true); ?>";
  </script>

  <script src="<?= make_url("assets/js/admin/user_edit.js", true); ?>"></script>

<?php includes_footer(); ?>
