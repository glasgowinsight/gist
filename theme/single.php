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
				<div id="container">
					<div id="article">
						<?php $rel = $related->show(get_the_ID(), true); ?>
						<?php if ( $rel ): ?>
								<div id="related">
									<h2 class="cap-switch bleed-switch">Related Articles</h2>  
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
							<h2 class="cap-right bleed-left">Author</h2>
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
					</div>
					
					<div id="sidebar">
						<div class="references">
							<?php $references = get_post_meta(get_the_ID(), 'references', True); ?>
							<?php if ($references ): ?>
								<h2 class="cap-switch bleed-switch">References</h2>
								<?php echo $references; ?>
							<?php endif;?>
						</div>
						
						<?php query_posts('category_name=feature,snippet&posts_per_page=7'); ?>
						<?php if ( have_posts() ) : ?>
							<div id="latest">
								<h2 class="cap-switch bleed-switch">Latest Articles</h2>  
								<?php get_archive_posts(3); ?>
				    		</div>
			    		<?php endif; ?>
		    		</div>
	    		</div>
	    		
				<?php if ( have_posts() ) : ?>
					<div id="other">
						<h2 class="cap-right bleed-left">Other Articles</h2>  
						<?php get_archive_posts(); ?>
		    		</div>
	    		<?php endif; ?>
				
				<?php $post = $main_post; setup_postdata($post); ?>
				<?php $withcomments = 1; ?>
				<?php comments_template( '', true ); ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php endif; ?>
<?php get_footer(); ?>