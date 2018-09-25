<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/post_create.php");

!is_logged() && redirect_to_login();

if(!empty($_POST)) {
  if($new_post_id = insert_post_db()) {
    $url = make_url("post.php?id=", true) . $new_post_id;
    header("Location: $url");
  } else {
    $db_insertion_error = true;
  }
}

$categories = fetch_categories_db();

?>

<?php includes_header("Create post"); ?>

  <main class="container mb-5">

    <?php if(isset($db_insertion_error)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        There was a error. Try again!
        <button type="button" data-dismiss="alert" class="close">&times;</button>
      </div>
    <?php endif; ?>

    <h1 class="mb-4">Create post</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <div class="form-group">
        <input type="text" name="title" placeholder="Title" class="form-control">
      </div>
      <div class="form-group">
        <select name="category" class="form-control">
          <?php foreach($categories as $category): ?>
            <option value="<?php echo $category["id"]; ?>" <?php if(strtolower($category["name"]) === "uncategorized") echo "selected"; ?>><?php echo $category["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <textarea name="body" cols="30" rows="10" placeholder="Body" class="form-control"></textarea>
      </div>
      <input type="submit" value="Create" class="btn btn-primary">
    </form>

  </main>

<?php includes_footer(); ?>