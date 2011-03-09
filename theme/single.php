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


				<div id="post-<?php the_ID(); ?>"  class="<?php post_class('single-Post'); ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>


					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->
					
					<div class="entry-content">
						<div class="authorImage"> 
						<?php userphoto_the_author_photo() ?>
						</div>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->					

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
		
				</div><!-- #post-## -->

		


<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->


<div id="sidebar" class="widget-area">



	<div class="sidebarSection"> 


	<div class="sidebarSection"> 
	<h3> Find out more </h3> 
	<ul>
		<li> External link 1 </li>
		<li> External link 2</li>
		<li> External link 3</li>
	</ul>
	</div>

	<div class="sidebarSection"> 
	<h3> Similar articles </h3> 
	<ul>
		<li> post 1 title </li>
		<li> post 2 title</li>
		<li> post 3 title</li>
	</ul>
	</div>

	<h3> Other articles by Chris </h3> 
	<ul>
		<li> post 1 title </li>
		<li> post 2 title</li>
		<li> post 3 title</li>
	</ul>
	</div>

</div>



<?php get_footer(); ?>
