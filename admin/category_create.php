<?php

$init_path = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

!file_exists($init_path) && header("Location: ../install.php");

require_once $init_path;
require_once make_url("includes/functions/admin/category_create.php");

!is_logged() && redirect_to("admin/login.php") && exit;

// handle the submit of the form in this page
if (!empty($_POST)) {

  $result = insert_category_db();

  if ($result[0] === "success") {
    $new_category_id = $result[1];
    $new_category_name = $_POST["name"];
    $success_message = generate_successmessage_variable($new_category_id, $new_category_name);
    // don't repopulate form if previous insertion was successful
    $_POST = [];
    
  } else {
    // if category creation wasn't successful, render this page with error warning
    $db_insertion_error = $result[1];
    $error_message = generate_errormessage_variable($db_insertion_error);
  }
}

// HTML output
$dashboard_link = make_url("admin/", true);
$categories_link = make_url("admin/categories.php", true);
$self = $_SERVER["PHP_SELF"];
$name = $_POST["name"] ?? "";

?>


<?php includes_header("Create category"); ?>

  <main class="container mb-5">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $dashboard_link; ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $categories_link; ?>">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create category</li>
      </ol>
    </nav>

    <div class="wrapper-w50 wrapper-md-w100 mx-auto">

      <h1 class="mb-4">Category create</h1>

      <!-- Can't use $_POST to verification below, because maybe it was cleared above to avoid repopulate form -->
      <?php if (isset($success_message) || isset($error_message)): ?>
        <div class="alert alert-dismissible fade show <?= isset($db_insertion_error) ? "alert-danger" : "alert-success"; ?>" role="alert">
        <?= isset($db_insertion_error) ? $error_message : $success_message; ?>
        <button type="button" data-dismiss="alert" class="close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="<?= $self; ?>" method="post">
        <div class="form-group">
          <input type="text" name="name" placeholder="name" class="form-control" value="<?= $name; ?>">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
      </form>

    </div>
    
  </main>

<?php includes_footer(); ?>
