<?php

/* These are functions specific to these options settings and this theme */

/*-----------------------------------------------------------------------------------*/
/* Remove the Options Panel that Thematic comes with by Default
/*-----------------------------------------------------------------------------------*/

function remove_thematic_panel() {
  remove_action('admin_menu' , 'mytheme_add_admin');
}
add_action('init', 'remove_thematic_panel');

/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

// This sets up the layouts and styles selected from the options panel

if (!function_exists('optionsframework_wp_head')) {
	function optionsframework_wp_head() { 
		$shortname =  get_option('of_shortname');
	
		//Layouts
		 $layout = get_option($shortname .'_layout');
		 if ($layout == '') {
		 	$layout = '2c-r-fixed';
		 }
	     echo '<link href="'. get_bloginfo('stylesheet_directory') .'/layouts/'. $layout . '.css" rel="stylesheet" type="text/css" />'."\n";
	    
		//Styles
		 if(!isset($_REQUEST['style']))
		 	$style = ''; 
		 else 
	     	$style = $_REQUEST['style'];
	     if ($style != '') {
			  $GLOBALS['stylesheet'] = $style;
	          echo '<link href="'. get_bloginfo('stylesheet_directory') .'/styles/'. $GLOBALS['stylesheet'] . '.css" rel="stylesheet" type="text/css" />'."\n"; 
	     } else { 
	          $GLOBALS['stylesheet'] = get_option('of_alt_stylesheet');
	          if($GLOBALS['stylesheet'] != '')
	               echo '<link href="'. get_bloginfo('stylesheet_directory') .'/styles/'. $GLOBALS['stylesheet'] .'" rel="stylesheet" type="text/css" />'."\n";         
	          else
	               echo '<link href="'. get_bloginfo('stylesheet_directory') .'/styles/default.css" rel="stylesheet" type="text/css" />'."\n";         		  
	     }       
			
		// This prints out the custom css and specific styling options
		of_head_css();
	}
}

add_action('wp_head', 'optionsframework_wp_head');


/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/

function of_head_css() {

		$shortname =  get_option('of_shortname'); 
		$output = '';
		
		if ($body_color = get_option($shortname . '_body_background') ) {
			$output .= "body {background:" . $body_color .";}\n";
		}
		
		if ($link_color = get_option($shortname .'_header_background') ) {
			$output .= "#header {background:" . $link_color .";}\n";
		}
		
		if ($link_hover_color = get_option($shortname .'_footer_background') ) {
			$output .= "#footer {background:" . $link_hover_color .";}\n";
		}
		
		$custom_css = get_option('of_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function childtheme_favicon() {
		$shortname =  get_option('of_shortname'); 
		if (get_option($shortname . '_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('of_custom_favicon')  .'"/>'."\n";
	    }
		else { ?>
			<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/admin/images/favicon.ico" />
<?php }
}

add_action('wp_head', 'childtheme_favicon');

/*-----------------------------------------------------------------------------------*/
/* Replace Blog Title With Logo
/*-----------------------------------------------------------------------------------*/

// If a logo is uploaded, unhook the page title and description

function add_childtheme_logo() {
	$shortname =  get_option('of_shortname');
	$logo = get_option($shortname . '_logo');
	if (!empty($logo)) {
		remove_action('thematic_header','thematic_blogtitle', 3);
		remove_action('thematic_header','thematic_blogdescription',5);
		add_action('thematic_header','childtheme_logo', 3);
	}
}
add_action('init','add_childtheme_logo');

// Displays the logo

function childtheme_logo() {
	$shortname =  get_option('of_shortname');
	$logo = get_option($shortname . '_logo');
    $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';?>
    <<?php echo $heading_tag; ?> id="site-title">
	<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
    <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>
	</a>
    </<?php echo $heading_tag; ?>>
<?php }

 
/*-----------------------------------------------------------------------------------*/
/* Filter Footer Text
/*-----------------------------------------------------------------------------------*/

function childtheme_footer($thm_footertext) {
	$shortname =  get_option('of_shortname');
	if ($footertext = get_option($shortname . '_footer_text'))
    	return $footertext;
}

add_filter('thematic_footertext', 'childtheme_footer');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){
	$shortname =  get_option('of_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','childtheme_analytics');

?>
