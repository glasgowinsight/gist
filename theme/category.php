<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage The GIST
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<div class="page-header">
					<h1 class="page-title bleed-left">
						<?php echo get_bleed(); ?>
						<?php echo single_cat_title( '', false ); ?>
					</h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</div>

			<?php if ( have_posts() ) : ?>

				<?php get_archive_posts(); ?>
				<?php get_navigation(); ?>

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