(function( $ ) {
	'use strict';
	
	 $( window ).load(function() {

       $("ul#submissions-data").hover(function () {
          $('#last-submission').addClass('unseen');
          $('#submissions-notice').removeClass('unseen');
          }, function () {
          $('#last-submission').removeClass('unseen');
          $('#submissions-notice').addClass('unseen');
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
         if ( selectVal == 'hidden' ) { $('.trname').addClass('unseen'); }
         else { $('.trname').removeClass('unseen'); 
	        if($('#namelabel').prop('checked') == true) { 
            $('tr.namelabel').addClass('unseen'); 
            } else { 
	        $('tr.namelabel').removeClass('unseen'); 
            }
	     }
       });          

       $('#lastname_field').on('change', function () {
         var selectVal = $("#lastname_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trlastname').addClass('unseen'); }
         else { $('.trlastname').removeClass('unseen');
	        if($('#lastnamelabel').prop('checked') == true) { 
            $('tr.lastnamelabel').addClass('unseen'); 
            } else { 
	        $('tr.lastnamelabel').removeClass('unseen'); 
            }
	     }
       });          

       $('#email_field').on('change', function () {
         var selectVal = $("#email_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.tremail').addClass('unseen'); }
         else { $('.tremail').removeClass('unseen'); 
	        if($('#emaillabel').prop('checked') == true) { 
            $('tr.emaillabel').addClass('unseen'); 
            } else { 
	        $('tr.emaillabel').removeClass('unseen'); 
            }
         }
       });          

       $('#phone_field').on('change', function () {
         var selectVal = $("#phone_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trphone').addClass('unseen'); }
         else { $('.trphone').removeClass('unseen'); 
	        if($('#phonelabel').prop('checked') == true) { 
            $('tr.phonelabel').addClass('unseen'); 
            } else { 
	        $('tr.phonelabel').removeClass('unseen'); 
            }
	     }
       });          

       $('#subject_field').on('change', function () {
         var selectVal = $("#subject_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trsubject').addClass('unseen'); }
         else { $('.trsubject').removeClass('unseen'); 
	        if($('#subjectlabel').prop('checked') == true) { 
            $('tr.subjectlabel').addClass('unseen'); 
            } else { 
	        $('tr.subjectlabel').removeClass('unseen'); 
            }
         }
       });          

       $('#captcha_field').on('change', function () {
         var selectVal = $("#captcha_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trcaptcha').addClass('unseen'); }
         else { $('.trcaptcha').removeClass('unseen'); }
       });          
       
       $( "#captcha_field" ).hover( function() { 
	     $('#description-captcha').css('visibility', 'visible');
	     }, function() { 
		 $('#description-captcha').css('visibility', 'hidden'); 
	   });             

       $('#preference_field').on('change', function () {
         var selectVal = $("#preference_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trpreference').addClass('unseen'); }
         else { $('.trpreference').removeClass('unseen'); }
       }); 
       
       $('#terms_field').on('change', function () {
         var selectVal = $("#terms_field option:selected").val();
         if ( selectVal == 'hidden' ) { $('.trterms').addClass('unseen'); }
         else { $('.trterms').removeClass('unseen'); }
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
         $('tr.'+labelID).addClass('unseen'); 
         } 
         else { 
	     $('tr.'+labelID).removeClass('unseen'); 
         }
       });
       
       $("#required_sign").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.trsign').addClass('unseen');
          } 
          else { 
          $('.trsign').removeClass('unseen'); 
          } 
       });
       
       $(".nav-tab").on("click", function() {
          var SettingsID = $(this).attr('id')
	      $( ".nav-tab-active" ).removeClass( "nav-tab-active" );
	      $( ".settings-tab" ).addClass('unseen');  
          $( '#tab-' + SettingsID ).removeClass('unseen');	   
	      $( this ).addClass( "nav-tab-active" );
	      $( ".message" ).css("visibility","hidden");  
       });

       $("#smtp-configuration").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.smtp').addClass('unseen');
          } 
          else { 
          $('.smtp.heading').removeClass('unseen'); 
          $("#smpt-warnings").text(ajax_sform_settings_options_object.show);
          $('#trsmtpon').removeClass('unseen'); 
           if($('#server_smtp').prop('checked') == true) { 
            $('.trsmtp').removeClass('unseen'); 
            $('#thsmtp').css('padding','65px 41px 13px'); 
            $('#tdsmtp').css('padding','65px 10px 13px');  
            $('#smtp-notice').css('visibility', 'visible'); 
            if ($('#smtp_authentication').prop('checked') == true) { 
	         $('.trauthentication').removeClass('unseen'); 
            } 
            else { $('.trauthentication').addClass('unseen'); 
            } 
           } 
           else { 
            $('.trsmtp').addClass('unseen'); 
            $('#thsmtp').css('padding','65px 41px 43px'); 
            $('#tdsmtp').css('padding','65px 10px 43px');  
            $('#smtp-notice').css('visibility', 'hidden'); 
           }
          } 
       });
       
       $('#form-template').on('change', function () {
         var selectVal = $("#form-template option:selected").val();
	         if ( selectVal == 'customized' ) { 
		         $("#template-notice").text(ajax_sform_settings_options_object.notes);
		     }
             else { 
                 $("#template-notice").html('&nbsp;');
	         }		
       });          
       
        $("#stylesheet").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.trstylesheet').removeClass('unseen');
          } 
          else { 
          $('.trstylesheet').addClass('unseen'); 
          } 
       });
      
	   $("#stylesheet-file").on("click", function() {
         if($(this).prop('checked') == true) { 
			$('#stylesheet-description').html(ajax_sform_settings_options_object.cssenabled); 
	     } 
	     else { 
		    $('#stylesheet-description').html(ajax_sform_settings_options_object.cssdisabled); 
		 }
       });
       
	   $("#javascript").on("click", function() {
         if($(this).prop('checked') == true) { 
			$('#javascript-description').html(ajax_sform_settings_options_object.jsenabled); 
	     } 
	     else { 
		    $('#javascript-description').html(ajax_sform_settings_options_object.jsdisabled); 
		 }
       });
       
	   $("#characters_length").on("click", function() {
         if($(this).prop('checked') == true) { 
			$('#characters-description').html(ajax_sform_settings_options_object.showcharacters); 
		    $('#firstname_error_message').val(ajax_sform_settings_options_object.numnamer);
		    $('#lastname_error_message').val(ajax_sform_settings_options_object.numlster);
		    $('#subject_error_message').val(ajax_sform_settings_options_object.numsuber);
		    $('#object_error_message').val(ajax_sform_settings_options_object.nummsger);

	     } 
	     else { 
		    $('#characters-description').html(ajax_sform_settings_options_object.hidecharacters); 
		    $('#firstname_error_message').val(ajax_sform_settings_options_object.gennamer);
		    $('#lastname_error_message').val(ajax_sform_settings_options_object.genlster);
		    $('#subject_error_message').val(ajax_sform_settings_options_object.gensuber);
		    $('#object_error_message').val(ajax_sform_settings_options_object.genmsger);
		 }
       });
       
       $("#success-message").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').removeClass('unseen'); 
         $('.trsuccessredirect').addClass('unseen'); 
         } 
       });

       $("#success-redirect").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsuccessmessage').addClass('unseen'); 
         $('.trsuccessredirect').removeClass('unseen'); 
         } 
       });

       $('#confirmation_page').on('change', function () {
	       
	     var element = $(this).find('option:selected'); 
         var value = element.attr("value"); 
         var Tag = element.attr("Tag"); 
       
         if ( Tag == 'draft' ) { 
             $("#post-status").html(ajax_sform_settings_options_object.status + ' - <a href="'+ ajax_sform_settings_options_object.adminurl +'post.php?post=' + value + '&action=edit" target="_blank" style="text-decoration: none; color: #9ccc79;">' + ajax_sform_settings_options_object.publish + '</a>');
	     }
         else { 
             $("#post-status").html('&nbsp;');
	     }		         
         
       });          

       $("#smpt-warnings").on("click", function() {
         if( $('.smpt-warnings').hasClass('unseen') ) { $(this).text(ajax_sform_settings_options_object.hide); $('.smpt-settings').addClass('unseen'); $('.smpt-warnings').removeClass('unseen'); } 
         else { 
	       $(this).text(ajax_sform_settings_options_object.show); 
	       $('#trsmtpon').removeClass('unseen'); 
	       $('.smpt-warnings').addClass('unseen'); 
	       if( $('#server_smtp').prop('checked') == true ){ 
		       $('.trsmtp').removeClass('unseen'); 
		       if( $('#smtp_authentication').prop('checked') == true ){ $('.trauthentication').removeClass('unseen'); } 
		       else { $('.trauthentication').addClass('unseen'); } 
		   } 
		   else { $('.trsmtp').addClass('unseen'); } 
         }
       });

       $("#server_smtp").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trsmtp').removeClass('unseen'); 
         $('#thsmtp').css('padding','65px 41px 13px'); 
         $('#tdsmtp').css('padding','65px 10px 13px');  
         $('#smtp-notice').css('visibility', 'visible'); 
           if ($('#smtp_authentication').prop('checked') == true) { 
	       $('.trauthentication').removeClass('unseen'); 
           } 
           else { $('.trauthentication').addClass('unseen'); } 
         } 
         else { 
           $('.trsmtp').addClass('unseen'); 
           $('#thsmtp').css('padding','65px 41px 43px'); 
           $('#tdsmtp').css('padding','65px 10px 43px');  
           $('#smtp-notice').css('visibility', 'hidden'); 
         }
       });

       $("#smtp_authentication").on("click", function() {
          if($(this).prop('checked') == true) { 
	      $('.trauthentication').removeClass('unseen'); 
          $('#tdauthentication').css('padding','35px 10px 13px'); 
          } 
          else { 
	      $('.trauthentication').addClass('unseen'); 
          $('#thsmtp').css('padding','65px 41px 43px'); 
          $('#tdauthentication').css('padding','35px 10px 43px'); 
          }  
       });

       $("#notification").on("click", function() {
          if($(this).prop('checked') == true) { 
          $('.trnotification').removeClass('unseen'); 
          $('#thnotification').css('padding','66px 41px 35px'); 
          $('#tdnotification').css('padding','66px 10px 35px'); 
            if ($('#custom-name').prop('checked') == true) { $('.trcustomname').removeClass('unseen'); } 
            else { $('.trcustomname').addClass('unseen'); } 
            if( $('#custom-subject').prop('checked') == true){ $('.trcustomsubject').removeClass('unseen'); } 
            else { $('.trcustomsubject').addClass('unseen'); } 
          } 
          else { 
          $('.trnotification').addClass('unseen'); 
          $('#thnotification').css('padding','66px 41px 65px'); 
          $('#tdnotification').css('padding','66px 10px 65px'); 
          }
       });

       $("#requester-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').addClass('unseen'); } 
       else { $('.trcustomname').removeClass('unseen'); }
       });
       
       $("#form-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').addClass('unseen'); } 
       else { $('.trcustomname').removeClass('unseen'); }
       });
       
       $("#custom-name").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomname').removeClass('unseen'); } 
       else { $('.trcustomname').addClass('unseen'); }
       });

       $("#request-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').addClass('unseen'); } 
       else { $('.trcustomsubject').removeClass('unseen'); }
       });
       
       $("#custom-subject").on("click", function() {
       if($(this).prop('checked') == true) { $('.trcustomsubject').removeClass('unseen'); } 
       else { $('.trcustomsubject').addClass('unseen'); }
       });

       $("#confirmation_email").on("click", function() {
         if($(this).prop('checked') == true) { 
         $('.trconfirmation').removeClass('unseen'); 
         $('#thconfirmation').css('padding','66px 41px 35px'); 
         $('#tdconfirmation').css('padding','66px 10px 35px'); 
         } 
         else { 
	     $('.trconfirmation').addClass('unseen'); 
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