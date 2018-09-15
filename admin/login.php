<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/login.php");

!empty($_POST) && verify_auth_db();

?>

<?php includes_header("Login", "end"); ?>

  <form method="post">
    <input type="text" name="user">
    <input type="password" name="pass">
    <input type="submit" name="submit">
  </form>

<?php includes_footer(); ?>