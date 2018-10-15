<?php

require_once $_SERVER["DOCUMENT_ROOT"] . $_SERVER["HTTP_MY_ROOT"] . "includes/init.php";

$redirect = $_GET["redirect"] ?? "homepage";

switch ($redirect) {
  case "homepage":
  $url = make_url("", true);
  break;
  case "dashboard":
  $url = make_url("admin/login.php", true);
  break;
}

!isset($_SESSION) && session_start();
session_destroy();

header("Location: $url");
