<?php

function elegant_blocks_render_shape_divider( $attribute ){

	$svg_1 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1893.000000pt" height="256.000000pt" viewBox="0 0 1893.000000 256.000000">
        <path d="M0 2124 l0 -436 68 69 c56 58 78 72 135 92 60 21 81 23 175 18 62 -3
        126 -12 152 -21 37 -14 53 -15 98 -5 30 6 75 8 100 4 60 -9 153 -56 205 -104
        41 -38 44 -39 128 -42 73 -3 91 -8 128 -32 l42 -28 17 32 c31 57 50 75 109
        106 144 77 316 84 467 18 93 -40 214 -144 289 -247 15 -21 39 -54 53 -73 l25
        -35 32 24 c39 30 133 62 207 71 70 8 187 -15 245 -49 40 -24 43 -24 58 -8 8 9
        18 28 22 42 14 47 74 135 127 186 139 134 342 223 628 276 159 30 541 32 670
        5 251 -54 448 -148 591 -284 67 -63 70 -62 98 49 64 249 218 387 466 417 176
        21 383 -32 528 -135 54 -39 60 -40 78 -18 28 35 109 65 189 71 l79 6 49 58
        c139 164 326 271 536 308 175 31 399 -7 603 -104 238 -112 368 -240 441 -433
        22 -57 26 -87 29 -195 1 -71 5 -132 8 -137 3 -4 26 -2 52 6 57 17 189 20 256
        4 105 -23 257 -116 323 -195 l35 -44 50 25 c212 107 474 109 696 5 66 -31 74
        -30 88 19 22 74 98 133 207 160 65 17 69 24 57 101 -34 207 63 420 228 502 89
        44 215 60 335 42 42 -6 45 -5 77 35 44 55 104 81 184 81 98 0 196 -40 259
        -107 55 -59 107 -216 108 -324 0 -48 13 -70 39 -70 31 0 121 -49 164 -89 51
        -47 55 -45 82 39 70 216 200 310 430 310 189 -1 419 -79 544 -187 57 -48 114
        -136 143 -221 19 -57 23 -86 22 -192 0 -70 -6 -144 -13 -169 -17 -58 -7 -67
        74 -63 84 5 160 -20 201 -65 l32 -35 46 35 c79 61 169 67 322 22 16 -5 26 0
        40 20 78 112 141 146 267 146 92 1 185 -27 294 -87 185 -103 277 -277 245
        -466 -7 -39 -9 -75 -4 -80 4 -4 34 6 65 23 157 85 387 64 632 -56 173 -84 293
        -198 371 -352 45 -90 53 -90 93 7 106 254 303 459 540 561 346 148 874 95
        1272 -128 44 -24 90 -43 107 -43 43 0 80 -16 128 -56 l43 -34 74 39 c154 81
        355 94 510 33 105 -41 200 -104 242 -162 61 -83 125 -249 125 -322 0 -13 6
        -33 14 -43 12 -17 15 -15 41 29 15 26 39 53 54 60 42 22 121 27 188 13 43 -9
        66 -10 73 -3 5 5 10 38 10 73 0 97 13 115 123 157 25 10 37 21 37 35 0 10 -22
        63 -49 118 -56 112 -94 219 -116 323 -18 84 -20 247 -4 322 15 70 60 168 105
        229 73 100 272 221 421 257 l73 17 0 358 0 357 -9465 0 -9465 0 0 -436z" transform="translate(0.000000,256.000000) scale(0.100000,-0.100000)" fill="#000" stroke="none" fill-opacity="1"/>
    </svg>';

	$color_1 = !empty( $attribute['color_1'] ) ? $attribute['color_1'] : '#ffa500';
	$color_2 = !empty( $attribute['color_2'] ) ? $attribute['color_2'] : '#ed143d';
	$selectedShapeDividerImage = !empty( $attribute['selectedShapeDividerImage'] ) ? $attribute['selectedShapeDividerImage'] : $svg_1;
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_shape_divider_' . $rand;

	ob_start(); ?>

	<div 
	class="eb_svg_divider_wrapper <?php echo esc_attr( $className ); ?>" 
	id="<?php echo esc_attr( $id ); ?>">
		<div class="row">
			<div class="col-sm-12">
				<?php echo strip_tags( $selectedShapeDividerImage, '<svg><path><g>'); ?>
			</div>
		</div>
	</div>

	<style>
		
		#<?php echo esc_attr( $id ); ?> svg{
			background: <?php echo esc_attr( $color_1 ); ?>
		}
		#<?php echo esc_attr( $id ); ?> svg path{
			fill: <?php echo esc_attr( $color_2 ); ?>
		}

	</style>

	<script>

		function <?php echo esc_attr( $id ); ?>_eb_shape_custom_height(){
			var result = jQuery("#<?php echo esc_attr( $id ); ?> svg").height();
			jQuery("#<?php echo esc_attr( $id ); ?>").css({ 'height' : parseInt(result) + 'px' });
		}

		jQuery(document).ready(function(){
			<?php echo esc_attr( $id ); ?>_eb_shape_custom_height();	
		});

		jQuery(window).resize(function() {
			<?php echo esc_attr( $id ); ?>_eb_shape_custom_height();
	  	});
	  	
	</script>

	<?php
	return ob_get_clean();

}