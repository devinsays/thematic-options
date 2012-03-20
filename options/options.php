<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * If the identifier changes, it'll appear as if the options have been reset. 
 */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'thematic_options';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/options/images/';
		
	$options = array();
	
	$options[] = array(
		"name" => "Settings",
		"type" => "heading");
						
	$options[] = array(
		"name" => "Logo",
		"desc" => "Upload a logo for your theme.",
		"id" => "logo",
		"type" => "upload");
						
	$options[] = array(
		"name" => "Select a layout",
		"desc" => "Select main content and sidebar alignment.",
		"id" => "layout",
		"std" => "2c-r-fixed.css",
		"type" => "images",
		"options" => array(
			'1col-fixed.css' => $imagepath . '1col.png',
			'2c-l-fixed.css' => $imagepath . '2cl.png',
			'2c-r-fixed.css' => $imagepath . '2cr.png',
			'3c-fixed.css' => $imagepath . '3cm.png',
			'3c-r-fixed.css' => $imagepath . '3cr.png'
			)
		);
						
	$options[] = array(
		"name" => "Custom Favicon",
		"desc" => "Upload a 16px .ico image that will represent your website's favicon.",
		"id" => "favicon",
		"type" => "upload");
						
	$options[] = array(
		"name" => "Footer Text",
    	"desc" => "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]",
    	"id" => "footer_text",
    	"std" => "Powered by [wp-link]. Built on the [theme-link].",
    	"type" => "textarea");	
                    	
	$options[] = array(
		"name" => "Colors",
		"type" => "heading");
						
	$options[] = array(
		"name" =>  "Text Color",
		"desc" => "Change the text color",
		"id" => "text_color",
		"std" => "#000000",
		"type" => "color");
		
	$options[] = array(
		"name" =>  "Header Background",
		"desc" => "Change the header background color",
		"id" => "header_color",
		"std" => "#ffffff",
		"type" => "color");
		
	$options[] = array(
		"name" =>  "Footer Background",
		"desc" => "Change the footer background color",
		"id" => "footer_color",
		"std" => "#ffffff",
		"type" => "color");
							
	return $options;
}