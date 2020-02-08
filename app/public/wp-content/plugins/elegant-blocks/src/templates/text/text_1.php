<?php

function elegant_blocks_render_text( $attributes ){

	$title = !empty( $attributes['title'] ) ? $attributes['title'] : '';
	$subTitle = !empty( $attributes['subTitle'] ) ? $attributes['subTitle'] : '';
	$columns = !empty( $attributes['columns'] ) ? $attributes['columns'] : '4';
	$selectedCategoryID = !empty( $attributes['selectedCategory'] ) ? $attributes['selectedCategory'] : '';
	$wordsLimit = !empty( $attributes['wordsLimit'] ) ? $attributes['wordsLimit'] : '150';
	$imageIcon = !empty( $attributes['imageIcon'] ) ? $attributes['imageIcon'] : '3';
	$align = !empty( $attributes['align'] ) ? $attributes['align'] : 'text-left';
	$clickStatus = !empty( $attributes['clickStatus'] ) ? true : false;
	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	// Icon Settings
	$iconSize = !empty( $attributes['iconSize'] ) ? $attributes['iconSize'] : '50';

	// Color Settings
	$mainTitleColor = !empty( $attributes['mainTitleColor'] ) ? $attributes['mainTitleColor'] : '#64686d';
	$mainSubTitleColor = !empty( $attributes['mainSubTitleColor'] ) ? $attributes['mainSubTitleColor'] : '#64686d';
	$iconColor = !empty( $attributes['iconColor'] ) ? $attributes['iconColor'] : '#64686d';
	$postTitleColor = !empty( $attributes['postTitleColor'] ) ? $attributes['postTitleColor'] : '#64686d';
	$postContentColor = !empty( $attributes['postContentColor'] ) ? $attributes['postContentColor'] : '#64686d';
	$separatorColor = !empty( $attributes['separatorColor'] ) ? $attributes['separatorColor'] : '#ed143d';
	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#fff';

	// Desktop Spacing
	$spacingTop = !empty( $attributes['spacingTop'] ) ? $attributes['spacingTop'] : 0;
	$spacingBottom = !empty( $attributes['spacingBottom'] ) ? $attributes['spacingBottom'] : 0;
	$spacingLeft = !empty( $attributes['spacingLeft'] ) ? $attributes['spacingLeft'] : 0;
	$spacingRight = !empty( $attributes['spacingRight'] ) ? $attributes['spacingRight'] : 0;

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : 50;
	$tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : 30;
	$tabletSpacingLeft = !empty( $attributes['tabletSpacingLeft'] ) ? $attributes['tabletSpacingLeft'] : 0;
	$tabletSpacingRight = !empty( $attributes['tabletSpacingRight'] ) ? $attributes['tabletSpacingRight'] : 0;

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : 50;
	$mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : 30;
	$mobileSpacingLeft = !empty( $attributes['mobileSpacingLeft'] ) ? $attributes['mobileSpacingLeft'] : 0;
	$mobileSpacingRight = !empty( $attributes['mobileSpacingRight'] ) ? $attributes['mobileSpacingRight'] : 0;

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_text_' . $rand; 

	ob_start();
	
	?>

	<style>
		#<?php echo esc_attr( $id ); ?> .eb_text_block > h2:after{
			border-color: <?php echo esc_attr( $separatorColor ); ?>
		}
		#<?php echo esc_attr( $id ); ?>{
			padding: <?php echo esc_attr( $spacingTop ); ?>px <?php echo esc_attr( $spacingRight ); ?>px <?php echo esc_attr( $spacingBottom ); ?>px <?php echo esc_attr( $spacingLeft ); ?>px;
			background: <?php echo esc_attr( $backgroundColor ); ?>;
		}

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            #<?php echo esc_attr( $id ); ?>{
				padding: <?php echo esc_attr( $tabletSpacingTop ); ?>px <?php echo esc_attr( $tabletSpacingRight ); ?>px <?php echo esc_attr( $tabletSpacingBottom ); ?>px <?php echo esc_attr( $tabletSpacingLeft ); ?>px;
			}
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
           	#<?php echo esc_attr( $id ); ?>{
				padding: <?php echo esc_attr( $mobileSpacingTop ); ?>px <?php echo esc_attr( $mobileSpacingRight ); ?>px <?php echo esc_attr( $mobileSpacingBottom ); ?>px <?php echo esc_attr( $mobileSpacingLeft ); ?>px;
			}
        }

	</style>

	<div class="text-3-main <?php echo esc_attr( $align ) . ' ' . esc_attr( $className ); ?>" 
		id="<?php echo esc_attr( $id ); ?>">
      
        <div class="text-list">

        	<div class="eb_container <?php echo ( !$containerStatus ? 'container' : '' ); ?>">
        		
	          	<div class="row">

	          		<?php 

	          		if( !empty( sanitize_text_field( $title ) ) || !empty( sanitize_text_field( $subTitle ) ) ){ ?>
	            	
		            	<div class="eb_text_block">
		            		
		            		<?php 
		            		if( !empty( $title ) ){ ?>
								<h2
								style="color: <?php echo esc_attr( $mainTitleColor ); ?>">
									<?php echo esc_html( $title ); ?>
								</h2>
								<?php 
							}

							if( !empty( $subTitle ) ){ ?>
								<p 
								style="color:<?php echo esc_attr( $mainSubTitleColor ); ?>"><?php echo esc_html( $subTitle ); ?></p>
								<?php 
							} ?>

						</div>

						<?php 

					}

					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'cat' => $selectedCategoryID
					); 

					$query_post = new WP_Query( $args );

					if( $query_post->have_posts() ):

						while( $query_post->have_posts() ): $query_post->the_post();

							global $post; 

							$icon = get_post_meta( $post->ID, 'icon', true ); ?>

			            	<div 
			            	class="<?php echo esc_attr( elegant_blocks_column_class( $columns ) ); ?> eb_text_wrapper">
				            	
				            	<?php 
				            	if( $clickStatus ){ ?>
				            		<a href="<?php the_permalink(); ?>">
				            		<?php 
				            	} ?>

				              		<div class="text-inner">	              			

			              				<?php 
			              				if( $imageIcon == 1 && has_post_thumbnail() ){
			              					echo '<div class="text-image mar-bottom-20 eb_text_image_wrapper">';
			              					the_post_thumbnail( 
				              					elegant_blocks_check_image_size( $columns ), 
				              					array( 'alt' => get_the_title() ) 
				              				);	
				              				echo '</div>';
			              				} elseif( $imageIcon == 2 && !empty( $icon ) ){
			              					echo '<div class="icon mar-bottom-10">';
			              					echo '<i class="' . esc_attr( $icon ) . '" style="font-size:' . absint( $iconSize ) . 'px;color:' . esc_attr( $iconColor ) . '" ></i>';
			              					echo '</div>';
			              				}
			              				?>

				                  		<h4 
				                  		style="color: <?php echo esc_attr( $postTitleColor ); ?>"><?php the_title(); ?></h4>
				                  		<p
				                  		style="color: <?php echo esc_attr( $postContentColor ); ?>">
				                  			<?php echo sanitize_text_field( elegant_blocks_limit_content_chr( get_the_content(), $wordsLimit ) ); ?>		
				                  		</p>
				              		</div>
				              		
				              	<?php 
				            	if( $clickStatus ){ ?>
				              		</a>
				              		<?php 
				            	} ?>
			            	</div>

	            			<?php

	            		endwhile;

	            	endif; ?>

	        	</div>

	        </div>

      	</div>

  	</div>

	<?php
	return ob_get_clean();

}

function elegant_blocks_check_image_size( $col ){

	switch ( $col ) {

		case '1':
			return 'bizberg_detail_image';
			break;

		case '2':
			return 'bizberg_portfolio_homepage';
			break;

		case '3':
			return 'bizberg_blog_list';
			break;
		
		default:
			return 'bizberg_medium';
			break;
	}

}

function elegant_blocks_column_class( $col ){

	switch ( $col ) {

		case '1':
			return 'col-xs-12';
			break;

		case '2':
			return 'col-sm-6 col-xs-12';
			break;

		case '3':
			return 'col-sm-4 col-xs-12';
			break;
		
		default:
			return 'col-sm-3 col-xs-12';
			break;
	}

}