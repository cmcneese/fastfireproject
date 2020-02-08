<?php

function elegant_blocks_services_col( $col ){

	switch ( $col ) {
		case '2':
			echo 'col-md-6 col-sm-6';
			break;
		
		default:
			echo 'col-md-4 col-sm-4';
			break;
	}

}

function elegant_blocks_style( $style ){

	if( !empty( $style ) && is_numeric( $style ) ){
		echo esc_attr( 'mb_services_style_' . $style );
	}

}

function elegant_blocks_render_services_1( $attributes ){

	$catID = !empty( $attributes['selectedServicesCategoryID'] ) ? absint( $attributes['selectedServicesCategoryID'] ) : '';
	$columns = !empty( $attributes['columns'] ) ? absint( $attributes['columns'] ) : '3';
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Title
	$serviceTitle = !empty( $attributes['serviceTitle'] ) ? sanitize_text_field( $attributes['serviceTitle'] ) : '';
	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? $attributes['mainTitleTextTransform'] : 'uppercase';
	$titleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#000';

	// Subtitle
	$serviceSubTitle = !empty( $attributes['serviceSubTitle'] ) ? sanitize_text_field( $attributes['serviceSubTitle'] ) : '';
	$subtitleColor = !empty( $attributes['subtitleColor'] ) ? $attributes['subtitleColor'] : '#000';

	// Separator
	$separatorColor = !empty( $attributes['separatorColor'] ) ? $attributes['separatorColor'] : '#000';

	// Desktop Spacing
	$paddingTop = !empty( $attributes['paddingTop'] ) ? $attributes['paddingTop'] : '50';
	$paddingBottom = !empty( $attributes['paddingBottom'] ) ? $attributes['paddingBottom'] : '10';
	$paddingLeft = !empty( $attributes['paddingLeft'] ) ? $attributes['paddingLeft'] : '0';
	$paddingRight = !empty( $attributes['paddingRight'] ) ? $attributes['paddingRight'] : '0';	

	// Tablet Spacing 
	$tabletPaddingTop = !empty( $attributes['tabletPaddingTop'] ) ? $attributes['tabletPaddingTop'] : '50';
	$tabletPaddingBottom = !empty( $attributes['tabletPaddingBottom'] ) ? $attributes['tabletPaddingBottom'] : '10';
	$tabletPaddingLeft = !empty( $attributes['tabletPaddingLeft'] ) ? $attributes['tabletPaddingLeft'] : '0';
	$tabletPaddingRight = !empty( $attributes['tabletPaddingRight'] ) ? $attributes['tabletPaddingRight'] : '0';

	// Mobile Spacing 
	$mobilePaddingTop = !empty( $attributes['mobilePaddingTop'] ) ? $attributes['mobilePaddingTop'] : '50';
	$mobilePaddingBottom = !empty( $attributes['mobilePaddingBottom'] ) ? $attributes['mobilePaddingBottom'] : '10';
	$mobilePaddingLeft = !empty( $attributes['mobilePaddingLeft'] ) ? $attributes['mobilePaddingLeft'] : '0';
	$mobilePaddingRight = !empty( $attributes['mobilePaddingRight'] ) ? $attributes['mobilePaddingRight'] : '0';	

	$serviceThemeColor = !empty( $attributes['serviceThemeColor'] ) ? $attributes['serviceThemeColor'] : '#06bbe487';
	$style = !empty( $attributes['style'] ) ? $attributes['style'] : '1';
	$clickable = !empty( $attributes['clickable'] ) ? true : false;

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$args = array(
		'post_type' => 'cp_services',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'services_cat',
				'field'    => 'term_id',
				'terms'    => $catID,
			),
		)
	);

	$rand = wp_generate_password( 20, false, false );
	$id = 'services_1_' . $rand;

	$services_query = new WP_Query( $args );

	ob_start(); 

	if( $services_query->have_posts() ): ?>

		<style>
			#<?php echo esc_attr( $id ); ?> .services_1_title_desc > h2:after{
				border-color: <?php echo esc_attr( $separatorColor ); ?>
			}

			<?php
			if( $style == 2 ){ ?>

				/* Style 2 */
				#<?php echo esc_attr( $id ); ?>.mb_services_style_2 .box{
					background: <?php echo esc_attr( $serviceThemeColor ); ?>;
					outline: <?php echo esc_attr( elegant_blocks_color_luminance( $serviceThemeColor , -10 ) ); ?> solid 2px;
				}
				#<?php echo esc_attr( $id ); ?>.mb_services_style_2 .box:hover{
					outline: <?php echo esc_attr( elegant_blocks_color_luminance( $serviceThemeColor , -10 ) ); ?> solid 6px;
				}

				<?php 

			} elseif( $style == 3 ){ ?>

				#<?php echo esc_attr( $id ); ?>.mb_services_style_3 .box .icon i{
					color: <?php echo esc_attr( $serviceThemeColor ); ?>;
				}

				#<?php echo esc_attr( $id ); ?>.mb_services_style_3 .box:hover:after, 
				#<?php echo esc_attr( $id ); ?>.mb_services_style_3 .box:hover:before {
					border-color: <?php echo esc_attr( $serviceThemeColor ); ?>;
				}

				<?php

			} elseif( $style == 4 ){ ?>

				#<?php echo esc_attr( $id ); ?>.mb_services_style_4 .box .icon i{
					color: <?php echo esc_attr( $serviceThemeColor ); ?>;
				}
				#<?php echo esc_attr( $id ); ?>.mb_services_style_4 .box:hover{
					border-color: <?php echo esc_attr( $serviceThemeColor ); ?>;
				}

				<?php
			} elseif( $style == 5 ){ ?>

				#<?php echo esc_attr( $id ); ?>.mb_services_style_5 .box .icon i{
					color: <?php echo esc_attr( elegant_blocks_color_luminance( $serviceThemeColor , -10 ) ); ?>;
				}
				#<?php echo esc_attr( $id ); ?>.mb_services_style_5 .box:hover .icon{
					background: <?php echo esc_attr( elegant_blocks_color_luminance( $serviceThemeColor , -10 ) ); ?> !important;
				}

				<?php 
			} ?>

			/**
			 * Responsive
			 */

			@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
			  	#<?php echo esc_attr( $id ); ?> .services-inner{
			  		padding-top : <?php echo esc_attr( $tabletPaddingTop ) ?>px !important;
			  		padding-bottom : <?php echo esc_attr( $tabletPaddingBottom ) ?>px !important;
			  		padding-left : <?php echo esc_attr( $tabletPaddingLeft ) ?>px !important;
			  		padding-right : <?php echo esc_attr( $tabletPaddingRight ) ?>px !important;
			  	}
			}

			@media (min-width: 300px) and (max-width: 767px) {
				#<?php echo esc_attr( $id ); ?> .services-inner{
			  		padding-top : <?php echo esc_attr( $mobilePaddingTop ) ?>px !important;
			  		padding-bottom : <?php echo esc_attr( $mobilePaddingBottom ) ?>px !important;
			  		padding-left : <?php echo esc_attr( $mobilePaddingLeft ) ?>px !important;
			  		padding-right : <?php echo esc_attr( $mobilePaddingRight ) ?>px !important;
			  	}
			}

		</style>

		<div class="services-main <?php elegant_blocks_style( $style ); echo ' ' . esc_attr( $className ); ?>" 
			id="<?php echo esc_attr( $id ); ?>">

			<div class="services-list">
		        
		        <section 
		        style="padding: <?php echo absint( $paddingTop ) ?>px <?php echo absint( $paddingRight ) ?>px <?php echo absint( $paddingBottom ) ?>px <?php echo absint( $paddingLeft ) ?>px" 
		        class="services-inner">

		            <div class="container1 <?php echo ( $containerStatus ? 'container' : '' ); ?>">

		            	<?php 
		              	if( !empty( $serviceTitle ) || !empty( $serviceSubTitle ) ){ ?>

			              	<div class="row">

			              		<div class="services_1_title_desc col-md-8">

			              			<?php 
			              			if( !empty( $serviceTitle ) ){ ?>

				              			<h2
				              			style="text-transform: <?php echo esc_attr( $mainTitleTextTransform ); ?>; color: <?php echo esc_attr( $titleColor ); ?>"
				              			><?php echo esc_html( $serviceTitle ); ?></h2>

				              			<?php 

				              		} ?>

			              			<?php 
			              			if( !empty( $serviceSubTitle ) ){ ?>
			              				<p
			              				style="color: <?php echo esc_attr( $subtitleColor ); ?>"><?php echo esc_html( $serviceSubTitle ); ?></p>
			              				<?php 
			              			}?>

			              		</div>

			              	</div>

			              	<?php 

			            }?>

		              	<div class="row">

		              		<?php 
		              		while( $services_query->have_posts() ): $services_query->the_post();

		              			global $post;

		              			$icon = get_post_meta( $post->ID, 'icon', true ); 
		              			$link = get_post_meta( $post->ID, 'link', true ); ?>

		              			<?php 
		              			if( !empty( $clickable ) ){
		              				echo '<a href="' . ( !empty( $link ) ? esc_url( $link ) : get_permalink() ) . '">'; 
		              			} ?>

			                  	<div class="<?php elegant_blocks_services_col( $columns ); ?> col-xs-12">
			                      	<div class="box shadow-large bor-lightgray text-center">
			                          	<div 
			                          	class="icon" 
			                          	style="background:<?php elegant_blocks_services_icon_background( $style , $serviceThemeColor ); ?>">
			                              	<i class="<?php echo esc_attr( $icon ); ?>"></i>
			                          	</div>
			                          	<h3 class="mar-bottom-15">
			                          		<?php the_title(); ?>
			                          	</h3>
			                          	<p><?php echo sanitize_text_field( get_the_content() ); ?></p>
			                      	</div>
			                  	</div>	
			                  	<?php 
			                  	if( !empty( $clickable ) ){
			                  		echo '</a>';
			                  	}
			                  	
			                endwhile; ?>

		              </div>

		            </div>

		         </section>

		   	</div>

	   	</div>

		<?php

	endif;
	return ob_get_clean();

}

function elegant_blocks_services_icon_background( $style , $serviceThemeColor ){

	if( $style == 1 ){
		echo esc_attr( $serviceThemeColor );
		return;
	}

	echo esc_attr( 'none' );

}