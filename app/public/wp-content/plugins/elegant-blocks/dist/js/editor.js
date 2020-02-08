/**
* Add elegant block icon
*/

( function() {

    var el = wp.element.createElement;
        var iconEl = el(
		'svg', 
		{ width: 20, height: 20 },
	  	el(
	  		'path', 
	  		{ 
	  			d: "m26 119l204 67l0 292l-203-69m254 70l205-70l0-288l-204 64m-26-34l188-61l-188-57l-193 57",
	  			transform : "scale(0.04 0.04)",
	  			fill:"url(#gradient_menu)"
	  		} 
	  	),
	  	el(
	  		'defs',
	  		'',
	  		el(
	  			'linearGradient',	
	  			{ id: 'gradient_menu' },
	  			el(
		  			'stop',	
		  			{ offset: '0%','stop-color':"#fc3d3c" }
		  		),
		  		el(
		  			'stop',	
		  			{ offset: '50%','stop-color':"#f53592" }
		  		),
		  		el(
		  			'stop',	
		  			{ offset: '100%','stop-color':"#009dda" }
		  		),
	  		),
	  	),
	);
    wp.blocks.updateCategory( 'elegant-blocks', { icon: iconEl } );
    wp.blocks.updateCategory( 'elegant-blocks-description-template', { icon: iconEl } );
    wp.blocks.updateCategory( 'elegant-blocks-banner-template', { icon: iconEl } );
    wp.blocks.updateCategory( 'elegant-blocks-video-template', { icon: iconEl } );
    wp.blocks.updateCategory( 'elegant-blocks-newsletters-template', { icon: iconEl } );

} )();

/**
* Unregister Blocks
*/

wp.domReady( () => {

	if ( Array.isArray( mb_backend_object.disable_blocks ) && mb_backend_object.disable_blocks.length ) {
	   	jQuery.each( mb_backend_object.disable_blocks, function ( key,value ) {
	   		wp.blocks.unregisterBlockType( value );
		});
	}

	if( mb_backend_object.pro_status != 1 ){
		wp.blocks.unregisterBlockType( 'elegant-blocks-plugin/banner-1' );
		wp.blocks.unregisterBlockType( 'elegant-blocks-plugin/description-1' );
		wp.blocks.unregisterBlockType( 'elegant-blocks-plugin/newsletter-1' );
		wp.blocks.unregisterBlockType( 'elegant-blocks-plugin/video-1' );
	}

} );

function eb_get_fonticons(){

	var arr = mb_backend_object.fontawesome_icons;
	var i = 0;
	var fontIcons = [];
	var content = [];

	jQuery.each( arr , function( key , value ){
        fontIcons[i] = value;
        i++;
    });	

	for (var i = 0; i < fontIcons.length; i++) {
		content.push(
			'<a href="javascript:void(0)" class="fontawesome-icons" data-value="' + fontIcons[i] + '"><i class="' + fontIcons[i] + '"></i></a>'
		);
	}

	return content.join('');

}

function eb_get_fontawesome_dialog_box( $this ){

	window.iconThis = $this;
	let icons = eb_get_fonticons();
	var content = '<div id="eb-dialog-fontawesome" class="hidden" title="Choose Icon">' +
		'<div class="search_icons_wrapper"><input type="text" placeholder="Search Icons Here" class="mb-10"></div>'+
  		'<div class="fontawesome_wrapper">' + icons + '</div>' +
  		'<div class="save_key" data-save-id=""></div>'
	'</div>';
	return content;

}

jQuery(document).on('keyup','.search_icons_wrapper input',function(){

	var userText = jQuery(this).val();
	var icon;

	jQuery('.fontawesome_wrapper .fontawesome-icons').hide();
	jQuery('.fontawesome_wrapper .fontawesome-icons').each(function(){
		icon = jQuery(this).attr('data-value');
		if ( icon.toLowerCase().indexOf( userText ) >= 0 ){
			jQuery(this).show();
		}
	});

});

/**
* Click on fontawesome icon
*/

jQuery(document).on( 'click' , '.fontawesome-icons' , function(){

	// Remove previous active class on click
	jQuery('.fontawesome_wrapper a').removeClass('active');

	// Add active class for highlight
	jQuery(this).addClass('active');

	// Save icon value
	var icon = jQuery(this).attr('data-value');
	var key = jQuery('.save_key').attr( 'data-save-id' );
	window.iconThis.onPageChanges( key , icon );
});

/**
* Button click opens dialog box
*/

jQuery(document).on('click','.eb_choose_icon',function(){

	// Reset search value
	jQuery('.search_icons_wrapper input').val('');

	// Display all font icons that are hidden
	jQuery('.fontawesome_wrapper .fontawesome-icons').show();

	// get attribute name
	var save_id = jQuery(this).attr('id');
	jQuery('.save_key').attr( 'data-save-id' , save_id );

	// Get selected Icon
	var selectedIcon = jQuery(this).nextAll('.selected_icon').attr('data-value');
	eb_set_active_class_fontawesome( selectedIcon );

	jQuery("#eb-dialog-fontawesome").dialog({
	   	height: 340,
	   	width: 700,
	   	resizable: false,
	   	modal: true,
	   	draggable: false
	});

});

