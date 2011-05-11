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
				<div class="authorImage">
					<?php 
						if(userphoto_exists(get_the_author_meta('ID')))
	    					userphoto(get_the_author_meta('ID'));
						else
	    					echo get_avatar(get_the_author_meta('ID'), 75, '404');
	    			?>
				</div>
				<div class="authorDescription"><?php echo $description; ?></div>
			</div> <?php 
		}

		$ids = array();
		$ids[] = get_the_ID();
		
		function format_article($article){
			?><a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a><?php 
		}
		
		$other = get_posts( array(
			'numberposts'=>3,
			'author_name'=>get_the_author(),
			'post__not_in'=>$ids
		));
		foreach ($other as $p){
			$ids[] = $p->ID;
		}
		
		sidebar('author-other', 'Other articles by <a href="' . get_author_posts_url(get_the_author_meta('first_name')) . '">' . get_the_author() . '</a>', $other, 'format_article');
		
		$links = get_post_custom_values('external_link');
		function format_link($link){
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
			'tag__in'=>$tag_ids,
			'post__not_in'=>$ids
		));
		
		sidebar('similar-articles', 'Similar articles', $similar, 'format_article');
	?>	
	<div class="sidebarSection">
		<h3>Spread The Word</h3>
		<?php do_action('addthis_widget', get_permalink(), the_title('', '', false), 'fb_tw_sc' ); ?>
	</div>
</div>
