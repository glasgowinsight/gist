<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Gist
 */

get_header(); ?>

	<div id="container">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title">Not Found</h1>
				<div class="entry-content">
					<p>Apologies, but the page you requested could not be found. Perhaps searching will help.</p>
					<?php get_search_form(); ?>
				</div>
			</div>

		</div>
	</div>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>