function eb_set_active_class_fontawesome( selectedIcon ){

	jQuery('.fontawesome_wrapper a').removeClass('active');
	jQuery('.fontawesome_wrapper a').each(function(){
		if( jQuery(this).attr('data-value') == selectedIcon ){
			jQuery(this).addClass('active');
		}
	});

}

/**
 * Radio Image
 *
 * @param {Object} $this - react object
 * @param {string} key - database save key
 * @param {array} images - array of images ( Can be custom image )
 * @param {string} selected - image link saved in database
 */

function eb_get_radio_images( $this, key, images, selected ){

	var tempName = 'eb_radio_image_' + key;
	window.tempName = $this;

	if( images == '' ){
		var images = mb_backend_object.shape_images;	
	}

	var temp = [];

	for (var i = images.length - 1; i >= 0; i--) {

		var className = ( selected == images[i] ) ? 'selected' : '';

		temp.push( '<a class="' + className + '" href="javascript:void(0)" data-value="' + images[i] + '"><img src="' +  images[i] + '"></a>' ); 
	}

	temp.push( '<span class="eb_radio_image_key hidden">' + key + '</span>' ); 

	return temp.join('');

}

jQuery(document).on( 'click', '.eb_radio_image_wrapper a', function(){

	jQuery(this).closest('.eb_radio_image_wrapper').find( 'a' ).removeClass('selected');
	jQuery(this).addClass('selected');

	var key = jQuery(this).closest('.eb_radio_image_wrapper').find( 'a' ).nextAll('.eb_radio_image_key').text();
	var value = jQuery(this).attr( 'data-value' );

	window.tempName.onPageChanges( key , value );

});

/**
* Get all svg images
*/

function eb_get_radio_svg( $this, key, images, selected ){

	var rand = Math.floor(Math.random() * 9999999);
	var tempName = 'eb_radio_svg_' + key + '_' + rand;
	window.tempName = $this;
	var className = '';

	var images = mb_backend_object.shape_svg;
	var temp = [];

	for ( var i = images.length - 1; i >= 0; i-- ) {

		if( selected != '' ){
			var trimPath = jQuery( images[i] ).find('path').attr('d').replace(/ /g,'');
			var trimSelectedSvgPath = jQuery( selected ).find('path').attr('d').replace(/ /g,'');
			className = ( trimPath == trimSelectedSvgPath ) ? 'selected' : '';
		} 

		temp.push( '<span><a class="' + className + '" href="javascript:void(0)">' + images[i] + '</a><span class="svg_text hidden">' + images[i] + '</span></span>' ); 
	}

	temp.push( '<span class="eb_radio_image_key hidden" data-rand="' + rand + '">' + key + '</span>' ); 

	return temp.join('');
}

jQuery(document).on( 'click', '.eb_radio_svg_wrapper a', function(){

	jQuery(this).closest('.eb_radio_svg_wrapper').find( 'a' ).removeClass('selected');
	jQuery(this).addClass('selected');

	var key = jQuery(this).closest('span').nextAll('.eb_radio_image_key').text();
	var value = jQuery(this).next('span.svg_text').html().toString();
	var randomNumber = jQuery(this).closest('span').nextAll('.eb_radio_image_key').attr('data-rand');

	var tempName = 'eb_radio_svg_' + key + '_' + randomNumber;
	window.tempName.onPageChanges( key , value );

});

/**
* Radio Image
*/

function eb_get_radio_image( key, $this, selected ){

	var tempName = 'eb_radio_image_' + key;
	window.tempName = $this;

	var markers = mb_backend_object.markers;

	var temp = [];

	for (var i = markers.length - 1; i >= 0; i--) {

		var checked = ( selected == markers[i] ) ? 'checked' : '';

		temp.push( '<label><input ' + checked + ' type="radio" class="eb_map_marker" name="' + key + '" value="' + markers[i] + '"/><img src="' + markers[i] + '" /></label>' ); 
	}

	return temp.join('');

}

jQuery(document).on('click','.eb_map_marker',function(){

	var selectedMarker = jQuery(this).filter(':checked').val();
	var key = jQuery(this).attr('name');

	var tempName = 'eb_radio_image_' + key;
	window.tempName.onPageChanges( key , selectedMarker );

});

/**
* Add More Markers
*/

