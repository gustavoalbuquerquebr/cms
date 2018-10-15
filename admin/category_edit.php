<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: ../install.php");

require_once $init_path;
require_once make_url("includes/functions/admin/category_edit.php");

!is_logged() && redirect_to("admin/login.php") && exit;

empty($_GET) && empty($_POST) && redirect_to("admin/login.php") && exit;


// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = update_category_db();

    if ($result[0] === "success") {
    $success_message = "<strong>Success:</strong> Category was updated.";

  } else {
    $db_update_error = $result[1];
    $error_message = generate_errormessage_variable($db_update_error);
  }
}

// HTML/JS output
$category_id = $_GET["id"] ?? $_POST["id"];
$output_id = "<strong>ID: </strong> $category_id";
$category_name = $_GET["name"] ?? $_POST["name"];
$dashboard_link = make_url("admin/", true);
$categories_link =  make_url("admin/categories.php", true);
$self = $_SERVER["PHP_SELF"];

?>


<?php includes_header("Edit category"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link; ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $categories_link; ?>">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit category</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">Edit category</h1>

      <?php if (!empty($_POST)): ?>
        <div class="alert alert-dismissible fade show <?= ($db_update_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
          <?= isset($db_update_error) ? $error_message : $success_message; ?>
        <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $self; ?>" method="post">
          <!-- not form inputs, are used only for display -->
          <div class="form-group">
            <p class="form-control disabled-input"> <?= $output_id; ?> </p>
          </div>
          <!-- display none, are used only to send data with form submission -->
          <div class="form-group d-none">
            <input type="number" name="id" placeholder="id" class="form-control" value="<?= $category_id; ?>">
          </div>
        <div class="form-group">
          <input type="text" name="name" placeholder="name" class="form-control" value="<?= $category_name; ?>">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
      </form>

    </div>
    
  </main>

<?php includes_footer(); ?>
