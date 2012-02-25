<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage The Gist
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">


			<?php if ( have_posts() ) : ?>
				<h1 class="page-title bleed-left">
					<img src="<?php echo resource('images/bleed_feature.png'); ?>"/>
					<?php printf( 'Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
				<?php get_archive_posts(); ?>
				<?php get_navigation(); ?>
			<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title">Nothing Found</h2>
					<div class="entry-content">
						<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
			<?php endif; ?>
		</div>
	</div>

<?php get_footer(); ?>