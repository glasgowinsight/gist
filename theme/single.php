<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
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
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->					
				</div><!-- #post-## -->
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
		<div id="sidebar">
			<div class="sidebarSection">
				<h3> About the Author </h3> 
				<div class="authorImage"><?php userphoto_the_author_photo() ?></div>
				<div class="authorDescription"><?php the_author_meta( 'description' ); ?></div>
			</div> <!-- sidebar section -->
		
			<?php 
				$links = get_post_custom_values('external_link');
				function format_link($tag){
					echo $link;
				}
				sidebar('find-out', 'Find out more', get_tags(), 'format_link');
			?>
		
			<div id="similar-articles" class="sidebarSection">
				<h3> Similar articles </h3> 
				<ul>
					<li> post 1 title </li>
					<li> post 2 title</li>
					<li> post 3 title</li>
				</ul>
			</div>
		
			<div  id= "author-other" class="sidebarSection"> 
				<h3> Other articles by Chris </h3> 
				<ul>
					<li> post 1 title </li>
					<li> post 2 title</li>
					<li> post 3 title</li>
				</ul>
			</div>
		</div>
	</div>
<?php get_footer(); ?>