<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/admin/categories.php");

!is_logged() && redirect_to_login() && exit;

!empty($_POST) && delete_category_db();

$categories = fetch_categories_db();


// HTML output
$dashboard_link = make_url("admin/", true);
$create_category_link = make_url("admin/category_create.php", true);
$self = $_SERVER["PHP_SELF"];
$script_link = make_url("assets/js/admin/categories.js", true);

?>


<?php includes_header("Manage categories"); ?>

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
          <p>Are you sure you want to delete this category?</p>
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
        <li class="breadcrumb-item active" aria-current="page">Categories</li>
      </ol>
    </nav>

    <h1 class="mb-4">Manage categories</h1>

    <section id="alerts"></section>

    <a href="<?= $create_category_link; ?>" class="btn btn-primary mb-4 create-page-link-white">Create category</a>

    <div class="table-responsive">
      <table class="table table-hover" style="width:100%; text-align:center;">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>(edit)</th>
            <th>(delete)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categories as $category): ?>
            <tr>
              <td><?= $category["id"] ?></td>
              <td><?= $category["name"] ?></td>
              <td><a href="<?= generate_editlink_html($category); ?>" class="edit-link"></a></td>
              <td class="text-danger" data-id=<?= $category["id"] ?>><span class="delete-link"></span></td>
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
