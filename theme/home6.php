<?php

/*
Template Name: Home 6 - Does this appear?
*/
?>
<?php get_header(); ?>

			<div id="content" role="main">

				<div class="slider noscript">
				    <h2 id="sliderTitle">Latest Features</h2>

				    <div class="simpleSlide-window" rel="1">
				    	<div class="simpleSlide-tray auto-slider" rel="1">
							<?php 
								query_posts( 'category_name=january-2011' );
								while (have_posts()) : 
									the_post(); 
					            	show_post_excerpt(true);
					        	endwhile;			
								rewind_posts();
							?>
				        </div>
				    </div>
				    <div class="simpleSlide-thumbnails">
				<h3> New articles on The GIST: </h3>
					    <?php $i=1 ?>
						<?php while ($i<=7) : the_post(); ?>
				            <span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php the_post_thumbnail(array(32,32), array('alt'=>'', 'title'=>the_title('', '', false))); ?></span>
					    	<?php $i++ ?>
					    <?php endwhile; ?>				
						<?php rewind_posts(); ?>
					</div>
				</div> 
				<div id="mainPostSection">  <!-- #Added 7th March -->
				
<?php 
					function add_posts($category, $limit, &$posts, &$ids) {
						$params = array(
							'category_name'=>$category,
							'numberposts'=>$limit,
							'post__not_in'=>$ids,
						);
						
						if($category=='january-2011'){
							$params['orderby'] = 'rand';
						}
						
						$p=get_posts($params);
						foreach ($p as $post) {
							$ids[] = $post->ID;
							$posts[] = $post;
						}
					}

					$ids = array();
					$posts = array();
					add_posts( 'january-2011', 2, $posts, $ids); ?>
						
					<noscript>	
							
							<?php
								foreach ($posts as $post):
									setup_postdata($post); 
									show_post_excerpt();
								endforeach;
							?>
					
					</noscript>
				<?php
					$posts = array();
					add_posts( 'snippet', 1, $posts, $ids );
					if ( !$posts ):
						add_posts( 'january-2011', 1, $posts, $ids);
					endif;
					add_posts( 'event', 1, $posts, $ids );
					add_posts( 'podcast', 1, $posts, $ids );
					$numposts = 4;
					if ( count($posts) < $numposts) :
						add_posts( 'snippet', $numposts-count($posts), $posts, $ids );
						if ( count($posts) < $numposts) :
							add_posts( 'january-2011', $numposts-count($posts), $posts, $ids );
						endif;
					endif;


					$posts = array(); ?> <!--- Added by Simon to suppress 4 posts --> <?php

					$i=0;
				    foreach ($posts as $post):
				    	setup_postdata($post); 
						if ( $i % 2 == 0): ?><?php endif;
				    	show_post_excerpt();
				    	if ( $i % 2 == 1): ?><?php endif;
				    	$i++;
					endforeach;
					if ( $i % 2 == 1): ?><?php endif;
				?>


			<div id="mainPostSectionLeft">
			<div id="snippets">
	<?php 
		function custom_excerpt_length( $length ) {
			return 20;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
		$posts = array();
		$ids = array();
		add_posts( 'snippet', 3, $posts, $ids );
		foreach ($posts as $post):
	    	setup_postdata($post); ?>
			<div id="post-<?php the_ID(); ?>" class="sideSnippets">
				<div class="sideSnippetTitle">
				<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</div>
				<?php the_post_thumbnail(); ?>
			    <div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</div><?php 
	    endforeach;
	    remove_filter( 'excerpt_length', 'custom_excerpt_length' );
	?>
</div>
			
			</div> 

			<div class="mainPostSectionMid">
			<h3> Podcasts </h3> 
			<ul>
				<li> <span class="highlight"> Comming Soon ... </span>GIST podcasts science podcasts from the GIST team will be with you soon. Check back here soon.</li>  
			</ul> 
			</div>
			<div class="mainPostSectionMid">
			<h3> More Features </h3> 
			<ul>
				<li> Or other things until we get enough podcasts to fill this up </li>
			</ul>

			</div> 
			
			</div>
			</div> <!-- #content -->
	


<div id="sidebar">

		<div id="primary" role="complementary">
		
		<div class="sidebarSection">
		<h3> Events coming up </h3>
		<ul>
				<li> <span class="highlight"> Comming Soon ... </span>GIST podcasts science podcasts from the GIST team will be with you soon. Check back here soon.</li> 
				<li> <span class="highlight"> 13th March 2011 </span>National Science Weedk </li>
				<li> <span class="highlight"> 24th March 2011 </span>GIST goes to Glasgow Uni </li>  
		</ul>
		</div> 

		
	
			

		<div class="sidebarSection">
		<h3> Find out about </h3> 
		<ul> 
			<li>Physics </li> 
			<li>Engineering</li> 
			<li>Biology</li> 
			<li>Chemistry</li> 
		</ul>
		<div class="sidebarSection">
		<script>show_tweets();</script>
		</div>	
		</div> <!-- second sidebarSection -->
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
		</div><!-- #primary .widget-area -->
</div> <!-- #sidebar -->


	<?php get_footer(); ?>

		