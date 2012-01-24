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
					<div><h2 class="cap-right">// Features</h2></div>
					<?php query_posts('category_name=feature&posts_per_page=10'); ?>
					<?php $i=0; ?>
					<?php while ( $i<4 && have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'extract' ); ?>
						<?php $i++; ?>
					<?php endwhile; ?>
					<div class="articles">
						<div class="entry-header">
							<h3 class="entry-title">More Features</h3>
						</div>
						<div class="entry-content">
							<ul>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="section  section-snippet">
					<div><h2 class="cap-right">// Snippets</h2></div>
					<?php query_posts('category_name=snippet&posts_per_page=3'); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'extract' ); ?>
					<?php endwhile; ?>
				</div>
				
				<div class="section  section-podcast">
					<div><h2 class="cap-right">// Communication</h2></div>
					<?php query_posts('category_name=podcast&posts_per_page=1'); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'extract' ); ?>
					<?php endwhile; ?>
				
	                <div class="articles">
                        <div class="entry-header">
							<h3 class="entry-title">Keep In Touch</h3>
						</div>
						<div class="entry-content">
							<ul class="blank">
								<li><a href="https://groups.google.com/group/the-gist"><img src="<?php echo resource('images/icon.png');?>"/><span>Join us</span></a></li>
								<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo resource('images/rss.png');?>"/><span>Get the latest news</span></a></li>
								<li><a href="mailto:glasgowinsight@gmail.com"><img src="<?php echo resource('images/email.png');?>"/><span>Talk to us</span></a></li>
								<li><a href="http://twitter.com/GlasgowGist"><img src="<?php echo resource('images/twitter.png');?>"/><span>Follow us</span></a></li>
								<li><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238"><img src="<?php echo resource('images/facebook.jpg');?>"/><span>Like us</span></a></li>
							</ul>
						</div>
                    </div>
                    
                    <div class="articles">
                    	<div id="twtr-widget"></div>
                    </div>
                </div>
				
				<div class="section  section-about">
					<div><h2 class="cap-right">// Outside GIST</h2></div>
					<div class="articles">
						<div class="entry-header">
							<h3 class="entry-title">Events</h3>
						</div>
						<div class="entry-content">
							<ul>
								<?php query_posts('category_name=event'); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
					<div class="articles">
                        <div class="entry-header">
							<h3 class="entry-title">Around The Web</h3>
						</div>
						<div class="entry-content">
							<ul>
								<li><a href="http://www.bluesci.org/">Bluesci</a></li>
								<li><a href="http://www.eusci.org.uk/">EUSci</a></li>
								<li><a href="http://www.aumag.co.uk/">Au magazine</a></li>
							</ul>
						</div>
                    </div>
                    <div class="articles">
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
								'rssitems'=>5
							));	?>
						</div>
                    </div>
                    <div class="articles">
						<div class="entry-header">
							<h3 class="entry-title">Participants Needed</h3>
						</div>
						<div class="entry-content">
							<ul>
								<?php query_posts('category_name=study'); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>