<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/post_edit.php");

!is_logged() && redirect_to_login();

!empty($_POST) && update_post_db();

$id = $_GET["id"];

$post = fetch_post_db($id);

?>

<?php includes_header("Edit post") ?>

  <main class="container mb-5">
  <h1 class="mb-4">Post edit</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <input type="number" name="id" value="<?php echo $post["id"]; ?>" class="d-none">
      <div class="form-group">
        <input name="title" type="text" value="<?php echo $post["title"]; ?>" class="form-control">
      </div>
      <div class="form-group">
        <textarea name="post" cols="30" rows="10" class="form-control"><?php echo $post["body"]; ?></textarea>
      </div>
      <input type="submit" id="submit" value="Save" class="btn btn-primary">
    </form>
  </main>


<?php includes_footer(); ?>