<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php global $bleed; ?>
	<div class="entry-header">
		<h1 class="entry-title bleed-left"><?php echo $bleed; ?><?php the_title(); ?></h1>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>	
</div>
