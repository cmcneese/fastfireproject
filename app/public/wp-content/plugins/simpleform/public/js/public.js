(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

      $("#sform").on("submit", function (e) { 

          $('.form-control, #sform_privacy, #captcha-question-wrap').removeClass('is-invalid');
          $('#sform-message span').removeClass('visible');   
          $('.control-label').removeClass('is-invalid');
          var postdata = $('form#sform').serialize();
		  $.ajax({
            type: 'POST',
            dataType: 'json',
            url:ajax_sform_processing.ajaxurl, 
            data: postdata + '&action=formdata_ajax_processing',
            success: function(data){
	          var error = data['error'];
	          var message = data['message'];
	          var label = data['label'];
	          var field = data['field'];
	          var redirect = data['redirect'];
	          var redirect_url = data['redirect_url'];
              if( error === true ){
                $('#sform-message span').addClass('visible');                                                
                $('.message').html(data.message);
                $('#sform_' + field).addClass('is-invalid');
                $('label[for="sform_' + field + '"].control-label').addClass('is-invalid');              
                $('div#' + field + '-question-wrap').addClass('is-invalid');
                $('#' + field + '-error span').text(data.label);
              }
              if( error === false ){
                if( redirect === false ){
                  $("#sform").css("display","none");
                  $("#sform-introduction").css("display","none");
                  $("#sform-bottom").css("display","none");
                  $('#sform-confirmation').html(data.message);
                  $('#sform-confirmation').focus();
                }
                else {
	              document.location.href = redirect_url;
                  $('#sform-message span').removeClass('visible');                                                
                }
              }
            },
 			error: function(data){
              $('#sform-message span').addClass('visible');                                                
              $('.message').html('AJAX call failed');
	        } 	
		  });
		  e.preventDefault();
		  return false;
	   });
   
   	 });

})( jQuery );