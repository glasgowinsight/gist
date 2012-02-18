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
		<?php global $post; ?>
		<?php $main_post = get_post(get_the_ID()); ?>
		<div id="primary">
			<div id="content" role="main">

				<?php $rel = $related->show(get_the_ID(), true); ?>
				<?php if ( $rel ): ?>
						<div id="related">
							<h2 class="cap-right">Related Articles</h2>  
							<?php foreach ($rel as $post) : ?>
			        			<?php setup_postdata($post); ?>
			        			<?php get_extract(); ?>
			    			<?php endforeach; ?>
			    		</div>
    			<?php endif; ?>

				<?php $post = $main_post; setup_postdata($post); ?>
				<?php get_template_part( 'content', 'single' ); ?>
				
				<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : ?>
				<div id="author-info">
					<h2 class="cap-right">Author</h2>
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
						<h2 class="cap-right">Latest Articles</h2>  
						<?php while ( $i<3 && have_posts() ) : the_post(); ?>
		        			<?php get_extract(); ?>
		        			<?php $i++; ?>
		    			<?php endwhile; ?>
		    		</div>
	    		<?php endif; ?>		
				<?php if ( have_posts() ) : ?>
					<div id="other">
						<h2 class="cap-right">Other Articles</h2>  
						<?php while ( have_posts() ) : the_post(); ?>
		        			<?php get_extract(); ?>
		    			<?php endwhile; ?>
		    		</div>
	    		<?php endif; ?>
				
				<?php $post = $main_post; setup_postdata($post); ?>
				<?php $withcomments = 1; ?>
				<?php comments_template( '', true ); ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php endif; ?>
<?php get_footer(); ?>