<?php /* Template Name: Custom Page 2 */ ?>
<?php get_header(); ?>
<div id="primary" class="content-area">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<div id="content" class="site-content" role="main">		
		<?php
		query_posts(array(
		    'category_name' => 'about-us', // get posts by category name
		    'posts_per_page' => -1 // all posts
		));
		?>
		<?php while(have_posts()): the_post(); ?>
    	<h1 style="font-size: 28px;"><b><?php the_title();?></b></h1><br>
    	<label>Post by </label><?php the_author(); ?>, <?php the_date(); ?>
    	<?php the_content(); ?>
		<?php endwhile; ?>

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('custom_sidebar') ) : ?>
		<?php endif; ?>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
<?php get_footer(); ?>