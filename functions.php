<?php

/* 
 * Thematic 0.9.7.6 compatible
 */
 
define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
define('THEMATIC_COMPATIBLE_POST_CLASS', true);
define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', true);
define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);
define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

/* 
 * Defines location of options.php for Options Framework
 */

add_filter('options_framework_location','options_framework_location_override');

function options_framework_location_override() {
    return array('/options/options.php');
}

/* 
 * Loads required functions for options
 */
 
require_once ( STYLESHEETPATH . '/options/options-functions.php');