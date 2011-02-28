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

		<div id="container">
			<div id="content" role="main">

				<div class="slider noscript">
					<h2>Latest Features</h2>
				    <div class="left-button" rel="1"></div>
				    <div class="right-button" rel="1"></div>
				    <div class="simpleSlide-window" rel="1">
				    	<div class="simpleSlide-tray auto-slider" rel="1">
							<?php 
								query_posts( 'category_name=january-2011' );
								while (have_posts()) : 
									the_post(); 
					            	show_post_excerpt(true);
					        	endwhile;			
								rewind_posts();
							?>
				        </div>
				    </div>
				    <div class="simpleSlide-thumbnails">
					    <?php $i=1 ?>
						<?php while (have_posts()) : the_post(); ?>
				            <span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php the_post_thumbnail(array(32,32), array('alt'=>'', 'title'=>the_title('', '', false))); ?></span>
					    	<?php $i++ ?>
					    <?php endwhile; ?>				
						<?php rewind_posts(); ?>
					</div>
				</div> 
				<?php 
					function add_posts($category, $limit, &$posts, &$ids) {
						$params = array(
							'category_name'=>$category,
							'numberposts'=>$limit,
							'post__not_in'=>$ids,
						);
						
						if($category=='january-2011'){
							$params['orderby'] = 'rand';
						}
						
						$p=get_posts($params);
						foreach ($p as $post) {
							$ids[] = $post->ID;
							$posts[] = $post;
						}
					}

					$ids = array();
					$posts = array();
					add_posts( 'january-2011', 2, $posts, $ids); ?>
						
					<noscript>	
						<div class="row">	
							<?php
								foreach ($posts as $post):
									setup_postdata($post); 
									show_post_excerpt();
								endforeach;
							?>
						</div>
					</noscript>
				<?php
					$posts = array();
					add_posts( 'snippet', 1, $posts, $ids );
					if ( !$posts ):
						add_posts( 'january-2011', 1, $posts, $ids);
					endif;
					add_posts( 'event', 1, $posts, $ids );
					add_posts( 'podcast', 1, $posts, $ids );
					$numposts = 4;
					if ( count($posts) < $numposts) :
						add_posts( 'snippet', $numposts-count($posts), $posts, $ids );
						if ( count($posts) < $numposts) :
							add_posts( 'january-2011', $numposts-count($posts), $posts, $ids );
						endif;
					endif;
					$i=0;
				    foreach ($posts as $post):
				    	setup_postdata($post); 
						if ( $i % 2 == 0): ?><div class="row"><?php endif;
				    	show_post_excerpt();
				    	if ( $i % 2 == 1): ?></div><?php endif;
				    	$i++;
					endforeach;
					if ( $i % 2 == 1): ?></div><?php endif;
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
