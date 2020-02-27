(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

       $("ul#submissions-data").hover(function () {
          $('#last-submission').addClass('hidden');
          $('#submissions-notice').removeClass('hidden');
          }, function () {
          $('#last-submission').removeClass('hidden');
          $('#submissions-notice').addClass('hidden');
       });
       
       $('.copy').click(function() {
         var tempInput = document.createElement('input');
         tempInput.style = "position: absolute; left: -1000px; top: -1000px";
         document.body.appendChild(tempInput);
         tempInput.value = $('#field1').text();
         tempInput.select();
         document.execCommand("copy");
         document.body.removeChild(tempInput);
         $('#shortcode-copy').val(ajax_sform_settings_options_object.copied);
         setTimeout(function(){ $('#shortcode-copy').val(ajax_sform_settings_options_object.copy); }, 30000); 
       });          

       $('#name_field').on('change', function () {
         var selectVal = $("#name_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trname').hide(); }
         else { $('.trname').show(); }
       });          

       $('#email_field').on('change', function () {
         var selectVal = $("#email_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.tremail').hide(); }
         else { $('.tremail').show(); }
       });          

       $('#subject_field').on('change', function () {
         var selectVal = $("#subject_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trsubject').hide(); }
         else { $('.trsubject').show(); }
       });          

       $('#captcha_field').on('change', function () {
         var selectVal = $("#captcha_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trcaptcha').hide(); }
         else { $('.trcaptcha').show(); }
       });          
       
       $( "#captcha_field" ).hover( function() { 
	     $('#description-captcha').css('visibility', 'visible');
	     }, function() { 
		 $('#description-captcha').css('visibility', 'hidden'); 
	   });             

       $('#terms_field').on('change', function () {
         var selectVal = $("#terms_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trterms').hide(); }
         else { $('.trterms').show(); }
       });          

       $("#terms_label").focus(function(){
         $('#description-terms').css('visibility', 'visible');	
       }); 

       $("#terms_label").blur(function(){
         $('#description-terms').css('visibility', 'hidden');	
       }); 
	
       $(".nav-tab").on("click", function() {
          var SettingsID = $(this).attr('id')
	      $( ".nav-tab-active" ).removeClass( "nav-tab-active" );
	      $( ".settings-tab" ).hide();  
          $( '#tab-' + SettingsID ).show();	   
	      $( this ).addClass( "nav-tab-active" );
	      $( ".message" ).css("visibility","hidden");  
       });

       $("#smtp-configuration").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.smtp').hide();
          } 
          else { 
          $('.smtp.heading').show(); 
          $('#trsmtpon').show(); 
           if($('#server_smtp').prop('checked') == true) { 
            $('.trsmtp').show(); 
            $('#thsmtp').css('padding','65px 41px 13px'); 
            $('#tdsmtp').css('padding','65px 10px 13px');  
            $('#smtp-notice').css('visibility', 'visible'); 
            if ($('#smtp_authentication').prop('checked') == true) { 
	         $('.trauthentication').show(); 
            } 
            else { $('.trauthentication').hide(); 
            } 
           } 
           else { 
            $('.trsmtp').hide(); 
            $('#thsmtp').css('padding','65px 41px 43px'); 
            $('#tdsmtp').css('padding','65px 10px 43px');  
            $('#smtp-notice').css('visibility', 'hidden'); 
           }
          } 
       });
       
       $('#form-template').on('change', function () {
         var selectVal = $("#form-template option:selected").val();
         if ( selectVal == 'basic' || selectVal == 'rounded' ) { 
	         $('.trbootstrap').show();
	         $('.trcustomized').hide(); 	          
	         $("#template-notice").text(ajax_sform_settings_options_object.bootstrap);
	     }
         else { 
	         $('.trbootstrap').hide(); 
	         if ( selectVal == 'customized' ) { 
		         $('.trcustomized').show(); 
		         $("#template-notice").text(ajax_sform_settings_options_object.customized);
		     }
             else { 
	             $('.trcustomized').hide(); 	          
                 $("#template-notice").html('&nbsp;');
	         }		         
         }
       });          
       
       $("#success-message").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').show(); 
         $('.trsuccessredirect').hide(); 
         } 
       });

       $("#success-redirect").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').hide(); 
         $('.trsuccessredirect').show(); 
         } 
       });

       $("#smpt-warnings").on("click", function() {
         $('.smpt-warnings').toggle(); 
         if( $('.smpt-warnings').is(':visible') ) { $(this).text(ajax_sform_settings_options_object.hide); $('.smpt-settings').hide(); } 
         else { $(this).text(ajax_sform_settings_options_object.show); $('#trsmtpon').show(); 
	       if( $('#server_smtp').prop('checked') == true ){ 
		       $('.trsmtp').show(); 
		       if( $('#smtp_authentication').prop('checked') == true ){ $('.trauthentication').show(); } 
		       else { $('.trauthentication').hide(); } 
		   } 
		   else { $('.trsmtp').hide(); } 
         }
       });

       $("#server_smtp").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsmtp').show(); 
         $('#thsmtp').css('padding','65px 41px 13px'); 
         $('#tdsmtp').css('padding','65px 10px 13px');  
         $('#smtp-notice').css('visibility', 'visible'); 
           if ($('#smtp_authentication').prop('checked') == true) { 
	       $('.trauthentication').show(); 
           } 
           else { $('.trauthentication').hide(); } 
         } 
         else { 
           $('.trsmtp').hide(); 
           $('#thsmtp').css('padding','65px 41px 43px'); 
           $('#tdsmtp').css('padding','65px 10px 43px');  
           $('#smtp-notice').css('visibility', 'hidden'); 
         }
       });

       $("#smtp_authentication").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.trauthentication').show(); 
          $('#tdauthentication').css('padding','35px 10px 13px'); 
          } 
          else { 
	      $('.trauthentication').hide(); 
          $('#thsmtp').css('padding','65px 41px 43px'); 
          $('#tdauthentication').css('padding','35px 10px 43px'); 
          }  
       });

       $("#notification").on("click", function() {
          if($(this).prop('checked') == true) { 
          $('.trnotification').show(); 
          $('#thnotification').css('padding','66px 41px 35px'); 
          $('#tdnotification').css('padding','66px 10px 35px'); 
            if ($('#custom-name').prop('checked') == true) { $('.trcustomname').show(); } 
            else { $('.trcustomname').hide(); } 
            if( $('#custom-subject').prop('checked') == true){ $('.trcustomsubject').show(); } 
            else { $('.trcustomsubject').hide(); } 
          } 
          else { 
          $('.trnotification').hide(); 
          $('#thnotification').css('padding','66px 41px 65px'); 
          $('#tdnotification').css('padding','66px 10px 65px'); 
          }
       });

       $("#requester-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').hide(); } 
       });
       
       $("#form-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').hide(); } 
       });
       
       $("#custom-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').show(); } 
       });

       $("#request-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').hide(); } 
       });
       
       $("#custom-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').show(); } 
       });

       $("#confirmation_email").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trconfirmation').show(); 
         $('#thconfirmation').css('padding','66px 41px 35px'); 
         $('#tdconfirmation').css('padding','66px 10px 35px'); 
         } 
         else { 
	     $('.trconfirmation').hide(); 
	     $('#thconfirmation').css('padding','66px 41px 65px'); 
	     $('#tdconfirmation').css('padding','66px 10px 65px');
         }
       });
       
	   $('#save_sform_options').click(function(e){
		  $('.message').css('visibility', 'visible');
	      $('.message').css('color', '#909090');
	      $('.message').css('background', '#F2F2F2');
          $('.message').html(ajax_sform_settings_options_object.loading);
          $('#form-errors').html('');
          var formData = $('form#settings').serialize();
		  $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_sform_settings_options_object.ajaxurl,
            data: formData + '&action=sform_edit_options', 
            success: function(data){
	          var error = data['error'];
	          var message = data['message'];
	          var update = data['update'];
	          $('.message').css('visibility', 'visible');
	          if( error === true ){
	            $('.message').css('color', '#FFF');
	            $('.message').css('background', '#F6866F');
                $('.message').html(data.message);
              }
	          if( error === false ){
	            $('.message').css('color', '#FFF');
                $('.message').html(data.message);
	            if( update === false ){ $('.message').css('background', '#F8CD5E'); }
	            if( update === true ){ $('.message').css('background', '#9BCC79'); }
              }
            },
 			error: function(data){
	          $('.message').css('visibility', 'visible');
              $('.message').html('AJAX call failed');
	        } 	
		  });	
		  e.preventDefault(); 
		  return false;
	   });


       $(document).on('change', 'input[type=checkbox], input[type=radio], select', function() {
	     $('.message').css('visibility', 'hidden');
       });

       $(document).on('input', 'input[type=text], input[type=email], textarea', function() {
	     $('.message').css('visibility', 'hidden');
       });

       $('#sform-edit-form').click(function(e){
		  $('.message').css('visibility', 'visible');
	      $('.message').css('color', '#909090');
	      $('.message').css('background', '#F2F2F2');
          $('.message').text(ajax_sform_settings_options_object.saving);
          var formData = $('form#sform-attributes').serialize();
		  $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_sform_settings_options_object.ajaxurl,
            data: formData + '&action=shortcode_costruction', 
            success: function(data){
	          var error = data['error'];
	          var message = data['message'];
	          var update = data['update'];
	          $('.message').css('visibility', 'visible');
	          if( error === true ){
	            $('.message').css('color', '#FFF');
	            $('.message').css('background', '#F6866F');
                $('.message').html(data.message);
              }
	          if( error === false ){
                $('#form-errors').html('');
	            $('.message').css('color', '#FFF');
                $('.message').html(data.message);
	            if( update === false ){
	              $('.message').css('background', '#F8CD5E');  
                }
	            if( update === true ){
	              $('.message').css('background', '#9BCC79');
                }
              }
            },
 			error: function(data){
	          $('.message').css('visibility', 'visible');
              $('.message').html('AJAX call failed');
	        } 	
		  });
		  e.preventDefault();
		  return false;
	   });
   
   	 });

})( jQuery );