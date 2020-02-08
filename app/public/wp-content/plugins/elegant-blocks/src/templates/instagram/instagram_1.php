<?php
function elegant_blocks_render_instagram_1( $attribute ){

	// Get datas
	$title = !empty( $attribute['title'] ) ? $attribute['title'] : esc_html__( 'Follow Us On', 'elegant-blocks' );
	$instaUsername = !empty( $attribute['instaUsername'] ) ? $attribute['instaUsername'] : '';
	$userID = !empty( $attribute['userID'] ) ? $attribute['userID'] : '';
	$accessToken = !empty( $attribute['accessToken'] ) ? $attribute['accessToken'] : '';
	$count = !empty( $attribute['count'] ) ? $attribute['count'] : 20;
	$layout = !empty( $attribute['layout'] ) ? $attribute['layout'] : 1;
	$slidesToShow = !empty( $attribute['slidesToShow'] ) ? $attribute['slidesToShow'] : 10;
	$bgColor = !empty( $attribute['bgColor'] ) ? $attribute['bgColor'] : 'rgb(247, 247, 247)';
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	// Title
	$titlePrimaryColor = !empty( $attribute['titlePrimaryColor'] ) ? $attribute['titlePrimaryColor'] : 'rgb(51, 51, 51)';
	$titleSecondaryColor = !empty( $attribute['titleSecondaryColor'] ) ? $attribute['titleSecondaryColor'] : 'rgba(237,20,61,1)';

	$rand = wp_generate_password( 20,false,false );

	// unique name for each instagram section
	$name = 'instagram_1_' . $rand;
	$wrapper = 'instagram_wrapper_' . $rand;

	ob_start(); ?>

	<div class="insta_wrapper_1 <?php echo esc_attr( 'mb_instagram_style_' . $layout ) . ' ' . esc_attr( $className ); ?>" id="<?php echo esc_attr( $wrapper ); ?>">
		<div id="<?php echo esc_attr( $name ); ?>" class="megablocks_insta_1">
			<div class="insta_inner_wrapper"></div>
		</div>
	</div>

	<script>
		jQuery(document).ready(function(){
			
			jQuery('#<?php echo esc_attr( $name ); ?>').on('didLoadInstagram', function(event, response) {

			    jQuery.each(response.data,function(i,photo){

			    	// Display only one time
			    	if( i == 0 ){
			    		jQuery("#<?php echo esc_attr( $name ); ?>").prepend('<h3 class="text-center mar-bottom-20">' + "<?php echo wp_kses_post( $title . ' <span>' . $instaUsername . '</span>' ); ?>" + '</h3>');
			    	}
			    	
			    	jQuery("#<?php echo esc_attr( $name ); ?>").find('.insta_inner_wrapper').append('<div class="insta"><a target="_blank" href="' + photo.link + '"><img src="' + photo.images.thumbnail.url + '" alt="insta"></a></div>');
			    	
			    });

			});

			jQuery('#<?php echo esc_attr( $name ); ?>').instagram({
		  		userId: <?php echo preg_replace( '/\D/', '', $userID ); ?>,
		  		accessToken: "<?php echo esc_attr( str_replace( ' ' , '', $accessToken ) ); ?>",
		  		count: <?php echo absint( $count ); ?>
			});

			<?php 
			if( $layout == 2 ){ ?>

				setTimeout(function(){ 

					jQuery( "#<?php echo esc_attr( $name ); ?>" + ' .insta_inner_wrapper').slick({
			      		infinite: true,
			      		autoplay: true,
			      		arrows: true,
			      		dots: false,
			      		slidesToShow: <?php echo absint( $slidesToShow ); ?>,
			      		slidesToScroll: 1,
			      		responsive: [
				        	{
				          		breakpoint: 767,
				          		settings: {
				            		slidesToShow: 6,
				            		slidesToScroll: 1,
				            		infinite: true,
				          		}
				        	},
				        	{
				          		breakpoint: 639,
				          		settings: {
				            		slidesToShow: 3,
				            		slidesToScroll: 1,
				            		infinite: true,
				          		}
				        	}
			      		]
			    	});

				}, 1000);

				<?php 
			} ?>

		});
	</script>

	<style>
		#<?php echo esc_attr( $name ); ?> h3{
			color:<?php echo esc_attr( $titlePrimaryColor ); ?>;
		}
		#<?php echo esc_attr( $name ); ?> h3 span{
			color:<?php echo esc_attr( $titleSecondaryColor ); ?>;
		}
		#<?php echo esc_attr( $wrapper ); ?>.insta_wrapper_1 {
			background: <?php echo esc_attr( $bgColor ); ?>;
		}
	</style>

	<?php
	return ob_get_clean();
}