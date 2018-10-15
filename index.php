<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: install.php");

require_once $init_path;
require_once make_url("includes/functions/index.php");

// navigation variables
$current_page = $_GET["page"] ?? 1;

// how many posts there are in the database
$posts_total = count_posts_db();

// how many navigation pages are needed
$pages_total = ceil($posts_total / POSTS_PER_PAGE);

// query offset
$query_offset = $current_page * POSTS_PER_PAGE - POSTS_PER_PAGE;

// fetch posts for current page
$posts = fetch_posts_db(POSTS_PER_PAGE, $query_offset);

// HTML output
$prevlink = generate_prevlink_variable($current_page);
$nextlink = generate_nextlink_variable($current_page);
$disable_prevlink = disable_prevlink_variable($current_page);
$disable_nextlink = disable_nextlink_variable($current_page, $pages_total);

?>


<?php includes_header("Homepage"); ?>

  <main class="container mb-5">
    <div class="row">
    
      <section class="col-md-8">

        <!-- If there isn't posts, output "No posts found." -->
        <?php if (!$posts_total): ?>
          <h1 class="mb-5">No posts found.</h1>
        <?php else: ?>
        <!-- If there is posts, iterate and output them  -->
          <?php foreach ($posts as $post): ?>
            <article>
              <h1><?= h($post["title"]); ?></h1>
                <h6 class="small">
                  <a href="<?= generate_categorylink_html($post["category_id"]); ?>" class="badge badge-primary mr-1 category_badge"><?= h($post["category_name"]); ?></a>
                  <a href="<?= generate_userlink_html($post["user_id"]); ?>" class="font-weight-bold"><?= h($post["user_name"]); ?></a>
                  <span> - <?= instantiate_date($post["date"], "d/m/Y"); ?></span>
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
