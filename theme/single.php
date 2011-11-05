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
				
				<div class="licence"><?php 
					$licence=get_licence($post);
					if( $licence != NULL ){ ?>
						<p>
							<a rel="license" href="<?php echo $licence['url']; ?>"><img alt="Creative Commons License" src="<?php echo $licence['image']; ?>" /></a>
							<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/Text" property="dct:title" rel="dct:type"><?php the_title(); ?></span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName"><?php the_author(); ?></span> is licensed under a <a rel="license" href="<?php echo $licence['url']; ?>"><?php echo $licence['licence']; ?></a>.
						</p>
					<?php } ?>
				</div>
				
				<h2>Discussion <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?></h2>
			
				<?php comments_template( '', true ); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div>
<?php get_sidebar( 'single' ); ?>
<?php get_footer(); ?>