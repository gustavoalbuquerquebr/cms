<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";
require_once make_url("includes/functions/contact.php");

!empty($_POST) && insert_contact_db();

?>

<?php includes_header("Contact", "front") ?>

  <main>
    <form method="post" id="contact">
      <input type="text" name="name" id="name">
      <input type="name" name="email" id="email">
      <textarea name="message" cols="30" rows="10" id="message"></textarea>
      <input type="submit" id="submit">
    </form>
  </main>

  <div id="messageOutput"></div>

  <script>
    let self = "<?php echo $_SERVER["PHP_SELF"]; ?>";
    let loading = "<?php echo make_url("assets/images/spinner.gif", true); ?>";
  </script>

  <script src="<?php echo make_url("assets/js/contact.js", true); ?>"></script>

<?php includes_footer(); ?>
