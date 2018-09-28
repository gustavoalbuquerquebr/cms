<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comments.php");

!is_logged() && redirect_to_login() && exit;

!empty($_POST) && delete_comment_db();

$comments = fetch_comments_db();

// JS output
$self = $_SERVER["PHP_SELF"];
$script_link = make_url("assets/js/admin/comments.js", true);

?>


<?php includes_header("Manage comments"); ?>

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

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= make_url("admin/", true); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Comments</li>
      </ol>
    </nav>

    <h1 class="mb-4">Manage comments</h1>

    <table class="table table-hover" style="width:100%; text-align:center;">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Post</th>
          <th>User</th>
          <th>Comment</th>
          <th>(edit)</th>
          <th>(delete)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($comments as $comment): ?>
          <tr>
            <td><?= $comment["id"] ?></td>
            <td><a href="<?= generate_postlink_html($comment["post"]); ?>" target="_blank"><?= $comment["post"]; ?></a></td>
            <td><?= h($comment["author"]); ?></td>
            <td><?= h($comment["body"]); ?></td>
            <td data-id=<?= $comment["id"] ?>><a href="<?= generate_editlink_html($comment["id"]); ?>" class="edit-link"></a></td>
            <td class="text-danger" data-id=<?= $comment["id"] ?>><span class="delete-link"></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script>
    let self = "<?= $self; ?>";
  </script>

  <script src="<?= $script_link ?>"></script>

<?php includes_footer(); ?>