function get_add_more_marker_fields( j , value ){

	var data;
	if( j == '' && value != '' ){
		data = JSON.parse( value );
		j = data.length;	
	}	

	var content = [];
	for (var i = 0; i < j; i++) {

		var lat = value != '' ? data[i][0].lat : '';
		var lng = value != '' ? data[i][0].lng : '';
		var description = value != '' ? data[i][0].description : '';
		var default_marker = value != '' ? data[i][0].default_marker : '';
		var marker = value != '' ? data[i][0].marker : '';

		content[i] = '<div class="add_more_markers_panel">'+
		'<a href="javascript:void(0)" class="remove_tab_marker"><i class="fa fa-remove"></i></a>'+ 
		'<a href="javascript:void(0)" class="marker_tab_title button">Marker <span class="count">' + (i+2) + '</span></a>'+
		'<div class="hidden">'+
			'<input type="text" class="more_lat" id="more_lat_' + i + '" placeholder="Latitude" value="' + lat + '"/>'+
			'<input type="text" class="more_lng" id="more_lng_' + i + '" placeholder="Longitude" value="' + lng + '"/>'+
			'<textarea class="place_description_marker" id="place_description_marker_' + i + '" placeholder="Description">' + description + '</textarea>'+
			'<label><input type="checkbox" value="1" class="default_more_marker" ' + ( default_marker ? 'checked' : '' ) + '>Use default map marker</label>'+
			'<div class="eb_repeater_marker" style="display:' + ( default_marker ? 'none' : 'block' ) + '">'+
				eb_get_repeater_markers( 'more_marker' , i , marker ) + 
			'</div>'+
		'</div>'+
		'</div>';	
	}

	return content.join('');
	
}

function eb_get_repeater_markers( name, i, marker ){

	var markers = mb_backend_object.markers;
	var selected = marker;
	var key = name+'_'+i;

	var temp = [];

	for (var i = markers.length - 1; i >= 0; i--) {

		var checked = ( selected == markers[i] ) ? 'checked' : '';

		//  select default if empty
		if( i == ( markers.length - 1 ) && checked == '' ){
			checked = 'checked';
		}

		temp.push( '<label><input ' + checked + ' type="radio" class="eb_map_more_marker" name="' + key + '" value="' + markers[i] + '"/><img src="' + markers[i] + '" /></label>' ); 
	}

	return temp.join('');


}

// On click "add more" add fields
jQuery(document).on('click','.add_more_markers',function(){

	var content = get_add_more_marker_fields( 1, '' );	
	jQuery(this).prevAll('.more_markers_wrapper').append(content);
	resetMarkerCountOnButton( jQuery(this) )
	resetMarkerID( jQuery(this) );

});

function resetMarkerID( $this ){
	$this.prevAll('.more_markers_wrapper').find('.add_more_markers_panel').each(function(i){
		jQuery(this).find('.more_lat').attr( 'id' , 'more_lat_' + i );
		jQuery(this).find('.more_lng').attr( 'id' , 'more_lng_' + i );
		jQuery(this).find('.place_description_marker').attr( 'id' , 'place_description_marker_' + i );
	});
}

function resetMarkerCountOnButton( $this ){
	$this.prevAll('.more_markers_wrapper').find('.add_more_markers_panel').each(function(i){
		jQuery(this).find('.marker_tab_title .count').text( i + 2 );
	});
}

var delay = (function(){
  	var timer = 0;
  	return function(callback, ms){
    	clearTimeout (timer);
    	timer = setTimeout(callback, ms);
  	};
})();

// on keyup save the value in array
jQuery(document).on(
	'keyup click',
	'.more_lat,.more_lng,.place_description_marker,.remove_tab_marker,.eb_map_more_marker,.default_more_marker',
	function(e){

	// e.preventDefault();
	
	var $this = jQuery(this);

	var cursorLocation = e.target.selectionEnd;

	var selectedElement = e.srcElement.localName + '#' + $this.attr("id");

	if ( (jQuery(this).hasClass('more_lat') || 
		jQuery(this).hasClass('more_lng') ||
		jQuery(this).hasClass('place_description_marker')) && e.type == 'click' ) {

		return;
	}

	var panel = jQuery( this ).closest( '.more_markers_wrapper' );
	var tempArr = [];	

	delay(function(){

		jQuery(panel).find('.add_more_markers_panel').each(function(i){

			var lat = jQuery(this).find('.more_lat').val();
			var lng = jQuery(this).find('.more_lng').val();
			var description = jQuery(this).find('.place_description_marker').val();
			var marker = jQuery(this).find('.eb_map_more_marker:checked').val();
			var default_marker = jQuery(this).find('.default_more_marker:checked').val();

			tempArr[i] = [];
			tempArr[i].push({ 
				'lat' : lat, 
				'lng' : lng, 
				'description' : description,
				'marker' : marker,
				'default_marker' : default_marker
			});

		});
	
      	var tempName = 'eb_more_markers_moreMarkers';
		window.tempName.onPageChanges( 'moreMarkers' , JSON.stringify( tempArr ) );	

		// Set input focus
		if( jQuery(selectedElement).val() != undefined ){
			jQuery(selectedElement).focus();
			var fldLength= jQuery(selectedElement).val().length;
			jQuery(selectedElement)[0].setSelectionRange(fldLength, cursorLocation);	
		}
				

    }, 1000 );

    // return false;

});

function setAddMoreMarkersVariables( $this, key ){
	var tempName = 'eb_more_markers_' + key;
	window.tempName = $this;
}

// Remove marker 
jQuery(document).on('click','.remove_tab_marker',function(){
	jQuery(this).closest('.add_more_markers_panel').remove();
});