<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set path to Options Framework and theme specific functions */

// This path is set for use in a child theme.  The code could be updated in a few places
// to TEMPLATEPATH if this was being used in a parent theme.

$functions_path = STYLESHEETPATH . '/functions/';

/* These files build out the options interface.  Likely won't need to edit these. */

require_once ($functions_path . 'admin-functions.php');		// Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once ($functions_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($functions_path . 'theme-functions.php'); 	// Theme actions based on options settings

?>