<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile;?>
				
				<?php 
					if ( have_posts() ) :
						the_post();
						$rel = $related->show(get_the_ID(), true); 
					    foreach ($rel as $r) :
	        				setup_postdata($r);
	        				get_template_part( 'content', 'extract' );
	    				endforeach;
	    				wp_reset_postdata();
	    			endif;		
				?>
				

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>