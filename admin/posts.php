<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/posts.php");

!is_logged() && redirect_to_login();

!empty($_POST) && delete_post_db();

$posts = fetch_posts_db();

?>

<?php includes_header("Manage posts", "back"); ?>

  <div id="deleteModal" class="modal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this post?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <main class="container mb-5">
    <h1 class="mb-4">Manage posts</h1>

    <div class="table-responsive">
        <table class="table table-hover" style="width:100%; text-align:center;">
          <thead class="thead-dark">
            <th></th>
            <th></th>
            <th>ID</th>
            <th>Date</th>
            <th>Title</th>
          </thead>
          <tbody>
            <?php foreach($posts as $post): ?>
              <tr>
                <td class="text-danger" data-id="<?php echo $post["id"]; ?>"><span class="delete"></span></td>
                <td class="edit"><a href="<?php echo generate_link_html($post["id"]); ?>">Edit</a></td>
                <td><?php echo $post["id"]; ?></td>
                <td><?php echo $post["date"]; ?></td>
                <td><a href="<?php echo make_url("post.php?id=", true) . $post["id"]; ?>" target="_blank"><?php echo $post["title"]; ?></a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  </main>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/posts.js", true); ?>"></script>

<?php includes_footer(); ?>