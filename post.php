<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/post.php");

!empty($_POST) && insert_comment_db();

$current_post = $_GET["id"];

$post = fetch_post_db($current_post);

$comments = fetch_comments_db($current_post);

?>

<?php includes_header($post["title"], "front"); ?>

  <main>
    <h1><?php echo $post["title"] ?></h1>
    <h6><?php echo $post["date"] ?></h6>
    <p><?php echo $post["body"] ?></p>
  </main>

  <form id="form" method="post">
    <input type="text" name="user">
    <textarea name="comment" cols="30" rows="10"></textarea>
    <input type="submit" id="submit">
  </form>

  <section id="comments">
    <h2>Comments</h2>
    <div class="output">
      <?php if(!empty($comments)): ?>
        <?php foreach($comments as $comment): ?>
          <h6><?php echo $comment["author"] . " - " . $comment["date"] ?></h6>
          <p><?php echo $comment["body"] ?></p>
        <?php endforeach; ?>
      <?php else: ?>
        <p id="noComments"><?php echo "no comments" ?></p>
      <?php endif; ?>
    </div>
  </section>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
    let current_post = <?php echo $current_post; ?>;
  </script>

  <script src="<?php echo make_url("assets/js/post.js", true); ?>"></script>

<?php includes_footer(); ?>