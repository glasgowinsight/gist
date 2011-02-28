<?php if (!isset($class)) $class=''?>
<div id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<?php the_post_thumbnail(); ?>
    <div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</div>