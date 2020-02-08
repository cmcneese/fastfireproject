<?php

function elegant_blocks_render_container( $attributes, $content ){
	
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Desktop
	$desktopSpacingTop = !empty( $attributes['desktopSpacingTop'] ) ? $attributes['desktopSpacingTop'] : '0';
	$desktopSpacingBottom = !empty( $attributes['desktopSpacingBottom'] ) ? $attributes['desktopSpacingBottom'] : '0';
	$desktopSpacingLeft = !empty( $attributes['desktopSpacingLeft'] ) ? $attributes['desktopSpacingLeft'] : '0';
	$desktopSpacingRight = !empty( $attributes['desktopSpacingRight'] ) ? $attributes['desktopSpacingRight'] : '0';

	// Tablet
	$tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : '0';
	$tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : '0';
	$tabletSpacingLeft = !empty( $attributes['tabletSpacingLeft'] ) ? $attributes['tabletSpacingLeft'] : '0';
	$tabletSpacingRight = !empty( $attributes['tabletSpacingRight'] ) ? $attributes['tabletSpacingRight'] : '0';

	// Mobile
	$mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : '0';
	$mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : '0';
	$mobileSpacingLeft = !empty( $attributes['mobileSpacingLeft'] ) ? $attributes['mobileSpacingLeft'] : '0';
	$mobileSpacingRight = !empty( $attributes['mobileSpacingRight'] ) ? $attributes['mobileSpacingRight'] : '0';

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_container_' . $rand;

	ob_start(); ?>

		<div class="container eb_block_container">
			<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
				<?php echo $content; ?>
			</div>
		</div>

		<style>
			
			#<?php echo esc_attr( $id ); ?> {
				padding-top: <?php echo esc_attr( $desktopSpacingTop ); ?>px;
				padding-bottom: <?php echo esc_attr( $desktopSpacingBottom ); ?>px;
				padding-left: <?php echo esc_attr( $desktopSpacingLeft ); ?>px;
				padding-right: <?php echo esc_attr( $desktopSpacingRight ); ?>px;
			}

			@media (min-width: 768px) and (max-width: 1024px) {
  
			 	#<?php echo esc_attr( $id ); ?> {
					padding-top: <?php echo esc_attr( $tabletSpacingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $tabletSpacingBottom ); ?>px;
					padding-left: <?php echo esc_attr( $tabletSpacingLeft ); ?>px;
					padding-right: <?php echo esc_attr( $tabletSpacingRight ); ?>px;
				}
			  
			}

			@media (min-width: 320px) and (max-width: 767px) {
  
				#<?php echo esc_attr( $id ); ?> {
					padding-top: <?php echo esc_attr( $mobileSpacingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $mobileSpacingBottom ); ?>px;
					padding-left: <?php echo esc_attr( $mobileSpacingLeft ); ?>px;
					padding-right: <?php echo esc_attr( $mobileSpacingRight ); ?>px;
				}
			  
			}

		</style>

		<?php

	return ob_get_clean();

}