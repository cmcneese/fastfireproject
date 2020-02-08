jQuery(document).ready(function(){

	var str1 = window.location.href;
	var str2 = "classic-editor";

	/**
	* Start
	*
 	* Check whether the editor is classic or gutenberg.
 	* If the classic editor then the below code will not run.
	*/

	if( !(str1.indexOf(str2) != -1) ){
	    jQuery('.megablocks_wrapper_custom_fields').closest('form').attr('onSubmit', 'return false;');
	}

	/* End */
	
});

jQuery(document).on( 'keyup','.fontawesome_search_post',function(){

	var userText = jQuery(this).val();
	var icon;

	jQuery('.eb_post_field_fontawesome_select .fontawesome-icons-post').hide();
	jQuery('.eb_post_field_fontawesome_select .fontawesome-icons-post').each(function(){
		icon = jQuery(this).find('i').attr('data-value');
		if ( icon.toLowerCase().indexOf( userText ) >= 0 ){
			jQuery(this).show();
		}
	});

});

jQuery(document).on( 'click' , '.eb_post_field_fontawesome_select a', function(){
	var icon = jQuery(this).find('i').attr('class');
	jQuery(this).closest('.eb_post_field_fontawesome_select').find('li').removeClass('active');
	jQuery(this).closest('li').addClass('active');	
	jQuery(this).closest('.eb_post_field_fontawesome_select').next('input').val(icon);
	jQuery(this).closest('.fontawesome_search_post_wrapper').find('.right i').removeClass().addClass(icon);
});