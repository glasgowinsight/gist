<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage The GIST
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php global $bleed; ?>
	<?php global $link_class; ?>
	<div class="entry-header">
		<h1 class="entry-title bleed-left"><?php echo $bleed; ?><?php the_title(); ?></h1>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<a href="#comments" <?php echo $link_class; ?>>Discuss</a> <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?>
	</div>	
</div>