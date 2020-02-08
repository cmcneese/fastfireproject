<?php
function elegant_blocks_filter_features( $content ){

	if( empty( $content ) ){
		return false;
	}

	// string to array convertion
	$tempArr = array_values( array_filter( explode("\n", $content) ) );

	$tempArr_2 = array();

	if( !empty( $tempArr ) && is_array( $tempArr ) ){

		foreach ( $tempArr as $key => $value) {
			
			$tempArr_2[] = explode( '|' , $value );

		}

		// Filterd array
		return $tempArr_2;

	}

	return false;

}

function elegant_blocks_pricing_class( $layout ){

	if( !empty( $layout ) && is_numeric( $layout ) ){
		return 'mb_pricing_table_style_' . absint( $layout );
	}

}

function elegant_blocks_filter_price( $price ){

	if( empty( $price ) ){
		return false;
	}

	$explode = array_filter( explode( '|' , $price ) );

	$content = '';
	if( count( $explode ) == 3 ){

		$content = '<span class="mb_price_first">' . esc_html( trim( $explode[0] ) ). '</span>';
		$content .= '<span class="mb_price_second">' . esc_html( trim($explode[1]) ) . '</span>';
		$content .= '<span class="mb_price_third">' . esc_html( trim($explode[2]) ) . '</span>';
		echo wp_kses_post( $content );

	} elseif( count( $explode ) == 2 ){
		$content = '<span class="mb_price_first">' . esc_html( trim($explode[0]) ) . '</span>';
		$content .= '<span class="mb_price_second">' . esc_html( trim($explode[1]) ) . '</span>';
		echo wp_kses_post( $content );
	} else {
		$content = '<span class="mb_price_second">' . esc_html( trim($explode[0]) ) . '</span>';
		echo wp_kses_post( $content );
	}

}

function elegant_blocks_bootstrap_class( $columns ){

	switch ( $columns ) {
		case '4':
			return 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
			break;

		case '3':
			return 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
			break;

		case '2':
			return 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			break;
		
		default:
			return 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
			break;
	}

}

function elegant_blocks_frequency_transform( $transform ){

	switch ( $transform ) {
		case 'no_transform':
			return 'none';
			break;

		case 'capitalize':
			return 'capitalize';
			break;
		
		default:
			return 'uppercase';
			break;
	}

}

