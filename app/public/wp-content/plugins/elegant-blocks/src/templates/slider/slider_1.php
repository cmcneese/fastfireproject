<?php

function elegant_blocks_slider_1_title( $title , $titleColor ){

	if( empty( $title ) ){
		return $title;
	}

	$pageTitle = $title;
  	$pageTitleArr = explode(' ', $pageTitle);
 	$firstPart = '<span style="color:' . $titleColor . '">' . $pageTitleArr[0] . '</span>';
  	$pageTitleArr[0] = $firstPart;
  	return implode(' ', $pageTitleArr);

}

function elegant_blocks_slider_layout( $layout ){

	switch ( $layout ) {

		case '5':
			return 'mb_slider_5';
			break;

		case '2':
			return 'mb_slider_2';
			break;

		case '3':
			return 'mb_slider_3';
			break;

		case '4':
			return 'mb_slider_4';
			break;
		
		default:
			return 'mb_slider_1';
			break;
	}

}

function elegant_blocks_get_data_n_category( $layout , $post_id , $animation, $margin_top, $margin_bottom ){

	if( $layout != 3 ){
		return false;
	} ?>

	<div 
	style="margin-top: <?php echo esc_attr( $margin_top ); ?>px;margin-bottom: <?php echo esc_attr( $margin_bottom ); ?>px;" 
	class="off date_category_wrapper animated_date_cat animated <?php echo esc_attr( $animation ); ?>">
		<p class="mb_slider_post_date">
			<i class="fa fa-calendar"></i>
			<?php echo esc_html( get_the_date( 'd M, Y', $post_id ) ); ?> 
		</p>
		<?php 
		$cat = get_the_terms( $post_id, 'ct_slider_category' );
		if( !empty( $cat[0]->name ) ){
			echo '<p class="mb_slider_post_cat"><i class="fa fa-folder"></i>' . esc_html( $cat[0]->name ) . '</p>';
		}
		?>
	</div>

	<?php
}

function elegant_blocks_layout_3_animation( $layout , $animation ){

	if( $layout != 3 ){
		return false;
	}

	return 'off animated_box animated ' . $animation;

}

