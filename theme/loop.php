<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Gist
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="not-found">
		<div class="entry-content">
			<p>There aren't any posts here yet, but they're coming soon</p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php 
	if ( !in_category('about') && !is_author() && have_posts() ){
		the_post();
		show_headline_post_excerpt('headlinePost', 'medium');
	}
?>

<?php $row=False ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php /* How to display posts in the Gallery category. */ ?>

	<?php 
		if ( !$row ): ?><div class="row"><?php endif;
		show_post_excerpt('smallPost', 'thumbnail');
		if ( $row ): ?></div><?php endif;
		$row = !$row;
	?>
<?php endwhile; // End the loop. Whew. ?>
<?php if ( $row ): ?></div><?php endif;?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
	</div>
<?php endif; ?>
