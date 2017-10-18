( function( $ ) {

	$(document).ready(function($){

		$("#home-page-widget-area .pt-testimonial-item-wrap").slick({
			dots: true,
		});
		
		$('#main-nav').meanmenu({
			meanScreenWidth: "1050",
		});

		// Go to top.
		var $scroll_obj = $( '#btn-scrollup' );
		
		$( window ).scroll(function(){
			if ( $( this ).scrollTop() > 100 ) {
				$scroll_obj.fadeIn();
			} else {
				$scroll_obj.fadeOut();
			}
		});

		$scroll_obj.click(function(){
			$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
			return false;
		});

	});

} )( jQuery );