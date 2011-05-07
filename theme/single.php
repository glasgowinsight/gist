<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Gist
 * 
 */

get_header(); ?>

<div id="container">
	<div id="content" role="main">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>"  <?php post_class('single-post'); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				
				<h2>Discussion <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?></h2>
			
				<?php comments_template( '', true ); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div>
<?php get_sidebar( 'single' ); ?>
<?php get_footer(); ?>