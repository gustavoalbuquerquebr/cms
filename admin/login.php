<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/login.php");

!empty($_POST) && verify_auth_db();

?>


<?php includes_header("Login"); ?>

  <main class="container mb-5">

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">Login</h1>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php if ($error === 1) echo "User not found!"; ?>
          <?php if ($error === 2) echo "Wrong password!"; ?>
          <button class="close" type="button" data-dismiss="alert"><span>&times;</span></button>
        </div>
      <?php endif; ?>

      <form method="post" class="mb-3">
        <div class="form-group">
          <input type="text" name="user" placeholder="Username" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="pass" placeholder="Password" class="form-control">
        </div>
        <input type="submit" name="submit" value="Log In" class="btn btn-primary">
      </form>

    </div>

  </main>


<?php includes_footer(); ?>
