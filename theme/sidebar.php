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
					?><div id="events"><ul><?php 
					while (have_posts()){
						the_post(); 
		            	?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php 
					}
					?></ul></div><?php 
				}
			?>
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

		</div><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>


</div> <!-- #sidebar -->
