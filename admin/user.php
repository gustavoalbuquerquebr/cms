<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/user.php");

!is_logged() && redirect_to_login();

// handle the submit of the form in this page
if(!empty($_POST)) {

  $result = insertorupdate_user_db();
    
  // if user creation was successful, redirect to new user page
  $result[0] === "success" && redirect_url_newuserpage($result[1]) && exit;
  
  // if user creation wasn't successful, render this page with error warning
  $page_title = isset($_POST["id"]) ? "Update user" : "Create user";
  $db_insertion_error = $result[1];
  $error_message = generate_errormessage_variable($db_insertion_error);
  // and continue trying to edit the same user
  if(isset($_POST["id"])) $update_id = $_POST["id"]; // only update requests will have id
  $update_username = $_POST["username"];

}
  
// handle requests sent by edit links at "manage users" page
if(!empty($_GET)) {
  $page_title = "Update user";
  
  $update_id = $_GET["id"];
  $update_username = $_GET["username"];
}

// handle request sent by "create user" links
if(empty($_POST) && empty($_GET)) $page_title = "Create user";

?>

<?php includes_header($page_title); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo make_url("admin/users.php", true); ?>">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <?php if(isset($db_insertion_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error_message; ?> Try again!
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>


      <h1 class="mb-4"><?php echo $page_title; ?></h1>

      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <?php if(!empty($_GET) || isset($_POST["id"])): ?>
          <div class="form-group d-none">
            <input type="number" name="id" placeholder="id" class="form-control" value="<?php echo $update_id ?? ""; ?>">
          </div>
        <?php endif; ?>
        <div class="form-group">
          <input type="text" name="username" placeholder="username" class="form-control" value="<?php echo $update_username ?? ""; ?>">
        </div>
        <div class="form-group">
          <div class="input-group">
            <input id="password-input" type="password" name="password" placeholder="password" class="form-control">
            <div class="input-group-append">
              <div class="input-group-text"><img id="pw-toggler" src="<?php echo make_url("assets/images/eye.svg", true); ?>" width=16></div>
            </div>
          </div>
          <?php if(isset($update_id)): ?>
            <small class="form-text pl-2">To let the password unchanged, leave the field above blank.</small>
          <?php endif; ?>
        </div>
        <input type="submit" value="<?php echo isset($_POST["id"]) ? "Update" : "Create"; ?>" class="btn btn-primary">
      </form>

    </div>
    
  </main>

  <script>
    let eye = "<?php echo make_url("assets/images/eye.svg", true); ?>";
    let eyeSlash = "<?php echo make_url("assets/images/eye-slash.svg", true); ?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/user.js", true); ?>"></script>

<?php includes_footer(); ?>