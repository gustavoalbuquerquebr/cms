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

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo make_url("admin/", true); ?>">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?php echo make_url("admin/posts.php", true); ?>">Posts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit post</li>
    </ol>
  </nav>

  <h1 class="mb-4">Edit post</h1>

    <a href="<?php echo make_url("post.php?id=", true) . $id; ?>" class="btn btn-outline-primary mb-4" target="_blank">View post</a>

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