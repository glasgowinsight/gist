<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.
 *
 * @package WordPress
 * @subpackage Gist
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="site-info">
			<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</div><!-- #site-info -->

		<div id="site-generator">
			<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" rel="generator">
				Proudly powered by WordPress
			</a>
		</div><!-- #site-generator -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<!-- WP-Minify JS -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
