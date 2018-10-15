<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: ../install.php");

require_once $init_path;
require_once make_url("includes/functions/admin/pages.php");

!is_logged() && redirect_to("admin/login.php") && exit;

!empty($_POST) && delete_page_db();

$pages = fetch_pages_db();

// HTML/JS output
$dashboard_link = make_url("admin/", true);
$create_page_link = make_url("admin/page_create.php", true);
$self = $_SERVER["PHP_SELF"];
$script_link = make_url("assets/js/admin/pages.js", true);

?>


<?php includes_header("Manage pages"); ?>

  <div id="deleteModal" class="modal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this page?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link; ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pages</li>
      </ol>
    </nav>

    <h1 class="mb-4">Manage pages</h1>

    <section id="alerts"></section>

    <a href="<?= $create_page_link; ?>" class="btn btn-primary mb-4 create-page-link-white">Create page</a>

    <div class="table-responsive">
        <table class="table table-hover" style="width:100%; text-align:center;">
          <thead class="thead-dark">
            <th>ID</th>
            <th>Date</th>
            <th>User</th>
            <th>Title</th>
            <th>(edit)</th>
            <th>(delete)</th>
          </thead>
          <tbody>
            <?php foreach ($pages as $page): ?>
              <tr>
                <td><?= $page["id"]; ?></td>
                <td><?= instantiate_date($page["date"]); ?></td>
                <td><a href="<?= generate_userpage_html($page["user_id"]); ?>"><?= h($page["user_name"]); ?></a></td>
                <td><a href="<?= generate_pagepage_html($page["id"]); ?>"><?= h($page["title"]); ?></a></td>
                <td><a href="<?= generate_editlink_html($page["id"]); ?>"  class="edit-link"></a></td>
                <td class="text-danger" data-id="<?= $page["id"]; ?>"><span class="delete-link"></span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>

  </main>

  <script>
    let self = "<?= $self; ?>";
  </script>

  <?= add_script($script_link); ?>

<?php includes_footer(); ?>
