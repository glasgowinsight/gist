<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( '%s Articles' , 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' )
				?></h1> 
				<div class="archive-meta">
					Glasgow Insight into Science and Technology report on science and 
					technology news, both in Glasgow and the wider world. We’re still 
					young but currently we produce this website, and plan to start 
					broadcasting podcasts and running events in the near future, with 
					a magazine on the way. We consist mainly of students from the 
					Universities of Glasgow and Strathclyde, but we’re open to anyone, 
					and looking for as many people to get involved as possible. Any 
					level of participation is welcome, so whether you want to help shape 
					the whole future of the group, get involved in writing, editing, 
					design, broadcasting, events or just have a single story you think 
					we should cover, please get in touch.
				</div>

				<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="not-found">
		<div class="entry-content">
			<p><?php _e( "There aren't any posts here yet, but they're coming soon", 'twentyten' ); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * This loop is used specifically for cateorgy pages: features, snippets, podcasts at the moment
	 * Design is to highlihgt the first post asa a headline then display remainder underneath in 
	 * double col format. 
	 * 
	 * For the generic, standard loop see loop.php
	 * 
	 * Without further ado, the loop:
	 */ ?>
<?php $i=0 ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php /* How to display posts in the Gallery category. */ ?>


<?php /* How to display all other posts.*/ ?>

	<?php 
		if ( $i % 2 == 0): ?><div class="row"><?php endif;
		show_post_excerpt('smallPost', 'thumbnail');
		if ( $i % 2 == 1): ?><div class="clearer"> </div> </div><?php endif;?>

	<?php $i++ ?>
<?php endwhile; // End the loop. Whew. ?>
<?php if ( $i % 2 == 0): ?></div><?php endif;?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

			<!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('category'); ?>

<?php get_footer(); ?>
