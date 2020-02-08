<?php

function elegant_blocks_accordion_style( $style ){

	switch ( $style ) {
		case '5':
			return 'accordion_style_5';
			break;
		case '4':
			return 'accordion_style_4';
			break;
		case '3':
			return 'accordion_style_3';
			break;
		case '2':
			return 'accordion_style_2';
			break;		
		default:
			return 'accordion_style_1';
			break;
	}

}

function elegant_blocks_adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

function elegant_blocks_accordion_font_color( $style , $backgroundColor ){

	switch ( $style ) {
		case 'accordion_style_4':
			return elegant_blocks_adjustBrightness( $backgroundColor, -25 );
			break;
		
		default:
			return 'inherit';
			break;
	}

}

function elegant_blocks_accordion_font_background_color( $style , $backgroundColor ){

	switch ( $style ) {
		case 'accordion_style_5':
		case 'accordion_style_3':
		case 'accordion_style_2':
			return elegant_blocks_adjustBrightness( $backgroundColor, -25 );
			break;
		
		default:
			return 'transparent';
			break;
	}

}

function elegant_blocks_accordion_background_color( $style , $backgroundColor ){

	switch ( $style ) {
		case 'accordion_style_3':
		case 'accordion_style_2':
		case 'accordion_style_4':
			return elegant_blocks_adjustBrightness( $backgroundColor, -25 );
			break;
		
		default:
			return 'none';
			break;
	}

}

