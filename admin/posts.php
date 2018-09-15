<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/posts.php");

!is_logged() && redirect_to_login();

!empty($_POST) && delete_post_db();

$posts = fetch_posts_db();

?>

<?php includes_header("Manage posts", "end"); ?>

  <h1>Manage posts</h1>

  <table style="width:100%; text-align:center;">
    <thead>
      <th></th>
      <th></th>
      <th>ID</th>
      <th>Date</th>
      <th>Title</th>
    </thead>
    <tbody>
      <?php foreach($posts as $post): ?>
        <tr>
          <td class="delete" data-id="<?php echo $post["id"]; ?>">&times;</td>
          <td class="edit"><a href="<?php echo generate_link_html($post["id"]); ?>">Edit</a></td>
          <td><?php echo $post["id"]; ?></td>
          <td><?php echo $post["date"]; ?></td>
          <td><?php echo $post["title"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    // PHP variables
    let self = "<?php echo $_SERVER["PHP_SELF"]?>";
  </script>

  <script src="<?php echo make_url("assets/js/admin/posts.js", true); ?>"></script>

<?php includes_footer(); ?>