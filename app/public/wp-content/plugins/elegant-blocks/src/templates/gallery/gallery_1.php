<?php
function elegant_blocks_render_gallery_1( $attributes ){

	$selectedGalleryCategoryID = !empty( $attributes['selectedGalleryCategoryID'] ) ? absint( $attributes['selectedGalleryCategoryID'] ) : 0;
	$imageGridCell = !empty( $attributes['imageGridCell'] ) ? absint( $attributes['imageGridCell'] ) : 5;
	$imageAlign = empty( $attributes['imageAlign'] ) ? 'false' : 'true';
	$loadingText = !empty( $attributes['loadingText'] ) ? $attributes['loadingText'] : 'loading ...';
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Title
	$galleryTitle = !empty( $attributes['galleryTitle'] ) ? $attributes['galleryTitle'] : '';
	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? $attributes['mainTitleTextTransform'] : 'uppercase';
	$titleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#333';

	// Subtitle
	$galleryDescription = !empty( $attributes['galleryDescription'] ) ? $attributes['galleryDescription'] : '';
	$subtitleColor = !empty( $attributes['subtitleColor'] ) ? $attributes['subtitleColor'] : '#333';

	// Separator
	$galleryColor = !empty( $attributes['galleryColor'] ) ? $attributes['galleryColor'] : '#ed143d';

	// Desktop Spacing
	$outerPaddingTop = !empty( $attributes['outerPaddingTop'] ) ? $attributes['outerPaddingTop'] : '50';
	$outerPaddingBottom = !empty( $attributes['outerPaddingBottom'] ) ? $attributes['outerPaddingBottom'] : '10';

	// Tablet Spacing
	$tabletOuterPaddingTop = !empty( $attributes['tabletOuterPaddingTop'] ) ? $attributes['tabletOuterPaddingTop'] : '50';
	$tabletOuterPaddingBottom = !empty( $attributes['tabletOuterPaddingBottom'] ) ? $attributes['tabletOuterPaddingBottom'] : '10';

	// Mobile Spacing
	$mobileOuterPaddingTop = !empty( $attributes['mobileOuterPaddingTop'] ) ? $attributes['mobileOuterPaddingTop'] : '50';
	$mobileOuterPaddingBottom = !empty( $attributes['mobileOuterPaddingBottom'] ) ? $attributes['mobileOuterPaddingBottom'] : '10';

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$args = array(
		'post_type' => 'ct_gallery',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'ct_gallery_category',
				'field'    => 'term_id',
				'terms'    => $selectedGalleryCategoryID,
			),
		),
	);

	$gallery_query = new WP_Query( $args );
	$images = array();
	$count = 0;
	$rand = wp_generate_password( 12, false, false );
	$div_id = 'image_grid_1_' . $rand; 

	ob_start();

	if( $gallery_query->have_posts() ):

		while( $gallery_query->have_posts() ): $gallery_query->the_post();

			global $post;
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID ); 
			$image_arr = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

			$images[$count]['src'] = !empty( $image_arr[0] ) ? esc_url( $image_arr[0] ) : '';
			$images[$count]['alt'] = get_the_title();
			$images[$count]['title'] = get_the_title(); 
			$images[$count]['caption'] = get_the_title(); 
			$images[$count]['thumbnail'] = !empty( $image_arr[0] ) ? esc_url( $image_arr[0] ) : '';

			$count++;

		endwhile;

		if( !empty( $images ) ){

			echo '<div class="' . ( $containerStatus ? 'container' : '' ) . '">';

			$id = 'imgs_' . $rand; ?>
			
			<div 
			style="margin-top: <?php echo esc_attr( $outerPaddingTop ); ?>px; margin-bottom: <?php echo esc_attr( $outerPaddingBottom ); ?>px" 
			class="gallery_1_wrapper <?php echo esc_attr( $className ); ?>" 
			id="<?php echo esc_attr( $div_id ); ?>">

				<div class="row">

					<div class="col-md-12">

						<?php 
						if( !empty( sanitize_text_field( $galleryTitle ) ) || !empty( sanitize_text_field( $galleryDescription ) ) ){ ?>

							<div class="gallery_1_title_desc col-md-8">
								
								<?php 
								if( !empty( sanitize_text_field( $galleryTitle ) ) ){ ?>
									<h2 
									style="color: <?php echo esc_attr( $titleColor ); ?> ; text-transform:<?php echo esc_attr( $mainTitleTextTransform ); ?>">
										<?php echo esc_html( $galleryTitle ); ?>
									</h2>
									<?php 
								} 

								if( !empty( sanitize_text_field( $galleryDescription ) ) ) { ?>
									<p 
									style="color: <?php echo esc_attr( $subtitleColor ); ?>"><?php echo esc_html( $galleryDescription ); ?></p>
									<?php 
								} ?>

							</div>

							<?php 

						} ?>

						<div class='clear'></div>
						<div class='megablock_image_grid_wrapper'>
							<div id="<?php echo esc_attr( $id ); ?>" class='megablock_image_grid'></div>
						</div>

					</div>

				</div>

			</div>

			<style>
				
				@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
			    	#<?php echo esc_attr( $div_id ); ?> {
			    		margin-top: <?php echo esc_attr( $tabletOuterPaddingTop ); ?>px !important;
			    		margin-bottom: <?php echo esc_attr( $tabletOuterPaddingBottom ); ?>px !important;
			    	}
			    }

			    @media (min-width: 300px) and (max-width: 767px) {
			    	#<?php echo esc_attr( $div_id ); ?> {
			    		margin-top: <?php echo esc_attr( $mobileOuterPaddingTop ); ?>px !important;
			    		margin-bottom: <?php echo esc_attr( $mobileOuterPaddingBottom ); ?>px !important;
			    	}
			    }

			</style>

			<?php

			echo '</div>';
			
			echo "<script>
			jQuery( document ).ready(function(){
				jQuery('#" . $id . "').imagesGrid({
			    	images: " . wp_json_encode( $images ) . ",
			    	align : " . $imageAlign . ",
			    	cells : " . $imageGridCell . ",
			    	loading : '" . esc_attr( $loadingText ) . "'
			  	});
			});		  	
			</script>
			<style>
				#" . esc_attr( $div_id ) . " .gallery_1_title_desc h2:after{
					border-color: " . esc_attr( $galleryColor ) . "
				}
			</style>";

		}

	endif;

	return ob_get_clean();

}