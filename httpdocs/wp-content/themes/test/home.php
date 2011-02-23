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

			<div class="slider">
			    <div class="left-button" rel="1"></div>
			    <div class="right-button" rel="1"></div>
			    <div class="simpleSlide-window" rel="1">
			    	<div class="simpleSlide-tray" rel="1">
			
					<?php while (have_posts()) : the_post(); ?>
			
			            <div id="slide-<?php the_ID(); ?>" <?php post_class('simpleSlide-slide'); ?> rel="1">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
							<?php the_post_thumbnail(); ?>
				            <div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						</div><!-- #post-## -->
			
					<?php endwhile; ?>				
					<?php rewind_posts(); ?>
			        </div>
			    </div>
			</div> 

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
