<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	set_post_thumbnail_size( 150, 150 );
}
endif;

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'More&nbsp;<span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( 'At %1$s on %2$s %3$s said', 'twentyten' ), get_comment_time(), get_comment_date(), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function show_post_excerpt($class, $thumbSize){
	?><div id="post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
		<h3>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php 	
				$title = get_post_meta($post->ID, 'short_title', true);
				if($title) echo $title;	else the_title(); ?>
			</a>
		</h3>
	    <div class="entry-thumbnail"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbSize ); ?></a></div>
	 	<div class="entry-summary"><?php the_excerpt(); ?></div>
	<div class="clearer"> </div> </div><?php
}


function show_headline_post_excerpt($class, $thumbSize){
	?><div id="post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
		<div class="headlinPostImage">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbSize ); ?></a>
		</div>
		<div class="headlinePostSummary">
		<h3>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php 	
				$title = get_post_meta($post->ID, 'short_title', true);
				if($title) echo $title;	else the_title(); ?>
			</a>
		</h3>
	 	<div class="entry-summary"><?php the_excerpt(); ?></div> </div>
	<div class="clearer"> </div> </div><?php
}

function gather_posts($category, $limit, &$posts, &$ids, $order=NULL) {
	$params = array(
		'category_name'=>$category,
		'numberposts'=>$limit,
		'post__not_in'=>$ids,
	);
	
	if($order != NULL){
		$params['orderby'] = $order;
	}
	
	$p=get_posts($params);
	foreach ($p as $post) {
		$ids[] = $post->ID;
		$posts[] = $post;
	}
}

function get_latest_feature_categories(){
	$parent = get_category_by_slug('feature'); 
  	return get_categories(array(
  		'child_of'=>$parent->cat_ID,
  		'orderby'=>'id',
  		'order'=>'desc'
  	));
}

function get_category_link_by_name($cat_name){
	$id = get_cat_ID($cat_name);
	return get_category_link($id);
}

function get_page_link_by_title($page_title){
	$page = get_page_by_title($page_title);
	return get_page_link($page->ID);
}

function improved_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
        $text = get_the_content('');

        $text = strip_shortcodes( $text );

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text, '<p><strong><em>');
        $excerpt_length = apply_filters('excerpt_length', 20);
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
        $text = force_balance_tags( $text );
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

function sidebar($id, $title, $collection, $callback) {
	if(count($collection)>0){?>
		<div id="<?php echo $id ?>" class="sidebarSection">
			<h3> <?php echo $title ?> </h3> 
			<ul> 
				<?php 
					foreach ($collection as $in){
						?><li><?php $callback($in) ?></li><?php 
					}
				?>
			</ul>
		</div><?php 
	}
}
