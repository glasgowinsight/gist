<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Gist
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( 'Page %s', max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style('clear');
	wp_enqueue_style('gist');
		
	if(is_home() || is_admin()){
		wp_enqueue_script('twitter');
		wp_enqueue_script('jquery-timers');
		wp_enqueue_script('simple-slide');
		wp_enqueue_script('gist');
		wp_localize_script('gist', 'gist', array('ajaxurl' => admin_url('admin-ajax.php')));
	}
	wp_enqueue_script('analytics');
		
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<?php 
	$classes='';
	if(is_home() || is_search()){
		$classes.='archive ';
	}
	if (is_single()){
		foreach((get_the_category()) as $category){
			$classes.='category-'.$category->slug.' ';
		}
	}
?>
<body <?php body_class($classes)?>>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="logo">
				<a href="<?php echo home_url( ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png"></a>
			</div> <!-- #logo --> 
	
			<div id="rightHeader">
				<div id="tagline"><?php bloginfo('description')?></div>
				<div id="searchForm">
					<?php get_search_form(); ?>
				</div>
			</div>	
		</div>
		<div id="topNav">
		<?php 
			function show_link($slug, $name){
				$current=False;
				if(is_category($slug)) $current=True;
				if(is_single()){
					$id=id_by_slug($slug);
					foreach((get_the_category()) as $category){
						if($category->cat_ID == $id || $category->category_parent == $id){
							$current=True;
							break;
						}
					}
				}
				
				?><li> <a href="<?php echo get_category_link_by_slug($slug); ?>" <?php if($current) echo 'class="current"'; ?>><?php echo $name?></a></li><?php 
			}
		?>
			<ul id="navList">
			<li> <a href="<?php echo home_url( ); ?>" <?php if(is_home()) echo 'class="current"'; ?>>home</a></li>
			<?php show_link('feature', 'features')?>
			<?php show_link('snippet', 'news snippets')?>
			<?php show_link('podcast', 'podcasts')?>
			<?php show_link('about-gist', 'about gist')?>
			</ul>
		</div>
	</div>

	<div id="main">
