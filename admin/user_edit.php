<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: ../install.php");

require_once $init_path;
require_once make_url("includes/functions/admin/user_edit.php");

!is_logged() && redirect_to("admin/login.php") && exit;

empty($_GET) && empty($_POST) && redirect_to("admin/login.php") && exit;


// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = update_user_db();

    if ($result[0] === "success") {
    $success_message = "<strong>Success:</strong> User was updated.";

  } else {
    $db_update_error = $result[1];
    $error_message = generate_errormessage_variable($db_update_error);
  }
}

// HTML/JS output
$user_id = $_GET["id"] ?? $_POST["id"];
$output_id = "<strong>ID: </strong> $user_id";
$user_username = $_GET["username"] ?? $_POST["username"];
$dashboard_link = make_url("admin/", true);
$users_link =  make_url("admin/users.php", true);
$self = $_SERVER["PHP_SELF"];
$script_link = make_url("assets/js/admin/user_edit.js", true);
$eye_icon = make_url("assets/images/eye.svg", true);
$eye_icon_slash = make_url("assets/images/eye-slash.svg", true);

?>


<?php includes_header("Edit user"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link; ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $users_link; ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit user</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">Edit user</h1>

      <?php if (!empty($_POST)): ?>
        <div class="alert alert-dismissible fade show <?= ($db_update_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
          <?= isset($db_update_error) ? $error_message : $success_message; ?>
        <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $self; ?>" method="post">
          <!-- not form inputs, are used only for display -->
          <div class="form-group">
            <p class="form-control disabled-input"> <?= $output_id; ?> </p>
          </div>
          <!-- display none, are used only to send data with form submission -->
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
              <div class="input-group-text"><img id="pw-toggler" src="<?= $eye_icon; ?>" width=16></div>
            </div>
          </div>
            <small class="form-text pl-2">To let the password unchanged, leave the field above blank.</small>
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
      </form>

    </div>
    
  </main>

  <script>
    let eye = "<?= $eye_icon; ?>";
    let eyeSlash = "<?= $eye_iconslash; ?>";
  </script>

  <?= add_script($script_link); ?>

<?php includes_footer(); ?>
