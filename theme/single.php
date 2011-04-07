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
					<h1 class="entry-title"><?php the_title(); ?> <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'fb_tw_sc' ); ?></h1>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
					<h2>Discussion <?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'small_toolbox' ); ?></h2>
				
					<?php comments_template( '', true ); ?>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
		<div id="sidebar">
			<?php 
				$description = get_the_author_meta('description');
				if($description){ ?>
					<div class="sidebarSection">
						<h3> About the Author </h3> 
						<div class="authorImage"><?php userphoto_the_author_photo() ?></div>
						<div class="authorDescription"><?php echo $description; ?></div>
					</div> <?php 
				}

				$links = get_post_custom_values('external_link');
				function format_link($tag){
					echo $tag;
				}
				sidebar('find-out', 'Find out more', get_tags(), 'format_link');
				
				$tags = get_the_tags();
				$tag_ids = array();
				foreach ($tags as $tag){
					$tag_ids[] = $tag->term_id;
				}
				$similar = get_posts( array(
					'numberposts'=>3,
					'tag__in'=>$tag_ids
				));
				
				$ids = array();
				foreach ($similar as $p){
					$ids[] = $p->ID;
				}
				function format_article($article){
					?><a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a><?php 
				}
				sidebar('similar-articles', 'Similar articles', $similar, 'format_article');
				
				$other = get_posts( array(
					'numberposts'=>3,
					'author_name'=>get_the_author(),
					'post__not_in'=>$ids
				));
			
				sidebar('author-other', 'Other articles by ' . get_the_author(), $other, 'format_article');
			?>	
		</div>
	</div>
<?php get_footer(); ?>