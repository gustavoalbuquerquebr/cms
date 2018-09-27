<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/user_create.php");

!is_logged() && redirect_to_login();

// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = insert_user_db();
    
  // if user creation was successful, redirect to new user page
  $result[0] === "success" && redirect_url_newuserpage($result[1]) && exit;
  
  // if user creation wasn't successful, render this page with error warning
  $db_insertion_error = $result[1];
  $error_message = generate_errormessage_variable($db_insertion_error);
}

?>


<?php includes_header("User create"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= make_url("admin/users.php", true); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create user</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">User create</h1>

      <?php if (isset($db_insertion_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error_message; ?> Try again!
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
          <input type="text" name="username" placeholder="username" class="form-control">
        </div>
        <div class="form-group">
          <div class="input-group">
            <input id="password-input" type="password" name="password" placeholder="password" class="form-control">
            <div class="input-group-append">
              <div class="input-group-text"><img id="pw-toggler" src="<?= make_url("assets/images/eye.svg", true); ?>" width=16></div>
            </div>
          </div>
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
      </form>

    </div>
    
  </main>

  <script>
    let eye = "<?= make_url("assets/images/eye.svg", true); ?>";
    let eyeSlash = "<?= make_url("assets/images/eye-slash.svg", true); ?>";
  </script>

  <script src="<?= make_url("assets/js/admin/user_create.js", true); ?>"></script>

<?php includes_footer(); ?>
