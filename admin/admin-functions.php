<?php

/* These are functions specific to these options settings and this theme */

// Grab all the options data
	global $data;
	$data = get_option(OPTIONS);
	
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

	global $data;	

	// Layouts
	$layout = $data['layout'];
	if ($layout == '') {
		 	$layout = '2c-r-fixed.css';
	}
	wp_register_style('layout', LAYOUTS . $layout );
    wp_enqueue_style('layout');
		
	// Kills sidebar if single column layout is selected
		if ($layout == '1col-fixed.css'){
			add_action('thematic_sidebar', 'kill_sidebar');
		}
		
	// Alt Styles
	$alt_style = $data['alt_stylesheet'];
		if ($alt_style == '') {
		 	$alt_style = 'default.css';
		}
	wp_register_style('alt_style',STYLES . $alt_style);
    wp_enqueue_style('alt_style');
	}
}

add_action('wp_print_styles', 'optionsframework_wp_head');

function kill_sidebar() {
	return FALSE;
}

/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/

function of_head_css() {
		global $data;

		$output = '';
		
		if ($body_color = $data['body_background'] ) {
			$output .= "body {background:" . $body_color .";}\n";
		}
		
		if ($header_color = $data['header_background'] ) {
			$output .= "#header {background:" . $header_color .";}\n";
		}
		
		if ($footer_color = $data['footer_background'] ) {
			$output .= "#footer {background:" . $footer_color .";}\n";
		}
		
		//sample typography
		if ($typography = $data['body_font'] ) {
			$output .= "body {\n     font-face:" . of_font_stack($typography['face']) . "; \n";
			$output .= "     font-size:" . $typography['size'] . "; \n";
			$output .= "     font-style:".$typography['style'] . "; \n";
			$output .= "     color: ".$typography['color'] . "; \n";
			$output .= "}\n";
		}
		
		$custom_css = $data['custom_css'];
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'of_head_css');

function of_font_stack($font){
	$stack = '';
	
	switch ( $font ) {
	
		case 'arial':
			$stack .= 'Arial, sans-serif';
		break;
		case 'verdana':
			$stack .= 'Verdana, "Verdana Ref", sans-serif';
		break;
		case 'trebuchet':
			$stack .= '"Trebuchet MS", Verdana, "Verdana Ref", sans-serif';
		break;
		case 'georgia':
			$stack .= 'Georgia, serif';
		break;
		case 'times':
			$stack .= 'Times, "Times New Roman", serif';
		break;
		case 'tahoma':
			$stack .= 'Tahoma,Geneva,Verdana,sans-serif';
		break;
		case 'palatino':
			$stack .= '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif';
		break;
		case 'helvetica':
			$stack .= '"Helvetica Neue", Helvetica, Arial, sans-serif';
		break;
	}
	return $stack;
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function childtheme_favicon() {
		global $data;
		if ($data['custom_favicon'] != '') {
	        echo '<link rel="shortcut icon" href="'.  $data['custom_favicon']  .'"/>'."\n";
	    }
		else { ?>
			<link rel="shortcut icon" href="<?php echo ADMIN ?>images/favicon.ico" />
<?php }
}

add_action('wp_head', 'childtheme_favicon');

/*-----------------------------------------------------------------------------------*/
/* Replace Blog Title With Logo
/*-----------------------------------------------------------------------------------*/

// If a logo is uploaded, unhook the page title and description

function add_childtheme_logo() {
	global $data;
	$logo = $data['logo'];
	if (!empty($logo)) {
		remove_action('thematic_header','thematic_blogtitle', 3);
		remove_action('thematic_header','thematic_blogdescription',5);
		add_action('thematic_header','childtheme_logo', 3);
	}
}
add_action('init','add_childtheme_logo');

// Displays the logo

function childtheme_logo() {
	global $data;
	$logo = $data['logo'];
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
	global $data;
	if ($footertext = $data['footer_text'])
    	return $footertext;
}

add_filter('thematic_footertext', 'childtheme_footer');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function childtheme_analytics() {
	global $data;
	$output = $data['google_analytics'];
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','childtheme_analytics');

?>