<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Gist
 */

get_header(); ?>

<div id="container">
	<div id="content" role="main">

		<h1 class="page-title"><?php echo single_cat_title( '', false ) ?></h1> 
		<?php
			$category_description = category_description();
			if ( ! empty( $category_description ) )
				echo '<div class="archive-meta">' . $category_description . '</div>'; 

			$posts=array();
			$ids=array();
			$votes=array();
			gather_posts('idea', -1, $posts, $ids);
			
			foreach($ids as $id){
	        	$votes[] = GetVotes($id);
	        }
	        array_multisort($votes, 'SORT_DESC', $posts);
	        foreach($posts as $post){
	        	setup_postdata($post); ?>
	        	<div class="idea">
		        	<div class="vote"><?php DisplayVotes(get_the_ID()); ?></div>
		        	<div>
			        	<h3><?php the_title();  ?></h3>
			        	<p><?php the_content(); ?></p>
		        	</div>
	        	</div>
	        	<?php 
	        	  
	        }
	        
	        tdomf_the_form(1);
		?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar('category'); ?>

<?php get_footer(); ?>
