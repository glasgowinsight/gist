<?php
/**
 * The Sidebar for the category page
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div id="sidebar">
	<div id="primary" role="complementary">
		<div class="sidebarSection"> 
			<h3><?php
					printf( __( '%ss' , 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' ) ?> by subject </h3> </h3> 
			<?php wp_tag_cloud('smallest=12&largest=12&number=50&orderby=count&format=list&'); ?>
			
		</div>
		
		<div class="sidebarSection">
			<h3><?php
					printf( __( '%ss' , 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' ) ?> by date </h3>
		<?php wp_get_archives('type=monthly&limit=12'); ?>
			
		</div>

		<div class="sidebarSection">
			<script>show_tweets();</script>
		</div>		

		<div class="sidebarSection followLinks">
			<h3>Keep In Touch</h3>
			<ul>
				<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png"/><span>Get the latest news</span></a></li>
				<li><a href="mailto:glasgowinsight@gmail.com"><img src="<?php bloginfo('template_directory'); ?>/images/email.png"/><span>Tell us what's happening</span></a></li>
				<li><a href="http://twitter.com/GlasgowGist"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"/><span>Follow us on Twitter</span></a></li>
				<li><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.jpg"/><span>Talk to us on Facebook</span></a></li>
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
