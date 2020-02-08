jQuery(document).on( 'click' , '.install_activate_recommended_plugins' , function(){

    var to_install_activate_plugins = [];
    jQuery('.tb_recommended_plugins_wrapper ul li').each(function() {
        to_install_activate_plugins.push( jQuery(this).attr('id') );
    });

	jQuery.ajax({
        type : "post",
        url : bizberg.ajaxUrl,
        data : {
         	action : "bizberg_install_plugins",
            to_install_activate_plugin : JSON.stringify( to_install_activate_plugins )
        },
        beforeSend: function() {
	        jQuery('.bizberg_spinner').show();
	        jQuery('.install_activate_recommended_plugins .text').text('Installing & Activating ...');
	    },
        success: function(response) {
        	jQuery('.install_activate_recommended_plugins').hide();
        	window.location.href = bizberg.demo_import_page; // Goto import page
        }
    })

});

jQuery(document).on( 'click' , '.bizberg_remove_install_notice' , function(){

	jQuery.ajax({
        type : "post",
        url : bizberg.ajaxUrl,
        data : {
         	action: "bizberg_hide_install_plugins_notice"
        },
        success: function() {
        	jQuery('#accordion-section-recommended-plugins-customizer').attr('style','display:none !important');
        }
    })

});

jQuery(document).on('click','.doc_title',function(){

    if( jQuery(this).closest('h3').hasClass('active') ){
        jQuery(this).closest('h3').removeClass('active');
    } else {
        jQuery(this).closest('h3').addClass('active');
    }
   
    jQuery(this).closest('h3').next('.tb_customizer_container').slideToggle();
});

jQuery(document).on('click','.import_presets_bizberg',function(){

    jQuery.ajax({
        dataType : 'json',
        type : "post",
        url : bizberg.ajaxUrl,
        data : {
            action: "bizberg_check_required_plugin_for_import_demo_data"
        },
        beforeSend : function(){
            jQuery('.sample_homepage_demo_wrapper').css( 'opacity', "0.3" );
        },
        success: function( data ) {
            if( data.message != null ){
                jQuery('.bizberg_install_plugin_notice').slideDown('slow').html( data.message );
                jQuery('.sample_homepage_demo_wrapper').css( 'opacity', "1" );

                document.location.href="#sub-accordion-section-pre-designed-sites";

            } else {
                jQuery('.bizberg_install_plugin_notice').slideUp('slow');
                window.location.href = bizberg.demo_import_page; // Goto import page
            }
        }
    })

});

jQuery(document).on( 'click' , '.customizer_install_activate_required_plugins' , function(){

    jQuery.ajax({
        dataType : 'json',
        type : "post",
        url : bizberg.ajaxUrl,
        data : {
            action: "bizberg_install_required_plugin_for_import_demo_data",
            plugins: jQuery('.customizer_install_activate_required_plugins').attr('data-install')
        },
        beforeSend : function(){
            jQuery('.customizer_install_activate_required_plugins').off('click').text( 'Please wait ...' );
        },
        success: function( data ) {
            if( data.status == 'success' ){
                jQuery('.bizberg_install_plugin_notice').slideToggle('slow');
                window.location.href = bizberg.demo_import_page;
            } else {

            }
        }
    })

});