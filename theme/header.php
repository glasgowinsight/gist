<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage The GIST
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
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
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo resource('styles/clear.css'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo resource('styles/main.css'); ?>" />
<!--[if (lt IE 9) & (!IEMobile)]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo resource('styles/large.css'); ?>" />
<![endif]-->
<link rel="stylesheet" type="text/css" media="(min-width: 1280px)" href="<?php echo resource('styles/extra-large.css'); ?>" />
<link rel="stylesheet" type="text/css" media="(min-width: 970px) and (max-width: 1280px)" href="<?php echo resource('styles/large.css'); ?>" />
<link rel="stylesheet" type="text/css" media="(min-width: 724px) and (max-width: 970px)" href="<?php echo resource('styles/medium.css'); ?>" />
<link rel="stylesheet" type="text/css" media="(min-width: 478px) and (max-width: 724px)" href="<?php echo resource('styles/small.css'); ?>" />

<?php wp_enqueue_script('twitter') ?>
<?php wp_enqueue_script( 'jquery' ); ?>
<?php wp_enqueue_script('load_twitter') ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
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
</head>


<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<div id="branding" role="banner">
			<h2 id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>" rel="home">
					<img width="212" height="128" src="<?php echo resource('images/logo.png'); ?>"/>
				</a>
			</h2>
			
			<div id="access" role="navigation">
				<ul id="navList" class="blank">
					<li class="feature"><a href="<?php echo get_category_link_by_slug('feature'); ?>">Features</a></li>
					<li class="snippet"><a href="<?php echo get_category_link_by_slug('snippet'); ?>">Snippets</a></li>
					<li class="podcast"><a href="<?php echo get_category_link_by_slug('podcast'); ?>">Podcasts</a></li>
					<li class="about"><a href="<?php echo get_category_link_by_slug('about'); ?>">About</a></li>
				</ul>
			</div>
			
			<div id="searchForm">
				<a href="<?php echo site_url('/wp-login.php')?>" class="link">Contributor Login</a>
				<?php get_search_form(); ?>
			</div>
			<br style="clear:both"/>
	</div>
	<div id="main">