<?php
/**
 * Functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, gist_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Gist
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

add_action( 'after_setup_theme', 'gist_setup' );
if ( ! function_exists( 'gist_setup' ) ):
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
		add_image_size( 'slideshow', 9999, 300 );
		add_image_size( 'jump', 40, 40, true );
		add_image_size( 'left-column', 150, 9999 );
		add_image_size( 'right-column', 100, 9999 );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
	
		$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
		foreach ( $filters as $filter ) {
		    remove_filter($filter, 'wp_filter_kses');
		}
		
		function f($n){return get_bloginfo('template_directory') . $n;}
		
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), '1.7.1');
		wp_register_script('twitter', 'http://widgets.twimg.com/j/2/widget.js', array(), False, True);
		wp_register_script('jquery-timers', f('/js/jquery.timers-1.2.js'), array(), '1.2', True);
		wp_register_script('simple-slide', f('/js/simpleSlide.js'), array(), False, True);
		wp_register_script('gist', f('/js/gist.js'), array(), False, True);
		wp_register_script('analytics', f('/js/analytics.js'), array(), False, True);

		wp_register_style('clear', f('/clearTheStyle.css'));
		wp_register_style('gist', f('/style.css'));
	}
endif;

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function gist_continue_reading() {
	return ' <a href="'. get_permalink() . '">More&nbsp;<span class="meta-nav">&rarr;</span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and gist_continue_reading().
 *
 * @return string An ellipsis
 */
function gist_excerpt_auto( $more ) {
	return ' &hellip;' . gist_continue_reading();
}
add_filter( 'excerpt_more', 'gist_excerpt_auto' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function gist_excerpt_custom( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= gist_continue_reading();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'gist_excerpt_custom' );

if ( ! function_exists( 'show_comment' ) ) :
function show_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( 'At %1$s on %2$s %3$s said', get_comment_time(), get_comment_date(), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em>Your comment is awaiting moderation.</em>
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
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( '(Edit)', ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function show_post_excerpt($class, $thumbSize){
	?><div id="post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
		<h3>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php 	
				$title = get_post_meta(get_the_ID(), 'short_title', true);
				if($title) echo $title;	else the_title(); ?>
			</a>
		</h3>
	    <?php if($thumbSize && has_post_thumbnail()){?>
	    	<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbSize ); ?></a></div>
	 	<?php }?>
	 	<div class="entry-summary"><?php the_excerpt(); ?></div>
	</div><?php
}


function show_headline_post_excerpt($class, $thumbSize){
	?><div id="post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
		<div class="headlinPostImage">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbSize ); ?></a>
		</div>
		<div class="headlinePostSummary">
			<h3>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php 	
					$title = get_post_meta($post->ID, 'short_title', true);
					if($title) echo $title;	else the_title(); ?>
				</a>
			</h3>
		 	<div class="entry-summary"><?php the_excerpt(); ?></div> 
	 	</div>
	 	<br style="clear:both"/>
	</div><?php
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
  		'order'=>'desc',
  		'hide_empty'=>0
  	));
}

function get_category_link_by_slug($cat_name){
	$id = id_by_slug($cat_name);
	return get_category_link($id);
}

function get_page_link_by_title($page_title){
	$page = get_page_by_title($page_title);
	return get_page_link($page->ID);
}

function add_excerpt( $data, $postarr) {
	if($data['post_excerpt'] == ''){
		$text = $data['post_content'];
		$text = strip_shortcodes($text);
		$text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text, '<p><strong><em><a>');
        $to = strpos($text, '</p>');
        if($to !== false){
            $text = substr($text, 0, $to + 4);
        }
        $text = force_balance_tags( $text );
        $data['post_excerpt'] = $text;
	}
	return $data;
}
add_filter('wp_insert_post_data', 'add_excerpt', 10, 2);

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

function custom_posts($query) {
	if ($query->is_feed) {
		$query->set('category__not_in', array(id_by_slug('about-gist'), id_by_slug('study')));
	}
	else{
		if((is_home() || is_archive()) && current_user_can( 'publish_posts' )){
			$query->set('post_status', 'any');
		}
		
		if(get_query_var('category_name') == 'about-gist' || get_query_var('cat') == id_by_slug('about-gist')){
			set_query_var('posts_per_page', 4);
		}
		
		if(get_query_var('author')){
			set_query_var('posts_per_page', 8);
		}
	}
	return $query;
}
add_filter('pre_get_posts','custom_posts');

function id_by_slug($slug){
	return get_category_by_slug($slug)->term_id;
}

add_action( 'wp_ajax_nopriv_load_slider', 'load_slider' );
add_action( 'wp_ajax_load_slider', 'load_slider' );

function load_slider() {
	global $post;
	
	ob_start();
	$ids = array();
	$posts = array();
	$num_posts=10;
	gather_posts( 'feature', $num_posts, $posts, $ids);
	
	foreach ($posts as $post){
    	setup_postdata($post); 
    	show_post_excerpt('simpleSlide-slide', 'slideshow');
	}
	
	# Repeat the first div. This is used by simpleSlide.js so we get the
	# effect of it constantly scrolling forward, without a 'rewind' effect
	$post = $posts[0];
	setup_postdata($post); 
	show_post_excerpt('simpleSlide-slide', 'slideshow');
	$slides = ob_get_clean();
	
	ob_start();
    $i=1;
    foreach ($posts as $post){
    	setup_postdata($post); 
		?><span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php 
		the_post_thumbnail('jump', array('alt'=>'', 'title'=>the_title('', '', false))); 
		?></span><?php 
		$i++;
	}
	$thumbs = ob_get_clean();
	
	$response = json_encode( array( 'slides' => $slides, 'thumbs' => $thumbs ) );
	header( "Content-Type: application/json" );
	echo $response;
	exit;
}

function get_licence($post){
	$licence_id = get_post_meta($post->ID, 'licence', true);
	switch($licence_id){
		case "CC BY":
			return array(
				'url'=>'http://creativecommons.org/licenses/by/3.0/',
				'image'=>'http://i.creativecommons.org/l/by/3.0/80x15.png',
				'licence'=>'Creative Commons Attribution 3.0 Unported License'		
			);
		case "CC BY-SA":
			return array(
				'url'=>'http://creativecommons.org/licenses/by-sa/3.0/',
				'image'=>'http://i.creativecommons.org/l/by-sa/3.0/80x15.png',
				'licence'=>'Creative Commons Attribution-Share-Alike 3.0 Unported License'		
			);
		default:
			return NULL;
	}
}
