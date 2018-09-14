<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

// head variables
$page_title = "Homepage";
$stylesheet = "front";

// navigation variables
$posts_per_page = 5;
$current_page = $_GET["page"] ?? 1;

// connect to database
$db_connection = new_db_connection();

// how many posts there are in the database
$query = "SELECT COUNT(id) FROM posts";
$result = mysqli_query($db_connection, $query);
$posts_total = mysqli_fetch_row($result)[0];
echo mysqli_free_result($result);

// how many navigation pages are needed
$pages_total = ceil($posts_total / $posts_per_page);

// query offset
$query_offset = $current_page * $posts_per_page - $posts_per_page;

// get posts for current page
$query = "SELECT * FROM posts
          ORDER BY id DESC
          LIMIT $posts_per_page
          OFFSET $query_offset";
$result = mysqli_query($db_connection, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

// close database connection
mysqli_close($db_connection);

// NAVIGATION LINKS FUNCTIONS

function button_next() {
  global $current_page;
  $href = "$_SERVER[PHP_SELF]?page=" . ($current_page + 1);
  return $href;
}

function button_previous() {
  global $current_page;
  $href = "$_SERVER[PHP_SELF]?page=" . ($current_page - 1);
  return $href;
}

function disable_next() {
  global $current_page, $pages_total;
  if($current_page == $pages_total) {
    return "disabled";
  }
}

function disable_previous() {
  global $current_page;
  if($current_page == 1) {
    return "disabled";
  }
}

// generate link to post page
function link_post_page($id) {
  return "post.php?id=" . $id;
}

?>

<?php require make_url("includes/templates/header.php"); ?>

  <nav>
    <a href="<?php echo button_previous(); ?>"  class="<?php echo disable_previous(); ?>">Previous</a>
    <a href="<?php echo button_next(); ?>" class="<?php echo disable_next(); ?>">Next</a>
  </nav>

  <main>
    <?php foreach($posts as $post): ?>
      <h1><?php echo $post["title"]; ?></h1>
      <h6><?php echo $post["date"]; ?></h6>
      <p><?php echo $post["post"]; ?></p>
      <a href="<?php echo link_post_page($post["id"]); ?>">Read More &raquo;</a>
      <hr>
    <?php endforeach; ?>
  </main>

<?php require make_url("includes/templates/footer.php"); ?>