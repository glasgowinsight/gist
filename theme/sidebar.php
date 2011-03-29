<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div id="sidebar">
	<div id="primary" role="complementary">
		<?php 
			query_posts( array(
				'category_name'=>'event',
				'num_posts'=>5
			));
			if(have_posts()){
				?><div id="events" class="sidebarSection"><ul><?php 
				while (have_posts()){
					the_post(); 
	            	?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php 
				}
				?></ul></div><?php 
			}
		?>
		
		<?php 
			$tags = get_tags();
			if(count($tags)>0){?>
				<div class="sidebarSection">
					<h3> Find out about </h3> 
					<ul> 
						<?php 
							foreach ($tags as $tag){
								?><li><a href="<?php echo get_tag_link($tag->term_id)?>"><?php echo $tag->name ?></a></li><?php 
							}
						?>
					</ul>
				</div><?php 
			}
		?>
		
		<div class="sidebarSection">
			<script>show_tweets();</script>
		</div>		

		<div class="sidebarSection">
			<h3>Keep In Touch</h3>
			<ul>
				<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png"/>Get the latest news</a></li>
				<li><a href="mailto:glasgowinsight@gmail.com"><img src="<?php bloginfo('template_directory'); ?>/images/email.png"/>Tell us what's happening</a></li>
				<li><a href="http://twitter.com/GlasgowGist"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"/>Follow us on Twitter</a></li>
				<li><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.jpg"/>Talk to us on Facebook</a></li>
			</ul>
		</div>
		
		<div class="sidebarSection">
			<h3>Around The Web</h3>
			<ul>
				<li><a href="http://www.bluesci.org/">Bluesci</a></li>
				<li><a href="http://www.eusci.org/">EUSci</a></li>
			</ul>
		</div>
	</div>
</div>
