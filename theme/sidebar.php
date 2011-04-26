<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Gist
 */
?>
<div id="sidebar">
	<div id="primary" role="complementary">
		<?php wp_reset_query();?>
		
		<?php 
			if(is_home()){
				$events = get_posts( array(
					'category_name'=>'event',
					'numberposts'=>5,
					'order'=>'ASC',
					'orderby'=>'meta_value',
					'meta_key'=>'start_date',
					'meta_query'=>array(
						array(
							'key'=>'end_date',
							'value'=>date('Y-m-d'),
							'compare'=>'>=',
							'type'=>'DATE'
						)
					)
				));
				
				function format_event($post){
					setup_postdata($post);
					?><a href="<?php the_permalink(); ?>">
	            		<strong><?php echo get_post_meta($post->ID, 'display_date', true)?>:</strong><?php the_title(); ?>
	            	</a><?php 
				}
				sidebar('events', 'Upcoming Events', $events, 'format_event');
			}

			if(!is_category('about')){
				function format_tag($tag){
					?><a href="<?php echo get_tag_link($tag->term_id)?>"><?php echo $tag->name ?></a><?php 
				}
				sidebar('tags', 'Find out about', get_tags(), 'format_tag');
			}
			
			if(is_category()){
				$category = get_category(get_query_var('cat'));
				$features_id = get_cat_ID('feature');
				
				if($category->cat_ID == $features_id || $category->category_parent == $features_id){
					$features = get_latest_feature_categories();
					function format_category($category){
						?><a href="<?php echo get_category_link($category->cat_ID)?>"><?php echo $category->cat_name ?></a><?php 
					}
					sidebar('old_features', 'Older Features', $features, 'format_category');
				}
			}
		?>
		
		<div class="sidebarSection">
			<script>show_tweets();</script>
		</div>		

		<div class="sidebarSection followLinks">
			<h3>Keep In Touch</h3>
			<ul>
				<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png"/><span>Get the latest news</span></a></li>
				<li><a href="mailto:glasgowinsight@gmail.com"><img src="<?php bloginfo('template_directory'); ?>/images/email.png"/><span>Talk to us</span></a></li>
				<li><a href="http://twitter.com/GlasgowGist"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"/><span>Follow us on Twitter</span></a></li>
				<li><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.jpg"/><span>Join us on Facebook</span></a></li>
			</ul>
		</div>
		
		<div class="sidebarSection">
			<h3>Around The Web</h3>
			<ul>
				<li><a href="http://www.bluesci.org/">Bluesci</a></li>
				<li><a href="http://www.eusci.org/">EUSci</a></li>
			</ul>
		</div>

		<div class="sidebarSection">
			<h3>GIST Contributors</h3>
			<ul>
				<li><a href="http://www.the-gist.org/wp-login.php">Login</a> </li>
			</ul>
		</div>
	</div>
</div>
