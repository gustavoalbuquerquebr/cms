<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/index.php");

// navigation variables
$posts_per_page = 5;
$current_page = $_GET["page"] ?? 1;

// how many posts there are in the database
$posts_total = count_posts_db();

// how many navigation pages are needed
$pages_total = ceil($posts_total / $posts_per_page);

// query offset
$query_offset = $current_page * $posts_per_page - $posts_per_page;

// fetch posts for current page
$posts = fetch_posts_db($posts_per_page, $query_offset);

?>

<?php includes_header("Homepage", "front"); ?>

  <nav>
    <a href="<?php echo generate_btnprev_ui($current_page); ?>"  class="<?php echo disable_btnprevious_ui($current_page); ?>">Previous</a>
    <a href="<?php echo generate_btnnext_ui($current_page); ?>" class="<?php echo disable_btnnext_ui($current_page, $pages_total); ?>">Next</a>
  </nav>

  <main>
    <?php foreach($posts as $post): ?>
      <h1><?php echo $post["title"]; ?></h1>
      <h6><?php echo $post["date"]; ?></h6>
      <p><?php echo generate_blogexcerpt_html($post["body"]); ?></p>
      <a href="<?php echo generate_postlink_html($post["id"]); ?>">Read More &raquo;</a>
      <hr>
    <?php endforeach; ?>
  </main>

<?php includes_footer(); ?>