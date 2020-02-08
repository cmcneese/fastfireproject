<?php

function elegant_blocks_render_map( $attributes ){

	$data = array();
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';
	$data['centerMarker'] = !empty( $attributes['centerMarker'] ) ? $attributes['moreMarkers'] : false;
	$data['moreMarkers'] = !empty( $attributes['moreMarkers'] ) ? $attributes['moreMarkers'] : '';
	$data['latitude'] = !empty( $attributes['latitude'] ) ? $attributes['latitude'] : '27.707847';
	$data['longitude'] = !empty( $attributes['longitude'] ) ? $attributes['longitude'] : '85.314331';
	$data['zoom'] = !empty( $attributes['zoom'] ) ? $attributes['zoom'] : '5';
	$data['description'] = !empty( $attributes['description'] ) ? $attributes['description'] : '';
	$data['scrollWheelZoom'] = !empty( $attributes['scrollWheelZoom'] ) ? $attributes['scrollWheelZoom'] : false;
	$data['mapStyle'] = !empty( $attributes['mapStyle'] ) ? $attributes['mapStyle'] : '1';
	$data['streetViewControl'] = !empty( $attributes['streetViewControl'] ) ? $attributes['streetViewControl'] : false;
	$data['mapTypeControl'] = !empty( $attributes['mapTypeControl'] ) ? $attributes['mapTypeControl'] : false;
	$data['draggable'] = !empty( $attributes['draggable'] ) ? $attributes['draggable'] : false;
	$data['fullscreenControl'] = !empty( $attributes['fullscreenControl'] ) ? $attributes['fullscreenControl'] : false;
	$data['zoomControl'] = !empty( $attributes['zoomControl'] ) ? $attributes['zoomControl'] : false;
	$data['marker'] = !empty( $attributes['marker'] ) ? $attributes['marker'] : '';
	$data['defaultMarker'] = !empty( $attributes['defaultMarker'] ) ? $attributes['defaultMarker'] : false;
	$data['autoOpenInfoWindow'] = !empty( $attributes['autoOpenInfoWindow'] ) ? $attributes['autoOpenInfoWindow'] : false;

	$data['markerClustererStatus'] = !empty( $attributes['markerClustererStatus'] ) ? true : false;
	$data['maxZoom'] = !empty( $attributes['maxZoom'] ) ? $attributes['maxZoom'] : 10;
	$data['minimumClusterSize'] = !empty( $attributes['minimumClusterSize'] ) ? $attributes['minimumClusterSize'] : 2;

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$mapHeight = !empty( $attributes['mapHeight'] ) ? $attributes['mapHeight'] : '300';
	$rand = wp_generate_password( 20, false, false );
		
	ob_start(); ?>

	<div class="<?php echo ( $containerStatus ? 'container' : '' ) . ' ' . esc_attr( $className ); ?>">
		<div class="row">
			<div class="col-sm-12">
				<div 
				id="<?php echo esc_attr( 'eb_map_' . $rand ); ?>" 
				class="eb_map"
				style="height:<?php echo absint( $mapHeight ) . 'px'; ?>"></div>
			</div>
		</div>
	</div>

	<script>
		jQuery( document ).ready(function(){
			eb_get_google_map( "<?php echo esc_attr( $rand ); ?>" , <?php echo json_encode( $data ); ?> );
		});
	</script>

	<?php

	return ob_get_clean();

}