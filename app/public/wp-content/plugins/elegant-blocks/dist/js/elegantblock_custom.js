
/**
* Make height equal to screen
*/

jQuery(window).on( 'resize load', function () {

   	setTimeout(function(){ 
   		
   		resize_eb_slider();
   		resize_eb_banner(); 

   		/**
		* Only for lanscape ( mobile ) not ipad/tablet
   		*/

   		if( jQuery(window).height() < jQuery(window).width() && jQuery(window).width() < 1024 ){
   			resize_landscape_slider();	
   			slider_content_vertical_center();	
   		}

   	}, 100);   	

}).resize();

/**
* If device is mobile ( landscape ) resize the content position inside the slider
*/

function slider_content_vertical_center(){

	var sliderHeight = jQuery(this).height();
	sliderHeight = sliderHeight * 2;

	var contentHeight = jQuery('.s-caption').height();

	var margin_top =  ( sliderHeight - contentHeight ) / 2 / 1.5;

	jQuery('.s-caption').css({
		'top' : margin_top + 'px'
	});

}

/**
* If device is mobile ( landscape ) resize the height
*/

function resize_landscape_slider(){
	var bodyheight = jQuery(this).height();
	bodyheight = bodyheight * 1.5;
	jQuery( ".slider-list" ).css( 'max-height',bodyheight+'px' );
}

/**
* Resize slider
*/

function resize_eb_slider(){

	jQuery('.slider-list .s-caption').removeAttr('style');

	var bodyheight = jQuery(this).height();
	if( jQuery(window).width() > 1400 ){
		bodyheight = bodyheight * 0.85;
		jQuery( ".slider-list" ).css( 'max-height',bodyheight+'px' );
	} else {
		jQuery( ".slider-list" ).css( 'max-height',bodyheight+'px' );
	}

}

/**
* Resize banner image
*/

function resize_eb_banner(){

	var bodyheight;
	if( jQuery(window).width() > 1400 ){
		bodyheight = jQuery(this).height() * 0.75;
		jQuery( ".eb_banner_title_grid" ).css( 'padding-top', '75px' );
	} else {
		bodyheight = jQuery(this).height();
		jQuery( ".eb_banner_title_grid" ).css( 'padding-top', '0px' );
	}

	jQuery( ".eb_banner_1_wrapper" ).css( 'height', bodyheight + 'px' );
}

jQuery(document).ready( function($){

	/**
	* Count Up
	*/

	jQuery(".count-facts_wrapper").appear(function () {

        jQuery(".timer").countTo({

        	formatter: function (value, options) {
        		
        		var dataPrefix = jQuery(this).attr('data-prefix').trim();
        		var dataSuffix = jQuery(this).attr('data-suffix').trim();
        		var newValue = [];

			    value = value.toFixed(options.decimals);
			    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			    if( dataPrefix != '' ){
			    	newValue.push( '<span class="eb_counter_prefix">' + dataPrefix + '</span>' );
			    }

			    newValue.push( value );

			    if( dataSuffix != '' ){
			    	newValue.push( '<span class="eb_counter_suffix">' + dataSuffix + '</span>' );
			    }

			    return newValue;

			}

        });
        
    });

	/**
	* Make equal height for team
	*/

	jQuery('.team_columns_item_image p').matchHeight();

    /**
	* Make equal height for text block
	*/

	jQuery('.eb_text_wrapper').matchHeight();

	/**
	* Make equal height for services
	*/

	jQuery('.services-inner .row .col-xs-12 .shadow-large').matchHeight();

	/**
	* Make equal height for Blog
	*/
	
	jQuery('.portfolio_col_carousel_wrapper .portfolio_col_item_image .portfolio_col_item_caption p').matchHeight();

	/**
	* When accordion is clicked change the icon
	*/
	
	$('.mb_accordion .panel-title > a').click(function() {

		var panelGrp =  $(this).closest('.panel-group');

		$(panelGrp).find('.accordion_icon').removeClass('fa-minus').addClass('fa-plus');

		if( $(this).closest('.panel').find('.panel-collapse').hasClass('in') ){
			$(this).closest('.panel').find('i').removeClass('fa-minus').addClass('fa-plus');
		} else {
			$(this).closest('.panel').find('i').removeClass('fa-plus').addClass('fa-minus');
		}

	});

});