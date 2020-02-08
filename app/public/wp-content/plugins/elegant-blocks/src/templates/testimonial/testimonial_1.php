<?php

function elegant_blocks_testimonials_layout($layout){

	if( !empty( $layout ) && is_numeric($layout) ){
		return 'mb_testimonials_style_' . absint( $layout );
	}

	return false;

}

function elegant_blocks_render_testimonial_1( $attributes ){

	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	$selectedTestimonialCategoryID = !empty( $attributes['selectedTestimonialCategoryID'] ) ? absint( $attributes['selectedTestimonialCategoryID'] ) : 0;
	$companyColor = !empty( $attributes['companyColor'] ) ? $attributes['companyColor'] : '#feb600';
	$ratingColor = !empty( $attributes['ratingColor'] ) ? $attributes['ratingColor'] : '#feb600';
	$testimonialColor = !empty( $attributes['testimonialColor'] ) ? $attributes['testimonialColor'] : '#feb600';
	$layout = !empty( $attributes['layout'] ) ? absint( $attributes['layout'] ) : 1;
	$columns = !empty( $attributes['columns'] ) ? absint( $attributes['columns'] ) : 1;
	$disable_autoplay = !empty( $attributes['disable_autoplay'] ) ? true : false;

	// Title
	$testimonialTitle = !empty( $attributes['testimonialTitle'] ) ? $attributes['testimonialTitle'] : '';
	$titleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#333';
	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? $attributes['mainTitleTextTransform'] : 'uppercase';

	// Subtitle
	$subtitleColor = !empty( $attributes['subtitleColor'] ) ? $attributes['subtitleColor'] : '#333';
	$testimonialSubTitle = !empty( $attributes['testimonialSubTitle'] ) ? $attributes['testimonialSubTitle'] : '';

	// Author
	$authorTextTransform = !empty( $attributes['authorTextTransform'] ) ? $attributes['authorTextTransform'] : 'capitalize';

	// Company / Position
	$com_position_color = !empty( $attributes['com_position_color'] ) ? $attributes['com_position_color'] : '#333';
	$hideCompanyPosition = !empty( $attributes['hideCompanyPosition'] ) ? true : false; 
	$com_positionTextTransform = !empty( $attributes['com_positionTextTransform'] ) ? $attributes['com_positionTextTransform'] : 'uppercase';

	// Desktop Spacing
	$paddingTop = !empty( $attributes['paddingTop'] ) ? $attributes['paddingTop'] : '50';
	$paddingBottom = !empty( $attributes['paddingBottom'] ) ? $attributes['paddingBottom'] : '50';
	$paddingLeft = !empty( $attributes['paddingLeft'] ) ? $attributes['paddingLeft'] : '140';
	$paddingRight = !empty( $attributes['paddingRight'] ) ? $attributes['paddingRight'] : '140';

	// Tablet Spacing
	$tabletPaddingTop = !empty( $attributes['tabletPaddingTop'] ) ? $attributes['tabletPaddingTop'] : '50';
	$tabletPaddingBottom = !empty( $attributes['tabletPaddingBottom'] ) ? $attributes['tabletPaddingBottom'] : '50';
	$tabletPaddingLeft = !empty( $attributes['tabletPaddingLeft'] ) ? $attributes['tabletPaddingLeft'] : '1';
	$tabletPaddingRight = !empty( $attributes['tabletPaddingRight'] ) ? $attributes['tabletPaddingRight'] : '1';

	// Mobile Spacing
	$mobilePaddingTop = !empty( $attributes['mobilePaddingTop'] ) ? $attributes['mobilePaddingTop'] : '50';
	$mobilePaddingBottom = !empty( $attributes['mobilePaddingBottom'] ) ? $attributes['mobilePaddingBottom'] : '50';
	$mobilePaddingLeft = !empty( $attributes['mobilePaddingLeft'] ) ? $attributes['mobilePaddingLeft'] : '1';
	$mobilePaddingRight = !empty( $attributes['mobilePaddingRight'] ) ? $attributes['mobilePaddingRight'] : '1';

	// Social Icons Settings
	$iconFullCircle = !empty( $attributes['iconFullCircle'] ) ? true : false;
	$iconBackgroundColor = !empty( $attributes['iconBackgroundColor'] ) ? $attributes['iconBackgroundColor'] : '#777';
	$iconFontColor = !empty( $attributes['iconFontColor'] ) ? $attributes['iconFontColor'] : '#fff';

	$args = array(
		'post_type' => 'ct_testimonials',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'ct_testimonial_category',
				'field'    => 'term_id',
				'terms'    => $selectedTestimonialCategoryID,
			),
		)
	); 

	$count = 0;

	$testimonial_query = new WP_Query( $args );
	$content = '';
	$default_img = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/team_01.png'; 
	$random_number = wp_generate_password( 12, false, false );
	$id = 'testimonial_1_' . $random_number;

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	ob_start();

	if( $testimonial_query->have_posts() ): ?>

		<div 
		style="padding-top: <?php echo esc_attr( $paddingTop ); ?>px;padding-bottom: <?php echo esc_attr( $paddingBottom ); ?>px;padding-left: <?php echo esc_attr( $paddingLeft ); ?>px;padding-right:  <?php echo esc_attr( $paddingRight ); ?>px;" 
		class="testimonial-list <?php echo esc_attr( elegant_blocks_testimonials_layout($layout) ) . ' ' . 'mb_testimonial_col_' . $columns . ' ' . esc_attr( $className ); ?>" 
		id="<?php echo esc_attr( $id ); ?>">
          	<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

            	<div class="row text-center">

              		<div class="col-md-12">

              			<?php 
                  		if( !empty( sanitize_text_field( $testimonialTitle ) ) || !empty( sanitize_text_field( $testimonialSubTitle ) ) ){ ?>

	                  		<div class="title mar-bottom-40 col-md-8 testimonial_title_desc_wrapper">

	                  			<?php 
	                  			if( !empty( sanitize_text_field( $testimonialTitle ) ) ){ ?>
		                      		<h2 
		                      		style="text-transform: <?php echo esc_attr( $mainTitleTextTransform ); ?>; color: <?php echo esc_attr( $titleColor ); ?>">
		                      			<?php echo esc_html( $testimonialTitle ); ?>
		                      		</h2>                      		
	                      			<?php
	                      		}

	                      		if( !empty( sanitize_text_field( $testimonialSubTitle ) ) ){ ?>
	                      			<p style="color: <?php echo esc_attr( $subtitleColor ); ?>"><?php echo esc_html( $testimonialSubTitle ); ?></p>
	                      			<?php 
	                      		}?>

	                  		</div>

	                  		<?php 
	                  	} ?>

              		</div>

            	</div>
            	
            	<div class="row testi-item1">

            		<?php
					while( $testimonial_query->have_posts() ): $testimonial_query->the_post(); 

						global $post;
						$position = get_post_meta( $post->ID, 'position', true );
						$rating = get_post_meta( $post->ID, 'rating', true );

						$fb_link = get_post_meta( $post->ID, 'fb_link', true );
						$tw_link = get_post_meta( $post->ID, 'tw_link', true );
						$ig_link = get_post_meta( $post->ID, 'ig_link', true ); 
						$lk_link = get_post_meta( $post->ID, 'lk_link', true ); ?>

	              		<div class="col-md-12">
	                		<div class="testimonial-inner1">
	                    		<p class="client-text mar-bottom-20 text-center">
	                    			<?php echo sanitize_text_field( get_the_content() ); ?>
	                    		</p>
			                    <div class="client-info1 text-center">
			                        <div class="client-img">
			                            <?php 
										if( has_post_thumbnail() ){
											the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) );
										} else {
											echo '<img src="' . esc_url( $default_img ) . '" />';
										}
										?>
			                        </div>
			                        <div class="client-name">

			                            <h4 
			                            class="green" 
			                            style="text-transform: <?php echo esc_attr( $authorTextTransform ); ?> ; color: <?php echo esc_attr( $companyColor ); ?>">
			                            	<?php the_title(); ?>
			                            </h4>

			                            <?php 
										if( empty( $hideCompanyPosition ) ){ ?>
											<p 
											class="mar-0" 
											style="text-transform: <?php echo esc_attr( $com_positionTextTransform ); ?> ; color: <?php echo esc_attr( $com_position_color ); ?>"><?php echo esc_attr( $position ); ?></p>
											<?php 
										} ?>

										<?php 
										if( !empty( $rating ) ){ 
											$rating_count = 0; ?>
											<ul class="testimonial_rating">

												<?php 
												for ($i=0; $i < $rating; $i++) { ?>

													<li><i class="fa fa-star" style="color: <?php echo esc_attr( $ratingColor ); ?>"></i></li>
													
												 	<?php
												 	$rating_count++;
												} 

												$remaining_rating = 5 - $rating_count;

												for ($i=0; $i < $remaining_rating; $i++) { ?>
													<li><i class="fa fa-star-o" style="color: <?php echo esc_attr( $ratingColor ); ?>"></i></li>
												 	<?php
												} ?>
												
												
											</ul>
											<?php 
										}

										if( !empty( $fb_link ) || !empty( $tw_link ) || !empty( $ig_link ) || !empty( $lk_link ) ){ ?>

											<div class="mb_testimonial_social_link">

					                        	<?php 
					                        	if( !empty( $fb_link ) ){ ?>
						                        	<a style="border-radius: <?php echo ( $iconFullCircle == true ? '50%' : 'inherit' ); ?>" 
						                        	href="<?php echo esc_url( $fb_link ); ?>" 
						                        	target="_blank">
						                        		<i class="fab fa-facebook-f"></i>
						                        	</a>
					                        		<?php 
					                        	} 

					                        	if( !empty( $tw_link ) ){ ?>
						                        	<a style="border-radius: <?php echo ( $iconFullCircle == true ? '50%' : 'inherit' ); ?>" 
						                        		href="<?php echo esc_url( $tw_link ); ?>" target="_blank">
						                        		<i class="fab fa-twitter"></i>
						                        	</a>
						                        	<?php 
						                        } 

						                        if( !empty( $ig_link ) ){ ?>
						                        	<a style="border-radius: <?php echo ( $iconFullCircle == true ? '50%' : 'inherit' ); ?>" 
						                        		href="<?php echo esc_url( $ig_link ); ?>" target="_blank">
						                        		<i class="fab fa-instagram"></i>
						                        	</a>
						                        	<?php 
						                        }

						                        if( !empty( $lk_link ) ){ ?>
					                        		<a style="border-radius: <?php echo ( $iconFullCircle == true ? '50%' : 'inherit' ); ?>" 
					                        			href="<?php echo esc_url( $lk_link ); ?>" target="_blank">
					                        			<i class="fab fa-linkedin-in"></i>
					                        		</a>
					                        		<?php 
					                        	} ?>
					                        	
					                        </div>

					                        <?php 
					                    } ?>

			                        </div>
			                    </div>
	                		</div>
	              		</div>

              			<?php

	              	endwhile;?>

            	</div>
          	</div>
      	</div>

		<style>

			#<?php echo esc_attr( $id ); ?> .testimonial_title_desc_wrapper h2:after,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_3 .testimonial-inner1 .client-text,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_3 .testimonial-inner1 .client-text:after,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .testimonial-inner1 .client-text{
				border-color: <?php echo esc_attr( $testimonialColor ); ?>;
			}

			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .client-info1.text-center {
				background: <?php echo esc_attr( $testimonialColor ); ?>;
			}

			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .testimonial-inner1{
				border-color: <?php echo esc_attr( $testimonialColor ); ?>;
			}

			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_1 .testimonial-inner1 p.client-text:before,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_3 .testimonial-inner1 p.client-text:before,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_4 .testimonial-inner1 p.client-text:before,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_5 .testimonial-inner1 p.client-text:before,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .testimonial-inner1 p.client-text:before{
				color: <?php echo esc_attr( $testimonialColor ); ?>;
			}

			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_1 .mb_testimonial_social_link a,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .mb_testimonial_social_link a,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_3 .mb_testimonial_social_link a,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_4 .mb_testimonial_social_link a,
			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_5 .mb_testimonial_social_link a{
				background: <?php echo esc_attr( $iconBackgroundColor ); ?>;
			}

			#<?php echo esc_attr( $id ); ?>.mb_testimonials_style_2 .mb_testimonial_social_link a{
				color: <?php echo esc_attr( $iconFontColor ); ?>;
			}

			/* 
	          ##Device = Tablets, Ipads (portrait)
	        */    

	        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	            #<?php echo esc_attr( $id ); ?>{
	                padding-top: <?php echo absint( $tabletPaddingTop ); ?>px !important;
	                padding-bottom: <?php echo absint( $tabletPaddingBottom ); ?>px !important;
	                padding-left: <?php echo absint( $tabletPaddingLeft ); ?>px !important;
	                padding-right: <?php echo absint( $tabletPaddingRight ); ?>px !important;
	            }
	        }

	        /* 
	          ##Device = Most of the Smartphones Mobiles (Portrait)
	        */

	        @media (min-width: 300px) and (max-width: 767px) {
	            #<?php echo esc_attr( $id ); ?>{
	                padding-top: <?php echo absint( $mobilePaddingTop ); ?>px !important;
	                padding-bottom: <?php echo absint( $mobilePaddingBottom ); ?>px !important;
	                padding-left: <?php echo absint( $mobilePaddingLeft ); ?>px !important;
	                padding-right: <?php echo absint( $mobilePaddingRight ); ?>px !important;
	            }
	        }

		</style>

		<script>
			jQuery( document ).ready(function(){

				/**
				* Slick for testimonials
				*/

				var id = "#<?php echo esc_attr( $id ); ?>" + ' .testi-item1';

				jQuery(id).slick({
				  	infinite: true,
				  	autoplay: <?php echo ( !empty( $disable_autoplay ) ? 'false' : 'true' ); ?>,
				  	arrows: false,
				  	dots: true,
				  	slidesToShow: <?php echo absint( $columns ); ?>,
				  	slidesToScroll: 1,
					  responsive: [
					    {
					      breakpoint: 767,
					      settings: {
					        slidesToShow: 1,
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
			})
		</script>

		<?php	

	endif;

	$content = ob_get_clean();
	return $content;

}

function elegant_blocks_hexToRgb( $hex, $alpha = false ) {
   	$hex      = str_replace('#', '', $hex);
   	$length   = strlen($hex);
   	$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
   	$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
   	$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
   	if ( $alpha ) {
      	$rgb['a'] = $alpha;
   	}
   	return 'rgba(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ', ' . $rgb['a'] . ')';
}