<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/page.php");

empty($_GET) && redirect_url_homepage() && exit;

$current_page = $_GET["id"];

$page = fetch_page_db($current_page);

// HTML/JS output
$title = h($page["title"]);
$user_link = generate_userlink_variable($page["user_id"]);
$user =  h($page["user_name"]);
$date = $page["date"];
$body = convert_nl2ptag_html(h($page["body"]));
$aside = $page["aside"];
$col = $aside ? "col-md-8" : "";

?>


<?php includes_header($title); ?>

  <main class="container mb-5">

    <div class="row">

      <div class="<?= $col ?>">
          <section class="mb-5">
            <h1><?= $title; ?></h1>
            <?php if ($page["nav"]): ?>
              <h6 class="small">
                <a href="<?= $user_link; ?>" class="font-weight-bold"><?= $user; ?></a>
                <span> - <?= $date; ?></span>
              </h6>
            <?php endif; ?>
            <p><?= $body; ?></p>
          </section>
      </div>

      <?php if($aside): ?>
        <?php require_once make_url("includes/templates/aside.php"); ?>
      <?php endif; ?>

    </div>


  </main>

  <script>
    // let self = "<?= $_SERVER["PHP_SELF"]; ?>";
    // let current_post = <?= $current_post; ?>;
  </script>

  <!-- <?= add_script($script_link); ?> -->

<?php includes_footer(); ?>
