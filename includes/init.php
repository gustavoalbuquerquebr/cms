<?php

// in case of output buffering isn't enabled by default
// ob_end_flush() it's called automatically at the end of the script
ob_start();

// PROJECT CONFIG
define("PROJECT_NAME", "CMS");
define("PROJECT_FOLDER_NAME", "cms");
// approximate length of blog post excerpt in the index page
define("CHAR_PER_EXCERPT", 400);

// UTILITIES
require_once $_SERVER["DOCUMENT_ROOT"] . "/" . PROJECT_FOLDER_NAME . "/includes/utils.php"; 

?>