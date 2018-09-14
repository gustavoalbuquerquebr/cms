<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/functions/init.php";

function stylesheet() {

  if(isset($GLOBALS["stylesheet"])) {
    global $stylesheet;

    $path = make_url("assets/css/", true);

    switch ($stylesheet) {
      case "front":
      $file = "front.css";
      break;
      case "end":
      $file = "end.css";
      break;
    }

    if(isset($path)) {
      return "<link rel=\"stylesheet\" href=\"{$path}{$file}\">";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo isset($page_title) ? PROJECT_NAME . " - $page_title" : "CMS"; ?></title>
  <?php echo stylesheet(); ?>
</head>
<body>