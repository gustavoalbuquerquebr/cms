<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

$redirect = isset($_GET["redirect"]) ? $_GET["redirect"] : "homepage";

switch ($redirect) {
  case "homepage":
  $url = make_url("", true);
  break;
  case "dashboard":
  $url = make_url("admin/login.php", true);
  break;
}

session_start();
session_destroy();

header("Location: $url");
