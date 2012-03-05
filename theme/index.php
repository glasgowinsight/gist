<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage The GIST
 */

get_header(); ?>

	<?php 
		global $post;
		$categories = array('feature'=>10, 'snippet'=>3, 'podcast'=>1, 'event'=>-1, 'study'=>5);
		$posts = array();
		foreach (array_keys($categories) as $category) {
			$posts[$category] = array();
		}
		
		foreach (get_posts(array('meta_query'=>array(array('key'=>'homepage', 'value'=>'0', 'compare'=>'!=')))) as $post){
			$position = get_post_meta($post->ID, 'homepage');
			$position = intval($position[0]) - 1;
			foreach(get_the_category($post->ID) as $category){
				$category_name = $category->category_nicename;
				$posts[$category_name][$position] = $post;
			}			
		}
		
		foreach (array_keys($categories) as $category) {
			$posts_per_page = $categories[$category];
			$i = 0;
			$loaded = array();
			foreach ($posts[$category] as $post){
				$loaded[] = $post->ID;
			}
			$cat_posts = get_posts(array(
				'category_name'=>$category, 
				'posts_per_page'=>$posts_per_page,
				'post__not_in'=>$loaded
			));
			foreach ($cat_posts as $post){
				while(array_key_exists($i, $posts[$category])){
					$i++;
				}
				$posts[$category][$i] = $post;
				$i++;
			}
		}
	?>

		<div id="primary">
			<div id="content" role="main">
				<div id="sections">
					<div class="section section-feature">
						<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_feature.png'); ?>"/><a href="<?php echo get_category_link_by_slug('feature'); ?>">//&nbsp;Features</a></h1></div>
						<div class="posts">
							<div class="row3">
								<?php $post = $posts['feature'][0]; ?>
								<?php setup_postdata($post); ?>
								<?php get_extract('main', 'large_thumb'); ?>
								<div class="row">
									<?php $post = $posts['feature'][1]; ?>
									<?php setup_postdata($post); ?>
									<?php get_extract('left', 'medium_thumb'); ?>
									<?php $post = $posts['feature'][2]; ?>
									<?php setup_postdata($post); ?>
									<?php get_extract('right', 'medium_thumb'); ?>
									<br class="clear"/>
								</div>
							</div>
							<div class="row">
								<?php $post = $posts['feature'][3]; ?>
								<?php setup_postdata($post); ?>
								<?php get_extract('left', 'medium_thumb'); ?>
								<div class="articles right">
									<div class="entry-header">
										<h3 class="entry-title">More Features</h3>
									</div>
									<div class="entry-content">
										<ul>
											<?php for ($i = 4; $i < count($posts['feature']); $i++):
												$post = $posts['feature'][$i];
												setup_postdata($post); ?>
												<li><a href="<?php the_permalink(); ?>" class="link-feature" rel="bookmark"><?php the_short_title(); ?></a></li>
											<?php endfor; ?>
										</ul>
									</div>
								</div>
								<br class="clear"/>
							</div>
						</div>
						<div class="section-link"><a href="<?php echo get_category_link_by_slug('feature'); ?>" class="link-feature">All Features</a></div>
					</div>
					
					<div class="section  section-snippet">
						<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_snippet.png'); ?>"/><a href="<?php echo get_category_link_by_slug('snippet'); ?>">//&nbsp;Snippets</a></h1></div>
						<div class="posts">
							<?php $post = $posts['snippet'][0]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('main'); ?>
							<?php $post = $posts['snippet'][1]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('left'); ?>
							<?php $post = $posts['snippet'][2]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('right'); ?>
						</div>
					</div>
					<div class="section-link"><a href="<?php echo get_category_link_by_slug('snippet'); ?>" class="link-snippet">All Snippets</a></div>
				</div>
				
				<div class="section  section-podcast">
					<div><h1 class="bleed-switch2"><img src="<?php echo resource('images/bleed_podcast.png'); ?>"/><a href="<?php echo get_category_link_by_slug('podcast'); ?>">//&nbsp;Communicate</a></h1></div>
					<div class="posts">
						<div class="articles left">
							<div id="twtr-widget"></div>
						</div>
					
						<?php $post = $posts['podcast'][0]; ?>
						<?php setup_postdata($post); ?>
						<?php get_extract('main'); ?>
						
						<div class="articles right">
							<div class="entry-header">
								<h3 class="entry-title">Keep In Touch</h3>
							</div>
							<div class="entry-content">
								<ul class="blank">
									<li><img src="<?php echo resource('images/icon.png');?>"/><a href="https://groups.google.com/group/the-gist" class="link-podcast"><span>Join us</span></a></li>
									<li><img src="<?php echo resource('images/rss.png');?>"/><a href="<?php bloginfo('rss2_url'); ?>" class="link-podcast"><span>Get the latest news</span></a></li>
									<li><img src="<?php echo resource('images/email.png');?>"/><a href="mailto:glasgowinsight@gmail.com" class="link-podcast"><span>Talk to us</span></a></li>
									<li><img src="<?php echo resource('images/twitter.png');?>"/><a href="http://twitter.com/GlasgowGist" class="link-podcast"><span>Follow us</span></a></li>
									<li><img src="<?php echo resource('images/facebook.jpg');?>"/><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238" class="link-podcast"><span>Like us</span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="section-link"><a href="<?php echo get_category_link_by_slug('podcast'); ?>" class="link-podcast">All Podcasts</a></div>
				</div>
				
				<div class="section  section-about">
					<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_about.png'); ?>"/><a href="<?php echo get_category_link_by_slug('about'); ?>">//&nbsp;Outside GIST</a></h1></div>
					<div class="posts">
						<div class="row">
							<div class="articles left">
								<div class="entry-header">
									<h3 class="entry-title">Events</h3>
								</div>
								<div class="entry-content">
									<ul>
										<?php foreach (array_slice($posts['event'], 0, $categories['event']) as $post):
											setup_postdata($post); ?>
											<li><a href="<?php the_permalink(); ?>" class="link-about" rel="bookmark"><?php the_short_title(); ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<div class="articles right">
								<div class="entry-header">
									<h3 class="entry-title">Around The Web</h3>
								</div>
								<div class="entry-content">
									<ul>
										<li><a href="http://www.bluesci.org/" class="link-about">Bluesci</a></li>
										<li><a href="http://www.eusci.org.uk/" class="link-about">EUSci</a></li>
										<li><a href="http://www.aumag.co.uk/" class="link-about">Au magazine</a></li>
									</ul>
								</div>
							</div>
							<br class="clear"/>
						</div>
						<div class="articles left">
							<div class="entry-header">
								<h3 class="entry-title">University News</h3>
							</div>
							<div class="entry-content">
								<?php echo rssinpage(array(
									'rssfeed'=>
										'http://www.gla.ac.uk/rss/news/index.xml,' .
										'http://feeds2.feedburner.com/uos/hp,' .
										'http://www.gcu.ac.uk/newsevents/feeds/feeds.php?s=fnunrn',
									'rssformat'=>'Y',
									'rssitems'=>5,
									'rsscss'=>'link-container-about'
								));	?>
							</div>
						</div>
						<div class="articles right">
							<div class="entry-header">
								<h3 class="entry-title">Participants Needed</h3>
							</div>
							<div class="entry-content">
								<ul>
									<?php foreach (array_slice($posts['study'], 0, $categories['study']) as $post):
										setup_postdata($post); ?>
										<li><a href="<?php the_permalink(); ?>" class="link-about" rel="bookmark"><?php the_short_title(); ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="section-link"><a href="<?php echo get_category_link_by_slug('about'); ?>" class="link-about">About The GIST</a></div>
				</div>
			</div>
			<br class="clear"/>
		</div>

<?php get_footer(); ?>