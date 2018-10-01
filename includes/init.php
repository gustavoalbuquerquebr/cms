<?php

// in case of output buffering isn't enabled by default
// ob_end_flush() it's called automatically at the end of the script
ob_start();


// PROJECT CONFIG CONSTANTS

define("PROJECT_NAME", "CMS");
define("PROJECT_FOLDER_NAME", "cms");
define("PROJECT_EMAIL", "cms@email.com");

// how many posts are shown at homepage for each navigation page
define("POSTS_PER_PAGE", 5);

// approximate length of blog post excerpt at the homepage
define("CHAR_PER_EXCERPT", 400);

// after how many seconds of inactivity a user will be automatically log out
define("LOGOUT_AUTOMATICALLY_AFTER", 180);


// stylesheets, fonts and scripts
define("STYLESHEET_BOOTSTRAP", "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css");
define("FONT_TITLE", "https://fonts.googleapis.com/css?family=Open+Sans:700");
define("FONT_BODY", "https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
define("SCRIPT_JQUERY", "https://code.jquery.com/jquery-3.3.1.slim.min.js");
define("SCRIPT_POPPER", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js");
define("SCRIPT_BOOTSTRAP", "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js");


// UTILITY FUNCTIONS
require_once $_SERVER["DOCUMENT_ROOT"] . "/" . PROJECT_FOLDER_NAME . "/includes/utils.php"; 
