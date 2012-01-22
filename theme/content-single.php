<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<h2 class="entry-title cap-right"><?php the_title(); ?></h2>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<a href="#comments">Discuss &rarr;</a> <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?>
	</div>
</div>