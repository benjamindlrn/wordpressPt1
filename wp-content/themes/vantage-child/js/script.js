jQuery(document).ready(function( $ )
{		    
	//Fill the search input with all the titles of the posts
    $("[name=s]").autocomplete({
      source: jArray     
    });

});
