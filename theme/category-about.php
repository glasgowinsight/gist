<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( '%s Articles' , 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' )
				?></h1> 
				<div class="archive-meta">
					Glasgow Insight into Science and Technology report on science and 
					technology news, both in Glasgow and the wider world. We’re still 
					young but currently we produce this website, and plan to start 
					broadcasting podcasts and running events in the near future, with 
					a magazine on the way. We consist mainly of students from the 
					Universities of Glasgow and Strathclyde, but we’re open to anyone, 
					and looking for as many people to get involved as possible. Any 
					level of participation is welcome, so whether you want to help shape 
					the whole future of the group, get involved in writing, editing, 
					design, broadcasting, events or just have a single story you think 
					we should cover, please get in touch.
				</div>

				<?php get_template_part( 'loop', 'category' ); ?>
			</div>
		</div><!-- #container -->
<?php get_sidebar('category'); ?>

<?php get_footer(); ?>
