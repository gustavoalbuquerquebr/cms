<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comments.php");

!is_logged() && redirect_to_login();

!empty($_POST) && delete_comment_db();

$comments = fetch_comments_db();

?>

<?php includes_header("Manage comments", "back"); ?>

  <main class="container mb-5">
    <h1 class="mb-4">Manage comments</h1>

    <table class="table table-hover" style="width:100%; text-align:center;">
      <thead class="thead-dark">
        <tr>
          <th></th>
          <th>ID</th>
          <th>Post</th>
          <th>User</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($comments as $comment): ?>
          <tr>
            <td class="text-danger" data-id=<?php echo $comment["id"] ?>><span class="delete">&times;</span></td>
            <td><?php echo $comment["id"] ?></td>
            <td><?php echo $comment["post"] ?></td>
            <td><?php echo $comment["author"] ?></td>
            <td><?php echo $comment["body"] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/comments.js", true); ?>"></script>

<?php includes_footer(); ?>