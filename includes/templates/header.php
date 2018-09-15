<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo isset($page_title) ? PROJECT_NAME . " - $page_title" : "CMS"; ?></title>
  <?php echo "<link rel=\"stylesheet\" href=\"" . make_url("assets/css/", true) . $stylesheet . ".css" . "\">" ?>
</head>
<body>