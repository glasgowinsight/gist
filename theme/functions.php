<?php

add_action( 'after_setup_theme', 'gist_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function gist_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large_thumb', 478, 9999 );
	add_image_size( 'medium_thumb', 314, 9999 );
	add_image_size( 'small_thumb', 232, 9999 );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	wp_register_script('twitter', 'http://widgets.twimg.com/j/2/widget.js', array(), False, True);
	wp_register_script('load_twitter', resource('js/twitter.js'), array(), False, True);
}

function resource($resource) {
	return get_stylesheet_directory_uri() . '/' . $resource;
}

function id_by_slug($slug){
        return get_category_by_slug($slug)->term_id;
}
        
function get_category_name_by_slug($cat_name){
        $id = id_by_slug($cat_name);
        return get_cat_name($id);
}

function get_category_link_by_slug($cat_name){
        $id = id_by_slug($cat_name);
        return get_category_link($id);
}

?>