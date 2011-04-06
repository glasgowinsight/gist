<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
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
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/clearTheStyle.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/mockup.css">
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
<script type="text/javascript">
    $(document).ready( function(){ 
		$('.noscript').removeClass("noscript");
	    
		$('.simpleSlide-window').each(function(){
			var width = $(this).outerWidth();
			var max_height = 0;
			$(this).find('.simpleSlide-slide').each(function(){
				$(this).css({
					'width': width
				});
				var height = $(this).outerHeight();
				if ( height > max_height) {
					max_height = height;
				}
				
			});
			$(this).find('.simpleSlide-slide').css({
				'height': max_height
			});
		}); 

		$('.jump-to[alt="1"]').addClass('current');
		$('.jump-to').hover(
			function(){$(this).addClass('hover');},
			function(){$(this).removeClass('hover');}
		);
		
        simpleSlide();
    });

    function show_tweets() {
    	new TWTR.Widget({
    		  version: 2,
    		  type: 'profile',
    		  rpp: 4,
    		  interval: 6000,
    		  width: 200,
    		  height: 300,
    		  footer: '',
    		  theme: {
    		    shell: {
    		      background: '#2857af',
    		      color: '#ffffff'
    		    },
    		    tweets: {
    		      background: '#E5E8FF',
    		      color: '#000000',
    		      links: '#a16106'
    		    }
    		  },
    		  features: {
    		    scrollbar: false,
    		    loop: false,
    		    live: false,
    		    hashtags: true,
    		    timestamp: false,
    		    avatars: false,
    		    behavior: 'all'
    		  }
    		}).render().setUser('GlasgowGist').start();
    }
</script>
</head>

<body <?php if(is_home()) body_class('archive'); else body_class('single-post-php'); ?>>
<div id="wrapper" class="hfeed">



<!------------------------  Top Banner Starts here----------------------------->
	<div id="header">
	<div id="masthead">
		<div id="logo">
			<a href="<?php echo home_url( ); ?>"><img src="<?php echo home_url( 'wp-content/themes/test/images/gistLogoLive.png' ); ?>"></a>
		</div> <!-- #logo --> 
	
		<div id="rightHeader">
			<div id="searchForm">
				<?php get_search_form(); ?>
			</div>
			
		</div> <!-- #rightHeader -->	
	</div> <!-- #Mastheat -->
	<div id="topNav">
		<ul id="navList">
		<li> <a href="<?php echo home_url( ); ?>">home</a></li>
		<li> <a href="<?php echo get_category_link_by_name( 'feature' ); ?>">features</a></li> 
		<li> <a href="<?php echo get_category_link_by_name( 'snippet' ); ?>">news snippets</a></li> 
		<li> <a href="<?php echo get_category_link_by_name( 'podcast' ); ?>">podcasts</a></li> 
		<li> <a href="<?php echo get_page_link_by_title( 'About GIST' ); ?>">about gist</a></li> 
		</ul>
	</div>  <!-- #topNav -->
	<div id="beta">
   <!---	<span>This site is still under development. If you have any problems, please visit our <a href="http://thegistmagazine.wordpress.com/">existing site</a>.</span>   -->
	</div>
</div><!-- #header -->

<!----------------------------------- Top Banner Ends Here -------------------------------------->

<div id="main">
