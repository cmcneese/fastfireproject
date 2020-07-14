(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

      $("#sform").on("submit", function (e) { 

	   if( ! $(this).hasClass("needs-validation") && ! $(this).hasClass("block-validation") ) { 
	      $('.form-control, #sform_privacy, #captcha-question-wrap, .control-label').removeClass('is-invalid');
          $('#sform-message span').removeClass('visible');   
          var postdata = $('form#sform').serialize();
		  $.ajax({
            type: 'POST',
            dataType: 'json',
            url:ajax_sform_processing.ajaxurl, 
            data: postdata + '&action=formdata_ajax_processing',
            success: function(data){
	          var error = data['error'];
	          var notice = data['notice'];
	          var label = data['label'];
	          var field = data['field'];
	          var redirect = data['redirect'];
	          var redirect_url = data['redirect_url'];
              if( error === true ){
	            $.each(data, function(field, label) {
	            $('#sform_' + field).addClass('is-invalid');
                $('label[for="sform_' + field + '"].control-label').addClass('is-invalid');              
                $('div#' + field + '-question-wrap').addClass('is-invalid');
                $('#' + field + '-error span').text(label);
	            if( $('#sform').hasClass("needs-focus") ) { $('input.is-invalid, textarea.is-invalid').first().focus(); }
                });
	            $('#sform-message span').addClass('visible');                                                
                $('.message').html(data.notice);
              }
              if( error === false ){
                if( redirect === false ){
                  $("#sform, #sform-introduction, #sform-bottom").addClass('d-none');
                  $('#sform-confirmation').html(data.notice);
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
	   }	  
		  
	  });
   
   	 });

})( jQuery );