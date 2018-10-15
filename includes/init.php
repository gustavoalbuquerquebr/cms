<?php

// in case of output buffering isn't enabled by default
// ob_end_flush() it's called automatically at the end of the script
ob_start();

// mysqli will throw exceptions when there's a error
// to catch use "catch (mysqli_sql_exception $e)"
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

date_default_timezone_set("America/Sao_Paulo");


// PROJECT CONFIG CONSTANTS
define("PROJECT_NAME", "");
// define("PROJECT_PATH", "/cms/");
define("PROJECT_EMAIL", "");

// how many posts are shown at homepage for each navigation page
define("POSTS_PER_PAGE", 5);

// approximate length of blog post excerpt at the homepage
define("CHAR_PER_EXCERPT", 400);

// after how many seconds of inactivity a user will be automatically log out
define("LOGOUT_AUTOMATICALLY_AFTER", 1800);


// stylesheets, fonts and scripts
define("STYLESHEET_BOOTSTRAP", "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css");
define("FONT_TITLE", "https://fonts.googleapis.com/css?family=Open+Sans:700");
define("FONT_BODY", "https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
define("SCRIPT_JQUERY", "https://code.jquery.com/jquery-3.3.1.slim.min.js");
define("SCRIPT_POPPER", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js");
define("SCRIPT_BOOTSTRAP", "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js");


// DATABASE CONSTANTS
define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "");


// UTILITY FUNCTIONS
require_once $_SERVER["DOCUMENT_ROOT"] . "" . $_SERVER["HTTP_MY_ROOT"] . "includes/utils.php";


// when in any other page than install, test db connection and if it fails, redirect to install
if ($_SERVER["PHP_SELF"] !== $_SERVER["HTTP_MY_ROOT"] . "install.php") {
  !test_db_connection() && redirect_to("install.php");
}
