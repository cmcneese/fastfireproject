<?php

function elegant_blocks_render_video_1( $attributes ){

	$layout = !empty( $attributes['layout'] ) ? $attributes['layout'] : '1';
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	$topHeadingTitle = !empty( $attributes['topHeadingTitle'] ) ? $attributes['topHeadingTitle'] : 'Welcome To Elegant Block';
	$hideTopHeadingTitle = !empty( $attributes['hideTopHeadingTitle'] ) ? true : false;

	$bottomHeadingTitle = !empty( $attributes['bottomHeadingTitle'] ) ? $attributes['bottomHeadingTitle'] : 'Let us know why you are the best';
	$bottomHeadingTitleFontSize = !empty( $attributes['bottomHeadingTitleFontSize'] ) ? $attributes['bottomHeadingTitleFontSize'] : '40';

	$description = !empty( $attributes['description'] ) ? $attributes['description'] : 'Ex quo legimus nominati imperdiet, ad sed error verear volumus. Eu meis saepe corrumpit nec, movet postea gloriatur ne duo, ut causae labitur indoctum his. Usu at enim suscipiantur, at summo debet pri, id officiis intellegat pro uto eos summo.';

	$readMoreTitle = !empty( $attributes['readMoreTitle'] ) ? $attributes['readMoreTitle'] : 'Watch Video';
	$videoUrl = !empty( $attributes['videoUrl'] ) ? $attributes['videoUrl'] : '';
	$bgImageID = !empty( $attributes['bgImage'] ) ? $attributes['bgImage'] : '';
	$primaryColor = !empty( $attributes['primaryColor'] ) ? $attributes['primaryColor'] : '#ffa500';
	$readMoreFontColor = !empty( $attributes['readMoreFontColor'] ) ? $attributes['readMoreFontColor'] : '#232323';

	// Desktop Spacing
	$spacingTop = !empty( $attributes['spacingTop'] ) ? $attributes['spacingTop'] : '100';
	$spacingBottom = !empty( $attributes['spacingBottom'] ) ? $attributes['spacingBottom'] : '100';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attributes['tabletSpacingTop'] ) ? $attributes['tabletSpacingTop'] : '50';
	$tabletSpacingBottom = !empty( $attributes['tabletSpacingBottom'] ) ? $attributes['tabletSpacingBottom'] : '50';

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attributes['mobileSpacingTop'] ) ? $attributes['mobileSpacingTop'] : '50';
	$mobileSpacingBottom = !empty( $attributes['mobileSpacingBottom'] ) ? $attributes['mobileSpacingBottom'] : '50';

	$image_attributes = wp_get_attachment_image_src( $bgImageID , 'medium_large' );

	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;

	$rand = wp_generate_password( 12, false, false );
	$id = 'eb_description_1_' . $rand;

	ob_start(); ?>

	<style>
		#<?php echo esc_attr( $id ); ?> .about-inner h4:before{
			    background: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> .about-inner a:hover{
			background: <?php echo esc_attr( $primaryColor ); ?>;
    		border-color: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> .about-images:before{
			border-color: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> .pulses button span,
		#<?php echo esc_attr( $id ); ?> button.js-video-button i {
			color: <?php echo esc_attr( $readMoreFontColor ); ?>;
			    transition: all ease-in-out 0.5s;
		}
		#<?php echo esc_attr( $id ); ?> button.js-video-button i {
			border-color: <?php echo esc_attr( $readMoreFontColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> button.js-video-button:hover{
			color: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> button.js-video-button:hover i {
		    color: <?php echo esc_attr( $primaryColor ); ?>;
		    border-color: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> button.js-video-button:hover i {
			border-color: <?php echo esc_attr( $primaryColor ); ?>;
		}
		#<?php echo esc_attr( $id ); ?> button.js-video-button:hover span {
			color: <?php echo esc_attr( $primaryColor ); ?>;
		}

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

            #<?php echo esc_attr( $id ); ?> {
                padding-top: <?php echo absint( $tabletSpacingTop ); ?>px !important;
                padding-bottom: <?php echo absint( $tabletSpacingBottom ); ?>px !important;
            }

        } 

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {

        	#<?php echo esc_attr( $id ); ?> {
                padding-top: <?php echo absint( $mobileSpacingTop ); ?>px !important;
                padding-bottom: <?php echo absint( $mobileSpacingBottom ); ?>px !important;
            }

        }

	</style>

	<div 
	style="padding-top: <?php echo esc_attr( $spacingTop ) ?>px;padding-bottom: <?php echo esc_attr( $spacingBottom ) ?>px;"
	class="about-3-main <?php echo esc_attr( $className ); ?>" 
	id="<?php echo esc_attr( $id ); ?>">
      	<div class="eb_container <?php echo ( !$containerStatus ? 'container' : '' ); ?>">
        	<div class="row">
            	<div class="col-md-6 col-sm-6 <?php echo ( $layout == 2 ? 'about-align' : '' ); ?>">
              		<div class="about-inner">

              			<?php 
              			if( empty( $hideTopHeadingTitle ) ){ ?>
	                  		<div class="about-label">
	                    		<h4>
	                    			<?php echo esc_html( $topHeadingTitle ); ?>
	                    		</h4>
	                  		</div>
	                  		<?php 
	                  	} ?>
	                  	
                  		<h2 
                  		style="font-size: <?php echo esc_attr( $bottomHeadingTitleFontSize ); ?>px" 
                  		class="about-title">
                  			<?php echo esc_html( $bottomHeadingTitle ); ?>
                  		</h2>
                  		<p class="about-text">
                    		<?php echo wp_kses_post( nl2br( $description ) ); ?>
                  		</p>                  		

                  		<?php 
                  		if( !empty( $videoUrl ) ){ ?>
                  			<div class="pulses">
			                    <button 
			                    type="button" 
			                    class="play-btn js-video-button" 
			                    data-video-id="<?php echo esc_attr( elegant_blocks_get_video_id( $videoUrl ) ); ?>">
			                    	<i class="fa fa-play"></i> <span><?php echo esc_html( $readMoreTitle ); ?></span>
			                    </button>
			                </div>
			                <script>
								jQuery(document).ready(function(){
							        jQuery("#<?php echo esc_attr( $id ); ?> .js-video-button").modalVideo(
							        	{
							        		channel: <?php echo (elegant_blocks_check_domain( $videoUrl ) == 'vimeo' ? "'vimeo'" : "'youtube'" ); ?>
							        	}
							        );
							    });
							</script>
                  			<?php 
                  		}?>

              		</div>
          		</div>
          		<div class="col-md-6 col-sm-6">
              		<div class="about-images">
              			<?php
              			$default_img = ELEGANTBLOCKS_PLUGIN_URL . 'src/images/sm_slider_01.jpg';
              			if( !empty( $image_attributes[0] ) ){ ?>
              				<img src="<?php echo esc_url( $image_attributes[0] ); ?>" alt="<?php echo esc_attr($bottomHeadingTitle); ?>">
              				<?php 
              			} else { ?>
              				<img src="<?php echo esc_url( $default_img ); ?>" alt="<?php echo esc_attr($bottomHeadingTitle); ?>">
              				<?php
              			}?>
              		</div>
          		</div>
        	</div>
      	</div>
    </div>

	<?php
	return ob_get_clean();

}

function elegant_blocks_check_domain( $url ){

	if(stripos($url,'youtu')===false){
    	return 'vimeo';
    } else {
    	return 'youtube';
    }

}

function elegant_blocks_get_video_id( $url ){
	if( elegant_blocks_check_domain( $url ) == 'vimeo' ){
		return elegant_blocks_get_vimeo_id( $url );
	} else {
		return elegant_blocks_get_youtube_id( $url );
	}
}

function elegant_blocks_get_vimeo_id( $url ){
	return (int) substr(parse_url( $url, PHP_URL_PATH ), 1 );
}

function elegant_blocks_get_youtube_id( $url ){
	preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
	return $matches[1];
}