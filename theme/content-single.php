<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title cap-right"><?php the_title(); ?></h2>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>