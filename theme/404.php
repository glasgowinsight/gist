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
 * @subpackage The GIST
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_feature.png'); ?>"/>Page Not found</h1></div>
				<div class="entry-content">
					<p>We can't find the page you're looking for. Try searching for it below, or if you followed a link on the site, <a href="mailto:web@the-gist.org">let us know</a> where it was and we'll try to get it sorted.</p>
					<?php get_search_form(); ?>
				</div>
			</div>
			<br class="clear"/>
		</div>

<?php get_footer(); ?>