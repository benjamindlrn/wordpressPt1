<?php /* Template Name: Home */ ?>

<?php get_header(); ?>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>
		<div style="text-align: center;">
			<h2><strong>IT SERVICES YOU CAN TRUST<strong></h2><br>
		<img id="mexico" src="/wp-content/uploads/2017/10/it-services-300x124.png" alt="IMAGE!!!">
		<img id="mexico" src="/wp-content/uploads/2017/10/whycms2-300x211.png" alt="IMAGE!!!">
		<img id="mexico" src="/wp-content/uploads/2017/10/banner_sm_img-272x182.png" alt="IMAGE!!!"> <img id="mexico" src="/wp-content/uploads/2017/10/Desktop-Application-294x300.png" alt="IMAGE!!!">		
		</div>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>