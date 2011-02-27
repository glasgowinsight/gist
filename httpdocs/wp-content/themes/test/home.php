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
				    <div class="left-button" rel="1"></div>
				    <div class="right-button" rel="1"></div>
				    <div class="simpleSlide-window" rel="1">
				    	<div class="simpleSlide-tray auto-slider" rel="1">
							<?php 
								query_posts( 'category_name=january-2011' );
								while (have_posts()) : 
									the_post(); 
					            	$class = 'simpleSlide-slide';
									include 'post-excerpt.php';
									$class = '';
					        	endwhile;			
								rewind_posts();
							?>
				        </div>
				    </div>
				    <div class="simpleSlide-thumbnails">
					    <?php $i=1 ?>
						<?php while (have_posts()) : the_post(); ?>
				            <span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php the_post_thumbnail(array(32,32)); ?></span>
					    	<?php $i++ ?>
					    <?php endwhile; ?>				
						<?php rewind_posts(); ?>
					</div>
				</div> 
				<?php 
					function posts($category, $limit, &$ids) {
						$params = array(
							'category_name'=>$category,
							'numberposts'=>$limit,
							'post__not_in'=>$ids,
						);
						
						if($category=='january-2011'){
							$params['orderby'] = 'rand';
						}
						
						$posts=get_posts($params);
						foreach ($posts as $post) {
							array_push($ids, $post->ID);
						}
						return $posts;
					}

					$ids = array();
					$posts = posts( 'january-2011', 2, $ids); ?>
					<noscript>	
						<div class="row">	
							<?php
								foreach ($posts as $post):
									setup_postdata($post); 
									include 'post-excerpt.php';
								endforeach;
							?>
						</div>
					</noscript>
				<?php
					$posts = posts( 'snippet', 1, $ids );
					if ( !$posts ):
						$posts = posts( 'january-2011', 1, $ids);
					endif;
					$posts = $posts + posts( 'event', 1, $ids );
					$posts = $posts + posts( 'podcast', 1, $ids );
					$numposts = 4;
					if ( count($posts) < $numposts) :
						$posts = $posts + posts( 'snippet', $numposts-count($posts), $ids );
						if ( count($posts) < $numposts) :
							$posts = $posts + posts( 'january-2011', $numposts-count($posts), $ids );
						endif;
					endif;
					$i=0;
				    foreach ($posts as $post):
				    	setup_postdata($post); 
						if ( $i % 2 == 0): ?><div class="row"><?php endif;
				    	include 'post-excerpt.php';
				    	if ( $i % 2 == 1): ?></div><?php endif;
				    	$i++;
					endforeach;
					if ( $i % 2 == 1): ?></div><?php endif;
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
