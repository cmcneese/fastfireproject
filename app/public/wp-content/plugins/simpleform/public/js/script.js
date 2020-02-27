(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

       $( "input,textarea" ).not( "#sform_email, #sform_privacy, #sform_captcha" ).on('input', function()  {
         $(this).val($(this).val().replace(/\s\s+/g, " "));
         if ( $(this).prop('required') ) {
         var field = $(this).attr('id');
           if ( $(this).val() != '') {         
	           $('label[for='+field+'] span').addClass("d-none");
           }
           else {
	           $('label[for='+field+'] span').removeClass("d-none");
           }
         }
       });
       
       $( "#sform_email" ).on('input', function()  {
         $(this).val($(this).val().replace(/\s\s+/g, " "));
         if ( $(this).prop('required') ) {
         const regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
           if ( $(this).val() != '' && regex.test($(this).val()) ) {
	           $('label[for="sform_email"] span').addClass("d-none");
           }
           else{
	           $('label[for="sform_email"] span').removeClass("d-none");
           }
         }
       });

       $("input, textarea").on("keypress", function(e) {
	     if (e.which === 32 && !this.value.length)
	     e.preventDefault();
	   });    

       $( "input,textarea" ).on("input", function()  {
         $(this).removeClass("is-invalid");     
         $('label[for="' + $(this).attr('id') + '"]').removeClass("is-invalid");
		 $('.message').removeClass("visible");
       });

       $("#terms").on("click",function () {
  	     if( $('input[name="sform_privacy"]').prop("checked") == false ) { 
      	   $('input[name="sform_privacy"]').val('false');
      	   $('.control-label span').removeClass("d-none");
         } 
         else {
     	   $('input[name="sform_privacy"]').val('true');
      	   $('.control-label span').addClass("d-none");
      	 }
       });  
       
       $("#sform_captcha").focus(function(){
       $(this).parent().addClass("focus");
       }).blur(function(){
       $(this).parent().removeClass("focus");
       })      
       
       $("#sform_captcha").on("keypress", function(e) {
	     if (e.which === 48 && !this.value.length)
	     e.preventDefault();
	   });    

       $( "#sform_captcha" ).on('input', function(e)  {
		  var value = parseInt($(this).val());
		  var question = parseInt($("#captcha_one").val()) + parseInt($("#captcha_two").val());
		  if( value == question ) { 
			$('label[for="sform_captcha"] span').addClass("d-none");
            $(this).removeClass("is-invalid");                      
	        $("#captcha-question-wrap").removeClass("is-invalid");  
            $("#captcha-error span").removeClass("d-block");
	      }
		  else { 
			$('label[for="sform_captcha"] span').removeClass("d-none");
			if( $("form").hasClass("was-validated") ) { 
	        $("#captcha-question-wrap").addClass("is-invalid");  
            $("#captcha-error span").addClass("d-block");
			}
		  }          
       });
 
   	 });

})( jQuery );