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
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/clearTheStyle.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/simpleSlide.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/twitter-widget.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/gist.js" type="text/javascript"></script>
</head>

<?php if (is_single()){

	foreach((get_the_category()) as $category){
		$catTag.=' category-';
		$catTag.=$category->category_nicename;
		}
} ?>
<body <?php if(is_home()) body_class('archive'); elseif(is_single()) body_class('single-post-php'.$catTag); else body_class('single-post-php')?>>
<div id="wrapper" class="hfeed">

	<div id="header">
		<div id="masthead">
			<div id="logo">
				<a href="<?php echo home_url( ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png"></a>
			</div> <!-- #logo --> 
	
			<div id="rightHeader">
				<div id="searchForm">
					<?php get_search_form(); ?>
				</div>
			</div>	
		</div>
		<div id="topNav">
			<ul id="navList">
			<li> <a href="<?php echo home_url( ); ?>">home</a></li>
			<li> <a href="<?php echo get_category_link_by_name( 'features' ); ?>">features</a></li> 
			<li> <a href="<?php echo get_category_link_by_name( 'snippets' ); ?>">news snippets</a></li> 
			<li> <a href="<?php echo get_category_link_by_name( 'podcasts' ); ?>">podcasts</a></li> 
			<li> <a href="<?php echo get_category_link_by_name( 'about gist' ); ?>">about gist</a></li> 
			</ul>
		</div>
	</div>

	<div id="main">
