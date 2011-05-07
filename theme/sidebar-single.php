<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Gist
 * 
 */

get_header(); ?>

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
		function format_link($links){
			echo $link;
		}
		sidebar('find-out', 'Find out more', $links, 'format_link');
		
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
	
		sidebar('author-other', 'Other articles by <a href="' . get_author_posts_url(get_the_author_meta('first_name')) . '">' . get_the_author() . '</a>', $other, 'format_article');
	?>	
	<div class="sidebarSection">
		<h3>Spread The Word</h3>
		<?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'fb_tw_sc' ); ?>
	</div>
</div>
