<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/author.php");

empty($_GET) && redirect_url_homepage() && exit;

$author = $_GET["id"];

// // if user doesn't exist, redirect to homepage
// !verify_user_db($author) && redirect_url_homepage() && exit;

// fetch username to display at page title
$author_username = fetch_authorusername_db($author);

// if user doesn't exist, redirect to homepage
!$author_username && redirect_url_homepage() && exit;

$page_title = $author_username . "'s posts";

// navigation variables
$current_page = $_GET["page"] ?? 1;

// how many posts there are in the database
$posts_total = count_posts_db($author);

// how many navigation pages are needed
$pages_total = ceil($posts_total / POSTS_PER_PAGE);

// query offset
$query_offset = $current_page * POSTS_PER_PAGE - POSTS_PER_PAGE;

// fetch posts for current page
$posts = fetch_posts_db($author, POSTS_PER_PAGE, $query_offset);

// HTML output
$prevlink = generate_prevlink_variable($author, $current_page);
$nextlink = generate_nextlink_variable($author, $current_page);
$disable_prevlink = disable_prevlink_variable($current_page);
$disable_nextlink = disable_nextlink_variable($current_page, $pages_total);

?>


<?php includes_header($page_title); ?>

  <main class="container mb-5">
    <div class="row">
    
      <section class="col-md-8">

      <!-- If there isn't posts output "No post found" -->
      <?php if (!$posts_total): ?>
        <h1 class="mb-5">No posts found.</h1>
      <?php else: ?>
        <!-- if there is posts, iterate and output them -->
        <?php foreach ($posts as $post): ?>
          <article>
            <h1><?= h($post["title"]); ?></h1>
            <h6 class="small">
              <a href="<?= generate_categorylink_html($post["category_id"]); ?>" class="badge badge-primary mr-1 category_badge"><?= h($post["category_name"]); ?></a>
              <a href="<?= generate_authorlink_html($post["author_id"]); ?>" class="font-weight-bold"><?= h($post["author_name"]); ?></a>
              <span> - <?= $post["date"]; ?></span>
            </h6>
            <p><?= h(generate_blogexcerpt_html($post["body"])); ?></p>
            <p class=""><a href="<?= generate_postlink_html($post["id"]); ?>">Read More &raquo;</a></p>
          </article>
          <hr class="mb-5">
        <?php endforeach; ?>
          <nav class="text-center mb-5 mb-md-0">
            <a href="<?= $prevlink; ?>"  class="btn btn-sm <?= $disable_prevlink; ?>">&laquo; Previous</a>
            <a href="<?= $nextlink; ?>" class="btn btn-sm <?= $disable_nextlink; ?>">Next &raquo;</a>
          </nav>
      <?php endif; ?>

      </section>

      <?php require_once make_url("includes/templates/aside.php"); ?>

    </div>
  </main>

<?php includes_footer(); ?>
