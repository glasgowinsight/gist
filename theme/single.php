<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<?php if ( have_posts() ): the_post();?>
		<?php global $post; ?>
		<?php $main_post = get_post(get_the_ID()); ?>
		<?php $post = $main_post; setup_postdata($post); ?>
		<?php $bleed = get_bleed(); ?>
		<?php $post_ids = array(get_the_ID()); ?>
		<div id="primary">
			<div id="content" role="main">
				<div id="container">
					<?php $rel = $related->show(get_the_ID(), true); ?>
					<?php if ( $rel ): ?>
							<div id="related">
								<h2 class="bleed-switch"><?php/* echo $bleed; */?>Related Articles</h2>  
								<?php foreach ($rel as $post) : ?>
									<?php $post_ids[] = $post->ID; ?>
									<?php setup_postdata($post); ?>
									<?php get_extract(); ?>
								<?php endforeach; ?>
							</div>
					<?php endif; ?>
	
					<div id="article">
						<?php $post = $main_post; setup_postdata($post); ?>
						<?php get_template_part( 'content', 'single' ); ?>
						
						<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : ?>
						<div id="author-info">
							<h2 class="bleed-left"><?php echo $bleed; ?>Author</h2>
							<div id="author-avatar">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php userphoto_the_author_thumbnail() ?>
								</a>
							</div>
							<div id="author-description">
								// <?php the_author_meta( 'description' ); ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="licence">
							<?php 
								$licence=get_licence($post);
								if( $licence != NULL ): ?>
									<p>
										<a rel="license" href="<?php echo $licence['url']; ?>"><img alt="Creative Commons License" src="<?php echo $licence['image']; ?>" /></a>
										<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/Text" property="dct:title" rel="dct:type"><?php the_title(); ?></span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName"><?php the_author(); ?></span> is licensed under a <a rel="license" href="<?php echo $licence['url']; ?>" class="link"><?php echo $licence['licence']; ?></a>.
									</p>
								<?php endif; 
							?>
						</div>
                                                <?php 
                                                    function show_notes($meta, $title, $class){
                                                        global $bleed;
                                                        $notes = get_post_meta(get_the_ID(), $meta, True);
                                                        if ($notes ){
                                                                echo '<h2 class="' . $class . '">' . $bleed . $title . '</h2>';
                                                                echo '<ul class="link-container notes-' . $meta . '">';
                                                                echo do_shortcode($notes);
                                                                echo '</ul>';
                                                        }
                                                    }
                                                ?>
						<?php if(!in_category('feature')):?>
							<div class="short-references">
                                                            <?php show_notes('external_link', 'Links', 'bleed-left'); ?>
                                                            <?php show_notes('notes', 'Notes', 'bleed-left'); ?>
                                                            <?php show_notes('corrections', 'Corrections', 'bleed-left'); ?>
                                                            <?php show_notes('references', 'References', 'bleed-left'); ?>
							</div>
						<?php endif; ?>
					</div>

					<div id="sidebar">
						<?php if(in_category('feature')):?>
                                                    <div class="references">
                                                        <?php show_notes('external_link', 'Links', 'bleed-switch'); ?>
                                                        <?php show_notes('notes', 'Notes', 'bleed-switch'); ?>
                                                        <?php show_notes('corrections', 'Corrections', 'bleed-switch'); ?>
                                                        <?php show_notes('references', 'References', 'bleed-switch'); ?>
                                                    </div>
						<?php endif; ?>
						
						<?php query_posts(array(
							'category_name'=>'feature,snippet',
							'posts_per_page'=>7,
							'post__not_in'=>$post_ids)); ?>
						<?php if ( have_posts() ) : ?>
							<div id="latest">
								<h2 class="bleed-switch"><?php /*echo $bleed;*/ ?>Latest Articles</h2>  
								<?php get_archive_posts(3); ?>
							</div>
						<?php endif; ?>
					</div>
					<br style="clear:both"/>
				</div>
				
				<?php if ( have_posts() ) : ?>
					<div id="other">
						<h2 class="bleed-left"><?php echo $bleed; ?>Other Articles</h2>  
						<?php get_archive_posts(); ?>
					</div>
				<?php endif; ?>
				
				<?php $post = $main_post; setup_postdata($post); ?>
				<?php $withcomments = 1; ?>
				<?php comments_template( '', true ); ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php endif; ?>
<?php get_footer(); ?>
