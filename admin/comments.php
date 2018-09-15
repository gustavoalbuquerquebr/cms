<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/comments.php");

!is_logged() && redirect_to_login();

!empty($_POST) && delete_comment_db();

$comments = fetch_comments_db();

?>

<?php includes_header("Manage comments", "end"); ?>

  <h1>Manage comments</h1>

  <table style="width:100%; text-align:center;">
    <thead>
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
          <td class="delete" data-id=<?php echo $comment["id"] ?>>&times;</td>
          <td><?php echo $comment["id"] ?></td>
          <td><?php echo $comment["post"] ?></td>
          <td><?php echo $comment["author"] ?></td>
          <td><?php echo $comment["body"] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/comments.js", true); ?>"></script>

<?php includes_footer(); ?>