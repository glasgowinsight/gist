<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Gist
 */

get_header(); ?>

<div id="content" role="main">

	<div class="slider">
		<div class="left-button" rel="1"></div>
		<div class="right-button" rel="1"></div>
		<div class="simpleSlide-window" rel="1">
	    	<div id="slider" class="simpleSlide-tray auto-slider" rel="1">
				<?php 
					$ids = array();
					$posts = array();
					# At the moment we have to get 10 posts even though we only show 1
					# so we get the right posts for the right-content div
					$num_posts=10;
					gather_posts( 'feature', $num_posts, $posts, $ids);
					
					$post = $posts[0];
					setup_postdata($post); 
					show_post_excerpt('simpleSlide-slide', 'slideshow');
				?>
	        </div>
	    </div>
	    <div id="slider-thumbs" class="simpleSlide-thumbnails">
	    	<span class="jump-to invisible-thumb">
	    		<?php the_post_thumbnail('jump');?>
	    		<span>Loading slideshow...</span>
	    	</span>
		</div>
	</div>
	<div id="left-content">
		<?php 
			query_posts(array(
				'category_name'=>'snippet',
				'posts_per_page'=>3
			));
			if(have_posts()){
				while (have_posts()){
					the_post(); 
	            	show_post_excerpt(implode(' ', get_post_class()), 'left-column');
				}
			}
		?>
	</div>
	<div id="right-content">
		<?php 
			$posts = array();
			$min_features=2;
			gather_posts( 'podcast', $min_features, $posts, $ids);
			if(count($posts)<$min_features){
				gather_posts( 'feature', $min_features-count($posts), $posts, $ids);
			}
			foreach ($posts as $post){
    			setup_postdata($post); 
				show_post_excerpt(implode(' ', get_post_class()), 'right-column');
			}					
		
		query_posts(array(
			'category_name'=>'study',
			'posts_per_page'=>5
		));
		if(have_posts()){ 
			?><div id="news" class="post news">
				<h3>Local News</h3>
			 	<div class="entry-summary">
			 		<?php echo rssinpage(array( 
				 			'rssfeed'=>
				 				'http://www.gla.ac.uk/rss/news/index.xml,' .
				 				'http://feeds2.feedburner.com/uos/hp,' .
				 				'http://www.gcu.ac.uk/newsevents/feeds/feeds.php?s=fnunrn',
			 				'rssformat'=>'Y (x)', 
				 			'rssdateformat'=>'j F',
				 			'rssitems'=>5
			 			)); 
			 		?>
			 	</div>
			 </div><?php 
		} ?>
	</div>
</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
