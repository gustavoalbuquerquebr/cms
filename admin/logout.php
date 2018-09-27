<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/cms/" . "includes/init.php";

session_start();
session_destroy();

$url = make_url("", true);

header("Location: $url");
