<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/user_create.php");

!is_logged() && redirect_to_login() && exit;

// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = insert_user_db();
    
  // // if user creation was successful, redirect to new user page
  // $result[0] === "success" && redirect_url_newuserpage($result[1]) && exit;

  if($result[0] === "success") {
    $db_insertion_success = true;
    $new_user_id = $result[1];
    $new_user_name = $_POST["username"];
    $success_message = generate_successmessage_variable($new_user_id, $new_user_name);
    // don't populate form if previous insertion was successful
    $_POST = [];

  } else {
    // if user creation wasn't successful, render this page with error warning
    $db_insertion_error = $result[1];
    $error_message = generate_errormessage_variable($db_insertion_error) . " Try again!";
  }
}

// HTML output
$dashboard_link = make_url("admin/", true);
$users_link = make_url("admin/users.php", true);
$self = $_SERVER["PHP_SELF"];
$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";
$eye_icon = make_url("assets/images/eye.svg", true);
$eye_slash_icon = make_url("assets/images/eye-slash.svg", true);
$script_link = make_url("assets/js/admin/user_create.js", true);

?>


<?php includes_header("User create"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link; ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $users_link; ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create user</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">User create</h1>

      <?php if (isset($db_insertion_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error_message; ?>
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <?php if (isset($db_insertion_success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $success_message; ?>
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $self; ?>" method="post">
        <div class="form-group">
          <input type="text" name="username" placeholder="username" class="form-control" value="<?= $username; ?>">
        </div>
        <div class="form-group">
          <div class="input-group">
            <input id="password-input" type="password" name="password" placeholder="password" class="form-control" value="<?= $password; ?>">
            <div class="input-group-append">
              <div class="input-group-text"><img id="pw-toggler" src="<?= $eye_icon; ?>" width=16></div>
            </div>
          </div>
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
      </form>

    </div>
    
  </main>

  <script>
    let eye = "<?= $eye_icon; ?>";
    let eyeSlash = "<?= $eye_slash_icon; ?>";
  </script>

  <script src="<?= $script_link; ?>"></script>

<?php includes_footer(); ?>
