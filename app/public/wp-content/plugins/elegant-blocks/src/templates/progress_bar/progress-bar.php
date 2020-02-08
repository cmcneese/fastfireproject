<?php
function elegant_blocks_render_progress_bar( $attribute ){

	/**
	* Shape Divider Options
	*/

	$shapeDividerBottom = !empty( $attribute['shapeDividerBottom'] ) ? true : false;
	$selectedShapeDividerImageBottom = !empty( $attribute['selectedShapeDividerImageBottom'] ) ? $attribute['selectedShapeDividerImageBottom'] : '';

	$shapeDividerTop = !empty( $attribute['shapeDividerTop'] ) ? true : false;
	$selectedShapeDividerImageTop = !empty( $attribute['selectedShapeDividerImageTop'] ) ? $attribute['selectedShapeDividerImageTop'] : '';

	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	$tempArr = array();
	$tempColor = '';
	for ($i=1; $i <= 10; $i++) {

		$title = 'title_' . $i; 
		$color = 'color_' . $i; 
		$progress = 'progress_' . $i; 

		$tempArr[$i]['title'] = !empty( $attribute[$title] ) ? esc_attr( $attribute[$title] ) : '';
		$tempArr[$i]['color'] = !empty( $attribute[$color] ) ? esc_attr( $attribute[$color] ) : '';
		$tempArr[$i]['progress'] = !empty( $attribute[$progress] ) ? esc_attr( $attribute[$progress] ) : '';

		if( empty( $tempColor ) ){
			$tempColor = $tempArr[$i]['color'];
		}
	}

	$filterdArr = array_values( array_filter( array_map('array_filter', $tempArr ) ) );

	$columns = !empty( $attribute['columns'] ) ? absint( $attribute['columns'] ) : 2;
	$height = !empty( $attribute['height'] ) ? absint( $attribute['height'] ) : 5;
	$border_radius = !empty( $attribute['border_radius'] ) ? true : false;
	$background_color = !empty( $attribute['background_color'] ) ? $attribute['background_color'] : '#000';

	// Title
	$title = !empty( $attribute['title'] ) ? $attribute['title'] : '';
	$mainTitleTextTransform = !empty( $attribute['mainTitleTextTransform'] ) ? $attribute['mainTitleTextTransform'] : 'uppercase';
	$titleColor = !empty( $attribute['titleColor'] ) ? $attribute['titleColor'] : '#fff';

	// Subtitle
	$subtitle = !empty( $attribute['subtitle'] ) ? $attribute['subtitle'] : '';
	$subtitleColor = !empty( $attribute['subtitleColor'] ) ? $attribute['subtitleColor'] : '#fff';

	// Separator
	$separatorColor = !empty( $attribute['separatorColor'] ) ? $attribute['separatorColor'] : '#fa373d';

	// Desktop Spacing
	$spacingTop = !empty( $attribute['spacingTop'] ) ? $attribute['spacingTop'] : '50';
	$spacingBottom = !empty( $attribute['spacingBottom'] ) ? $attribute['spacingBottom'] : '50';
	$spacingLeft = !empty( $attribute['spacingLeft'] ) ? $attribute['spacingLeft'] : '50';
	$spacingRight = !empty( $attribute['spacingRight'] ) ? $attribute['spacingRight'] : '50';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attribute['tabletSpacingTop'] ) ? $attribute['tabletSpacingTop'] : '50';
	$tabletSpacingBottom = !empty( $attribute['tabletSpacingBottom'] ) ? $attribute['tabletSpacingBottom'] : '50';
	$tabletSpacingLeft = !empty( $attribute['tabletSpacingLeft'] ) ? $attribute['tabletSpacingLeft'] : '5';
	$tabletSpacingRight = !empty( $attribute['tabletSpacingRight'] ) ? $attribute['tabletSpacingRight'] : '5';

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attribute['mobileSpacingTop'] ) ? $attribute['mobileSpacingTop'] : '50';
	$mobileSpacingBottom = !empty( $attribute['mobileSpacingBottom'] ) ? $attribute['mobileSpacingBottom'] : '50';
	$mobileSpacingLeft = !empty( $attribute['mobileSpacingLeft'] ) ? $attribute['mobileSpacingLeft'] : '5';
	$mobileSpacingRight = !empty( $attribute['mobileSpacingRight'] ) ? $attribute['mobileSpacingRight'] : '5';

	// Background Image
	$bgImageStatus = !empty( $attribute['bgImageStatus'] ) ? true : false;
	$bgImageID = !empty( $attribute['bgImage'] ) ? absint( $attribute['bgImage'] ) : '';
	$bgOverlay = !empty( $attribute['bgOverlay'] ) ? esc_attr( $attribute['bgOverlay'] ) : '';

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	$rand = wp_generate_password( 20, false, false );
	$id = 'mb_progress_bar_' . $rand;

	ob_start();

	?>

	<div class="progres-main prgress_bar_wrapper <?php echo esc_attr( $className ); ?>" id="<?php echo esc_attr( $id ); ?>">        

      	<div 
      	style="padding-top: <?php echo esc_attr( $spacingTop ); ?>px; padding-bottom: <?php echo esc_attr( $spacingBottom ); ?>px; padding-left: <?php echo esc_attr( $spacingLeft ); ?>px; padding-right: <?php echo esc_attr( $spacingRight ); ?>px;" 
      	class="progress-list">

	      	<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

	      		<?php 
		      	if( $shapeDividerTop ){ ?>
			      	<div class="eb_shape_divider_wrapper top">
						<img src="<?php echo esc_url( $selectedShapeDividerImageTop ); ?>">
					</div>
					<?php 
				} ?>

	      		<div class="prgress_bar_wrapper_inner">

	      			<?php 
					if( !empty( sanitize_text_field( $title ) ) || !empty( sanitize_text_field( $subtitle ) ) ){ ?>

			      		<div class="progress_bar_title_desc">
							
							<?php 
							if( !empty( sanitize_text_field( $title ) ) ){ ?>
								<h2 
								style="text-transform: <?php echo esc_attr( $mainTitleTextTransform ); ?>; color: <?php echo esc_attr( $titleColor ); ?>;">
									<?php echo esc_html( $title ); ?>		
								</h2>
								<?php
							}

							if( !empty( sanitize_text_field( $subtitle ) ) ){ ?>
								<p style="color: <?php echo esc_attr( $subtitleColor ); ?>"><?php echo esc_html( $subtitle ); ?></p>
								<?php 
							}?>
						</div>

						<?php 

					} ?>
		        	
		        	<div class="progress-inner">

		        		<?php 
		        		foreach ($filterdArr as $key => $value) { 

		        			$progress = !empty( $value['progress'] ) ?  absint( $value['progress'] ) : '0';
		        			$color = !empty( $value['color'] ) ?  esc_attr( $value['color'] ) : '#fa373d'; ?> 

		        		 	<div class="<?php echo esc_attr( $columns == 2 ? 'col-sm-6' : 'col-sm-12' ) ?> col-xs-12">
				        		<span>
				        			<?php 
				        			echo ( !empty( $value['title'] ) ?  esc_attr( $value['title'] ) : esc_html__( 'No Title', 'elegant-blocks' ) );
				        			?>
				        		</span>
				        		<span>
				        			<?php 
				        			echo absint( $progress ) . '%';
				        			?>
				        		</span>
				        		<div class="progress">
				          			<div 
				          			class="progress-bar wow bounceInLeft" 
				          			role="progressbar" 
				          			aria-valuenow="<?php echo absint( $progress ); ?>" 
				          			aria-valuemin="0" 
				          			aria-valuemax="100" 
				          			data-wow-duration="2s" data-wow-delay="0.3s" 
				          			data-animation="animated bounceInLeft" 
				          			style="width:<?php echo absint( $progress ); ?>%;background: <?php echo esc_attr( $color ); ?>">
				              		</div>
				            	</div>
				          	</div>

		        		 	<?php
		        		} ?>

			        </div>
			        
		        </div>

		        <?php 
		      	if( $shapeDividerBottom ){ ?>
			      	<div class="eb_shape_divider_wrapper">
						<img src="<?php echo esc_url( $selectedShapeDividerImageBottom ); ?>">
					</div>
					<?php 
				} ?>

		        <?php 
		      	if( $bgImageStatus ){
		      		echo '<div class="black-overlay"></div>';
		      	} ?>

	    	</div>  

    	</div>	

	</div>

	<style>

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
           	#<?php echo esc_attr( $id ); ?> .progress-list {
           		padding-top: <?php echo esc_attr( $tabletSpacingTop ); ?>px !important; 
           		padding-bottom: <?php echo esc_attr( $tabletSpacingBottom ); ?>px !important; 
           		padding-left: <?php echo esc_attr( $tabletSpacingLeft ); ?>px !important; 
           		padding-right: <?php echo esc_attr( $tabletSpacingRight ); ?>px !important;
           	}
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
            #<?php echo esc_attr( $id ); ?> .progress-list {
           		padding-top: <?php echo esc_attr( $mobileSpacingTop ); ?>px !important; 
           		padding-bottom: <?php echo esc_attr( $mobileSpacingBottom ); ?>px !important; 
           		padding-left: <?php echo esc_attr( $mobileSpacingLeft ); ?>px !important; 
           		padding-right: <?php echo esc_attr( $mobileSpacingRight ); ?>px !important;
           	}
        }

		#<?php echo esc_attr( $id ); ?> .progress-inner > div > .progress{
			height: <?php echo absint( $height ); ?>px;
			border-radius: <?php echo esc_attr( $border_radius ? '30px' : '0px' ); ?>
		}
		
		#<?php echo esc_attr( $id ); ?> .progress_bar_title_desc > h2:after{
			border-color: <?php echo esc_attr( $separatorColor ); ?>;
		}

		<?php 
    	if( $bgImageStatus ){ ?>

    		#<?php echo esc_attr( $id ); ?> .black-overlay, 
    		#<?php echo esc_attr( $id ); ?> .white-overlay, 
    		#<?php echo esc_attr( $id ); ?> .blue-overlay, 
    		#<?php echo esc_attr( $id ); ?> .navy-overlay{
    			background: <?php echo esc_attr( $bgOverlay ) ?>;
    		}

    		#<?php echo esc_attr( $id ); ?> .progress-list, 
			#<?php echo esc_attr( $id ); ?> .progress-list1 {
    			background: url( <?php elegant_blocks_get_bg_image( $bgImageID ); ?> ) no-repeat;
    		}

    		<?php 

    	} else { ?>

    		#<?php echo esc_attr( $id ); ?> .progress-list, 
			#<?php echo esc_attr( $id ); ?> .progress-list1{
				background: <?php echo esc_attr( $background_color ); ?>;
			}

    		<?php
    	} ?>

	</style>

	<?php

	return ob_get_clean();

}