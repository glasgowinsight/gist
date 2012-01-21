<?php
/**
 * The template used for displaying page content in index.php and
 * other archive pages
 *
 * @package WordPress
 * @subpackage The GIST
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('extract'); ?>>
	<header class="entry-header">
		<h3 class="entry-title"><?php the_title(); ?></h3>
	</header>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail( 'medium_thumb' ); ?>
		</a>
	</div>
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
	<br style="clear:both"/>
</article>