<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/post.php");

!empty($_POST) && insert_comment_db();

empty($_GET) && redirect_url_homepage() && exit;

$current_post = $_GET["id"];

$post = fetch_post_db($current_post);

$posts_id = fetch_postsid_db();

$current_position = array_search($current_post, $posts_id);

$prev_post = make_url("post.php?id=", true) . getid_prevpost_db($posts_id, $current_position);

$next_post = make_url("post.php?id=", true) . getid_nextpost_db($posts_id, $current_position);

$prevbtn_class = disable_prevpost_ui($current_position);

$nextbtn_class = disable_nextpost_ui($posts_id, $current_position);

$comments = fetch_comments_db($current_post);

?>


<?php includes_header($post["title"]); ?>

  <main class="container mb-5">
    <section class="mb-5">
      <h1><?= h($post["title"]); ?></h1>
      <h6 class="small mb-4"><a href="<?= make_url("author.php?id=", true) . $post["author"]; ?>" class="font-weight-bold"><?= h($post["username"]); ?></a> - <?= $post["date"]; ?></h6>
      <p><?= convert_nl2ptag_ui(h($post["body"])); ?></p>
    </section>

    <nav class="text-center mb-5">
      <a href="<?= $prev_post; ?>" class="btn btn-sm <?= $prevbtn_class; ?>">&laquo; Previous</a>
      <a href="<?= $next_post; ?>" class="btn btn-sm <?= $nextbtn_class; ?>">Next &raquo;</a>
    </nav>

    <section id="commentsSection">
      <h2 class="mb-4"><span class="font-weight-bold" id="comments_counter"><?= count($comments); ?></span> comments</h2>

      <form id="form" method="post" class="<?php if (!empty($comments)) { echo "mb-5"; }; ?>">
        <div class="form-group">
          <input type="text" name="user" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
          <textarea name="comment" cols="30" rows="3" class="form-control" placeholder="Comment"></textarea>
        </div>
        <input type="submit" id="submit" class="btn btn-primary">
      </form>

      <div id="comments">
          <?php foreach ($comments as $comment): ?>
            <div class="comment mb-4 border-left border-primary pl-2">
              <h6><strong><?= h($comment["author"]); ?></strong><span class="text-muted"><?php if($comment["moderated"]) echo " (moderated)"; ?></span> - <?= $comment["date"] ?></h6>
              <p><?= h($comment["body"]); ?></p>
            </div>
          <?php endforeach; ?>
      </div>
    </section>

  </main>

  <script>
    let self = "<?= $_SERVER["PHP_SELF"]; ?>";
    let current_post = <?= $current_post; ?>;
  </script>

  <script src="<?= make_url("assets/js/post.js", true); ?>"></script>

<?php includes_footer(); ?>
