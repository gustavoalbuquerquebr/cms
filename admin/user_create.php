<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/user_create.php");

!is_logged() && redirect_to_login();

if(!empty($_POST)) {

  $result = insert_user_db();

  if($result[0] === "success") {
    $user_id = $result[1];
    $url = make_url("user.php?id=", true) . $user_id;
    header("Location: $url");
    exit();
  }
    
  $db_insertion_error = $result[1];

  switch($db_insertion_error){
    case 1: $error_message = "Username and password must be at least 8 characters long.";
    break;
    case 2: $error_message = "Username already exists.";
    break;
  }
}

?>

<?php includes_header("Create post"); ?>

  <main class="container mb-5">

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <?php if(isset($db_insertion_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error_message; ?> Try again!
          <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <h1 class="mb-4">Create user</h1>

      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
          <input type="text" name="username" placeholder="username" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="password" placeholder="password" class="form-control">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
      </form>

    </div>


  </main>

<?php includes_footer(); ?>