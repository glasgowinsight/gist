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
		$posts_per_page = array('latest'=>4, 'feature'=>3, 'snippet'=>3, 'podcast'=>1, 'event'=>-1, 'study'=>5);
		$extra_params = array(
                        'latest'=>array(
                            'category__not_in'=>array(
                                id_by_slug('event'), 
                                id_by_slug('study')
                            )
                        ),
			'event'=>array(
				'meta_query'=>array(array(
					'key'=>'end_date', 
					'value'=>date('Y-m-d'), 
					'compare'=>'>=', 
					'type'=>'DATE')
				), 
				'orderby'=>'meta_value', 
				'order'=>'ASC', 
                                'meta_key'=>'start_date',
                                'post__not_in'=>array()
			)
		);
		$posts = array();
		$post_ids = array();
		foreach (array_keys($posts_per_page) as $category) {
			$posts[$category] = array();
		}
		
		foreach (get_posts(array('meta_query'=>array(array('key'=>'homepage', 'value'=>'NONE', 'compare'=>'!=')))) as $post){
			foreach(get_post_meta($post->ID, 'homepage') as $homepage){
				$parts = explode('_', $homepage);
				if(count($parts)>1 && strtotime($parts[1])<time()){
					continue;
				}
				$position = intval($parts[0]) - 1;
				$post_ids[] = $post->ID;
				if($position >= 0){
					$posts['latest'][$position] = $post;
				}
			}
		}
		
		foreach (array_keys($posts_per_page) as $category) {
			$i = 0;
			
                        $num_posts = $posts_per_page[$category];
                        if($num_posts >= 0){
                            $num_posts -= count($posts[$category]);
                            if($num_posts <= 0) continue;
                        }

			$params = array(
				'posts_per_page'=>$num_posts,
				'post__not_in'=>$post_ids
			);
                        if ($category != 'latest') {
                            $params['category_name'] = $category;
                        }
			if (array_key_exists($category, $extra_params)) {
				$params = array_merge($params, $extra_params[$category]);
			}
			$cat_posts = get_posts($params);
			foreach ($cat_posts as $post){
				while(array_key_exists($i, $posts[$category])){
					$i++;
				}
				$posts[$category][$i] = $post;
				$post_ids[] = $post->ID;
				$i++;
			}
		}
	?>
		<div id="primary">
			<div id="content" role="main">
				<div id="sections">
					<div class="section section-latest">
						<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_latest.png'); ?>"/>//&nbsp;Latest</h1></div>
						<div class="posts">
							<div class="bigfatpost">
								<?php $post = $posts['latest'][0]; //main big post?>
								<?php setup_postdata($post); ?>
								<?php get_main_extract('big_main', 'large_thumb'); ?>
								<!--<div class="row">-->
									<?php /*$post = $posts['latest'][1]; */?>
									<?php /*setup_postdata($post);*/ ?>
									<?php /*get_extract('left', 'medium_thumb');*/ ?>
									<?php /*$post = $posts['latest'][2]; */?>
									<?php /*setup_postdata($post); */?>
									<?php /*get_extract('right', 'medium_thumb'); */?>
									<!--<br class="clear"/>-->
								<!--</div>-->
							</div>
							<div class="row">
								<?php $post = $posts['latest'][1]; ?>
								<?php setup_postdata($post); ?>
								<?php get_extract('main', 'medium_thumb'); ?>
								<?php $post = $posts['latest'][2]; ?>
								<?php setup_postdata($post); ?>
								<?php get_extract('left', 'medium_thumb'); ?>
								<?php $post = $posts['latest'][3]; ?>
								<?php setup_postdata($post); ?>
								<?php get_extract('right', 'medium_thumb'); ?>
								<br class="clear"/>
							</div>
						</div>
					</div>
					
					<div class="section  section-feature">
						<div><h1 class="bleed-left"><img src="<?php echo resource('images/bleed_feature.png'); ?>"/><a href="<?php echo get_category_link_by_slug('feature'); ?>">//&nbsp;Features</a></h1></div>
						<div class="posts">
							<?php $post = $posts['feature'][0]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('main'); ?>
							<?php $post = $posts['feature'][1]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('left'); ?>
							<?php $post = $posts['feature'][2]; ?>
							<?php setup_postdata($post); ?>
							<?php get_extract('right'); ?>
                                                     
						</div>
						<div class="section-link"><a href="<?php echo get_category_link_by_slug('feature'); ?>" class="link">All Features</a></div>
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
						<div class="section-link"><a href="<?php echo get_category_link_by_slug('snippet'); ?>" class="link">All Snippets</a></div>
					</div>
				</div>
				
				<div class="section  section-podcast">
					<div><h1 class="bleed-switch2"><img src="<?php echo resource('images/bleed_podcast.png'); ?>"/><a href="<?php echo get_category_link_by_slug('podcast'); ?>">//&nbsp;Communicate</a></h1></div>
					<div class="posts">
						<div class="articles main">
                                                    <a class="twitter-timeline" data-dnt=true href="https://twitter.com/GlasgowGist" data-widget-id="262183730460893184">Tweets by @GlasgowGist</a>
                                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
					
						<?php $post = $posts['podcast'][0]; ?>
						<?php setup_postdata($post); ?>
						<?php get_extract('left'); ?>
						
						<div class="articles right">
							<div class="entry-header">
								<h3 class="entry-title">Keep In Touch</h3>
							</div>
							<div class="entry-content">
								<ul class="blank">
									<li><img src="<?php echo resource('images/icon.png');?>"/><a href="https://groups.google.com/group/the-gist" class="link"><span>Join us</span></a></li>
									<li><img src="<?php echo resource('images/rss.png');?>"/><a href="<?php bloginfo('rss2_url'); ?>" class="link"><span>Get the latest news</span></a></li>
									<li><img src="<?php echo resource('images/email.png');?>"/><a href="mailto:editor@the-gist.org" class="link"><span>Talk to us</span></a></li>
									<li><img src="<?php echo resource('images/twitter.png');?>"/><a href="http://twitter.com/GlasgowGist" class="link"><span>Follow us</span></a></li>
									<li><img src="<?php echo resource('images/facebook.jpg');?>"/><a href="http://www.facebook.com/glasgow.gist" class="link"><span>Like us</span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="section-link"><a href="<?php echo get_category_link_by_slug('podcast'); ?>" class="link">All Podcasts</a></div>
				</div>
				
				
			</div>
			<br class="clear"/>
		</div>

<?php get_footer(); ?>
