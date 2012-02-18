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
	add_image_size( 'large_thumb', 456, 456, True );
	add_image_size( 'medium_thumb', 221, 110, True );
	add_image_size( 'small_thumb', 150, 110, True );
	
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

add_filter('img_caption_shortcode', 'fix_caption_width', 10, 3);
function fix_caption_width($val, $attr, $content = null) {

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . ((int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">// ' . $caption . '</p></div>';
}

add_action( 'after_setup_theme', 'remove_filters' );
function remove_filters() {
	remove_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );
	remove_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );
}
    
function gist_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '" ' . get_the_link_class() . '>More</a>';
}

function gist_auto_excerpt_more( $more ) {
	return ' &hellip;' . gist_continue_reading_link();
}
add_filter( 'excerpt_more', 'gist_auto_excerpt_more' );

function gist_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= gist_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'gist_custom_excerpt_more' );

function get_the_link_class( $classes = '' ) {
	$categories = array('feature', 'snippet', 'podcast', 'about');
	foreach ($categories as $category) {
		if ( in_category($category) ){
			return 'class="link-' . $category . ' ' . $classes . '"';
		}
	}
	
	if ( $classes ) {
		return 'class="' . $classes . '"';
	}
	return '';
}

function get_extract( $classes = '', $thumb = 'small_thumb' ) {	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('extract ' . $classes); ?>>
		<div class="entry-header">
			<h3 class="entry-title"><?php the_title(); ?></h3>
		</div>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $thumb ); ?>
			</a>
		</div>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
		<br style="clear:both"/>
	</div><?php 
}

function get_archive_posts(){
	$i = 0;
	while ( have_posts() ) {
		the_post();
		$class = '';
		if ($i % 2 == 0) $class .= ' clear2';
		if ($i % 3 == 0) $class .= ' clear3';
		get_extract($class);
		$i++;
	}

	twentyeleven_content_nav( 'nav-below' );
}
?>