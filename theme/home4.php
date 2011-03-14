<?php

/*
Template Name: Home 4
*/
?>
<?php get_header(); ?>

			<div id="content" role="main">

				<div class="slider noscript">
					<h2>Latest Features</h2>
				    <div class="left-button" rel="1"></div>
				    <div class="right-button" rel="1"></div>
				    <div class="simpleSlide-window" rel="1">
				    	<div class="simpleSlide-tray auto-slider" rel="1">
							<?php 
								query_posts( 'category_name=january-2011' );
								while (have_posts()) : 
									the_post(); 
					            	show_post_excerpt(true);
					        	endwhile;			
								rewind_posts();
								the_post();
								show_post_excerpt(true);
								rewind_posts();
							?>
				        </div>
				    </div>
				    <div class="simpleSlide-thumbnails">
					    <?php $i=1 ?>
						<?php while (have_posts()) : the_post(); ?>
				            <span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php the_post_thumbnail(array(32,32), array('alt'=>'', 'title'=>the_title('', '', false))); ?></span>
					    	<?php $i++ ?>
					    <?php endwhile; ?>				
						<?php rewind_posts(); ?>
					</div>
				</div> 
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
						<div class="row">	
							<?php
								foreach ($posts as $post):
									setup_postdata($post); 
									show_post_excerpt();
								endforeach;
							?>
						</div>
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
					$i=0;
				    foreach ($posts as $post):
				    	setup_postdata($post); 
						if ( $i % 2 == 0): ?><div class="row"><?php endif;
				    	show_post_excerpt();
				    	if ( $i % 2 == 1): ?></div><?php endif;
				    	$i++;
					endforeach;
					if ( $i % 2 == 1): ?></div><?php endif;
				?>
			</div><!-- #content -->
	
<div id="sidebar">

		<div id="primary" role="complementary">
			
		<div class="sidebarSection">
		<script>show_tweets();</script>
		</div>		

		<div class="sidebarSection">
		<h3> Find items about </h3>
		
		<ul> 
			<li>Local Glasgow science </li> 
			<li>Internationsl research </li> 
			<li>interviews with scientists </li> 
			<li>Current Events </li> 
			<li>Opinions </li> 
		</ul>
		</div> <!-- first sidebarSection -->


		<div class="sidebarSection">
		<h3> Intererest? Find out about </h3> 
		<ul> 
			<li>Physics </li> 
			<li>Engineering</li> 
			<li>Biology</li> 
			<li>Chemistry</li> 
		</ul>
		</div> <!-- second sidebarSection -->
		<div class="sidebarSection">
		<h3>Latest News<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png"/></a>
		</div>
		</div><!-- #primary .widget-area -->
</div> <!-- #sidebar -->


	<?php get_footer(); ?>

