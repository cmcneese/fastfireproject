<?php

function elegant_blocks_render_calltoaction_1( $attributes ){

    $className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

    // Bottom Top Image
    $selectedShapeDividerImageTop = !empty( $attributes['selectedShapeDividerImageTop'] ) ? $attributes['selectedShapeDividerImageTop'] : '';
    $shapeDividerTop = !empty( $attributes['shapeDividerTop'] ) ? true : false;
    $selectedShapeDividerImageBottom = !empty( $attributes['selectedShapeDividerImageBottom'] ) ? $attributes['selectedShapeDividerImageBottom'] : '';
    $shapeDividerBottom = !empty( $attributes['shapeDividerBottom'] ) ? true : false;

    
	$selectedPageID = !empty( $attributes['selectedPageID'] ) ? absint( $attributes['selectedPageID'] ) : '';

	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#ffa500';

    // Btn Options
	$hideDownloadBtn = !empty( $attributes['hideDownloadBtn'] ) && $attributes['hideDownloadBtn'] == 'true' ? true : false;

	$downloadText = !empty( $attributes['downloadText'] ) ? $attributes['downloadText'] : esc_html__( 'Download App', 'elegant-blocks' );

	$downloadLink = !empty( $attributes['downloadLink'] ) ? $attributes['downloadLink'] : '#';

	$downloadBtnBackground = !empty( $attributes['downloadBtnBackground'] ) ? $attributes['downloadBtnBackground'] : '#fff';

	$downloadBtnTextColor = !empty( $attributes['downloadBtnTextColor'] ) ? $attributes['downloadBtnTextColor'] : '#181d31';

	$downloadBtnTextColor = !empty( $attributes['downloadBtnTextColor'] ) ? $attributes['downloadBtnTextColor'] : '#181d31';

	$layout = !empty( $attributes['layout'] ) ? $attributes['layout'] : '1';
    $btnBorderRadius = !empty( $attributes['btnBorderRadius'] ) ? $attributes['btnBorderRadius'] : '5';
    $btnTextTransform = !empty( $attributes['btnTextTransform'] ) ? $attributes['btnTextTransform'] : 'none';
    $btnSizeTopBottom = !empty( $attributes['btnSizeTopBottom'] ) ? $attributes['btnSizeTopBottom'] : '12';
    $btnSizeLeftRight = !empty( $attributes['btnSizeLeftRight'] ) ? $attributes['btnSizeLeftRight'] : '24';
    $btnSpacingTop = !empty( $attributes['btnSpacingTop'] ) ? $attributes['btnSpacingTop'] : '10';
    $btnFontSize = !empty( $attributes['btnFontSize'] ) ? $attributes['btnFontSize'] : '16';
    $btnPosition = !empty( $attributes['btnPosition'] ) ? $attributes['btnPosition'] : 'left';

    // Big Monitor Spacing
    $monitorPaddingTop = !empty( $attributes['monitorPaddingTop'] ) ? $attributes['monitorPaddingTop'] : '50';
    $monitorPaddingBottom = !empty( $attributes['monitorPaddingBottom'] ) ? $attributes['monitorPaddingBottom'] : '50';
    $monitorPaddingLeft = !empty( $attributes['monitorPaddingLeft'] ) ? $attributes['monitorPaddingLeft'] : '120';
    $monitorPaddingRight = !empty( $attributes['monitorPaddingRight'] ) ? $attributes['monitorPaddingRight'] : '120';

    // Desktop Spacing
    $paddingTop = !empty( $attributes['paddingTop'] ) ? $attributes['paddingTop'] : '50';
    $paddingBottom = !empty( $attributes['paddingBottom'] ) ? $attributes['paddingBottom'] : '50';
    $paddingLeft = !empty( $attributes['paddingLeft'] ) ? $attributes['paddingLeft'] : '120';
    $paddingRight = !empty( $attributes['paddingRight'] ) ? $attributes['paddingRight'] : '120';

    // Tablet Spacing
    $tabletPaddingTop = !empty( $attributes['tabletPaddingTop'] ) ? $attributes['tabletPaddingTop'] : '50';
    $tabletPaddingBottom = !empty( $attributes['tabletPaddingBottom'] ) ? $attributes['tabletPaddingBottom'] : '50';
    $tabletPaddingLeft = !empty( $attributes['tabletPaddingLeft'] ) ? $attributes['tabletPaddingLeft'] : '15';
    $tabletPaddingRight = !empty( $attributes['tabletPaddingRight'] ) ? $attributes['tabletPaddingRight'] : '15';

    // Mobile Spacing
    $mobilePaddingTop = !empty( $attributes['mobilePaddingTop'] ) ? $attributes['mobilePaddingTop'] : '50';
    $mobilePaddingBottom = !empty( $attributes['mobilePaddingBottom'] ) ? $attributes['mobilePaddingBottom'] : '70';
    $mobilePaddingLeft = !empty( $attributes['mobilePaddingLeft'] ) ? $attributes['mobilePaddingLeft'] : '15';
    $mobilePaddingRight = !empty( $attributes['mobilePaddingRight'] ) ? $attributes['mobilePaddingRight'] : '15';

	// Background Image
	$bgImageStatus = !empty( $attributes['bgImageStatus'] ) ? true : false;
	$bgImageID = !empty( $attributes['bgImage'] ) ? absint( $attributes['bgImage'] ) : '';
	$bgOverlay = !empty( $attributes['bgOverlay'] ) ? esc_attr( $attributes['bgOverlay'] ) : '';

    // Title
    $titleColor = !empty( $attributes['titleColor'] ) ? $attributes['titleColor'] : '#fff';
    $titleTextTransform = !empty( $attributes['titleTextTransform'] ) ? $attributes['titleTextTransform'] : 'uppercase';
    $titleTextAlign = !empty( $attributes['titleTextAlign'] ) ? $attributes['titleTextAlign'] : 'left';
    $titleTextSize = !empty( $attributes['titleTextSize'] ) ? $attributes['titleTextSize'] : '30';

    // Content
    $contentColor = !empty( $attributes['contentColor'] ) ? $attributes['contentColor'] : '#fff';
    $contentWordsLimit = !empty( $attributes['contentWordsLimit'] ) ? $attributes['contentWordsLimit'] : '50';
    $contentTextAlign = !empty( $attributes['contentTextAlign'] ) ? $attributes['contentTextAlign'] : 'left';
    $contentTextSize = !empty( $attributes['contentTextSize'] ) ? $attributes['contentTextSize'] : '17';
    $contentFontWeight = !empty( $attributes['contentFontWeight'] ) ? $attributes['contentFontWeight'] : 'normal';

	$page = !empty($selectedPageID) ? get_post( $selectedPageID ) : '';

    $containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$title = '';
	$content = '';

	if( is_object( $page ) ){
		$title = $page->post_title;
		$content = $page->post_content;
	} else {
		return '';
	}

	$rand = wp_generate_password( 20, false, false );
	$id = 'mb_calltoaction_' . $rand; 
	
	ob_start(); ?>

	<div id="<?php echo esc_attr( $id ); ?>" class="cta-list1 <?php echo esc_attr( 'mb_call_to_action_style_' . absint( $layout ) ) . ' ' . esc_attr( $className ); ?>">

        <section class="cta-inner text-center bg2">

            <?php 
            if( $shapeDividerTop ){ ?>
                <div class="eb_shape_divider_wrapper top">
                    <img src="<?php echo esc_url( $selectedShapeDividerImageTop ); ?>">
                </div>
                <?php 
            } ?>

          	<div class="container1 <?php echo ( $containerStatus ? 'container' : '' ); ?>">
            	<div class="row">
              		<div class="col-xs-12">

              			<div class="call_to_action_title_desc_wrap">

                			<h2 
                            style="font-size: <?php echo esc_attr( $titleTextSize ); ?>px;text-align: <?php echo esc_attr( $titleTextAlign ); ?>;text-transform: <?php echo esc_attr( $titleTextTransform ); ?>;color:<?php echo esc_attr( $titleColor ); ?>" >
                                <?php echo esc_html( $title ); ?>
                            </h2>

                			<p 
                            class="mar-top-30" 
                            style="font-weight: <?php echo esc_attr( $contentFontWeight ); ?>; font-size: <?php echo esc_attr( $contentTextSize ); ?>px;text-align: <?php echo esc_attr( $contentTextAlign ); ?>; color:<?php echo esc_attr( $contentColor ); ?>" >
                            <?php echo wp_trim_words( sanitize_text_field( $content ) , $contentWordsLimit, ' [...]' ); ?></p>

                            <?php
                            if( $hideDownloadBtn == false ){ ?>
                                <a 
                                href="<?php echo esc_url( $downloadLink ); ?>" 
                                class="btn btn-white mar-top-10"
                                style="float: <?php echo esc_attr( $btnPosition ) ?>; text-transform: <?php echo esc_attr( $btnTextTransform ) ?>; border-radius: <?php echo absint( $btnBorderRadius ) ?>px ;background:<?php echo esc_attr( $downloadBtnBackground ); ?>;color:<?php echo esc_attr( $downloadBtnTextColor ); ?>; padding-top: <?php echo absint( $btnSizeTopBottom ); ?>px; padding-bottom: <?php echo absint( $btnSizeTopBottom ); ?>px; padding-left: <?php echo absint( $btnSizeLeftRight ); ?>px; padding-right: <?php echo absint( $btnSizeLeftRight ); ?>px; margin-top: <?php echo absint( $btnSpacingTop ); ?>px; font-size: <?php echo absint( $btnFontSize ); ?>px;"
                                ><?php echo esc_html( $downloadText ); ?></a>
                                <?php 
                            }?>

                		</div>               		

              		</div>
            	</div>
          	</div>

            <?php 
            if( $shapeDividerBottom ){ ?>
                <div class="eb_shape_divider_wrapper">
                    <img src="<?php echo esc_url( $selectedShapeDividerImageBottom ); ?>">
                </div>
                <?php 
            } 

          	if( $bgImageStatus ){
          		echo '<div class="black-overlay"></div>';
          	} ?>

        </section>

    </div>

    <style>

        /**
         * Responsive
         */ 

        /* 
          ##Device = Desktops
          ##Screen = 1281px to higher resolution desktops
        */

        @media (min-width: 1601px) {

            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_1 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_2 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_3 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_4 .call_to_action_title_desc_wrap,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_5 .call_to_action_title_desc_wrap{
                padding-top: <?php echo absint( $monitorPaddingTop ); ?>px;
                padding-bottom: <?php echo absint( $monitorPaddingBottom ); ?>px;
                padding-left: <?php echo absint( $monitorPaddingLeft ); ?>px;
                padding-right: <?php echo absint( $monitorPaddingRight ); ?>px;
            }
  
        } 

        /* 
          ##Device = Laptops, Desktops
          ##Screen = B/w 1025px to 1280px
        */      

        @media (min-width: 1025px) and (max-width: 1600px) {

            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_1 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_2 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_3 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_4 .call_to_action_title_desc_wrap,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_5 .call_to_action_title_desc_wrap{
                padding-top: <?php echo absint( $paddingTop ); ?>px;
                padding-bottom: <?php echo absint( $paddingBottom ); ?>px;
                padding-left: <?php echo absint( $paddingLeft ); ?>px;
                padding-right: <?php echo absint( $paddingRight ); ?>px;
            }

        }   

        /* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_1 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_2 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_3 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_4 .call_to_action_title_desc_wrap,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_5 .call_to_action_title_desc_wrap{
                padding-top: <?php echo absint( $tabletPaddingTop ); ?>px;
                padding-bottom: <?php echo absint( $tabletPaddingBottom ); ?>px;
                padding-left: <?php echo absint( $tabletPaddingLeft ); ?>px;
                padding-right: <?php echo absint( $tabletPaddingRight ); ?>px;
            }
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_1 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_2 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_3 section.cta-inner,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_4 .call_to_action_title_desc_wrap,
            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_5 .call_to_action_title_desc_wrap{
                padding-top: <?php echo absint( $mobilePaddingTop ); ?>px;
                padding-bottom: <?php echo absint( $mobilePaddingBottom ); ?>px;
                padding-left: <?php echo absint( $mobilePaddingLeft ); ?>px;
                padding-right: <?php echo absint( $mobilePaddingRight ); ?>px;
            }
        }

    	<?php 
    	if( $bgImageStatus ){ ?>

    		#<?php echo esc_attr( $id ); ?> .black-overlay, 
    		#<?php echo esc_attr( $id ); ?> .white-overlay, 
    		#<?php echo esc_attr( $id ); ?> .blue-overlay, 
    		#<?php echo esc_attr( $id ); ?> .navy-overlay{
    			background: <?php echo esc_attr( $bgOverlay ) ?>;
    		}

    		#<?php echo esc_attr( $id ); ?> .cta-inner {
    			background: url( <?php elegant_blocks_get_bg_image( $bgImageID ); ?> ) no-repeat;
    		}

    		<?php 

    	} else { ?>

    		#<?php echo esc_attr( $id ); ?> .cta-inner {
    			background: <?php echo esc_attr( $backgroundColor ); ?>;
    		}

    		<?php
    	}

        if( $layout == 4 ){ ?>

            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_4 .call_to_action_title_desc_wrap:before{
                background: <?php echo esc_attr( $backgroundColor ); ?>;
            }

            <?php
        } elseif( $layout == 5 ){ ?>

            #<?php echo esc_attr( $id ); ?>.mb_call_to_action_style_5 .call_to_action_title_desc_wrap:before{
                background: <?php echo esc_attr( $backgroundColor ); ?>;
            }

            <?php
        } ?>
	</style>

	<?php

	$content = ob_get_clean();
	return $content;

}

function elegant_blocks_get_bg_image( $image_id ){

	$image_attributes = wp_get_attachment_image_src( $image_id , 'full' );

	if ( !empty( $image_attributes ) ){

		echo esc_url( $image_attributes[0] );

	}

}
