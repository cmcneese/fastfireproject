(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

	   $("#data-storing").on("click", function() {
         if($(this).prop('checked') == true) { 
            $('#thstoring').css('padding','65px 41px 13px'); 
            $('#tdstoring').css('padding','65px 10px 13px');  
	        $('.trstoring').removeClass('unseen'); 
			$('#storing-description').html(sform_submissions_object.disable); 
	     } 
	     else { $('.trstoring').addClass('unseen'); 
            $('#thstoring').css('padding','65px 41px 43px'); 
            $('#tdstoring').css('padding','65px 10px 43px');  
		    $('#storing-description').html(sform_submissions_object.enable); 
		 }
       });
       
   
   	 });

})( jQuery );