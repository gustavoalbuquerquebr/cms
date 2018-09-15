<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/post_edit.php");

!is_logged() && redirect_to_login();

!empty($_POST) && update_post_db();

$id = $_GET["id"];

$post = fetch_post_db($id);

?>

<?php includes_header("Edit post", "end") ?>

  <form method="post" action="post_edit.php">
    <input type="number" name="id" value="<?php echo $post["id"]; ?>" style="display:none;">
    <input name="title" type="text" value="<?php echo $post["title"]; ?>">
    <textarea name="post" cols="30" rows="10"><?php echo $post["body"]; ?></textarea>
    <input type="submit" id="submit">
  </form>


<?php includes_footer(); ?>