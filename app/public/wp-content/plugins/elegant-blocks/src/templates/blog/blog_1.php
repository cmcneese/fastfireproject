<?php

function elegant_blocks_blog_1_column_class( $col ){

	switch ( $col ) {
		case '4':
			return 'four_shows_one_move';
			break;

		case '3':
			return 'three_shows_one_move';
			break;
		
		default:
			return 'two_shows_one_move';
			break;
	}

}

function elegant_blocks_blog_1_column( $col ){

	switch ( $col ) {
		case '4':
			return 'adv_portfolio_4_columns_carousel';
			break;

		case '3':
			return 'adv_portfolio_3_columns_carousel';
			break;
		
		default:
			return 'adv_portfolio_2_columns_carousel';
			break;
	}

}

function elegant_blocks_blog_1_bootstrap_column( $val ){

	switch ( $val ) {
		case '2':
			return ' col-sm-6 col-md-6 ';
			break;

		case '3':
			return ' col-sm-4 col-md-4 ';
			break;
		
		default:
			return ' col-sm-6 col-md-3 ';
			break;
	}

}

function elegant_blocks_render_blog_1( $attributes ){

	$cat = !empty( $attributes['selectedPostCategoryID'] ) ? absint( $attributes['selectedPostCategoryID'] ) : ''; 

	$characterLimit = !empty( $attributes['characterLimit'] ) ? absint( $attributes['characterLimit'] ) : 20;
	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? sanitize_text_field( $attributes['backgroundColor'] ) : '#232323';
	$paginationBtnColor = !empty( $attributes['paginationBtnColor'] ) ? sanitize_text_field( $attributes['paginationBtnColor'] ) : '#0dbae8';
	$blogColumn = !empty( $attributes['blogColumn'] ) ? absint( $attributes['blogColumn'] ) : '4';
	$blogDescription = !empty( $attributes['blogDescription'] ) ? $attributes['blogDescription'] : '';
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Title
	$blogTitle = !empty( $attributes['blogTitle'] ) ? $attributes['blogTitle'] : '';
	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? $attributes['mainTitleTextTransform'] : 'uppercase';
	$titleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#fff';

	// Subtitle
	$subtitleColor = !empty( $attributes['subtitleColor'] ) ? $attributes['subtitleColor'] : '#fff';

	// Separator
	$separatorColor = !empty( $attributes['separatorColor'] ) ? $attributes['separatorColor'] : '#0dbae8';

	// Read More
	$readMoreBackground = !empty( $attributes['readMoreBackground'] ) ? sanitize_text_field( $attributes['readMoreBackground'] ) : '#0dbae8';
	$readMore = !empty( $attributes['readMore'] ) ? sanitize_text_field( $attributes['readMore'] ) : esc_html__( 'Read More' , 'elegant-blocks' ); 
	$readMoreTextTransform = !empty( $attributes['readMoreTextTransform'] ) ? $attributes['readMoreTextTransform'] : 'uppercase';
	$readMoreColor = !empty( $attributes['readMoreColor'] ) ? $attributes['readMoreColor'] : '#fff';
	$readMoreSpacingTopBottom = !empty( $attributes['readMoreSpacingTopBottom'] ) ? $attributes['readMoreSpacingTopBottom'] : '10';
	$readMoreSpacingLeftRight = !empty( $attributes['readMoreSpacingLeftRight'] ) ? $attributes['readMoreSpacingLeftRight'] : '20';
	$readMoreSpacingTop = !empty( $attributes['readMoreSpacingTop'] ) ? $attributes['readMoreSpacingTop'] : '20';

	// Column
	$columnFontColor = !empty( $attributes['columnFontColor'] ) ? $attributes['columnFontColor'] : '#fff';

	// Desktop Spacing
	$spacingTop = !empty( $attributes['spacingTop'] ) ? $attributes['spacingTop'] : '50';
	$spacingBottom = !empty( $attributes['spacingBottom'] ) ? $attributes['spacingBottom'] : '50';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : '50';
	$tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : '50';

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : '50';
	$mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : '50';

	// Column Title
	$columnTitleTextTransform = !empty( $attributes['columnTitleTextTransform'] ) ? $attributes['columnTitleTextTransform'] : 'none';
	$columnTitleFontSize = !empty( $attributes['columnTitleFontSize'] ) ? $attributes['columnTitleFontSize'] : '24';
	$columnTitleSpacingBottom = !empty( $attributes['columnTitleSpacingBottom'] ) ? $attributes['columnTitleSpacingBottom'] : '5';

	$style = !empty( $attributes['style'] ) ? $attributes['style'] : '1';

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'cat' => $cat
	); 

	$blog_query = new WP_Query( $args );
	$count = 0;
	$content = '';
	$default_img = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/sm_slider_01.jpg'; 
	$random_text = wp_generate_password( 12, false, false );
	ob_start();

	if( $blog_query->have_posts() ): ?>

		<style>
			#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?> .portfolio_col_item_caption{
				border-color: <?php echo esc_attr( $readMoreBackground ); ?>;
			}
			#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?> .blog_title_desc_wrapper h2:after{
				border-color: <?php echo esc_attr( $separatorColor ); ?>;
			}
			#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?>.portfolio_col_carousel_wrapper{
				padding-top: <?php echo esc_attr( $spacingTop ); ?>px;
				padding-bottom: <?php echo esc_attr( $spacingBottom ); ?>px;
			}
			@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
	            #<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?>.portfolio_col_carousel_wrapper{
					padding-top: <?php echo esc_attr( $tabletSpacingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $tabletSpacingBottom ); ?>px;
				}
	        }
	        @media (min-width: 300px) and (max-width: 767px) {
	        	#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?>.portfolio_col_carousel_wrapper{
					padding-top: <?php echo esc_attr( $mobileSpacingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $mobileSpacingBottom ); ?>px;
				}
	        }
		</style>

		<div style="background:<?php echo esc_attr( $backgroundColor ); ?>" class="<?php echo esc_attr( $className ); ?>">

			<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

				<div 
				id="<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) ) . $random_text; ?>" 
				class="carousel slide <?php echo esc_attr( elegant_blocks_blog_1_column_class( $blogColumn ) ); ?> portfolio_col_carousel_wrapper swipe_x megablocks_blog_1 <?php echo 'eb_blog_style_' . absint( $style ); ?>" 
				data-ride="carousel" 
				data-duration="1000" 
				data-interval="false" 
				data-pause="hover">

					<?php 
					if( !empty( sanitize_text_field( $blogTitle ) ) || !empty( sanitize_text_field( $blogDescription ) ) ) { ?>

						<div class="col-md-8 blog_title_desc_wrapper">

							<?php 
							if( !empty( sanitize_text_field( $blogTitle ) ) ){ ?>
							
								<h2 
								style="color: <?php echo esc_attr( $titleColor ); ?> ; text-transform: <?php echo esc_attr( $mainTitleTextTransform ); ?>" 
								><?php echo esc_html( $blogTitle ); ?></h2>

								<?php 
							}

							if( !empty( sanitize_text_field( $blogDescription ) ) ){ ?>
								<p style="color: <?php echo esc_attr( $subtitleColor ); ?>;"><?php echo esc_html( $blogDescription ); ?></p>
								<?php 
							} ?>

						</div>

						<?php 

					} ?>

					<div class="carousel-inner" role="listbox">

						<?php 
						while( $blog_query->have_posts() ): $blog_query->the_post(); ?>

							<div class="item <?php echo esc_attr( $count == 0 ? 'active' : '' ); ?>">

									<div class="col-xs-12 <?php echo esc_attr( elegant_blocks_blog_1_bootstrap_column( $blogColumn ) ); ?>">

										<div class="portfolio_col_item_image">

											<?php 
											if( has_post_thumbnail() ){
												the_post_thumbnail( 'elegant_blocks_blog_1', array( 'alt' => get_the_title() ) );
											} else {
												echo '<img src="' . esc_url( $default_img ) . '" />';
											}
											?>
											
											<div class="portfolio_col_item_caption">
												
												<h3 
												style="margin-bottom: <?php echo esc_attr( $columnTitleSpacingBottom ); ?>px; font-size: <?php echo esc_attr( $columnTitleFontSize ); ?>px; text-transform: <?php echo esc_attr( $columnTitleTextTransform ); ?>; color: <?php echo esc_attr( $columnFontColor ); ?>">
													<?php the_title(); ?>
												</h3>

												<p 
												style="color: <?php echo esc_attr( $columnFontColor ); ?>"><?php echo wp_trim_words( get_the_content() , $characterLimit, ' [...]' ); ?></p>

												<a 
												href="<?php the_permalink(); ?>" 
												style="margin-top: <?php echo esc_attr( $readMoreSpacingTop ); ?>px; padding-right: <?php echo esc_attr( $readMoreSpacingLeftRight ); ?>px; padding-left: <?php echo esc_attr( $readMoreSpacingLeftRight ); ?>px; padding-top: <?php echo esc_attr( $readMoreSpacingTopBottom ); ?>px; padding-bottom: <?php echo esc_attr( $readMoreSpacingTopBottom ); ?>px; color: <?php echo esc_attr( $readMoreColor ); ?> !important; text-transform: <?php echo esc_attr( $readMoreTextTransform ); ?>; background: <?php echo esc_attr( $readMoreBackground  ); ?>">
													<?php echo esc_html( $readMore ); ?>
												</a>
											</div>

										</div>

									</div>
							</div>

							<?php 

							$count++;
						endwhile; ?>

					</div>

					<!--======= Left Button =========-->
					<a 
					class="left carousel-control portfolio_col_carousel_control_left adv_left" 
					href="#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) . $random_text ); ?>" 
					role="button" 
					data-slide="prev"
					style="background:<?php echo esc_attr( $paginationBtnColor ); ?> !important">
						<span class="fa fa-angle-left portfolio_col_carousel_control_icons" aria-hidden="true"></span>
						<span class="sr-only"><?php echo esc_attr__( 'Previous' , 'elegant-blocks' ) ?></span>
					</a>

					<!--======= Right Button =========-->
					<a 
					class="right carousel-control portfolio_col_carousel_control_right adv_right" 
					href="#<?php echo esc_attr( elegant_blocks_blog_1_column( $blogColumn ) . $random_text ); ?>" 
					role="button" 
					data-slide="next" 
					style="background:<?php echo esc_attr( $paginationBtnColor ); ?> !important">
						<span class="fa fa-angle-right portfolio_col_carousel_control_icons" aria-hidden="true"></span>
						<span class="sr-only"><?php echo esc_attr__( 'Next' , 'elegant-blocks' ) ?></span>
					</a>

				</div>

			</div>

		</div>

		<?php

	endif;

	$content = ob_get_clean();
	return $content;
}