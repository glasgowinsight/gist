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
				
				<?php if ( have_posts() ) : ?>
					<?php global $post; ?>
					<?php the_post(); ?>
					<?php $rel = $related->show(get_the_ID(), true); ?>
					<?php if ( $rel ): ?>
							<div id="related">
								<h2>Related Articles</h2>  
								<?php foreach ($rel as $post) : ?>
				        			<?php setup_postdata($post); ?>
				        			<?php get_template_part( 'content', 'extract' ); ?>
				    			<?php endforeach; ?>
				    			<?php wp_reset_postdata(); ?>
				    		</div>
	    			<?php endif; ?>
	    		<?php endif; ?>		
				
				<?php query_posts('category_name=feature,snippet&posts_per_page=7'); ?>
				<?php $i=0; ?>
				<?php if ( have_posts() ) : ?>
					<div id="latest">
						<h2>Latest Articles</h2>  
						<?php while ( $i<3 && have_posts() ) : the_post(); ?>
		        			<?php get_template_part( 'content', 'extract' ); ?>
		        			<?php $i++; ?>
		    			<?php endwhile; ?>
		    		</div>
	    		<?php endif; ?>		
				<?php if ( have_posts() ) : ?>
					<div id="other">
						<h2>Other Articles</h2>  
						<?php while ( have_posts() ) : the_post(); ?>
		        			<?php get_template_part( 'content', 'extract' ); ?>
		    			<?php endwhile; ?>
		    		</div>
	    		<?php endif; ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>