<?php

function elegant_blocks_team_1_id( $val ){

	switch ( $val ) {
		case '2':
			return 'adv_team_2_columns_carousel';
			break;

		case '3':
			return 'adv_team_3_columns_carousel';
			break;
		
		default:
			return 'adv_team_4_columns_carousel';
			break;
	}

}

function elegant_blocks_team_1_class( $val ){

	switch ( $val ) {
		case '2':
			return 'two_shows_one_move';
			break;

		case '3':
			return 'three_shows_one_move';
			break;
		
		default:
			return 'four_shows_one_move';
			break;
	}

}

function elegant_blocks_team_1_column( $val ){

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

function elegant_blocks_render_dynamic_block_team_1( $attributes ) {

	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

 	$team_category_id = !empty( $attributes['selectedCategoryID'] ) ? absint( $attributes['selectedCategoryID'] ) : '';

 	$characterLimit = !empty( $attributes['characterLimit'] ) ? absint( $attributes['characterLimit'] ) : '10';

 	$readMore = empty( $attributes['readMore'] ) ? false : true;

 	$readMoreColor = empty( $attributes['readMoreColor'] ) ? '#feb600' : $attributes['readMoreColor'];

 	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? esc_attr( $attributes['backgroundColor'] ) : '#171717';

 	$teamTitleColor = !empty( $attributes['teamTitleColor'] ) ? esc_attr( $attributes['teamTitleColor'] ) : '#fff';

 	$sociaIconBackgroundColor = !empty( $attributes['sociaIconBackgroundColor'] ) ? esc_attr( $attributes['sociaIconBackgroundColor'] ) : '#feb600';

 	$sociaIconColor = !empty( $attributes['sociaIconColor'] ) ? esc_attr( $attributes['sociaIconColor'] ) : '#171717';

 	$paginationBackground = !empty( $attributes['paginationBackground'] ) ? esc_attr( $attributes['paginationBackground'] ) : '#feb600';

 	$teamLayout = !empty( $attributes['teamLayout'] ) ? absint( $attributes['teamLayout'] ) : '4';
 	$style = !empty( $attributes['style'] ) ? absint( $attributes['style'] ) : '1';

 	$hidePaginationLink = !empty( $attributes['hidePaginationLink'] ) ? false : true;

 	$teamTitle = !empty( $attributes['teamTitle'] ) ? $attributes['teamTitle'] : '';

 	$teamSubTitle = !empty( $attributes['teamSubTitle'] ) ? $attributes['teamSubTitle'] : '';

 	$outerBgColor = !empty( $attributes['outerBgColor'] ) ? esc_attr( $attributes['outerBgColor'] ) : '#fff';
 	$subTitleColor = !empty( $attributes['subTitleColor'] ) ? esc_attr( $attributes['subTitleColor'] ) : '#333';
 	$separatorColor = !empty( $attributes['separatorColor'] ) ? esc_attr( $attributes['separatorColor'] ) : '#333';

 	// Desktop Padding
 	$outerPaddingTop = !empty( $attributes['outerPaddingTop'] ) ? absint( $attributes['outerPaddingTop'] ) : '25';
 	$outerPaddingBottom = !empty( $attributes['outerPaddingBottom'] ) ? absint( $attributes['outerPaddingBottom'] ) : '25';
 	$outerPaddingLeft = !empty( $attributes['outerPaddingLeft'] ) ? absint( $attributes['outerPaddingLeft'] ) : '25';
 	$outerPaddingRight = !empty( $attributes['outerPaddingRight'] ) ? absint( $attributes['outerPaddingRight'] ) : '25';

 	// Tablet Padding
 	$tabletOuterPaddingTop = !empty( $attributes['tabletOuterPaddingTop'] ) ? absint( $attributes['tabletOuterPaddingTop'] ) : '25';
 	$tabletOuterPaddingBottom = !empty( $attributes['tabletOuterPaddingBottom'] ) ? absint( $attributes['tabletOuterPaddingBottom'] ) : '60';
 	$tabletOuterPaddingLeft = !empty( $attributes['tabletOuterPaddingLeft'] ) ? absint( $attributes['tabletOuterPaddingLeft'] ) : '1';
 	$tabletOuterPaddingRight = !empty( $attributes['tabletOuterPaddingRight'] ) ? absint( $attributes['tabletOuterPaddingRight'] ) : '1';

 	// Mobile Padding
 	$mobileOuterPaddingTop = !empty( $attributes['mobileOuterPaddingTop'] ) ? absint( $attributes['mobileOuterPaddingTop'] ) : '25';
 	$mobileOuterPaddingBottom = !empty( $attributes['mobileOuterPaddingBottom'] ) ? absint( $attributes['mobileOuterPaddingBottom'] ) : '60';
 	$mobileOuterPaddingLeft = !empty( $attributes['mobileOuterPaddingLeft'] ) ? absint( $attributes['mobileOuterPaddingLeft'] ) : '1';
 	$mobileOuterPaddingRight = !empty( $attributes['mobileOuterPaddingRight'] ) ? absint( $attributes['mobileOuterPaddingRight'] ) : '1';

 	// Main Title
 	$mainTitleColor = !empty( $attributes['mainTitleColor'] ) ? esc_attr( $attributes['mainTitleColor'] ) : '#333';
 	$mainTitleTextTransform = !empty( $attributes['mainTitleTextTransform'] ) ? esc_attr( $attributes['mainTitleTextTransform'] ) : 'uppercase';

 	// Author
 	$innerTitleTextTransform = !empty( $attributes['innerTitleTextTransform'] ) ? esc_attr( $attributes['innerTitleTextTransform'] ) : 'uppercase';
 	$innerTitleBold = !empty( $attributes['innerTitleBold'] ) ? $attributes['innerTitleBold'] : 700;
 	$innerTitleLetterSpacing = !empty( $attributes['innerTitleLetterSpacing'] ) ? $attributes['innerTitleLetterSpacing'] : 0;

 	// Company / Position
 	$teamCompanyColor = !empty( $attributes['teamCompanyColor'] ) ? esc_attr( $attributes['teamCompanyColor'] ) : '#fff';
 	$companyTextTransform = !empty( $attributes['companyTextTransform'] ) ? esc_attr( $attributes['companyTextTransform'] ) : 'uppercase';
 	$companyTitleBold = !empty( $attributes['companyTitleBold'] ) ? $attributes['companyTitleBold'] : 700;
 	$companyLetterSpacing = !empty( $attributes['companyLetterSpacing'] ) ? $attributes['companyLetterSpacing'] : 0;

 	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

 	$rand = wp_generate_password( 12, false, false );

 	$content = '';

 	ob_start(); 

	$arg = array(
		'post_type' => 'ct_teams',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'ct_team_category',
				'field'    => 'term_id',
				'terms'    => $team_category_id,
			),
		),
	);

	$team_query = new WP_Query( $arg );
	$count = 0;
	$team_id = elegant_blocks_team_1_id( $teamLayout ) . $rand;

	if( $team_query->have_posts() ): ?>

		<style>
			#<?php echo esc_attr( $team_id ) ?> .team_1_title_desc h2{
				color: <?php echo esc_attr( $mainTitleColor ); ?>;
			}
			#<?php echo esc_attr( $team_id ) ?> .team_1_title_desc p{
				color: <?php echo esc_attr( $subTitleColor ); ?>;
			}
			#<?php echo esc_attr( $team_id ) ?>{
				padding-top: <?php echo esc_attr( $outerPaddingTop ); ?>px;
				padding-bottom: <?php echo esc_attr( $outerPaddingBottom ); ?>px;
				padding-left: <?php echo esc_attr( $outerPaddingLeft ); ?>px;
				padding-right: <?php echo esc_attr( $outerPaddingRight ); ?>px;
			}
			#<?php echo esc_attr( $team_id ) ?> .team_1_title_desc > h2:after{
				border-color: <?php echo esc_attr( $separatorColor ); ?>;
			}
			#<?php echo esc_attr( $team_id ) ?>.mb_team_style_3 .team_columns_item_caption:before{
				border-color: <?php echo esc_attr( $backgroundColor ); ?>;
			}
			#<?php echo esc_attr( $team_id ) ?>.mb_team_style_5 .team_columns_item_caption:before{
				border-color: transparent transparent transparent <?php echo esc_attr( $backgroundColor ); ?>;
			}
			
			/* 
	          ##Device = Tablets, Ipads (portrait)
	        */    

       		@media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
       			#<?php echo esc_attr( $team_id ) ?>{
					padding-top: <?php echo esc_attr( $tabletOuterPaddingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $tabletOuterPaddingBottom ); ?>px;
					padding-left: <?php echo esc_attr( $tabletOuterPaddingLeft ); ?>px;
					padding-right: <?php echo esc_attr( $tabletOuterPaddingRight ); ?>px;
				}
       		}

       		/* 
	          ##Device = Most of the Smartphones Mobiles (Portrait)
	        */

	        @media (min-width: 300px) and (max-width: 767px) {
	        	#<?php echo esc_attr( $team_id ) ?>{
					padding-top: <?php echo esc_attr( $mobileOuterPaddingTop ); ?>px;
					padding-bottom: <?php echo esc_attr( $mobileOuterPaddingBottom ); ?>px;
					padding-left: <?php echo esc_attr( $mobileOuterPaddingLeft ); ?>px;
					padding-right: <?php echo esc_attr( $mobileOuterPaddingRight ); ?>px;
				}
	        }

		</style>

		<div style="background: <?php echo esc_attr( $outerBgColor ); ?>" 
			class="<?php echo esc_attr( $className ); ?>">

			<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

				<div 
				id="<?php echo esc_attr( $team_id ); ?>" 
				class="<?php echo esc_attr( 'mb_team_style_' . absint( $style ) ); ?> carousel slide <?php echo esc_attr( elegant_blocks_team_1_class( $teamLayout ) ); ?> team_columns_carousel_wrapper swipe_x cyt_team_1" 
				data-ride="carousel" 
				data-duration="1000" 
				data-interval="false" 
				data-pause="hover">			

					<?php 
					if( !empty( sanitize_text_field( $teamTitle ) ) || !empty( sanitize_text_field( $teamSubTitle ) ) ){ ?>

						<div class="team_1_title_desc">
							
							<?php 
							
							if( !empty( $teamTitle ) ){ ?>
								<h2 
								style="text-transform:<?php echo esc_attr( $mainTitleTextTransform ); ?>">
									<?php echo esc_html( $teamTitle ); ?>
								</h2>
								<?php 
							} 

							if( !empty( $teamSubTitle ) ){ ?>
								<p><?php echo esc_html( $teamSubTitle ); ?></p>
								<?php 
							} ?>

						</div>

						<?php 

					} ?>

					<div class="carousel-inner" role="listbox">

						<?php

						while ( $team_query->have_posts() ): $team_query->the_post();

							global $post;
							$position = get_post_meta( $post->ID, 'position', true ); 
							$facebook = get_post_meta( $post->ID, 'facebook_link', true );
							$twitter = get_post_meta( $post->ID, 'twitter_link', true );
							$google_plus = get_post_meta( $post->ID, 'google_plus_link', true ); 
							$instagram = get_post_meta( $post->ID, 'instagram_link', true );

							$default_img = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/team_01.png'; ?>

							<div class="item <?php echo esc_attr( $count == 1 ? 'active' : '' ); ?>">
								<div class="col-xs-12 <?php echo esc_attr( elegant_blocks_team_1_column( $teamLayout ) ); ?>">

									<div class="team_columns_item_image">

										<?php 
										if( has_post_thumbnail() ){
											the_post_thumbnail( 'elegant_blocks_team_1', array( 'alt' => get_the_title() ) );
										} else {
											echo '<img src="' . esc_url( $default_img ) . '"/>';
										} 
										?>

										<div class="team_columns_item_caption" style="background:<?php echo esc_attr( $backgroundColor ); ?>">
											<h4 style="letter-spacing: <?php echo absint( $innerTitleLetterSpacing ); ?>px ; font-weight: <?php echo esc_attr( $innerTitleBold ); ?>; color:<?php echo esc_attr( $teamTitleColor ); ?>;text-transform:<?php echo esc_attr( $innerTitleTextTransform ); ?>"><?php the_title(); ?></h4>

											<div class="team_content_wrap">
												
												<h5 style="letter-spacing: <?php echo esc_attr( $companyLetterSpacing ); ?>px ; font-weight: <?php echo esc_attr( $companyTitleBold ); ?>; text-transform: <?php echo esc_attr( $companyTextTransform ); ?> ; color:<?php echo esc_attr( $teamCompanyColor ); ?>">
													<?php echo esc_html( $position ); ?>
												</h5>
												
												<p>
													<?php 
													echo wp_trim_words( get_the_content() , $characterLimit, ' [...]' );
													
													if( $readMore ){ ?>
														<a style="color:<?php echo esc_attr( $readMoreColor ); ?>" class="cyt_team_1_permalink" href="<?php the_permalink(); ?>">
															<?php esc_html_e( 'Read More' , 'elegant-blocks' ); ?>
														</a>
														<?php 
													} ?>
												</p>
												<div class="team_columns_item_social">

													<?php 
													if( !empty( $facebook ) ){ ?>
														<a style="background:<?php echo esc_attr( $sociaIconBackgroundColor ); ?>;color:<?php echo esc_attr( $sociaIconColor ); ?>" href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook-f"></i></a>
														<?php 
													} ?>

													<?php 
													if( !empty( $twitter ) ){ ?>
														<a style="background:<?php echo esc_attr( $sociaIconBackgroundColor ); ?>;color:<?php echo esc_attr( $sociaIconColor ); ?>" href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter"></i></a>
														<?php 
													} ?>

													<?php 
													if( !empty( $google_plus ) ){ ?>
														<a style="background:<?php echo esc_attr( $sociaIconBackgroundColor ); ?>;color:<?php echo esc_attr( $sociaIconColor ); ?>" href="<?php echo esc_url( $google_plus ); ?>"><i class="fab fa-google-plus-g"></i></a>
														<?php 
													} ?>

													<?php 
													if( !empty( $instagram ) ){ ?>
														<a style="background:<?php echo esc_attr( $sociaIconBackgroundColor ); ?>;color:<?php echo esc_attr( $sociaIconColor ); ?>" href="<?php echo esc_url( $instagram ); ?>"><i class="fab fa-instagram"></i></a>
														<?php 
													} ?>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

							<?php 
						
							$count++;
						endwhile; ?>

					</div>

					<?php 
					// Hide pagination link
					if( $hidePaginationLink ){ ?>

						<a 
						class="left carousel-control team_columns_carousel_control_left adv_left" 
						href="#<?php echo esc_attr( elegant_blocks_team_1_id( $teamLayout ) . $rand ); ?>" 
						role="button" 
						data-slide="prev" 
						style="background: <?php echo esc_attr( $paginationBackground ); ?> !important">
							<span class="fa fa-angle-left team_columns_carousel_control_icons" aria-hidden="true"></span>
							<span class="sr-only"><?php esc_html_e( 'Previous', 'elegant-blocks' ); ?></span>
						</a>

						<a 
						class="right carousel-control team_columns_carousel_control_right adv_right" 
						href="#<?php echo esc_attr( elegant_blocks_team_1_id( $teamLayout ) . $rand ); ?>" 
						role="button" 
						data-slide="next" 
						style="background: <?php echo esc_attr( $paginationBackground ); ?> !important">
							<span class="fa fa-angle-right team_columns_carousel_control_icons" aria-hidden="true"></span>
							<span class="sr-only"><?php esc_html_e( 'Next', 'elegant-blocks' ); ?></span>
						</a>

						<?php 
					} ?>

				</div>			

			</div>

		</div>

		<?php

	endif;

 	$content = ob_get_clean();

 	return $content;

}