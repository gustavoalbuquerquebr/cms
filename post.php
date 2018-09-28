<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/post.php");

!empty($_POST) && insert_comment_db();

empty($_GET) && redirect_url_homepage() && exit;

$current_post = $_GET["id"];

$post = fetch_post_db($current_post);

$posts_id = fetch_postsid_db();

$current_position = array_search($current_post, $posts_id);

$comments = fetch_comments_db($current_post);

// HTML/JS output
$title = h($post["title"]);
$category_link = generate_categorylink_html($post["category_id"]);
$category = h($post["category_name"]);
$author_link = generate_authorlink_html($post["author_id"]);
$author =  h($post["author_name"]);
$date = $post["date"];
$body = convert_nl2ptag_html(h($post["body"]));
$prev_post = make_url("post.php?id=", true) . getid_prevpost_db($posts_id, $current_position);
$prevbtn_class = disable_prevpost_html($current_position);
$next_post = make_url("post.php?id=", true) . getid_nextpost_db($posts_id, $current_position);
$nextbtn_class = disable_nextpost_html($posts_id, $current_position);
$script_link = make_url("assets/js/post.js", true);

?>


<?php includes_header($post["title"]); ?>

  <main class="container mb-5">
    <section class="mb-5">
      <h1><?= $title; ?></h1>
      <h6 class="small">
        <a href="<?= $category_link; ?>" class="badge badge-primary mr-1 category_badge"><?= $category; ?></a>
        <a href="<?= $author_link; ?>" class="font-weight-bold"><?= $author; ?></a>
        <span> - <?= $date; ?></span>
      </h6>
      <p><?= $body; ?></p>
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
              <h6>
                <strong><?= h($comment["author"]); ?></strong>
                <span class="text-muted"><?= verify_ifmoderated_db($comment["moderated"]); ?></span>
                - <?= $comment["date"] ?>
              </h6>
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

  <script src="<?= $script_link; ?>"></script>

<?php includes_footer(); ?>
