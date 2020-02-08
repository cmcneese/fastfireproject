<?php

function elegant_blocks_class( $layout ){

	switch ( $layout ) {

		case '2':
			return 'col-md-6';
			break;

		case '3':
			return 'col-md-4';
			break;

		case '4':
			return 'col-md-3';
			break;

		default:
			return 'col-md-2';
			break;
	}

}

function elegant_blocks_render_clients( $attributes ){

	$selectedClientCatID = !empty( $attributes['selectedClientCatID'] ) ? $attributes['selectedClientCatID'] : '0';
	$style = !empty( $attributes['style'] ) ? $attributes['style'] : '1';
	$layout = !empty( $attributes['layout'] ) ? $attributes['layout'] : '2';
	$disableArrow = !empty( $attributes['disableArrow'] ) ? true : false;
	$disableDots = !empty( $attributes['disableDots'] ) ? true : false;
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Color
	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#fff';

	// Title
	$title = !empty( $attributes['title'] ) ? $attributes['title'] : '';
	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? $attributes['mainTitleTextTransform'] : 'uppercase';
	$mainTitleColor = !empty( $attributes['mainTitleColor'] ) ? $attributes['mainTitleColor'] : '#000';

	// Subtitle
	$subtitle = !empty( $attributes['subtitle'] ) ? $attributes['subtitle'] : '';
	$subTitleColor = !empty( $attributes['subTitleColor'] ) ? $attributes['subTitleColor'] : '#000';

	// Separator
	$separatorColor = !empty( $attributes['separatorColor'] ) ? $attributes['separatorColor'] : '#0dbae8';

	// Desktop Spacing
	$paddingTop = !empty( $attributes['paddingTop'] ) ? $attributes['paddingTop'] : '50';
	$paddingBottom = !empty( $attributes['paddingBottom'] ) ? $attributes['paddingBottom'] : '40';
	$paddingLeft = !empty( $attributes['paddingLeft'] ) ? $attributes['paddingLeft'] : '0';
	$paddingRight = !empty( $attributes['paddingRight'] ) ? $attributes['paddingRight'] : '0';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : '25';
	$tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : '25';
	$tabletSpacingLeft = !empty( $attributes['tabletSpacingLeft'] ) ? $attributes['tabletSpacingLeft'] : '0';
	$tabletSpacingRight = !empty( $attributes['tabletSpacingRight'] ) ? $attributes['tabletSpacingRight'] : '0';

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : '20';
	$mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : '5';
	$mobileSpacingLeft = !empty( $attributes['mobileSpacingLeft'] ) ? $attributes['mobileSpacingLeft'] : '0';
	$mobileSpacingRight = !empty( $attributes['mobileSpacingRight'] ) ? $attributes['mobileSpacingRight'] : '0';

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_client_' . $rand;

	ob_start(); ?>	

	<div 
	id="<?php echo esc_attr( $id ); ?>"
	class="<?php echo esc_attr( $className ); ?> partner-main <?php echo esc_attr( 'eb_client_style_' . $style ); ?>">
      	<div 
      	style="background: <?php echo esc_attr( $backgroundColor ); ?>; padding-top: <?php echo esc_attr( $paddingTop ); ?>px; padding-bottom: <?php echo esc_attr( $paddingBottom ); ?>px; padding-left: <?php echo esc_attr( $paddingLeft ); ?>px; padding-right: <?php echo esc_attr( $paddingRight ); ?>px;" 
      	class="partner-list">

      		<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

	      		<?php 
	      		if( !empty( $title ) || !empty( $subtitle ) ){ ?>
		            <div class="row text-center">
		              	<div class="col-md-12">
		                  	<div class="clients_title_desc">
								
								<?php 
								if( !empty( $title ) ){ ?>
									<h2 
									style="text-transform:<?php echo esc_attr( $mainTitleTextTransform ); ?>; color: <?php echo esc_attr( $mainTitleColor ); ?>;">
										<?php echo esc_html( $title ); ?>			
									</h2>
									<?php 
								}

								if( !empty( $subtitle ) ){ ?>
									<p 
									style="color: <?php echo esc_attr( $subTitleColor ); ?>">
										<?php echo esc_html( $subtitle ); ?>		
									</p>
									<?php 
								} ?>

							</div>
		              	</div>
		            </div>
	            	<?php 
	            }

	            $args = array(
	            	'post_type' => 'eb_clients',
	            	'post_status' => 'publish',
	            	'posts_per_page' => -1,
	            	'tax_query' => array(
						array(
							'taxonomy' => 'client_cat',
							'field'    => 'term_id',
							'terms'    => $selectedClientCatID,
						),
					)
	            ); 

	            $clients_query = new WP_Query( $args );

	            if( $clients_query->have_posts() ): ?>

	            	<div class="row partner-item">

		            	<?php
		            	while( $clients_query->have_posts() ): $clients_query->the_post();

		            		global $post;
		            		$link = get_post_meta( $post->ID, 'link', true ); ?>

		            		<div class="<?php echo esc_attr( elegant_blocks_class( $layout ) ); ?>">
			                	<div class="partner-list">
			                    	<a 
			                    	href="<?php echo esc_url( !empty($link) ? $link : '#' ); ?>" 
			                    	<?php echo ( !empty( $link ) ? 'target="_blank"' : '' ); ?>>
			                    		<?php 
			                    		if( has_post_thumbnail() ){
			                    			the_post_thumbnail();	
			                    		}
			                    		?>
			                    	</a>
			                	</div>
			              	</div>

		            		<?php
		            	endwhile; ?>

	            	</div>

	            	<?php
	            endif;

	            ?>	

            </div>
            	
      	</div>

  	</div>

	<script>
	jQuery(document).ready(function(){
		jQuery( "#<?php echo esc_attr( $id ); ?>" + ' .partner-item').slick({
	      	infinite: true,
	      	autoplay: true,
	      	arrows: <?php echo ( $disableArrow ? 'false' : 'true' ); ?>,
	      	dots: <?php echo ( $disableDots ? 'false' : 'true' ); ?>,
	      	slidesToShow: <?php echo absint( $layout ); ?>,
	      	slidesToScroll: 1,
	      	responsive: [
	        	{
	          		breakpoint: 640,
	          		settings: {
	            		slidesToShow: 3,
	            		slidesToScroll: 1,
	            		infinite: true,
	          		}
	        	},
	        	{
	          		breakpoint: 480,
	          		settings: {
	            		slidesToShow: 1,
	            		slidesToScroll: 1,
	            		infinite: true,
	          		}
	        	}
	        ]
	    });	
	});		
	</script>

	<style>
		#<?php echo esc_attr( $id ); ?> .clients_title_desc h2:after{
			border-color: <?php echo esc_attr( $separatorColor ); ?>;
		}

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

            #<?php echo esc_attr( $id ); ?> .partner-list {
                margin-top: <?php echo absint( $tabletSpacingTop ); ?>px !important;
                margin-bottom: <?php echo absint( $tabletSpacingBottom ); ?>px !important;
                margin-left: <?php echo absint( $tabletSpacingLeft ); ?>px !important;
                margin-right: <?php echo absint( $tabletSpacingRight ); ?>px !important;
            }

        } 

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {

        	#<?php echo esc_attr( $id ); ?> .partner-list {
                margin-top: <?php echo absint( $mobileSpacingTop ); ?>px !important;
                margin-bottom: <?php echo absint( $mobileSpacingBottom ); ?>px !important;
                margin-left: <?php echo absint( $mobileSpacingLeft ); ?>px !important;
                margin-right: <?php echo absint( $mobileSpacingRight ); ?>px !important;
            }

        }

	</style>

	<?php
	return ob_get_clean();

}