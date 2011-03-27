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
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="content" role="main">

	<div class="slider noscript">
		<h2>Latest Features</h2>
	    <div class="left-button" rel="1"></div>
	    <div class="right-button" rel="1"></div>
	    <div class="simpleSlide-window" rel="1">
	    	<div class="simpleSlide-tray auto-slider" rel="1">
				<?php 
					$categories = get_latest_feature_categories();
					$ids = array();
					$posts = array();
					gather_posts( $categories[0]->name, -1, $posts, $ids);
					$min_features=6;
					$i=1;
					while($i<count($categories) && count($posts)<$min_features){
						gather_posts( $categories[i]->name, $min_features-count($posts), $posts, $ids);
					}
					
					foreach ($posts as $post){
	    				setup_postdata($post); 
						show_post_excerpt(true);
					}
				?>
	        </div>
	    </div>
	    <div class="simpleSlide-thumbnails">
		    <?php 
		    	$i=1;
		    	foreach ($posts as $post){
    				setup_postdata($post); 
					?><span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php 
					the_post_thumbnail(array(50,50), array('alt'=>'', 'title'=>the_title('', '', false))); 
					?></span><?php 
					$i++;
				}
		     ?>
		</div>
	</div>
	<?php 
		query_posts( array(
			'category_name'=>'snippet',
			'num_posts'=>3
		));
		if(have_posts()){
			?><div id="snippets"><?php 
			while (have_posts()){
				the_post(); 
            	show_post_excerpt(true);
			}
			?></div><?php 
		}
	?>
	<?php 
		query_posts( array(
			'category_name'=>'podcast',
			'num_posts'=>2
		));
		if(have_posts()){
			?><div id="podcasts"><?php 
			while (have_posts()){
				the_post(); 
            	show_post_excerpt(true);
			}
			?></div><?php 
		}
	?>
	<?php 
		query_posts( array(
			'category_name'=>'feature',
			'num_posts'=>10,
			'post__not_in'=>$ids,
		));
		if(have_posts()){
			?><div id="old_features"><?php 
			while (have_posts()){
				the_post(); 
            	show_post_excerpt(true);
			}
			?></div><?php 
		}
	?>
	<?php 
		query_posts( array(
			'category_name'=>'event',
			'num_posts'=>5
		));
		if(have_posts()){
			?><div id="events"><?php 
			while (have_posts()){
				the_post(); 
            	show_post_excerpt(true);
			}
			?></div><?php 
		}
	?>
</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
