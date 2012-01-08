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
				<section class="feature">
					<header><h2 class="cap-right">// Features</h2></header>
					<?php query_posts('category_name=feature&posts_per_page=10'); ?>
					<?php $i=0; ?>
					<?php while ( $i<4 && have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h3 class="entry-title"><?php the_title(); ?></h3>
							</header>
							<div class="entry-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'medium_thumb' ); ?>
								</a>
							</div>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
						</article>
						<?php $i++; ?>
					<?php endwhile; ?>
					<nav class="articles">
						<header class="entry-header">
							<h3 class="entry-title">More Features</h3>
						</header>
						<div class="entry-content">
							<ul>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</nav>
				</section>
				
				<section class="snippet">
					<header><h2 class="cap-right">// Snippets</h2></header>
					<?php query_posts('category_name=snippet&posts_per_page=3'); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h3 class="entry-title"><?php the_title(); ?></h3>
							</header>
							<div class="entry-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'medium_thumb' ); ?>
								</a>
							</div>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; ?>
				</section>
				
				<section class="podcast">
					<header><h2 class="cap-right">// Communication</h2></header>
					<?php query_posts('category_name=podcast&posts_per_page=1'); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h3 class="entry-title"><?php the_title(); ?></h3>
							</header>
							<div class="entry-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'medium_thumb' ); ?>
								</a>
							</div>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; ?>
				
	                <nav class="articles">
                        <header class="entry-header">
							<h3 class="entry-title">Keep In Touch</h3>
						</header>
						<div class="entry-content">
							<ul class="blank">
								<li><a href="https://groups.google.com/group/the-gist"><img src="<?php echo resource('images/icon.png');?>"/><span>Join us</span></a></li>
								<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo resource('images/rss.png');?>"/><span>Get the latest news</span></a></li>
								<li><a href="mailto:glasgowinsight@gmail.com"><img src="<?php echo resource('images/email.png');?>"/><span>Talk to us</span></a></li>
								<li><a href="http://twitter.com/GlasgowGist"><img src="<?php echo resource('images/twitter.png');?>"/><span>Follow us</span></a></li>
								<li><a href="http://www.facebook.com/pages/The-GIST-Glasgow-Insight-into-Science-and-Technology/185836941455238"><img src="<?php echo resource('images/facebook.jpg');?>"/><span>Like us</span></a></li>
							</ul>
						</div>
                    </nav>
                    
                    <div id="twtr-widget"></div>
                </section>
				
				<section class="about">
					<header><h2 class="cap-right">// Outside GIST</h2></header>
					<nav class="articles">
						<header class="entry-header">
							<h3 class="entry-title">Events</h3>
						</header>
						<div class="entry-content">
							<ul>
								<?php query_posts('category_name=event'); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</nav>
					<nav class="articles">
                        <header class="entry-header">
							<h3 class="entry-title">Around The Web</h3>
						</header>
						<div class="entry-content">
							<ul>
								<li><a href="http://www.bluesci.org/">Bluesci</a></li>
								<li><a href="http://www.eusci.org.uk/">EUSci</a></li>
								<li><a href="http://www.aumag.co.uk/">Au magazine</a></li>
							</ul>
						</div>
                    </nav>
                    <nav class="articles">
                        <header class="entry-header">
							<h3 class="entry-title">University News</h3>
						</header>
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
                    </nav>
                    <nav class="articles">
						<header class="entry-header">
							<h3 class="entry-title">Participants Needed</h3>
						</header>
						<div class="entry-content">
							<ul>
								<?php query_posts('category_name=study'); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</nav>
				</section>
			</div>
		</div>

<?php get_footer(); ?>