function elegant_blocks_render_accordion( $attribute ){

	$catID = !empty( $attribute['selectedPostCategoryID'] ) ? absint( $attribute['selectedPostCategoryID'] ) : ''; 
	$style = !empty( $attribute['style'] ) ? absint( $attribute['style'] ) : 1; 

	$animation = !empty( $attribute['animation'] ) ? $attribute['animation'] : 'fadeInUp'; 
	$backgroundColor = !empty( $attribute['backgroundColor'] ) ? $attribute['backgroundColor'] : '#1ABC9C'; 
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	// Desktop Spacing
	$spacingTop = !empty( $attribute['spacingTop'] ) ? $attribute['spacingTop'] : '50';
	$spacingBottom = !empty( $attribute['spacingBottom'] ) ? $attribute['spacingBottom'] : '50';
	$spacingLeft = !empty( $attribute['spacingLeft'] ) ? $attribute['spacingLeft'] : '0';
	$spacingRight = !empty( $attribute['spacingRight'] ) ? $attribute['spacingRight'] : '0';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attribute['tabletSpacingTop'] ) ? $attribute['tabletSpacingTop'] : '50';
	$tabletSpacingBottom = !empty( $attribute['tabletSpacingBottom'] ) ? $attribute['tabletSpacingBottom'] : '50';
	$tabletSpacingLeft = !empty( $attribute['tabletSpacingLeft'] ) ? $attribute['tabletSpacingLeft'] : '0';
	$tabletSpacingRight = !empty( $attribute['tabletSpacingRight'] ) ? $attribute['tabletSpacingRight'] : '0';

	// Tablet Spacing
	$mobileSpacingTop = !empty( $attribute['mobileSpacingTop'] ) ? $attribute['mobileSpacingTop'] : '50';
	$mobileSpacingBottom = !empty( $attribute['mobileSpacingBottom'] ) ? $attribute['mobileSpacingBottom'] : '50';
	$mobileSpacingLeft = !empty( $attribute['mobileSpacingLeft'] ) ? $attribute['mobileSpacingLeft'] : '0';
	$mobileSpacingRight = !empty( $attribute['mobileSpacingRight'] ) ? $attribute['mobileSpacingRight'] : '0';

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'cat' => $catID
	); 

	$tabs_query = new WP_Query( $args );

	$rand = wp_generate_password( 20, false, false );
	
	$accordionID = 'mb_accordion_' . $rand;
	$count = 0;
	
	ob_start(); 

	if( $tabs_query->have_posts() ): ?>

		<div 
		id="<?php echo esc_attr( $accordionID ); ?>_wrapper"
		class="<?php echo esc_attr( $className ); ?> mb_accordion <?php echo esc_attr( elegant_blocks_accordion_style( $style ) ); ?>">

			<div class="panel-group" id="<?php echo esc_attr( $accordionID ); ?>" role="tablist" aria-multiselectable="true">

				<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

					<?php 
					while( $tabs_query->have_posts() ): $tabs_query->the_post(); 
						$rand2 = wp_generate_password( 20, false, false );
						$panelID = 'mb_panel_' . $rand2;
						$contentID = 'mb_tabs_' . $rand2;
						?>
					  	<div class="panel panel-default">
					    	<div 
					    	style="background-color: <?php echo esc_attr( $backgroundColor ); ?>" 
					    	class="panel-heading" 
					    	role="tab" 
					    	id="<?php echo esc_attr( $panelID ); ?>">
					      		<h4 class="panel-title">
					        		<a 
					        		data-toggle="collapse" 
					        		data-parent="#<?php echo esc_attr( $accordionID ); ?>" 
					        		href="#<?php echo esc_attr( $contentID ); ?>" 
					        		aria-expanded="true" 
					        		aria-controls="<?php echo esc_attr( $contentID ); ?>" 
					        		class="accordion_anchor collapsed" 
					        		>
					        			<?php the_title(); ?>
					        			<i 
					        			class="accordion_icon fa <?php echo ( empty( $count ) ? 'fa-minus' : 'fa-plus' ); ?>" 
					        			style="color: <?php echo esc_attr( elegant_blocks_accordion_font_color( elegant_blocks_accordion_style( $style ) , $backgroundColor ) );?>;border-color: <?php echo esc_attr( elegant_blocks_accordion_background_color( elegant_blocks_accordion_style( $style ) , $backgroundColor ) );?>; background: <?php echo esc_attr( elegant_blocks_accordion_font_background_color( elegant_blocks_accordion_style( $style ) , $backgroundColor ) );?>"></i>
					        		</a>
					      		</h4>
					    	</div>
					    	<div 
					    	style="border-color: <?php echo esc_attr( $backgroundColor ); ?>" 
					    	id="<?php echo esc_attr( $contentID ); ?>" 
					    	class="panel-collapse collapse <?php echo ( empty( $count ) ? 'in' : '' ); ?>" 
					    	role="tabpanel" 
					    	aria-labelledby="<?php echo esc_attr( $panelID ); ?>">
					      		<div class="panel-body">
					      			<div class="<?php echo esc_attr( $animation ); ?> animated">
					    				<?php the_content(); ?>  				
					      			</div>					
						      	</div>
						    </div>
						</div>
						<?php 
						$count++;
					endwhile; ?>

				</div>

			</div>

		</div>

		<style>
			.accordion_style_2 #<?php echo esc_attr( $accordionID ); ?> h4.panel-title a i:after{
				background: <?php echo esc_attr( elegant_blocks_accordion_background_color( elegant_blocks_accordion_style( $style ) , $backgroundColor ) );?>;
			}
			.accordion_style_4 #<?php echo esc_attr( $accordionID ); ?> h4.panel-title a:not(.collapsed){
				color: <?php echo esc_attr( elegant_blocks_accordion_font_color( elegant_blocks_accordion_style( $style ) , $backgroundColor ) );?>;
			}

			#<?php echo esc_attr( $accordionID ); ?>_wrapper{
            	padding-top: <?php echo absint( $spacingTop ); ?>px; 
            	padding-bottom: <?php echo absint( $spacingBottom ); ?>px; 
            	padding-left: <?php echo absint( $spacingLeft ); ?>px; 
            	padding-right: <?php echo absint( $spacingRight ); ?>px;
            }

			/* 
	          ##Device = Tablets, Ipads (portrait)
	        */    

	        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	            #<?php echo esc_attr( $accordionID ); ?>_wrapper{
	            	padding-top: <?php echo absint( $tabletSpacingTop ); ?>px; 
	            	padding-bottom: <?php echo absint( $tabletSpacingBottom ); ?>px; 
	            	padding-left: <?php echo absint( $tabletSpacingLeft ); ?>px; 
	            	padding-right: <?php echo absint( $tabletSpacingRight ); ?>px;
	            }
	        }

	        /* 
	          ##Device = Most of the Smartphones Mobiles (Portrait)
	        */

	        @media (min-width: 300px) and (max-width: 767px) {
	        	#<?php echo esc_attr( $accordionID ); ?>_wrapper{
	            	padding-top: <?php echo absint( $mobileSpacingTop ); ?>px; 
	            	padding-bottom: <?php echo absint( $mobileSpacingBottom ); ?>px; 
	            	padding-left: <?php echo absint( $mobileSpacingLeft ); ?>px; 
	            	padding-right: <?php echo absint( $mobileSpacingRight ); ?>px;
	            }
	        }

		</style>

		<?php

	endif;

	$content = ob_get_clean();

	return $content;

}