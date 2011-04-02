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
						show_post_excerpt('simpleSlide-slide');
					}
					
					# Repeat the first div. This is used by simpleSlide.js so we get the
					# effect of it constantly scrolling forward, without a 'rewind' effect
					$post = $posts[0];
					setup_postdata($post); 
					show_post_excerpt('simpleSlide-slide');
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
	<div id="left-content">
		<?php 
			query_posts( array(
				'category_name'=>'snippet',
				'posts_per_page'=>3
			));
			if(have_posts()){
				?><div id="snippets"><?php 
				while (have_posts()){
					the_post(); 
	            	show_post_excerpt(implode(' ', get_post_class()));
				}
				?></div><?php 
			}
		?>
	</div>
	<div id="right-content">
		<?php 
			query_posts( array(
				'category_name'=>'podcast',
				'posts_per_page'=>2
			));
			if(have_posts()){
				?><div id="podcasts"><?php 
				while (have_posts()){
					the_post(); 
	            	show_post_excerpt(implode(' ', get_post_class()));
				}
				?></div><?php 
			}
		?>
		<?php 
			query_posts( array(
				'category_name'=>'feature',
				'posts_per_page'=>10,
				'post__not_in'=>$ids
			));
			if(have_posts()){
				?><div id="old_features"><h3>Older Stories</h3><ul><?php 
				while (have_posts()){
					the_post(); 
	            	?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php 
				}
				?></ul></div><?php 
			}
		?>
	</div>
</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
