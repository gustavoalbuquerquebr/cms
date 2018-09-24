<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/contact.php");

!empty($_POST) && insert_contact_db();

?>

<?php includes_header("Contact", "front") ?>

  <main class="container mb-5">

    <div class="wrapper mx-auto">

      <h1 class="mb-3">Contact</h1>
  
      <form method="post" id="contact">
        <div class="form-group">
          <input type="text" name="name" id="name" placeholder="Name" class="form-control">
        </div>
        <div class="form-group">
          <input type="name" name="email" id="email" placeholder="Email" class="form-control">
          <div class="invalid-feedback">Insert a valid email</div>
        </div>
        <div class="form-group">
          <textarea name="message" cols="30" rows="8" id="message" placeholder="Message" class="form-control"></textarea>
        </div>
        <input type="submit" id="submit" class="btn btn-primary">
      </form>
      
      <div id="messageOutput">
        <img src="<?php echo make_url("assets/images/spinner.gif", true); ?>" width="50" height="50" class="d-none mx-auto">
        <div class="alert alert-dismissible show fade d-none" role="alert">
          <span></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      </div>

    </div>

  </main>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
  </script>

  <script src="<?php echo make_url("assets/js/contact.js", true); ?>"></script>

<?php includes_footer(); ?>
