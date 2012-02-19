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

		<div id="primary">
			<div id="content" role="main">
				<div class="section section-feature">
					<div><h1 class="cap-right bleed-left">//&nbsp;Features</h1></div>
					<div class="posts">
						<?php query_posts('category_name=feature&posts_per_page=10'); ?>
						<div class="row3">
							<?php the_post(); ?>
							<?php get_extract('main', 'large_thumb'); ?>
							<div class="row">
								<?php the_post(); ?>
								<?php get_extract('left', 'medium_thumb'); ?>
								<?php the_post(); ?>
								<?php get_extract('right', 'medium_thumb'); ?>
								<br class="clear"/>
							</div>
						</div>
						<div class="row">
							<?php the_post(); ?>
							<?php get_extract('left', 'medium_thumb'); ?>
							<div class="articles right">
								<div class="entry-header">
									<h3 class="entry-title">More Features</h3>
								</div>
								<div class="entry-content">
									<ul>
										<?php while ( have_posts() ) : the_post(); ?>
											<li><a href="<?php the_permalink(); ?>" class="link-feature" rel="bookmark"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
									</ul>
								</div>
							</div>
							<br class="clear"/>
						</div>
					</div>
				</div>
				
				<div class="section  section-snippet">
					<div><h1 class="cap-right bleed-left">//&nbsp;Snippets</h1></div>
					<div class="posts">
						<?php query_posts('category_name=snippet&posts_per_page=3'); ?>
						<?php the_post(); ?>
						<?php get_extract('main'); ?>
						<?php the_post(); ?>
						<?php get_extract('left'); ?>
						<?php the_post(); ?>
						<?php get_extract('right'); ?>
					</div>
				</div>
				
				<div class="section  section-podcast">
					<div><h1 class="cap-right bleed-left">//&nbsp;Communication</h1></div>
					<div class="posts">
						<?php query_posts('category_name=podcast&posts_per_page=1'); ?>
						<?php the_post(); ?>
						<?php get_extract('main'); ?>
						
		                <div class="articles left">
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
	                    
	                    <div class="articles right">
	                    	<div id="twtr-widget"></div>
	                    </div>
                    </div>
                </div>
				
				<div class="section  section-about">
					<div><h1 class="cap-right bleed-left">//&nbsp;Outside GIST</h1></div>
					<div class="posts">
						<div class="row">
							<div class="articles left">
								<div class="entry-header">
									<h3 class="entry-title">Events</h3>
								</div>
								<div class="entry-content">
									<ul>
										<?php query_posts('category_name=event'); ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<li><a href="<?php the_permalink(); ?>" class="link-about" rel="bookmark"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
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
									<?php query_posts('category_name=study'); ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<li><a href="<?php the_permalink(); ?>" class="link-about" rel="bookmark"><?php the_title(); ?></a></li>
									<?php endwhile; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br class="clear"/>
		</div>

<?php get_footer(); ?>