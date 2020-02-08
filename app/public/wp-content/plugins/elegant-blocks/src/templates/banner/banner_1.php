<?php

function elegant_blocks_render_banner_1( $attributes ){

	$title = !empty( $attributes['title'] ) ? $attributes['title'] : 'ABOUT ELEGANT BLOCK';
	$subtitle = !empty( $attributes['subtitle'] ) ? $attributes['subtitle'] : 'We Do Things That Matters';
	$primaryColor = !empty( $attributes['primaryColor'] ) ? $attributes['primaryColor'] : '#ffa500';
	$bgImageID = !empty( $attributes['bgImage'] ) ? $attributes['bgImage'] : '';
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	$bgImageArr = wp_get_attachment_image_src( $bgImageID, 'full' );
	if( !empty( $bgImageArr[0] ) ){
		$bgImage = $bgImageArr[0];
	} else {
		$bgImage = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/sm_slider_01.jpg';
	}

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_banner_1_' . $rand;

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	/**
	* Background Overlay
	*/

	$backgroundOverlayStatus = empty( $attributes['backgroundOverlayStatus'] ) ? true : false;
	$bgOverlayPrimaryColor = !empty( $attributes['bgOverlayPrimaryColor'] ) ? $attributes['bgOverlayPrimaryColor'] : 'rgba(0,0,0,0.6)';
	$bgOverlaySecondaryColor = !empty( $attributes['bgOverlaySecondaryColor'] ) ? $attributes['bgOverlaySecondaryColor'] : 'rgba(0,0,0,0.6)';

	if( $backgroundOverlayStatus == false ){
		$bgOverlayPrimaryColor = 'rgba(0,0,0,0)';
		$bgOverlaySecondaryColor = 'rgba(0,0,0,0)';
	}

	ob_start(); ?>	

	<style>
		#<?php echo esc_attr( $id ); ?> .eb_banner_title_grid h6:before{
			background: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> .black-overlay{
    		background: linear-gradient( to right, <?php echo esc_attr( $bgOverlayPrimaryColor ); ?> , <?php echo esc_attr( $bgOverlaySecondaryColor ); ?> );
    	}
	</style>

    <div 
    style="background-image: url( <?php echo esc_url( $bgImage ); ?> ); " 
    class="eb_banner_1_wrapper <?php echo esc_attr( $className ); ?>" 
    id="<?php echo esc_attr( $id ); ?>">    	
	    <div class="eb_banner_title_inner">
	        <div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">
	            <div class="eb_banner_title_grid">
	                <h6><?php echo esc_html( $title ); ?></h6>
	                <h1><?php echo esc_html( $subtitle ); ?></h1>
	            </div>
	        </div>
        </div>
        <div class="black-overlay"></div>

    </div>

	<?php
	return ob_get_clean();

}