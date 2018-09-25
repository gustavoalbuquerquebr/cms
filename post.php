<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/post.php");

!empty($_POST) && insert_comment_db();

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

<?php includes_header($post["title"], "front"); ?>

  <main class="container mb-5">
    <section class="mb-5">
      <h1><?php echo $post["title"] ?></h1>
      <h6 class="small mb-4"><strong><?php echo $post["author"]; ?></strong> - <?php echo $post["date"]; ?></h6>
      <p><?php echo convert_nl2ptag_ui($post["body"]); ?></p>
    </section>

    <nav class="text-center mb-5">
      <a href="<?php echo $prev_post; ?>" class="btn btn-sm <?php echo $prevbtn_class; ?>">&laquo; Previous</a>
      <a href="<?php echo $next_post; ?>" class="btn btn-sm <?php echo $nextbtn_class; ?>">Next &raquo;</a>
    </nav>

    <section id="commentsSection">
      <h2 class="mb-4"><?php echo count($comments); ?> comments</h2>

      <form id="form" method="post" class="<?php if(!empty($comments)) echo "mb-5"; ?>">
        <div class="form-group">
          <input type="text" name="user" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
          <textarea name="comment" cols="30" rows="3" class="form-control" placeholder="Comment"></textarea>
        </div>
        <input type="submit" id="submit" class="btn btn-primary">
      </form>

      <div id="comments">
          <?php foreach($comments as $comment): ?>
            <div class="comment mb-4 border-left border-primary pl-2">
              <h6><strong><?php echo $comment["author"]; ?></strong> - <?php echo $comment["date"] ?></h6>
              <p><?php echo $comment["body"] ?></p>
            </div>
          <?php endforeach; ?>
      </div>
    </section>

  </main>


  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
    let current_post = <?php echo $current_post; ?>;
  </script>

  <script src="<?php echo make_url("assets/js/post.js", true); ?>"></script>

<?php includes_footer(); ?>