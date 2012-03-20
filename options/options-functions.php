<?php

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

/* 
 * Removes the default Thematic options panel
 */

function remove_thematic_panel() {
  remove_action( 'admin_menu' , 'mytheme_add_admin' );
}

add_action('init', 'remove_thematic_panel');

/* 
 * Theme header output - wp_head()
 *
 * This sets up the layouts and styles selected from the options panel
 */

function optionsframework_wp_head() {
	
	$layout = of_get_option('layout','2c-r-fixed.css');
	wp_register_style('layout', get_stylesheet_directory_uri() . '/layouts/' . $layout );
    wp_enqueue_style('layout');
		
	// Kills sidebar if single column layout is selected
	if ( $layout == '1col-fixed.css' ){
		add_action('thematic_sidebar', 'kill_sidebar');
	}
}

add_action('wp_enqueue_scripts', 'optionsframework_wp_head');

function kill_sidebar() {
	return FALSE;
}

/* 
 * Output CSS from standarized options
 */

function thematicoptions_head_css() {

		$output = '';
		
		if ( of_get_option('text_color') )
			$output .= 'body, input, textarea {color:' . of_get_option('text_color') .'}';
			
		if ( of_get_option('header_color') )
			$output .= '#header {background:' . of_get_option('header_color') .'}';
			
		if ( of_get_option('footer_color') )
			$output .= '#footer {background:' . of_get_option('header_color') .'}';
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style>\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'thematicoptions_head_css');

/* 
 * Add Favicon
 */

function thematicoptions_favicon() {
	if ( of_get_option('favicon') ) {
        echo '<link rel="shortcut icon" href="' . of_get_option('favicon') . '"/>'."\n";
    }
}

add_action('wp_head', 'thematicoptions_favicon');

/* 
 * Replace blog title with logo
 *
 * If a logo is uploaded, unhook the page title and description
 */

function thematicoptions_logo_check() {
	$logo = of_get_option('logo');
	if ( $logo ) {
		remove_action('thematic_header','thematic_blogtitle', 3);
		remove_action('thematic_header','thematic_blogdescription',5);
		add_action('thematic_header','thematicoptions_logo', 3);
	}
}
add_action('init','thematicoptions_logo_check');

/* 
 * Displays the logo
 */

function thematicoptions_logo() {
	$logo = of_get_option('logo');
    $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';?>
    <<?php echo $heading_tag; ?> id="site-title">
	<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
    <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>
	</a>
    </<?php echo $heading_tag; ?>>
<?php }

/* 
 * Filter footer text
 */

function thematicoptions_footer($thm_footertext) {
	$footertext = of_get_option('footer_text');
    return $footertext;
}

add_filter('thematic_footertext', 'thematicoptions_footer');
