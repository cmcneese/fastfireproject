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

       $('#firstname_field').on('change', function () {
         var selectVal = $("#firstname_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trname').addClass('hidden'); }
         else { $('.trname').removeClass('hidden'); 
	        if($('#namelabel').prop('checked') == true) { 
            $('tr.namelabel').addClass('hidden'); 
            } else { 
	        $('tr.namelabel').removeClass('hidden'); 
            }
	     }
       });          

       $('#lastname_field').on('change', function () {
         var selectVal = $("#lastname_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trlastname').addClass('hidden'); }
         else { $('.trlastname').removeClass('hidden');
	        if($('#lastnamelabel').prop('checked') == true) { 
            $('tr.lastnamelabel').addClass('hidden'); 
            } else { 
	        $('tr.lastnamelabel').removeClass('hidden'); 
            }
	     }
       });          

       $('#email_field').on('change', function () {
         var selectVal = $("#email_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.tremail').addClass('hidden'); }
         else { $('.tremail').removeClass('hidden'); 
	        if($('#emaillabel').prop('checked') == true) { 
            $('tr.emaillabel').addClass('hidden'); 
            } else { 
	        $('tr.emaillabel').removeClass('hidden'); 
            }
         }
       });          

       $('#phone_field').on('change', function () {
         var selectVal = $("#phone_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trphone').addClass('hidden'); }
         else { $('.trphone').removeClass('hidden'); 
	        if($('#phonelabel').prop('checked') == true) { 
            $('tr.phonelabel').addClass('hidden'); 
            } else { 
	        $('tr.phonelabel').removeClass('hidden'); 
            }
	     }
       });          

       $('#subject_field').on('change', function () {
         var selectVal = $("#subject_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trsubject').addClass('hidden'); }
         else { $('.trsubject').removeClass('hidden'); 
	        if($('#subjectlabel').prop('checked') == true) { 
            $('tr.subjectlabel').addClass('hidden'); 
            } else { 
	        $('tr.subjectlabel').removeClass('hidden'); 
            }
         }
       });          

       $('#captcha_field').on('change', function () {
         var selectVal = $("#captcha_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trcaptcha').addClass('hidden'); }
         else { $('.trcaptcha').removeClass('hidden'); }
       });          
       
       $( "#captcha_field" ).hover( function() { 
	     $('#description-captcha').css('visibility', 'visible');
	     }, function() { 
		 $('#description-captcha').css('visibility', 'hidden'); 
	   });             

       $('#terms_field').on('change', function () {
         var selectVal = $("#terms_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trterms').addClass('hidden'); }
         else { $('.trterms').removeClass('hidden'); }
       });          

       $("#terms_label").focus(function(){
         $('#description-terms').css('visibility', 'visible');	
       }); 

       $("#terms_label").blur(function(){
         $('#description-terms').css('visibility', 'hidden');	
       }); 
       
       $(".field-label").on("click", function() {
         var labelID = $(this).attr('id')
         if($(this).prop('checked') == true) { 
         $('tr.'+labelID).addClass('hidden'); 
         } 
         else { 
	     $('tr.'+labelID).removeClass('hidden'); 
         }
       });
       
       $(".nav-tab").on("click", function() {
          var SettingsID = $(this).attr('id')
	      $( ".nav-tab-active" ).removeClass( "nav-tab-active" );
	      $( ".settings-tab" ).addClass('hidden');  
          $( '#tab-' + SettingsID ).removeClass('hidden');	   
	      $( this ).addClass( "nav-tab-active" );
	      $( ".message" ).css("visibility","hidden");  
       });

       $("#smtp-configuration").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.smtp').addClass('hidden');
          } 
          else { 
          $('.smtp.heading').removeClass('hidden'); 
          $("#smpt-warnings").text(ajax_sform_settings_options_object.show);
          $('#trsmtpon').removeClass('hidden'); 
           if($('#server_smtp').prop('checked') == true) { 
            $('.trsmtp').removeClass('hidden'); 
            $('#thsmtp').css('padding','65px 41px 13px'); 
            $('#tdsmtp').css('padding','65px 10px 13px');  
            $('#smtp-notice').css('visibility', 'visible'); 
            if ($('#smtp_authentication').prop('checked') == true) { 
	         $('.trauthentication').removeClass('hidden'); 
            } 
            else { $('.trauthentication').addClass('hidden'); 
            } 
           } 
           else { 
            $('.trsmtp').addClass('hidden'); 
            $('#thsmtp').css('padding','65px 41px 43px'); 
            $('#tdsmtp').css('padding','65px 10px 43px');  
            $('#smtp-notice').css('visibility', 'hidden'); 
           }
          } 
       });
       
       $('#form-template').on('change', function () {
         var selectVal = $("#form-template option:selected").val();
         if ( selectVal == 'basic' || selectVal == 'rounded' ) { 
	         $('.trbootstrap').removeClass('hidden');
	         $('.trcustomized').addClass('hidden'); 	          
	         $("#template-notice").text(ajax_sform_settings_options_object.bootstrap);
	     }
         else { 
	         $('.trbootstrap').addClass('hidden'); 
	         if ( selectVal == 'customized' ) { 
		         $('.trcustomized').removeClass('hidden'); 
		         $("#template-notice").text(ajax_sform_settings_options_object.customized);
		     }
             else { 
	             $('.trcustomized').addClass('hidden'); 	          
                 $("#template-notice").html('&nbsp;');
	         }		         
         }
       });          
       
       $("#success-message").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').removeClass('hidden'); 
         $('.trsuccessredirect').addClass('hidden'); 
         } 
       });

       $("#success-redirect").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').addClass('hidden'); 
         $('.trsuccessredirect').removeClass('hidden'); 
         } 
       });


       $("#smpt-warnings").on("click", function() {
         if( $('.smpt-warnings').hasClass('hidden') ) { $(this).text(ajax_sform_settings_options_object.hide); $('.smpt-settings').addClass('hidden'); $('.smpt-warnings').removeClass('hidden'); } 
         else { 
	       $(this).text(ajax_sform_settings_options_object.show); 
	       $('#trsmtpon').removeClass('hidden'); 
	       $('.smpt-warnings').addClass('hidden'); 
	       if( $('#server_smtp').prop('checked') == true ){ 
		       $('.trsmtp').removeClass('hidden'); 
		       if( $('#smtp_authentication').prop('checked') == true ){ $('.trauthentication').removeClass('hidden'); } 
		       else { $('.trauthentication').addClass('hidden'); } 
		   } 
		   else { $('.trsmtp').addClass('hidden'); } 
         }
       });


       $("#server_smtp").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsmtp').removeClass('hidden'); 
         $('#thsmtp').css('padding','65px 41px 13px'); 
         $('#tdsmtp').css('padding','65px 10px 13px');  
         $('#smtp-notice').css('visibility', 'visible'); 
           if ($('#smtp_authentication').prop('checked') == true) { 
	       $('.trauthentication').removeClass('hidden'); 
           } 
           else { $('.trauthentication').addClass('hidden'); } 
         } 
         else { 
           $('.trsmtp').addClass('hidden'); 
           $('#thsmtp').css('padding','65px 41px 43px'); 
           $('#tdsmtp').css('padding','65px 10px 43px');  
           $('#smtp-notice').css('visibility', 'hidden'); 
         }
       });

       $("#smtp_authentication").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.trauthentication').removeClass('hidden'); 
          $('#tdauthentication').css('padding','35px 10px 13px'); 
          } 
          else { 
	      $('.trauthentication').addClass('hidden'); 
          $('#thsmtp').css('padding','65px 41px 43px'); 
          $('#tdauthentication').css('padding','35px 10px 43px'); 
          }  
       });

       $("#notification").on("click", function() {
          if($(this).prop('checked') == true) { 
          $('.trnotification').removeClass('hidden'); 
          $('#thnotification').css('padding','66px 41px 35px'); 
          $('#tdnotification').css('padding','66px 10px 35px'); 
            if ($('#custom-name').prop('checked') == true) { $('.trcustomname').removeClass('hidden'); } 
            else { $('.trcustomname').addClass('hidden'); } 
            if( $('#custom-subject').prop('checked') == true){ $('.trcustomsubject').removeClass('hidden'); } 
            else { $('.trcustomsubject').addClass('hidden'); } 
          } 
          else { 
          $('.trnotification').addClass('hidden'); 
          $('#thnotification').css('padding','66px 41px 65px'); 
          $('#tdnotification').css('padding','66px 10px 65px'); 
          }
       });


       $("#requester-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').addClass('hidden'); } 
       else { $('.trcustomname').removeClass('hidden'); }
       });
       
       $("#form-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').addClass('hidden'); } 
       else { $('.trcustomname').removeClass('hidden'); }
       });
       
       $("#custom-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').removeClass('hidden'); } 
       else { $('.trcustomname').addClass('hidden'); }
       });

       $("#request-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').addClass('hidden'); } 
       else { $('.trcustomsubject').removeClass('hidden'); }
       });
       
       $("#custom-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').removeClass('hidden'); } 
       else { $('.trcustomsubject').addClass('hidden'); }
       });

       $("#confirmation_email").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trconfirmation').removeClass('hidden'); 
         $('#thconfirmation').css('padding','66px 41px 35px'); 
         $('#tdconfirmation').css('padding','66px 10px 35px'); 
         } 
         else { 
	     $('.trconfirmation').addClass('hidden'); 
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