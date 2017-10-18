<?php /* Template Name: Custom Page 1 */ ?>

<?php get_header(); ?>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="primary" class="content-area">
<?php
if(function_exists('hello_world')) {
hello_world();
}
?>
	<div id="dom-target" style="display: none">		
		<?php  
		//Retrieves all the posts into an array
			query_posts(array(		    
		    'posts_per_page' => -1 
		));
	        while(have_posts()): the_post();
	        	$titles[] .= get_the_title();
	        endwhile;        
	    ?>
	<script type="text/javascript">
		//Pass the php array to a javascript array
    	var jArray =<?php echo json_encode($titles); ?>;
    </script>
	</div>
	<div id="content" class="site-content" role="main">
		<?php
		query_posts(array(
		    'category_name' => 'team-info', 
		    'posts_per_page' => -1 
		));
		?>
		<?php while(have_posts()): the_post(); ?>
    	<h1 style="font-size: 28px;"><b><?php the_title();?></b></h1><br>
    	<label>Post by </label><?php the_author(); ?>, <?php the_date(); ?>
    	<?php the_content(); ?>
		<?php endwhile; ?>

	</div><!-- #content .site-content -->	
</div><!-- #primary .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>