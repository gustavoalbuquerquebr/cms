<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
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

?>

<?php includes_header("Homepage"); ?>

  <main class="container mb-5">
    <div class="row">
    
      <section class="col-md-8">

        <?php foreach($posts as $post): ?>
          <article class="mb-5">
            <h1><?php echo $post["title"]; ?></h1>
            <h6 class="small"><strong><?php echo $post["author"]; ?></strong> - <?php echo $post["date"]; ?></h6>
            <p><?php echo generate_blogexcerpt_html($post["body"]); ?></p>
            <p class=""><a href="<?php echo generate_postlink_html($post["id"]); ?>">Read More &raquo;</a></p>
            <hr>
          </article>
        <?php endforeach; ?>

        <nav class="text-center mb-5 mb-md-0">
          <a href="<?php echo generate_btnprev_ui($current_page); ?>"  class="btn btn-sm <?php echo disable_btnprevious_ui($current_page); ?>">&laquo; Previous</a>
          <a href="<?php echo generate_btnnext_ui($current_page); ?>" class="btn btn-sm <?php echo disable_btnnext_ui($current_page, $pages_total); ?>">Next &raquo;</a>
        </nav>
        
      </section>

      <?php require_once make_url("includes/templates/aside.php"); ?>

    </div>
  </main>

<?php includes_footer(); ?>