function elegant_blocks_render_pricing_table( $attribute ){

	$data = array();
	$columns = !empty( $attribute['columns'] ) ? absint( $attribute['columns'] ) : 1;
	$layout = !empty( $attribute['layout'] ) ? absint( $attribute['layout'] ) : 1;
	$outer_background_color = !empty( $attribute['outer_background_color'] ) ? $attribute['outer_background_color'] : '#2c2b36';
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	// Desktop Spacing
	$pricing_padding_top = !empty( $attribute['pricing_padding_top'] ) ? $attribute['pricing_padding_top'] : '80';
	$pricing_padding_bottom = !empty( $attribute['pricing_padding_bottom'] ) ? $attribute['pricing_padding_bottom'] : '80';
	$pricing_padding_left = !empty( $attribute['pricing_padding_left'] ) ? $attribute['pricing_padding_left'] : '50';
	$pricing_padding_right = !empty( $attribute['pricing_padding_right'] ) ? $attribute['pricing_padding_right'] : '50';

	// Tablet Spacing
	$tablet_pricing_padding_top = !empty( $attribute['tablet_pricing_padding_top'] ) ? $attribute['tablet_pricing_padding_top'] : '50';
	$tablet_pricing_padding_bottom = !empty( $attribute['tablet_pricing_padding_bottom'] ) ? $attribute['tablet_pricing_padding_bottom'] : '50';
	$tablet_pricing_padding_left = !empty( $attribute['tablet_pricing_padding_left'] ) ? $attribute['tablet_pricing_padding_left'] : '1';
	$tablet_pricing_padding_right = !empty( $attribute['tablet_pricing_padding_right'] ) ? $attribute['tablet_pricing_padding_right'] : '1';

	// Mobile Spacing
	$mobile_pricing_padding_top = !empty( $attribute['mobile_pricing_padding_top'] ) ? $attribute['mobile_pricing_padding_top'] : '50';
	$mobile_pricing_padding_bottom = !empty( $attribute['mobile_pricing_padding_bottom'] ) ? $attribute['mobile_pricing_padding_bottom'] : '50';
	$mobile_pricing_padding_left = !empty( $attribute['mobile_pricing_padding_left'] ) ? $attribute['mobile_pricing_padding_left'] : '1';
	$mobile_pricing_padding_right = !empty( $attribute['mobile_pricing_padding_right'] ) ? $attribute['mobile_pricing_padding_right'] : '1';

	$pricing_title = !empty( $attribute['pricing_title'] ) ? $attribute['pricing_title'] : '';
	$pricing_subtitle = !empty( $attribute['pricing_subtitle'] ) ? $attribute['pricing_subtitle'] : '';

	$data[0]['plan_1'] = !empty( $attribute['plan_1'] ) ? $attribute['plan_1'] : '';
	$data[0]['price_1'] = !empty( $attribute['price_1'] ) ? $attribute['price_1'] : '';
	$data[0]['perMonthLabel_1'] = !empty( $attribute['perMonthLabel_1'] ) ? $attribute['perMonthLabel_1'] : '';
	$data[0]['content_1'] = !empty( $attribute['content_1'] ) ? $attribute['content_1'] : '';
	$data[0]['buyNow_1'] = !empty( $attribute['buyNow_1'] ) ? $attribute['buyNow_1'] : '';
	$data[0]['link_1'] = !empty( $attribute['link_1'] ) ? $attribute['link_1'] : '';
	$data[0]['ribbon_1'] = !empty( $attribute['ribbon_1'] ) ? $attribute['ribbon_1'] : '';
	$data[0]['highlight_1'] = !empty( $attribute['highlight_1'] ) ? true : false;


	$data[1]['plan_2'] = !empty( $attribute['plan_2'] ) ? $attribute['plan_2'] : '';
	$data[1]['price_2'] = !empty( $attribute['price_2'] ) ? $attribute['price_2'] : '';
	$data[1]['perMonthLabel_2'] = !empty( $attribute['perMonthLabel_2'] ) ? $attribute['perMonthLabel_2'] : '';
	$data[1]['content_2'] = !empty( $attribute['content_2'] ) ? $attribute['content_2'] : '';
	$data[1]['buyNow_2'] = !empty( $attribute['buyNow_2'] ) ? $attribute['buyNow_2'] : '';
	$data[1]['link_2'] = !empty( $attribute['link_2'] ) ? $attribute['link_2'] : '';
	$data[1]['ribbon_2'] = !empty( $attribute['ribbon_2'] ) ? $attribute['ribbon_2'] : '';
	$data[1]['highlight_2'] = !empty( $attribute['highlight_2'] ) ? true : false;


	$data[2]['plan_3'] = !empty( $attribute['plan_3'] ) ? $attribute['plan_3'] : '';
	$data[2]['price_3'] = !empty( $attribute['price_3'] ) ? $attribute['price_3'] : '';
	$data[2]['perMonthLabel_3'] = !empty( $attribute['perMonthLabel_3'] ) ? $attribute['perMonthLabel_3'] : '';
	$data[2]['content_3'] = !empty( $attribute['content_3'] ) ? $attribute['content_3'] : '';
	$data[2]['buyNow_3'] = !empty( $attribute['buyNow_3'] ) ? $attribute['buyNow_3'] : '';
	$data[2]['link_3'] = !empty( $attribute['link_3'] ) ? $attribute['link_3'] : '';
	$data[2]['ribbon_3'] = !empty( $attribute['ribbon_3'] ) ? $attribute['ribbon_3'] : '';
	$data[2]['highlight_3'] = !empty( $attribute['highlight_3'] ) ? true : false;


	$data[3]['plan_4'] = !empty( $attribute['plan_4'] ) ? $attribute['plan_4'] : '';
	$data[3]['price_4'] = !empty( $attribute['price_4'] ) ? $attribute['price_4'] : '';
	$data[3]['perMonthLabel_4'] = !empty( $attribute['perMonthLabel_4'] ) ? $attribute['perMonthLabel_4'] : '';
	$data[3]['content_4'] = !empty( $attribute['content_4'] ) ? $attribute['content_4'] : '';
	$data[3]['buyNow_4'] = !empty( $attribute['buyNow_4'] ) ? $attribute['buyNow_4'] : '';
	$data[3]['link_4'] = !empty( $attribute['link_4'] ) ? $attribute['link_4'] : '';
	$data[3]['ribbon_4'] = !empty( $attribute['ribbon_4'] ) ? $attribute['ribbon_4'] : '';
	$data[3]['highlight_4'] = !empty( $attribute['highlight_4'] ) ? true : false;

	// Button
	$btn_roundness_top_left = !empty( $attribute['btn_roundness_top_left'] ) ? '40px' : 0;
	$btn_roundness_top_right = !empty( $attribute['btn_roundness_top_right'] ) ? '40px' : 0;
	$btn_roundness_bottom_left = !empty( $attribute['btn_roundness_bottom_left'] ) ? '40px' : 0;
	$btn_roundness_bottom_right = !empty( $attribute['btn_roundness_bottom_right'] ) ? '40px' : 0;
	$custom_btn_color = !empty( $attribute['custom_btn_color'] ) ? true : false;
	$custom_btn_background_color = !empty( $attribute['custom_btn_background_color'] ) ? $attribute['custom_btn_background_color'] : '#333';
	$custom_btn_text_color = !empty( $attribute['custom_btn_text_color'] ) ? $attribute['custom_btn_text_color'] : '#fff';

	// Feature
	$feature_text_align = empty( $attribute['feature_text_align'] ) ? 'mb_feature_justified' : 'mb_feature_centered';
	$feature_background = !empty( $attribute['feature_background'] ) ? 'mb_feature_background_' . $attribute['feature_background'] : 'mb_feature_background_light-dashed';
	$feature_font_color = !empty( $attribute['feature_font_color'] ) ? $attribute['feature_font_color'] : '#fff';

	// Frequency
	$frequency_size = !empty( $attribute['frequency_size'] ) ? absint( $attribute['frequency_size'] ) : '14';
	$frequency_transform = empty( $attribute['frequency_transform'] ) ? 'uppercase' : $attribute['frequency_transform'];
	$frequency_font_color = !empty( $attribute['frequency_font_color'] ) ? $attribute['frequency_font_color'] : '#fff';

	// Title
	$title_font_size = !empty( $attribute['title_font_size'] ) ? absint( $attribute['title_font_size'] ) : '18';
	$title_text_transform = empty( $attribute['title_text_transform'] ) ? 'uppercase' : $attribute['title_text_transform'];
	$pricing_font_color = !empty( $attribute['pricing_font_color'] ) ? $attribute['pricing_font_color'] : '#fff';

	// Columns
	$column_spacing = !empty( $attribute['column_spacing'] ) ? true : false;
	$column_box_shadow = !empty( $attribute['column_box_shadow'] ) ? true : false;
	$column_btn_roundness_top_left = !empty( $attribute['column_btn_roundness_top_left'] ) ? '32px' : 0;
	$column_btn_roundness_top_right = !empty( $attribute['column_btn_roundness_top_right'] ) ? '32px' : 0;
	$column_btn_roundness_bottom_left = !empty( $attribute['column_btn_roundness_bottom_left'] ) ? '32px' : 0;
	$column_btn_roundness_bottom_right = !empty( $attribute['column_btn_roundness_bottom_right'] ) ? '32px' : 0;
	$primary_color = !empty( $attribute['primary_color'] ) ? $attribute['primary_color'] : '#db6842';
	$secondary_color = !empty( $attribute['secondary_color'] ) ? $attribute['secondary_color'] : '#db417f';
	$column_background_color = !empty( $attribute['column_background_color'] ) ? $attribute['column_background_color'] : '#312e2e';

	// Package
	$title_font_color = !empty( $attribute['title_font_color'] ) ? $attribute['title_font_color'] : '#fff';

	$rand = wp_generate_password( 20, false, false );
	$pricing_id = 'mb_pricing_table_' . $rand;

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	ob_start();	

	echo '<div id="' . esc_attr( $pricing_id ) . '" class="mb_pricing_wrapper ' . esc_attr( $className ) . ' ' . esc_attr( elegant_blocks_pricing_class( $layout ) ) . '" style="padding-right:' . absint( $pricing_padding_right ) . 'px; padding-left:' . absint( $pricing_padding_left ) . 'px;padding-bottom:' . esc_attr( 
	$pricing_padding_bottom ) . 'px;padding-top:' . absint( $pricing_padding_top ) . 'px;background:' . esc_attr( $outer_background_color )  . '">';

	if( $containerStatus ){
		echo '<div class="container">';
	}

	if( !empty( sanitize_text_field( $pricing_title ) ) || !empty( sanitize_text_field( $pricing_subtitle ) ) ){

		echo '<div class="team_1_title_desc pricing_table_title_desc">';

		if( !empty( sanitize_text_field( $pricing_title ) ) ){
			echo '<h2>' . esc_html( $pricing_title ) . '</h2>';	
		}	
		
		if( !empty( sanitize_text_field( $pricing_subtitle ) ) ){
			echo '<p>' . esc_html( $pricing_subtitle ) . '</p>';
		}

		echo '</div>';

	}

	echo '<div>';

	for ($i=0; $i < $columns; $i++) { 

		$plan = 'plan_' . ($i + 1);
		$price = 'price_' . ($i + 1);
		$perMonthLabel = 'perMonthLabel_' . ($i + 1);
		$content = 'content_' . ($i + 1); 
		$link = 'link_' . ($i + 1);
		$buyNow = 'buyNow_' . ($i + 1);
		$ribbon = 'ribbon_' . ($i + 1);
		$highlight = 'highlight_' . ($i + 1); ?>
		
		<div class="mb_panel_pricing <?php echo esc_attr( elegant_blocks_bootstrap_class( $columns ) ) . ' ' . esc_attr( !empty( $data[$i][$highlight] ) ? 'mb_highlight_pricing_table' : '' ); ?>">
			
			<div 
			class="mb_pricing_column"
			style="box-shadow: <?php echo ( !empty( $column_box_shadow ) ? 'none' : '' ); ?> ;border-top-left-radius: <?php echo esc_attr( $column_btn_roundness_top_left ); ?>;border-top-right-radius: <?php echo esc_attr( $column_btn_roundness_top_right ); ?>;border-bottom-left-radius: <?php echo esc_attr( $column_btn_roundness_bottom_left ); ?>;border-bottom-right-radius: <?php echo esc_attr( $column_btn_roundness_bottom_right ); ?>;margin: <?php echo ( !empty($column_spacing) ? '0 -15px' : 'auto' ); ?>;background: <?php echo esc_attr( $column_background_color ); ?>" >
				
				<?php 
				if( !empty( $data[$i][$ribbon] ) ){ ?>
					<div class="mb_pricing_ribbon">
						<span><?php echo esc_html( $data[$i][$ribbon] ); ?></span>
					</div>
					<?php 
				} ?>

				<div class="mb_pricing_header">
					<h1 
					style="text-transform: <?php echo esc_attr( elegant_blocks_frequency_transform( $title_text_transform ) ) ?>;font-size: <?php echo absint( $title_font_size ); ?>px"><?php echo esc_html( $data[$i][$plan] ); ?></h1>
				</div>
				<div class="mb_pricing_amount">
					<strong>
						<span class="mb_pricing_price">
							<?php elegant_blocks_filter_price( $data[$i][$price] ); ?>		
						</span>
					</strong>
					<div 
					class="mb_pricing_frequency" 
					style="text-transform: <?php echo esc_attr( elegant_blocks_frequency_transform( $frequency_transform ) ) ?>; font-size: <?php echo esc_attr( $frequency_size ) . 'px'; ?>">
						<?php echo esc_html( $data[$i][$perMonthLabel] ); ?>		
					</div>
				</div>

				<?php 
				$filteredArray = elegant_blocks_filter_features( $data[$i][$content] ); 
				if( !empty( $filteredArray ) && is_array( $filteredArray ) ){
					echo '<ul class="mb_pricing_feature ' . esc_attr( $feature_text_align ) . '">';
					foreach ( $filteredArray as $key => $value ) {
						echo '<li class="' . esc_attr( $feature_background ) . '">';
						echo esc_html( trim( $value[0] ) );

						if( !empty( $value[1] ) ){
							echo '<span>' . esc_html( trim( $value[1] ) ) . '</span>';	
						}
						
						echo '</li>';
					}
					echo '</ul>';
				}
				?>

				<div class="mb_pricing_footer">
					<a 
					class="mb_pricing_button" href="<?php echo esc_url( $data[$i][$link] ); ?>"
					style="border-top-left-radius: <?php echo esc_attr( $btn_roundness_top_left ); ?>;border-top-right-radius: <?php echo esc_attr( $btn_roundness_top_right ); ?>;border-bottom-left-radius: <?php echo esc_attr( $btn_roundness_bottom_left ); ?>;border-bottom-right-radius: <?php echo esc_attr( $btn_roundness_bottom_right ); ?>"
					>
						<?php echo esc_html( $data[$i][$buyNow] ); ?>	
					</a>
				</div>
			</div>
		</div>

		<?php
	}	
	echo '</div>';

	if( $containerStatus ){
		echo '</div>';
	}

	echo '</div>'; ?>

	<script>
		jQuery(document).ready( function($){
			var selector = '#' + "<?php echo esc_attr( $pricing_id ); ?>";
			jQuery( selector + ' .mb_pricing_feature').matchHeight();
			setTimeout(function(){
				jQuery( selector + ' .mb_panel_pricing .mb_pricing_column').matchHeight();
			}, 1);
		});
	</script>

	<style>	

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            #<?php echo esc_attr( $pricing_id  ); ?> {
                padding-top: <?php echo absint( $tablet_pricing_padding_top ); ?>px !important;
                padding-bottom: <?php echo absint( $tablet_pricing_padding_bottom ); ?>px !important;
                padding-left: <?php echo absint( $tablet_pricing_padding_left ); ?>px !important;
                padding-right: <?php echo absint( $tablet_pricing_padding_right ); ?>px !important;
            }
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
            #<?php echo esc_attr( $pricing_id  ); ?> {
                padding-top: <?php echo absint( $mobile_pricing_padding_top ); ?>px !important;
                padding-bottom: <?php echo absint( $mobile_pricing_padding_bottom ); ?>px !important;
                padding-left: <?php echo absint( $mobile_pricing_padding_left ); ?>px !important;
                padding-right: <?php echo absint( $mobile_pricing_padding_right ); ?>px !important;
            }
        }

		#<?php echo esc_attr( $pricing_id ) ?> .pricing_table_title_desc > h2:after{
			border-color:<?php echo esc_attr( $secondary_color ); ?>;
		}

		/** 
		* Button 
		*/

		<?php 
		if( !empty( $custom_btn_color ) ){ ?>

			#<?php echo esc_attr( $pricing_id ) ?> .mb_pricing_button{
				background: <?php echo esc_attr( $custom_btn_background_color ); ?>;
				color: <?php echo esc_attr( $custom_btn_text_color ); ?>;
			}
			#<?php echo esc_attr( $pricing_id ) ?> .mb_highlight_pricing_table .mb_pricing_button{
				background: <?php echo esc_attr( $custom_btn_text_color ); ?>;
				color: <?php echo esc_attr( $custom_btn_background_color ); ?>;
				border: <?php echo esc_attr( $custom_btn_text_color ); ?>;
			}

			<?php 
		} else { ?>

			#<?php echo esc_attr( $pricing_id ) ?> a.mb_pricing_button{
				background:linear-gradient(303deg, <?php echo esc_attr( $primary_color ); ?>, <?php echo esc_attr( $secondary_color ); ?>) border-box;
			}

			#<?php echo esc_attr( $pricing_id ) ?> .mb_highlight_pricing_table .mb_pricing_button{
				background: #fff;
				color:<?php echo esc_attr( $primary_color ); ?>;
			}

			<?php
		}
		?>

		/** 
		* Feature 
		*/

		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_pricing_feature li{
			color: <?php echo esc_attr( $feature_font_color ); ?>;
		}

		/** 
		* Frequency 
		*/

		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_pricing_frequency{
			color: <?php echo esc_attr( $frequency_font_color ); ?>;
		}
	
		/** 
		* Title 
		*/

		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_price_first,
		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_price_second,
		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_price_third{
			color: <?php echo esc_attr( $pricing_font_color ); ?>;
		}

		#<?php echo esc_attr( $pricing_id ) ?> .mb_panel_pricing:not(.mb_highlight_pricing_table) .mb_pricing_header h1{
			color: <?php echo esc_attr( $title_font_color ); ?>;
		}

		/** 
		* Column Background Color 
		*/
		
		#<?php echo esc_attr( $pricing_id ) ?> .mb_highlight_pricing_table .mb_pricing_column::before{
			background:linear-gradient(227deg, <?php echo esc_attr( $secondary_color ); ?>, <?php echo esc_attr( $primary_color ); ?>) border-box;
		}		

		#<?php echo esc_attr( $pricing_id ) ?> .mb_pricing_ribbon span{
			background:linear-gradient(227deg, <?php echo esc_attr( $secondary_color ); ?>, <?php echo esc_attr( $primary_color ); ?>) border-box;
		}

		#<?php echo esc_attr( $pricing_id ) ?> .mb_highlight_pricing_table .mb_pricing_ribbon span{
			background: rgb(48, 63, 69);
		}

		<?php 
		if( $feature_text_align == 'mb_feature_justified' ){
			echo '#' . esc_attr( $pricing_id ) . ' .mb_pricing_feature.mb_feature_justified li {
			    text-align: justify;
			}';
			echo '#' . esc_attr( $pricing_id ) . ' .mb_pricing_feature.mb_feature_justified li span {
			    position: absolute;
			    right: 25px;
			    padding-left: 5px;
			    font-weight: bold;
			}';
		} ?>
	</style>

	<?php
	$content = ob_get_clean();
	return $content;

}