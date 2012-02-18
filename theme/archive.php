<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage The GIST
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<h1 class="page-title cap-right">
						<?php if ( is_day() ) : ?>
							<span><?php echo get_the_date(); ?></span>
						<?php elseif ( is_month() ) : ?>
							<span><?php echo get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ); ?></span>
						<?php elseif ( is_year() ) : ?>
							<span><?php echo get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ); ?></span>
						<?php else : ?>
							<?php _e( 'Archives', 'twentyeleven' ); ?>
						<?php endif; ?>
					</h1>
				</div>

								<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_extract(); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<div id="post-0" class="post no-results not-found">
					<div class="entry-header">
						<h3 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h3>
					</div><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>