<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<?php if ( have_posts() ): the_post();?>
<?php $main_post<-get_postdata(); ?>
		<div id="primary">
			<div id="content" role="main">

				<?php $rel = $related->show($main_post->ID, true); ?>
				<?php if ( $rel ): ?>
						<div id="related">
							<h2>Related Articles</h2>  
							<?php global $post; ?>
							<?php foreach ($rel as $post) : ?>
			        			<?php setup_postdata($post); ?>
			        			<?php get_template_part( 'content', 'extract' ); ?>
			    			<?php endforeach; ?>
			    		</div>
    			<?php endif; ?>

				<?php $post = $main_post; setup_postdata($post); ?>
				<?php get_template_part( 'content', 'single' ); ?>
				
				<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : ?>
				<div id="author-info">
					<h2>Author</h2>
					<div id="author-avatar">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
						</a>
					</div><!-- #author-avatar -->
					<div id="author-description">
						// <?php the_author_meta( 'description' ); ?>
					</div>
				</div>
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
				
				<?php $post = $main_post; setup_postdata($post); ?>
				<?php comments_template( '', true ); ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php endif; ?>
<?php get_footer(); ?>