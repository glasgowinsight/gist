<?php
/*
Plugin Name: Feature Slideshow
Plugin URI: http://sleek.no/kunder/138/
Description: Based on Feature List by jQueryGlobe. Retrives posts / pages and creates a jQuery driven slideshow, with a vertical list of post titles and a short excerpt. Choose which posts and style the slideshow from the adminpanel.
Version: 1.0.8-beta
Author: Magnus Hauge Bakke
Author URI: http://sleek.no/
*/


/* Set variables and constants
---------------------------------------------------------------------------------------------*/

// Define constants
define('FEATURE_SLIDESHOW_DIR', get_bloginfo('wpurl')."/wp-content/plugins/feature-slideshow");

// Get slideshow settings
$feature_slideshow_settings = get_option('feature_slideshow_settings');


/* Add necessary stuff to head
---------------------------------------------------------------------------------------------*/

// Add header scripts
if( !is_admin() ) {
	add_action( 'wp_head', 'feature_slideshow_add_header' );
	add_action( 'init', 'feature_slideshow_scripts' );
}

function feature_slideshow_scripts() {
	
	$feature_list = FEATURE_SLIDESHOW_DIR . '/js/jquery.featureList-1.0.0.js';
	
	wp_register_script( 'feature-list', $feature_list );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'feature-list' );
	
}

function feature_slideshow_add_header() {
	
	global $feature_slideshow_settings;
	
	echo '<link rel="stylesheet" href="' . FEATURE_SLIDESHOW_DIR . '/css/style.php?width=' . $feature_slideshow_settings['width'] . '&height=' . (($feature_slideshow_settings['numberposts'] * 81) - 1) . '&imagewidth=' . ($feature_slideshow_settings['width'] - $feature_slideshow_settings['list_width']) . '&psize=' . $feature_slideshow_settings['p_size'] . '&title_color=' . $feature_slideshow_settings['title_color'] . '&list_width=' . $feature_slideshow_settings['list_width'] . '" type="text/css" media="all" />';
		
	echo '
		<script type="text/javascript">
		
		jQuery(document).ready(function() {
			
			jQuery.featureList(
				jQuery("#feature-slideshow-container #tabs li a"),
				jQuery("#feature-slideshow-container #output li"), {
					start_item : 0,
					transition_interval : ' . $feature_slideshow_settings['transition_interval'] . ',
					pause_on_hover : true
				}
			);
		});
		</script>
	';
}


/* Admin functions
---------------------------------------------------------------------------------------------*/

// Fetch template for admin panel
function feature_slideshow_admin() {
	include('includes/feature_slideshow_admin.php'); 
}

// Add admin menu
function feature_slideshow_admin_actions() {
	add_options_page( 'Feature Slideshow Settings', 'Feature Slideshow', 'manage_options', 'administrator', 'feature_slideshow_admin' );
}

// Add new meta boxes
function feature_slideshow_add_meta() {
	
	global $feature_slideshow_settings;
	add_meta_box( 'feature_slideshow_image', 'Feature Slideshow options', 'feature_slideshow_meta_options', $feature_slideshow_settings['post_type'], 'normal', 'high' );
		
}

// Set meta boxes options
function feature_slideshow_meta_options() {
	
	global $post;
	$custom = get_post_custom( $post->ID );
	$feature_description = $custom['feature_slideshow_description'][0];
	$feature_overlay = $custom['feature_slideshow_overlay'][0];
		
	include( 'includes/feature_slideshow_meta_boxes.php' );
		
}
	
// Save post meta
function feature_slideshow_save_meta() {
	
	global $post;
	update_post_meta( $post->ID, 'feature_slideshow_image', $_POST['feature_slideshow_image'] );
	update_post_meta( $post->ID, 'feature_slideshow_description', $_POST['feature_slideshow_description'] );
	update_post_meta( $post->ID, 'feature_slideshow_overlay', $_POST['feature_slideshow_overlay'] );
		
}
	
function feature_slideshow_admin_scripts() {
			
	wp_register_script( 'feature_slideshow_colorpicker', FEATURE_SLIDESHOW_DIR . '/js/colorpicker/colorpicker.js' );
	wp_enqueue_script( 'feature_slideshow_colorpicker', array('jquery') );

}

function feature_slideshow_admin_styles() {
	
	wp_register_style( 'colorpicker_css', FEATURE_SLIDESHOW_DIR . '/js/colorpicker/css/colorpicker.css' );
	wp_enqueue_style( 'colorpicker_css' );
	
}
	
// Add actions
if( is_admin() ) {
	add_action( 'admin_init', 'feature_slideshow_add_meta' );
	add_action( 'save_post', 'feature_slideshow_save_meta' );
	add_action( 'admin_print_scripts', 'feature_slideshow_admin_scripts' );
	add_action( 'admin_print_styles', 'feature_slideshow_admin_styles' );
	add_action( 'admin_menu', 'feature_slideshow_admin_actions' );
}


/* Admin functions
---------------------------------------------------------------------------------------------*/

// Initialize the plugin
function feature_slideshow() {
		
	// Fetch settings
	global $feature_slideshow_settings;		
	
	$numberposts 	= 	$feature_slideshow_settings['numberposts'];
	$orderby 		= 	$feature_slideshow_settings['orderby'];
	$post_parent 	= 	$feature_slideshow_settings['post_parent'];
	$post_type 		= 	$feature_slideshow_settings['post_type'];
	$category 		= 	$feature_slideshow_settings['category'];
	$tag 			= 	$feature_slideshow_settings['tag'];
	
	function get_thumbnail_url() {
		$img_id = get_post_thumbnail_id();
		$img_url = wp_get_attachment_image_src( $img_id, 'full' );
		return $img_url[0];
	}
	
	include( 'includes/feature_slideshow_body.php' );
	
	return $return;
		
}

function feature_slideshow_init() {
	echo feature_slideshow();
}

// Add shortcode
add_shortcode( 'feature-slideshow', 'feature_slideshow' );

// Add post thumbnail support if doesen't exist
if( !current_theme_supports( 'post-thumbnails' ) && function_exists( 'add_theme_support' ) ) {
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 100, 100, true );
	
}


/* Install and uninstall
---------------------------------------------------------------------------------------------*/

// Register hooks for activation and deactivation
register_activation_hook( __FILE__,'feature_slideshow_install' );
register_deactivation_hook( __FILE__,'feature_slideshow_remove' );

// Add options to database
function feature_slideshow_install() {
	
	$feature_slideshow_settings = array(
			'width'					=>		'600',
			'list_width'			=>		'200',
			'title_color'			=>		'3e96da',
			'numberposts'			=>		'4',
			'orderby'				=>		'',
			'post_parent'			=>		'',
			'post_type'				=>		'post',
			'category'				=>		'',
			'p_size'				=>		'18',
			'transition_interval'	=>		'5000'
			
	);
	
	add_option( 'feature_slideshow_settings', $feature_slideshow_settings );
}

// Clean up on removal
function feature_slideshow_remove() {
	delete_option('feature_slideshow_settings');
}

?>