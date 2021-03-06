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
	add_image_size( 'large_thumb', 614, 300, True );
	add_image_size( 'medium_thumb', 300, 150, True );
	add_image_size( 'small_thumb', 150, 110, True );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	wp_register_script('twitter', 'http://widgets.twimg.com/j/2/widget.js', array(), False, True);
	wp_register_script('load_twitter', resource('js/twitter.js'), array(), False, True);
}

function filter_query($query) {
        if ($query->is_feed) {
                $query->set('category__not_in', array(id_by_slug('study')));
        }
            
	if ( $query->is_archive && !isset($query->query_vars['posts_per_page'])) {
		$query->query_vars['posts_per_page'] = 12;
	}

	return $query;
}
add_filter('pre_get_posts', 'filter_query');

function show_rss_notes($meta, $title){
    $result = '';
    $notes = get_post_meta(get_the_ID(), $meta, True);
    if ($notes ){
        $result .= '<h2>' . $title . '</h2>';
        $result .= '<ul>';
        $result .= do_shortcode($notes);
        $result .= '</ul>';
    }
    return $result;
}

function format_feed($content) {
    if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) {
        $content .= '<div id="author-description"> // ' . get_the_author_meta( 'description' ) . '</div>';
    }
    $content .= '<div style="list-style: none inside none;">';
    $content .= show_rss_notes('external_link', 'Links');
    $content .= show_rss_notes('notes', 'Notes');
    $content .= show_rss_notes('corrections', 'Corrections');
    $content .= show_rss_notes('references', 'References');
    $content .= '</div>';
    return $content;
}
add_filter('the_content_feed', 'format_feed');

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

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
		. do_shortcode( $content ) . '<p class="wp-caption-text link-container">// ' . $caption . '</p><br style="clear:both"/></div>';
}

add_filter('comment_form_default_fields', 'comments');
function comments(){
	return array(
		'author' => '<label for="author">Name *</label>' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><br/>',
		'email'  => '<label for="email">Email *</label>' .
					'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><br/>',
		'url'	=> '<label for="url">Website</label>' .
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><br/>',
	);
}

add_filter('comment_form_field_comment', 'narrow_textarea');
function narrow_textarea(){
	return '<label for="comment">Comment</label>' .
		   '<textarea id="comment" name="comment" cols="34" rows="8" aria-required="true"></textarea><br/>';
}


function format_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
                case 'pingback' :
                case 'trackback' :
        ?>
        <li class="post pingback">
                <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                        break;
                default :
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <footer class="comment-meta">
                                <div class="comment-author vcard">
                                        <?php
                                                $avatar_size = 39;

                                                echo get_avatar( $comment, $avatar_size );

                                                /* translators: 1: comment author, 2: date and time */
                                                printf( '%1$s on %2$s <span class="says">said:</span>',
                                                        sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                                        sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                                                get_comment_time( 'c' ),
                                                                /* translators: 1: date, 2: time */
                                                                sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() )
                                                        )
                                                );
                                        ?>

                                        <?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
                                </div><!-- .comment-author .vcard -->

                                <?php if ( $comment->comment_approved == '0' ) : ?>
                                        <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
                                        <br />
                                <?php endif; ?>

                        </footer>

                        <div class="comment-content link-container"><?php comment_text(); ?></div>

                        <div class="reply link-container">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                </article><!-- #comment-## -->

        <?php
                        break;
        endswitch;
}

add_action( 'after_setup_theme', 'remove_filters' );
function remove_filters() {
	remove_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );
	remove_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );
}

function gist_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '" class="link">More</a>';
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

function get_bleed(  ) {
	$categories = array('feature', 'snippet', 'podcast');
	foreach ($categories as $category) {
		if ( in_category($category) || is_category($category) ){
			return '<img src="' . resource('images/bleed_' . $category . '.png') . '"/>';
		}
	}

	return '<img src="' . resource('images/bleed_other.png') . '"/>';
}

function the_short_title(){
	$title = get_post_meta(get_the_ID(), 'short_title', true);
	if($title) echo $title; else the_title();
}

function get_extract( $classes = '', $thumb = 'medium_thumb' ) {	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('extract ' . $classes); ?>>
		
		<div class="entry-thumbnail">
			<div class="thumbnail-caption">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail( $thumb ); ?>
				</a>
			</div>
		</div>
		<div class="entry-header">
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_short_title(); ?></a></h3>
		</div>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
		<br style="clear:both"/>
	</div><?php
}


function get_main_extract( $classes = '', $thumb = 'large_thumb' ) {	?>
	
		
	
	
	
	<div id="post-<?php the_ID(); ?>" <?php post_class('extract ' . $classes); ?> style="height:320px;">
		
		

			<div class="entry-thumbnail">
				<div class="thumbnail-caption-large">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_post_thumbnail( $thumb ); ?>
					</a>
				</div>
			</div>
			
			<div class="entrypost">
				<div class="entry-header"; style="display:block">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_short_title(); ?></a></h3>
				</div>
			
		
				<div class="entry-content"; style="display:block">
					<?php the_excerpt(); ?>
				</div>
			</div>
		<br style="clear:both"/>
	
	
	</div><?php
	
}

function get_archive_posts($limit=9999){
	$i = 0;
	while ( have_posts() && $i < $limit) {
		the_post();
		$class = '';
		if ($i % 2 == 0) $class .= ' clear2';
		if ($i % 3 == 0) $class .= ' clear3';
		if ($i % 4 == 0) $class .= ' clear4';
		get_extract($class);
		$i++;
	}
}


function get_navigation(){
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav id="nav-below">
			<h3 class="assistive-text bleed-left"><?php echo get_bleed(); ?><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous link-container-back"><?php next_posts_link( 'Older articles' ); ?></div>
			<div class="nav-next link-container"><?php previous_posts_link( 'Newer articles' ); ?></div>
		</nav><?php
	}
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

$note_types = array(
    'correct' => array('prefix'=>'', 'suffix'=>''),
    'note' => array('prefix'=>'', 'suffix'=>''),
    'ref' => array('prefix'=>'[', 'suffix'=>']')
);

function define_note($atts, $content, $tag){
    global $note_types;
    $type = substr($tag, 1);
    $id = $atts['id'];
    $prefix = $note_types[$type]['prefix'];
    $suffix = $note_types[$type]['suffix'];
    return "<li><a name='${type}_${id}'></a>${prefix}${id}${suffix} $content</li>";
}
function link_note($atts, $content, $tag){
    global $note_types;
    $type = substr($tag, 1);
    $ids = explode(',', $atts['id']);
    $prefix = $note_types[$type]['prefix'];
    $suffix = $note_types[$type]['suffix'];

    $links = $prefix;
    foreach($ids as $id){
        $links .= "<a href='#${type}_${id}' class='link-down'>${id}</a>,";
    }
    $links = rtrim($links, ',');
    $links .= $suffix;

    return $links;
}

foreach($note_types as $note_type => $note_config){
    add_shortcode('d' . $note_type, 'define_note');
    add_shortcode('l' . $note_type, 'link_note');
} 
?>
