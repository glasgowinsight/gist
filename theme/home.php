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

	<div class="slider noscript">
		<div class="left-button" rel="1"></div>
		<div class="right-button" rel="1"></div>
		<div class="simpleSlide-window" rel="1">
	    	<div class="simpleSlide-tray auto-slider" rel="1">
				<?php 
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
				?>
	        </div>
	    </div>
	    <div class="simpleSlide-thumbnails">
		    <?php 
		    	$i=1;
		    	foreach ($posts as $post){
    				setup_postdata($post); 
					?><span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php 
					the_post_thumbnail('jump', array('alt'=>'', 'title'=>the_title('', '', false))); 
					?></span><?php 
					$i++;
				}
		     ?>
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
			$min_features=3;
			gather_posts( 'podcast', $min_features, $posts, $ids);
			if(count($posts)<$min_features){
				gather_posts( 'feature', $min_features-count($posts), $posts, $ids);
			}
			foreach ($posts as $post){
    			setup_postdata($post); 
				show_post_excerpt(implode(' ', get_post_class()), 'right-column');
			}					
		?>
	</div>
</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
