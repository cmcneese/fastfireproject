<?php

function elegant_blocks_render_countup( $attributes ){ 

    $className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

    /**
    * Shape Divider Options
    */

    $shapeDividerBottom = !empty( $attributes['shapeDividerBottom'] ) ? true : false;
    $selectedShapeDividerImageBottom = !empty( $attributes['selectedShapeDividerImageBottom'] ) ? $attributes['selectedShapeDividerImageBottom'] : '';

    $shapeDividerTop = !empty( $attributes['shapeDividerTop'] ) ? true : false;
    $selectedShapeDividerImageTop = !empty( $attributes['selectedShapeDividerImageTop'] ) ? $attributes['selectedShapeDividerImageTop'] : '';

    $layout = !empty( $attributes['layout'] ) ? $attributes['layout'] : '1';

	// Title
	$mainTitle = !empty( $attributes['mainTitle'] ) ? $attributes['mainTitle'] : '';
	$mainTitleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#333';
	$titleTextTransform = !empty( $attributes['titleTextTransform'] ) ? $attributes['titleTextTransform'] : 'uppercase';

	// Subtitle
	$mainSubTitle = !empty( $attributes['mainSubTitle'] ) ? $attributes['mainSubTitle'] : '';
	$subtitleColor = !empty( $attributes['subtitleColor'] ) ? $attributes['subtitleColor'] : '#333';

	// Separator
	$separatorColor = !empty( $attributes['separatorColor'] ) ? $attributes['separatorColor'] : '#0dbae8';

    // Counter Text
    $counterTextSize = !empty( $attributes['counterTextSize'] ) ? $attributes['counterTextSize'] : '42';
    $counterLineHeight = !empty( $attributes['counterLineHeight'] ) ? $attributes['counterLineHeight'] : '24';
    $counterColor = !empty( $attributes['counterColor'] ) ? $attributes['counterColor'] : '#333';
    $counterFontWeight = !empty( $attributes['counterFontWeight'] ) ? $attributes['counterFontWeight'] : '400';

    // Background Image
    $bgImageStatus = !empty( $attributes['bgImageStatus'] ) ? true : false;
    $bgImageID = !empty( $attributes['bgImage'] ) ? $attributes['bgImage'] : '';
    $bgImageObj = wp_get_attachment_image_src( $bgImageID , 'large' );
    $bgImageUrl = !empty( $bgImageObj[0] ) ? $bgImageObj[0] : '';
    $fixedBackground = !empty( $attributes['fixedBackground'] ) ? true : false;
    $bgOverlay = !empty( $attributes['bgOverlay'] ) ? $attributes['bgOverlay'] : 'rgba(255,0,0,0.3)';

	// Columns
	$columns = !empty( $attributes['columns'] ) ? $attributes['columns'] : '4';

    // Description
    $descriptionColor = !empty( $attributes['descriptionColor'] ) ? $attributes['descriptionColor'] : '#333';
    $descriptionFontWeight = !empty( $attributes['descriptionFontWeight'] ) ? $attributes['descriptionFontWeight'] : 'normal';

    // Desktop Spacing
    $outerPaddingTop = !empty( $attributes['outerPaddingTop'] ) ? $attributes['outerPaddingTop'] : '60';
    $outerPaddingBottom = !empty( $attributes['outerPaddingBottom'] ) ? $attributes['outerPaddingBottom'] : '60';

    // Tablet Spacing
    $tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : '50';
    $tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : '50';

    // Mobile Spacing
    $mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : '50';
    $mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : '50';

    // Font Icon
    $fontColor = !empty( $attributes['fontColor'] ) ? $attributes['fontColor'] : '#fff';
    $fontBackground = !empty( $attributes['fontBackground'] ) ? $attributes['fontBackground'] : '#06bbe4';
    $iconWidth = !empty( $attributes['iconWidth'] ) ? $attributes['iconWidth'] : '40';
    $iconHeight = !empty( $attributes['iconHeight'] ) ? $attributes['iconHeight'] : '40';
    $iconLineHeight = !empty( $attributes['iconLineHeight'] ) ? $attributes['iconLineHeight'] : '42';
    $iconSize = !empty( $attributes['iconSize'] ) ? $attributes['iconSize'] : '25';
    $iconFullCircleBackground = empty( $attributes['iconFullCircleBackground'] ) ? '5px' : '50%';

    // Background Color
    $backgroundColor = !empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#fff';

    $containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_countup_' . $rand;

	ob_start(); ?>

	<style>
		
        <?php 

        if( $bgImageStatus == true ){ ?>

            #<?php echo esc_attr( $id ); ?> {
                background: url( <?php echo esc_url( $bgImageUrl ); ?> ) no-repeat;
                background-size: cover;
                background-attachment: <?php echo ( $fixedBackground == true ? 'fixed' : 'inherit' ); ?>;
                position: relative;                
            }

            <?php

        } else { ?>

            #<?php echo esc_attr( $id ); ?> {
                background:<?php echo esc_attr( $backgroundColor ); ?>;
            }

            <?php
        } ?>

        #<?php echo esc_attr( $id ); ?> {
            padding: <?php echo esc_attr( $outerPaddingTop ); ?>px 15px <?php echo esc_attr( $outerPaddingBottom ); ?>px;
        }

		#<?php echo esc_attr( $id ); ?> .eb_countup_title_desc > h2:after {
			border-color: <?php echo esc_attr( $separatorColor ); ?>;
		}

        /* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            #<?php echo esc_attr( $id ); ?> {
                padding: <?php echo esc_attr( $tabletSpacingTop ); ?>px 15px <?php echo esc_attr( $tabletSpacingBottom ); ?>px;
            }
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
            #<?php echo esc_attr( $id ); ?> {
                padding: <?php echo esc_attr( $mobileSpacingTop ); ?>px 15px <?php echo esc_attr( $mobileSpacingBottom ); ?>px;
            }
        }

	</style>

	<section 
    class="<?php echo esc_attr( elegant_blocks_layout( $layout ) ); ?> eb_counter_wrapper <?php echo esc_attr( $className ); ?>" 
    id="<?php echo esc_attr( $id ); ?>">

        <?php 
        if( $shapeDividerTop ){ ?>
            <div class="eb_shape_divider_wrapper top">
                <img src="<?php echo esc_url( $selectedShapeDividerImageTop ); ?>">
            </div>
            <?php 
        } ?>

        <div class="container1 <?php echo ( $containerStatus ? 'container' : '' ); ?>">
            
            <?php 
            if( !empty( sanitize_text_field( $mainTitle ) ) || !empty( sanitize_text_field( $mainSubTitle ) ) ){ ?>

                <div class="eb_countup_title_desc col-md-8">

                    <?php 
                    if( !empty( sanitize_text_field( $mainTitle ) ) ){ ?>
        		        <h2 
        		        style="text-transform: <?php echo esc_attr( $titleTextTransform ); ?>; color: <?php echo esc_attr( $mainTitleColor ); ?>">
        		    		<?php echo esc_html( $mainTitle ); ?>
        		    	</h2>
        		    	<?php
                    }
                     
    		    	if( !empty( sanitize_text_field( $mainSubTitle ) ) ){ ?>
       					<p style="color: <?php echo esc_attr( $subtitleColor ); ?>">
       						<?php echo esc_html( $mainSubTitle ); ?>		
       					</p>
       					<?php 
       				}?>

    		    </div>

                <?php 
            } ?>

            <div class="row facts_row">

            	<?php 
            	for ( $i = 1; $i <= $columns; $i++ ) { 

            		$icon = 'icon_' . $i;
            		$counter = 'counter_' . $i;
                    $description = 'description_' . $i;

            		$icon_counter = !empty( $attributes[$icon] ) ? $attributes[$icon] : 'fab fa-wordpress';
            		$count_counter = !empty( $attributes[$counter] ) ? $attributes[$counter] : '99';
                    $count_description = !empty( $attributes[$description] ) ? $attributes[$description] : 'Description';

                    preg_match_all('!\d+!', $count_counter, $countNumber );
                    $filterCount = elegant_blocks_join_numbers($countNumber);

                    // Extract prefix and suffix
                    $matches = str_replace( $filterCount, ' ', $count_counter );
                    $matches = array_values( explode( ' ' , $matches , 2 ) ); ?>

            		<div 
                    class="<?php echo esc_attr( elegant_blocks_counter_bootstrap_col( $columns ) ); ?> facts_col">
	                    <div class="count-facts_wrapper">
	                        <div class="count-icon">
	                        	<i 
                                style="color: <?php echo esc_attr( $fontColor ) ?>;background: <?php echo esc_attr( $fontBackground ) ?>;width: <?php echo esc_attr( $iconWidth ) ?>px; height: <?php echo esc_attr( $iconHeight ) ?>px; line-height: <?php echo esc_attr( $iconLineHeight ) ?>px; font-size: <?php echo esc_attr( $iconSize ) ?>px; border-radius: <?php echo esc_attr( $iconFullCircleBackground ) ?>"
                                class="<?php echo esc_attr( $icon_counter ); ?>"></i>
	                        </div>
	                        <div class="count-para">
	                          	<p 
                                style="font-size: <?php echo absint( $counterTextSize ); ?>px; line-height: <?php echo absint( $counterLineHeight ); ?>px;color: <?php echo esc_attr( $counterColor ); ?>;font-weight: <?php echo esc_attr( $counterFontWeight ); ?>"
	                          	class="count-facts_figure timer" 
                                data-prefix="<?php echo ( !empty( $matches[0] ) ? esc_attr( $matches[0] ) : '' ); ?>"
                                data-suffix="<?php echo ( !empty( $matches[1] ) ? esc_attr( $matches[1] ) : '' ); ?>"
	                          	data-to="<?php echo absint( $filterCount ); ?>" 
	                          	data-speed="3000"
	                          	data-ordinal="true" 
                                data-render-with="html" 
	                          	data-decimals="<?php echo strlen(substr(strrchr($filterCount, "."), 1)); ?>">
	                          		<?php echo absint( $filterCount ); ?>
	                          	</p>
	                            <p 
                                class="count-facts_title"
                                style="color: <?php echo esc_attr( $descriptionColor ); ?>; font-weight: <?php echo esc_attr( $descriptionFontWeight ); ?>;">
                                    <?php echo esc_html( $count_description ); ?>
                                </p>
	                        </div>
	                    </div>
	                </div>

            		<?php
            	}
            	?>

            </div>

        </div>

        <?php 
        if( $shapeDividerBottom ){ ?>
            <div class="eb_shape_divider_wrapper">
                <img src="<?php echo esc_url( $selectedShapeDividerImageBottom ); ?>">
            </div>
            <?php 
        }

        if( $bgImageStatus ){ ?>
            <div 
            class="black-overlay" 
            style="background: <?php echo esc_attr( $bgOverlay ); ?>"></div>
            <?php 
        } ?>

    </section>

	<?php

	$content = ob_get_clean();
	return $content;

}

function elegant_blocks_layout( $layout ){

    switch ( $layout ) {

        case '2':
            return 'counter_style_2';
            break;
        
        default:
            return 'counter_style_1';
            break;

    }

}

function elegant_blocks_counter_bootstrap_col( $cols ){

    switch ( $cols ) {

        case '4':
            return 'col-md-3 col-sm-6 col-xs-6';
            break;

        case '3':
            return 'col-md-4 col-sm-6 col-xs-6';
            break;

        case '2':
            return 'col-md-6 col-sm-6 col-xs-6';
            break;
        
        default:
            return 'col-md-12 col-sm-12 col-xs-12';
            break;
    }

}