function elegant_blocks_render_slider_1( $attribute ){

	$className = !empty( $attribute['className'] ) ? $attribute['className'] : ''; 

	/**
	* Spacing Title
	*/

	$tabletTitleMarginTop = !empty( $attribute['tabletTitleMarginTop'] ) ? $attribute['tabletTitleMarginTop'] : '0';
	$tabletTitleMarginBottom = !empty( $attribute['tabletTitleMarginBottom'] ) ? $attribute['tabletTitleMarginBottom'] : '0';

	$mobileTitleMarginTop = !empty( $attribute['mobileTitleMarginTop'] ) ? $attribute['mobileTitleMarginTop'] : '0';
	$mobileTitleMarginBottom = !empty( $attribute['mobileTitleMarginBottom'] ) ? $attribute['mobileTitleMarginBottom'] : '0';

	/**
	* Spacing Subtitle
	*/

	$tabletSubtitleMarginTop = !empty( $attribute['tabletSubtitleMarginTop'] ) ? $attribute['tabletSubtitleMarginTop'] : '0';
	$tabletSubtitleMarginBottom = !empty( $attribute['tabletSubtitleMarginBottom'] ) ? $attribute['tabletSubtitleMarginBottom'] : '0';

	$mobileSubtitleMarginTop = !empty( $attribute['mobileSubtitleMarginTop'] ) ? $attribute['mobileSubtitleMarginTop'] : '0';
	$mobileSubtitleMarginBottom = !empty( $attribute['mobileSubtitleMarginBottom'] ) ? $attribute['mobileSubtitleMarginBottom'] : '0';

	/**
	* Shape Divider Options
	*/

	$shapeDividerBottom = !empty( $attribute['shapeDividerBottom'] ) ? true : false;
	$selectedShapeDividerImageBottom = !empty( $attribute['selectedShapeDividerImageBottom'] ) ? $attribute['selectedShapeDividerImageBottom'] : '';

	$shapeDividerTop = !empty( $attribute['shapeDividerTop'] ) ? true : false;
	$selectedShapeDividerImageTop = !empty( $attribute['selectedShapeDividerImageTop'] ) ? $attribute['selectedShapeDividerImageTop'] : '';

	/**
	* Slider Other Options
	*/

	$sliderInterval = !empty( $attribute['sliderInterval'] ) ? $attribute['sliderInterval'] : 10000;
	$slideDuration = !empty( $attribute['slideDuration'] ) ? $attribute['slideDuration'] : 3000;
	$sliderStyle = ( !empty( $attribute['sliderStyle'] ) && $attribute['sliderStyle'] == 'vertical' ) ? 'vertical' : 'horizontal';
	$sliderPaginationPosition = ( !empty( $attribute['sliderPaginationPosition'] ) ) ? $attribute['sliderPaginationPosition'] : 'both';

	$selectedSliderCategoryID = !empty( $attribute['selectedSliderCategoryID'] ) ? $attribute['selectedSliderCategoryID'] : '';

	$sliderColor = !empty( $attribute['sliderColor'] ) ? $attribute['sliderColor'] : '#f04d4e';
	$sliderLayout = !empty( $attribute['sliderLayout'] ) ? absint( $attribute['sliderLayout'] ) : '1';
	$autoplay = !empty( $attribute['autoplay'] ) ? 'false' : 'true';

	/**
	* For Title
	*/

	$titleAnimationStyle = !empty( $attribute['titleAnimationStyle'] ) ? $attribute['titleAnimationStyle'] : 'fadeInLeft';
	$titleAnimationDelay = !empty( $attribute['titleAnimationDelay'] ) ? $attribute['titleAnimationDelay'] : '.5s';
	$titleFontSize = !empty( $attribute['titleFontSize'] ) ? absint( $attribute['titleFontSize'] ) : 70;
	$titleMarginTop = !empty( $attribute['titleMarginTop'] ) ? $attribute['titleMarginTop'] : 0;
	
	$titleFontFamily = !empty( $attribute['titleFontFamily'] ) ? explode( ',' , $attribute['titleFontFamily'] ) : '';

	$titleMarginBottom = 20;

	if( array_key_exists( 'titleMarginBottom', $attribute ) ){			
		$titleMarginBottom = !empty( $attribute['titleMarginBottom'] ) || $attribute['titleMarginBottom'] == '0' ? absint( $attribute['titleMarginBottom'] ) : 20;
	}

	/**
	* For Subtitle
	*/

	$subtitleAnimationStyle = !empty( $attribute['subtitleAnimationStyle'] ) ? $attribute['subtitleAnimationStyle'] : 'fadeInRight';
	$subTitleAnimationDelay = !empty( $attribute['subTitleAnimationDelay'] ) ? $attribute['subTitleAnimationDelay'] : '1s';
	$subtitleMarginTop = !empty( $attribute['subtitleMarginTop'] ) ? absint( $attribute['subtitleMarginTop'] ) : 0;
	$subtitleMarginBottom = 40;
	$subtitleFontFamily = !empty( $attribute['subtitleFontFamily'] ) ? explode( ',' , $attribute['subtitleFontFamily'] ) : '';

	if( array_key_exists( 'subtitleMarginBottom', $attribute ) ){	
		$subtitleMarginBottom = !empty( $attribute['subtitleMarginBottom'] ) || $attribute['subtitleMarginBottom'] == '0' ? absint( $attribute['subtitleMarginBottom'] ) : 40;
	}
	
	/**
	* For Read More
	*/

	$readMoreStatus = !empty( $attribute['readMoreStatus'] ) ? true : false;
	$readMoreLabel = !empty( $attribute['readMoreLabel'] ) ? $attribute['readMoreLabel'] : esc_html__( 'Read More', 'elegant-blocks' );
	$readMoreHoverBackground = !empty( $attribute['readMoreHoverBackground'] ) ? $attribute['readMoreHoverBackground'] : '#f04d4e';
	$readMoreAnimationStyle = !empty( $attribute['readMoreAnimationStyle'] ) ? $attribute['readMoreAnimationStyle'] : 'fadeInUp';
	$readMoreAnimationDelay = !empty( $attribute['readMoreAnimationDelay'] ) ? $attribute['readMoreAnimationDelay'] : '.5s';
	$readMoreColor = !empty( $attribute['readMoreColor'] ) ? $attribute['readMoreColor'] : '#fff';
	$readMoreBorderRadius = !empty( $attribute['readMoreBorderRadius'] ) ? absint( $attribute['readMoreBorderRadius'] ) : '0';

	/**
	* Layout 3
	*/

	$layout_3_box_animation = !empty( $attribute['layout_3_box_animation'] ) ? $attribute['layout_3_box_animation'] : 'fadeInUp';
	$layout_3_date_cat_animation = !empty( $attribute['layout_3_date_cat_animation'] ) ? $attribute['layout_3_date_cat_animation'] : 'fadeInUp';
	$dateCatAnimationDelay = !empty( $attribute['dateCatAnimationDelay'] ) ? $attribute['dateCatAnimationDelay'] : '.5s';
	$dateMarginTop = !empty( $attribute['dateMarginTop'] ) ? $attribute['dateMarginTop'] : 0;
	$dateMarginBottom = !empty( $attribute['dateMarginBottom'] ) ? $attribute['dateMarginBottom'] : 0;

	/**
	* Background Overlay
	*/

	$backgroundOverlayStatus = empty( $attribute['backgroundOverlayStatus'] ) ? true : false;
	$bgOverlayPrimaryColor = !empty( $attribute['bgOverlayPrimaryColor'] ) ? $attribute['bgOverlayPrimaryColor'] : 'rgba(0,0,0,0.6)';
	$bgOverlaySecondaryColor = !empty( $attribute['bgOverlaySecondaryColor'] ) ? $attribute['bgOverlaySecondaryColor'] : 'rgba(0,0,0,0.6)';

	if( $backgroundOverlayStatus == false ){
		$bgOverlayPrimaryColor = 'rgba(0,0,0,0)';
		$bgOverlaySecondaryColor = 'rgba(0,0,0,0)';
	}

	$args = array(
		'post_type' => 'ct_slider',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'ct_slider_category',
				'field'    => 'term_id',
				'terms'    => $selectedSliderCategoryID,
			),
		)
	); 

	$content = '';
	$default_img = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/fw_al_001_01.jpg';
	$random_text = wp_generate_password( 12, false, false );
	$sider_query = new WP_Query( $args );
	$sliderID = 'slider_1_' . $random_text;

	ob_start();

	if( $sider_query->have_posts() ): ?>

		<div class="slider-main <?php echo esc_attr( elegant_blocks_slider_layout( $sliderLayout ) ) . ' ' . esc_attr( $className ); ?>">

			<?php 
	      	if( $shapeDividerTop ){ ?>
		      	<div class="eb_shape_divider_wrapper top">
					<img src="<?php echo esc_url( $selectedShapeDividerImageTop ); ?>">
				</div>
				<?php 
			} ?>

      		<div class="slider-list slider-item" id="<?php echo esc_attr( $sliderID ); ?>">

      			<?php 
				while( $sider_query->have_posts() ): $sider_query->the_post();

					global $post;

					// Custom Button Link
					$button_link = get_post_meta( $post->ID, 'button_link', true ); ?>

	        		<div class="s-item">
	          			<?php 
						if( has_post_thumbnail() ){
							the_post_thumbnail( 'elegant_blocks_slider_1', array( 'alt' => get_the_title() ) );
						} else {
							echo '<img src="' .esc_url( $default_img ). '" />';
						}
						?>

			          	<div class="s-caption <?php echo esc_attr( elegant_blocks_layout_3_animation( $sliderLayout , $layout_3_box_animation ) ); ?>">

			            	<h1 
			            	style="font-size: <?php echo absint( $titleFontSize ); ?>px;margin-top: <?php echo esc_attr( $titleMarginTop ); ?>px;margin-bottom: <?php echo absint( $titleMarginBottom ); ?>px" 
			            	class="white mar-bottom-20 animated1 animated off">
			            		<?php echo wp_kses_post( elegant_blocks_slider_1_title( get_the_title() , $sliderColor ) ); ?>
			            	</h1>

			            	<?php 
			            	elegant_blocks_get_data_n_category( 
			            		$sliderLayout, 
			            		$post->ID, 
			            		$layout_3_date_cat_animation,
			            		$dateMarginTop,
			            		$dateMarginBottom
			            	);
			            	?>

			            	<p 
			            	style="margin-top: <?php echo absint( $subtitleMarginTop ); ?>px;margin-bottom: <?php echo absint( $subtitleMarginBottom ); ?>px" 
			            	class="white mar-bottom-40 animated2 animated off slider_subtitle">
			            		<?php echo sanitize_text_field( get_the_content() ); ?>
			            	</p>

			            	<?php 
			            	if( $readMoreStatus == false ){ ?>
				            	<a 
				            	href="<?php echo ( !empty( $button_link ) ? esc_url( $button_link ) : get_permalink() ); ?>" 
				            	class="btn btn-white animated3 animated slider_read_more off"
				            	style="border-radius: <?php echo esc_attr( $readMoreBorderRadius ) ?>px;border-color:<?php echo esc_attr( $readMoreHoverBackground ); ?>;background:<?php echo esc_attr( $readMoreHoverBackground ); ?>;color: <?php echo esc_attr( $readMoreColor ); ?>">
				            		<?php echo esc_html( $readMoreLabel ); ?>
				            	</a>
				            	<?php 
				            } ?>

			          	</div>
	          			<div class="black-overlay"></div>
	        		</div>

	        		<?php 
				endwhile;?>
        
	      	</div>

	      	<?php 
	      	if( $shapeDividerBottom ){ ?>
		      	<div class="eb_shape_divider_wrapper">
					<img src="<?php echo esc_url( $selectedShapeDividerImageBottom ); ?>">
				</div>
				<?php 
			} ?>

	    </div>

    <script>
    	
    	jQuery(document).ready(function($){  

    		var slider_1 = '#slider_1_' + "<?php echo esc_attr( $random_text ); ?>";

		  	$(slider_1).on('init', function(event, slick){

		    	$( slider_1 + ' .animated1').addClass("<?php echo esc_attr( $titleAnimationStyle ) ?>");
		    	$( slider_1 + ' .animated2').addClass("<?php echo esc_attr( $subtitleAnimationStyle ) ?>");
		    	$( slider_1 + ' .animated3').addClass("<?php echo esc_attr( $readMoreAnimationStyle ) ?>");
		    	$( slider_1 + ' .animated_box').addClass("<?php echo esc_attr( $layout_3_box_animation ) ?>");
		    	$( slider_1 + ' .animated_date_cat').addClass("<?php echo esc_attr( $layout_3_date_cat_animation ) ?>");

		    	$( slider_1 + ' .animated1').removeClass('off');
		    	$( slider_1 + ' .animated2').removeClass('off');
		    	$( slider_1 + ' .animated3').removeClass('off');
		    	$( slider_1 + ' .animated_box').removeClass('off');	
		    	$( slider_1 + ' .animated_date_cat').removeClass('off');	

		  	});   

		  	$(slider_1).slick({

		    	autoplay: <?php echo esc_attr( $autoplay ); ?>,
		    	autoplaySpeed: <?php echo absint( $sliderInterval ); ?>,
		    	pauseOnHover: true,
		    	dots:<?php echo ( ( $sliderPaginationPosition == 'dots' || $sliderPaginationPosition == 'both' ) ? 'true' : 'false' ); ?>,
		    	vertical: <?php echo esc_attr( $sliderStyle == 'vertical' ? 'true' : 'false' ); ?>,
		    	arrows: <?php echo ( ( $sliderPaginationPosition == 'arrow' || $sliderPaginationPosition == 'both' ) ? 'true' : 'false' ); ?>,
		    	speed:<?php echo absint( $slideDuration ); ?>,
		    	draggable:false,
		    	swipe: false,
				swipeToSlide: false,
				touchMove: false

		  	});     

		  	$(slider_1).on('afterChange', function(event, slick, currentSlide) {

		    	$(slider_1 +' .animated1').removeClass('off');
		    	$(slider_1 +' .animated1').addClass("<?php echo esc_attr( $titleAnimationStyle ) ?>");

		     	$(slider_1 +' .animated2').removeClass('off');
		    	$(slider_1 +' .animated2').addClass("<?php echo esc_attr( $subtitleAnimationStyle ) ?>");

		     	$(slider_1 +' .animated3').removeClass('off');
		    	$(slider_1 +' .animated3').addClass("<?php echo esc_attr( $readMoreAnimationStyle ) ?>");

		    	$(slider_1 +' .animated_box').removeClass('off');
		    	$(slider_1 +' .animated_box').addClass("<?php echo esc_attr( $layout_3_box_animation ) ?>");

		    	$(slider_1 +' .animated_date_cat').removeClass('off');
		    	$(slider_1 +' .animated_date_cat').addClass("<?php echo esc_attr( $layout_3_date_cat_animation ) ?>");

		  	});   

		  	$(slider_1).on('beforeChange', function(event, slick, currentSlide) {

		    	$(slider_1 +' .animated1').removeClass("<?php echo esc_attr( $titleAnimationStyle ) ?>");
		    	$(slider_1 +' .animated1').addClass('off');

		    	$(slider_1 +' .animated2').removeClass("<?php echo esc_attr( $subtitleAnimationStyle ) ?>");
		    	$(slider_1 +' .animated2').addClass('off');

		       	$(slider_1 +' .animated3').addClass('off');
		    	$(slider_1 +' .animated3').removeClass("<?php echo esc_attr( $readMoreAnimationStyle ) ?>");

		    	$(slider_1 +' .animated_box').addClass('off');
		    	$(slider_1 +' .animated_box').removeClass("<?php echo esc_attr( $layout_3_box_animation ) ?>");

		    	$(slider_1 +' .animated_date_cat').addClass('off');
		    	$(slider_1 +' .animated_date_cat').removeClass("<?php echo esc_attr( $layout_3_date_cat_animation ) ?>");

		  	});

		});

    </script>

    <style>

    	<?php 
    	// Title Font
    	if( !empty( $titleFontFamily ) ){ ?>

	    	@font-face {
			   font-family: "<?php echo esc_attr( $titleFontFamily[1] ) ?>";
			   src: url(<?php echo esc_attr( $titleFontFamily[0] ) ?>) format( 'truetype' );
			}
	    	#<?php echo esc_attr( $sliderID ); ?> h1{
	    		font-family: "<?php echo esc_attr( $titleFontFamily[1] ) ?>";
	    	}

	    	<?php 
	    } 

	    // Subtitle Font
    	if( !empty( $subtitleFontFamily ) ){ ?>

	    	@font-face {
			   font-family: "<?php echo esc_attr( $subtitleFontFamily[1] ) ?>";
			   src: url(<?php echo esc_attr( $subtitleFontFamily[0] ) ?>) format( 'truetype' );
			}
	    	#<?php echo esc_attr( $sliderID ); ?> .slider_subtitle{
	    		font-family: "<?php echo esc_attr( $subtitleFontFamily[1] ) ?>";
	    	}

	    	<?php 
	    } ?>

    	#<?php echo esc_attr( $sliderID ); ?> .black-overlay{
    		background: linear-gradient( to right, <?php echo esc_attr( $bgOverlayPrimaryColor ); ?> , <?php echo esc_attr( $bgOverlaySecondaryColor ); ?> );
    	}
    	#<?php echo esc_attr( $sliderID ); ?> .animated1 {
		  	animation-duration: 1s;
		  	animation-delay: <?php echo esc_attr( $titleAnimationDelay ) ?>;
		}
		#<?php echo esc_attr( $sliderID ); ?> .animated2 {
		  	animation-duration: 1.5s;
		  	animation-delay: <?php echo esc_attr( $subTitleAnimationDelay ) ?>;
		}
		#<?php echo esc_attr( $sliderID ); ?> .animated3 {
		  	animation-duration: 2s;
		  	animation-delay: <?php echo esc_attr( $readMoreAnimationDelay ) ?>;
		}
		#<?php echo esc_attr( $sliderID ); ?> .animated_date_cat {
		  	animation-duration: 1.5s;
		  	animation-delay: <?php echo esc_attr( $dateCatAnimationDelay ) ?>;
		}
		#<?php echo esc_attr( $sliderID ); ?>.slider-list .slick-prev:hover, 
		#<?php echo esc_attr( $sliderID ); ?>.slider-list .slick-next:hover {
		    background: <?php echo esc_attr( $sliderColor ); ?>;
		}
		#<?php echo esc_attr( $sliderID ); ?>.slider-list .slick-dots li.slick-active button:before{
			background: <?php echo esc_attr( $sliderColor ); ?>;
		}

		/**
		 * Responsive
		 */

		@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
		  	#<?php echo esc_attr( $sliderID ); ?> h1{
		  		margin-top : <?php echo esc_attr( $tabletTitleMarginTop ) ?>px !important;
		  		margin-bottom : <?php echo esc_attr( $tabletTitleMarginBottom ) ?>px !important;
		  	}
		}

		@media (min-width: 300px) and (max-width: 767px) {
			#<?php echo esc_attr( $sliderID ); ?> h1{
		  		margin-top : <?php echo esc_attr( $mobileTitleMarginTop ) ?>px !important;
		  		margin-bottom : <?php echo esc_attr( $mobileTitleMarginBottom ) ?>px !important;
		  	}
		}

		@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
		  	#<?php echo esc_attr( $sliderID ); ?> p.slider_subtitle {
		  		margin-top : <?php echo esc_attr( $tabletSubtitleMarginTop ) ?>px !important;
		  		margin-bottom : <?php echo esc_attr( $tabletSubtitleMarginBottom ) ?>px !important;
		  	}
		}

		@media (min-width: 300px) and (max-width: 767px) {
			#<?php echo esc_attr( $sliderID ); ?> p.slider_subtitle {
		  		margin-top : <?php echo esc_attr( $mobileSubtitleMarginTop ) ?>px !important;
		  		margin-bottom : <?php echo esc_attr( $mobileSubtitleMarginBottom ) ?>px !important;
		  	}
		}

    </style>

	<?php

	endif;

	$content = ob_get_clean();
	return $content;

}