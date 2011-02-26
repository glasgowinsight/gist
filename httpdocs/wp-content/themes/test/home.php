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
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

			<div class="slider noscript">
			    <div class="left-button" rel="1"></div>
			    <div class="right-button" rel="1"></div>
			    <div class="simpleSlide-window" rel="1">
			    	<div class="simpleSlide-tray auto-slider" rel="1">
			
					<?php query_posts( 'category_name=january-2011' )?>
					<?php while (have_posts()) : the_post(); ?>
			            <div id="slide-<?php the_ID(); ?>" class="simpleSlide-slide" rel="1">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
							<?php the_post_thumbnail(); ?>
				            <div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						</div><!-- #post-## -->
					<?php endwhile; ?>				
					<?php rewind_posts(); ?>
			        </div>
			    </div>
			    <div class="simpleSlide-thumbnails">
				    <?php $i=1 ?>
					<?php while (have_posts()) : the_post(); ?>
			            <span class="jump-to" rel="1" alt="<?php echo($i)?>"><?php the_post_thumbnail(array(32,32)); ?></span>
				    	<?php $i++ ?>
				    <?php endwhile; ?>				
					<?php rewind_posts(); ?>
				</div>
			</div> 
			<?php $posts=get_posts( array('category_name'=>'january-2011', 'order_by'=>'rand', 'number_posts'=>2) ); ?>
				<noscript>	
					<div class="row">	
						<?php foreach ($posts as $post): ?>
							<div id="post-<?php $post->the_ID(); ?>" <?php $post->post_class(); ?>>
								<h2 class="entry-title"><a href="<?php $post->the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), $post->the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $post->the_title(); ?></a></h2>
					
								<?php $post->the_post_thumbnail(); ?>
					            <div class="entry-summary">
									<?php $post->the_excerpt(); ?>
								</div><!-- .entry-summary -->
							</div>
						<?php endforeach;?>
					</div>
				</noscript>
			<?php
				$posts=get_posts( array('category_name'=>'snippet', 'number_posts'=>1) );
				if ( !$posts ):
					$posts = get_posts( array('category_name'=>'january-2011', 'order_by'=>'rand', 'number_posts'=>1, 'post__not_in'=>array_map(the_ID, $posts)) );
				endif;
				array_splice($posts,0,0,get_posts(array('category_name'=>'event', 'number_posts'=>1)));
				array_splice($posts,0,0,get_posts(array('category_name'=>'podcast', 'number_posts'=>1)));
				if ( count($posts) < 4) :
					$posts=get_posts( array('category_name'=>'snippet', 'number_posts'=>4-count($posts), 'post__not_in'=>array_map(the_ID, $posts)) );
					if ( count($posts) < 4) :
						$posts=get_posts( array('category_name'=>'january-2011', 'number_posts'=>4-count($posts), 'post__not_in'=>array_map(the_ID, $posts)) );
					endif;
				endif;
			    $i=0;
			?>
			<?php foreach ($posts as $post): ?>
				<?php if ( $i % 2 == 0): ?><div class="row"><?php endif;?>
					<div id="post-<?php $post->the_ID(); ?>" <?php $post->post_class(); ?>>
						<h2 class="entry-title"><a href="<?php $post->the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), $post->the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $post->the_title(); ?></a></h2>
			
						<?php $post->the_post_thumbnail(); ?>
			            <div class="entry-summary">
							<?php $post->the_excerpt(); ?>
						</div><!-- .entry-summary -->
					</div><!-- #post-## -->
				<?php if ( $i % 2 == 1): ?></div><?php endif;?>
				<?php $i++ ?>
			<?php endforeach; // End the loop. Whew. ?>
			<?php if ( $i % 2 == 1): ?></div><?php endif;?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
