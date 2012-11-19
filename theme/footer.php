<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage The GIST
 */
?>

	</div><!-- #main -->

	<div id="colophon" role="contentinfo">

			<div id="site-generator">
				// <?php bloginfo( 'name' ); ?> - <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" class="link" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" class="plain" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a>
			</div>
	</div><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
