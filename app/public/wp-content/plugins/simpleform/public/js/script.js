(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {
 
	   if ( $("#sform").find(".is-invalid").length ) {     
		  $("#sform").addClass("was-validated");
      }    

       $("#sform").submit(function(event) {
	     $(this).addClass("was-validated");
         var submit = true;
	      if( $(this).hasClass("needs-validation") && $('input[name="url"]').val() == '' && $('input[name="telephone"]').val() == '' ) { 
           if ($(this)[0].checkValidity() === false ) {
             submit = false;
             $(".form-control").each(function(){
	         if ($(this).is(":invalid") ) {
             $(this).addClass("is-invalid");
             $(this).next().children().addClass("d-block");
             $(this).parent().addClass("is-invalid");
             }
             })
             $('#sform-message span').addClass('visible');                
 	         if( $('#sform_privacy').prop('required') == true && $('#sform_privacy').prop("checked") == false ) { 
                $('#sform_privacy').addClass("is-invalid");
                $('label[for="sform_privacy"]').addClass('is-invalid');
             }  
	         if( $(this).hasClass("needs-focus") ) { 
                 $(this).find(":invalid").first().focus();
	         }
           }
           else {
             $("#sform").removeClass("needs-validation");
           }
         }
          if ( submit === false || $('input[name="url"]').val() != '' || $('input[name="telephone"]').val() != '' ) {
           event.preventDefault();
          }
       });
	
       $( "input,textarea" ).on("input", function()  {
         $(this).val($(this).val().replace(/\s\s+/g, " "));
         var field = $(this).attr('id');    	 
	     if ( $(this).is(":valid") ) {   
		    $(this).removeClass("is-invalid");
            $('label[for="' + $(this).attr('id') + '"]').removeClass("is-invalid");
            $(this).next().children().removeClass("d-block");
            $(this).parent().removeClass("is-invalid");
	        if ( ! $("#sform").find(".is-invalid").length && ! $("#sform").find(":invalid").length ) {     
		       $('.message').removeClass("visible");
       	    } 
            if ( $(this).prop('required') ) {
               $('label[for='+field+'] span').addClass("d-none"); 
            }
    	 }
    	 else {   
	       if ( $("#sform").hasClass("was-validated") ) {
		    $('label[for='+field+'] span').removeClass("d-none");
		    $(this).addClass("is-invalid");
            $('label[for="' + $(this).attr('id') + '"]').addClass("is-invalid");
            $(this).next().children().addClass("d-block");
            $(this).parent().addClass("is-invalid");
		    $('.message').addClass("visible");
            if ( $(this).prop('required') ) {
               $('label[for='+field+'] span').removeClass("d-none"); 
            }
           }
    	 }

       });

       $("#terms").on("click",function () {
  	     if( $('#sform_privacy').prop("checked") == false ) { $('#sform_privacy').val('false'); } 
         else { $('#sform_privacy').val('true'); }
       });  
       
       $("#sform_captcha").focus(function(){
       $(this).parent().addClass("focus");
       }).blur(function(){
       $(this).parent().removeClass("focus");
       })      
       
       $( "#sform_captcha" ).on('input', function(e)  {
		  if ( $(this).is(":valid") ) {
			$('label[for="sform_captcha"] span').addClass("d-none");
            $(this).removeClass("is-invalid");                      
	        $("#captcha-question-wrap").removeClass("is-invalid");  
            $("#captcha-error span").removeClass("d-block");
	      }
       });
 
       // Prevent zero to be entered as first value in captcha field
       $("#sform_captcha").on("keypress", function(e) {
	     if (e.which === 48 && !this.value.length)
	     e.preventDefault();
	   });  
	   
       // Prevent space to be entered as first value
       $("input, textarea").on("keypress", function(e) {
	     if (e.which === 32 && !this.value.length)
	     e.preventDefault();
	   });    
	     
   	 });

})( jQuery );