<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set path to Options Framework and theme specific functions */

// This path is set for use in a child theme. The code could be updated in a few places
// to TEMPLATEPATH if this was being used in a parent theme.

define('ADMIN_PATH', STYLESHEETPATH . '/admin/');
define('ADMIN_DIR', get_bloginfo('stylesheet_directory') . '/admin/');

// Set additional constants

$themedata = get_theme_data(STYLESHEETPATH . '/style.css');
define('THEMENAME', $themedata['Name']);
define('OPTIONS', 'of_options'); // Name of entry in database - will break DB if this has spaces!

/* These files build out the options interface. Likely won't need to edit these. */

require_once (ADMIN_PATH . 'admin-setup.php'); // Custom functions and plugins
require_once (ADMIN_PATH . 'admin-interface.php'); // Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (ADMIN_PATH . 'admin-functions.php'); // Theme actions based on options settings
require_once (ADMIN_PATH . 'theme-options.php'); // Options panel settings and custom settings

?>