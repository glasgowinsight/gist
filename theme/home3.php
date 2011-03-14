<?php

/*
Template Name: Home 5
*/
?>
<?php
get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


				<div id="post-<?php the_ID(); ?>"  <?php post_class('single-post'); ?>>
					<h1 class="entry-title"><?php the_title(); ?> <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'fb_tw_sc' ); ?></h1>


					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->
					
					<div class="entry-content">
						
						<?php the_content(); ?>
		</div><!-- .entry-content -->					

				</div><!-- #post-## -->
				<h2>Discussion <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?></h2>
				
				<?php comments_template( '', true ); ?>


<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->


<div id="sidebar">




	<div class="sidebarSection">
	<h3> About the Author </h3> 
	 <div class="authorImage"> 
		<?php userphoto_the_author_photo() ?>
	</div>
	<div class="AuthorDescprition"> 
	<?php the_author_meta( 'description' ); ?>
	</div>
	</div> <!-- sidebar section -->

	<div id="find-out" class="sidebarSection"> 
	<h3> Find out more </h3> 
	<ul>
		<li> External link 1 </li>
		<li> External link 2</li>
		<li> External link 3</li>
	</ul>
	</div>

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



<?php get_footer(); ?>

