<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set path to Options Framework and theme specific functions */

// This path is set for use in a child theme.  The code could be updated in a few places
// to TEMPLATEPATH if this was being used in a parent theme.

//define some constant paths
define('ADMIN_PATH', STYLESHEETPATH . '/admin/');
define('FUNCTIONS_PATH', STYLESHEETPATH . '/functions/');

//define some constants
define('CHILDTHEME', get_bloginfo('stylesheet_directory') . '/');
define('ADMIN', CHILDTHEME . 'admin/');
define('FUNCTIONS', CHILDTHEME . 'functions/');
define('LAYOUTS', CHILDTHEME . 'layouts/');
define('STYLES', STYLESHEETPATH . '/styles/');

// You can mess with these 2 if you wish.
$themedata = get_theme_data(STYLESHEETPATH . '/style.css');
define('THEMENAME', $themedata['Name']);
define('OPTIONS', 'of_options'); //name of entry into database - will break DB if this has spaces!


/* These files build out the options interface.  Likely won't need to edit these. */

require_once (ADMIN_PATH . 'admin-setup.php');		// Custom functions and plugins
require_once (ADMIN_PATH . 'admin-interface.php');	// Admin Interfaces 

/* These files build out the admin specific options and associated functions. */

require_once (ADMIN_PATH . 'theme-options.php'); 	// Options panel settings and custom settings
require_once (ADMIN_PATH . 'admin-functions.php'); 	// Theme actions based on options settings

//Thematic 0.9.7.6 compatible
define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
define('THEMATIC_COMPATIBLE_POST_CLASS', true);
define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', true);
define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);
define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

?>