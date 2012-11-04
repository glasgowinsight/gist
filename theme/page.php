<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<?php if ( have_posts() ): the_post();?>
		<?php $bleed = get_bleed(); ?>
		<div id="primary">
			<div id="content" role="main">
				<div id="container">
					<div id="article">
						<?php get_template_part( 'content', 'page' ); ?>
					</div>

					<div id="sidebar">
						<?php query_posts(array(
							'category_name'=>'feature,snippet',
							'posts_per_page'=>7,
							'post__not_in'=>$post_ids)); ?>
						<?php if ( have_posts() ) : ?>
							<div id="latest">
								<h2 class="bleed-switch"><?php echo $bleed; ?>Latest Articles</h2>  
								<?php get_archive_posts(3); ?>
							</div>
						<?php endif; ?>
					</div>
					<br style="clear:both"/>
				</div>
				
				<?php if ( have_posts() ) : ?>
					<div id="other">
						<h2 class="bleed-left"><?php echo $bleed; ?>Other Articles</h2>  
						<?php get_archive_posts(); ?>
					</div>
				<?php endif; ?>
                        </div><!-- #content -->
                </div><!-- #primary -->
<?php endif; ?>
<?php get_footer(); ?>
