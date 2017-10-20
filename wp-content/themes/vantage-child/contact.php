<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">


		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>
		<div class="g-recaptcha" data-sitekey="6LcwSTUUAAAAABAtwsQ1hThvwBLml7xSd9TQBTna"></div>
				<img id="mexico" src="/wp-content/uploads/2017/10/9535320-1080x380.png" alt="IMAGE!!!">

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>get_option('simple_list_data')