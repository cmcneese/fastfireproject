<?php

function elegant_blocks_render_newsletter_1( $attributes ){

	$title = !empty( $attributes['title'] ) ? $attributes['title'] : 'Subscribe To Our Newsletter';
	$subTitle = !empty( $attributes['subTitle'] ) ? $attributes['subTitle'] : 'We will not send spam emails.';
	$selectedIcon = !empty( $attributes['selectedIcon'] ) ? $attributes['selectedIcon'] : 'fa-envelope';
	$shortcode = !empty( $attributes['shortcode'] ) ? $attributes['shortcode'] : '';
	$containerStatus = !empty( $attributes['containerStatus'] ) ? true : false;
	$className = !empty( $attributes['className'] ) ? $attributes['className'] : '';

	$spacingTop = !empty( $attributes['spacingTop'] ) ? $attributes['spacingTop'] : '40';
	$spacingBottom = !empty( $attributes['spacingBottom'] ) ? $attributes['spacingBottom'] : '40';

	// Colors
	$backgroundColor = !empty( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '#f1f1f1';
	$iconColor = !empty( $attributes['iconColor'] ) ? $attributes['iconColor'] : '#2fbeef';
	$buttonColor = !empty( $attributes['buttonColor'] ) ? $attributes['buttonColor'] : '#2fbeef';

	$rand = wp_generate_password( 20, false, false );
	$id = 'eb_newsletter_btn_' . $rand;

	ob_start(); ?>

	<style>
		#<?php echo esc_attr( $id ); ?> input[type="submit"]{
			background : <?php echo esc_attr( $buttonColor ); ?>;
		}
	</style>

	<div 
	id="<?php echo esc_attr( $id ); ?>"
	class="subscription-7-main <?php echo esc_attr( $className ); ?>" 
	style="background:<?php echo esc_attr( $backgroundColor ); ?>; padding-top: <?php echo esc_attr( $spacingTop ); ?>px; padding-bottom: <?php echo esc_attr( $spacingBottom ); ?>px;">

		<?php 
		if( !$containerStatus ){ ?>
			<div class="container">
			<?php 
		} ?>
			<div class="subscription-list">
	      		<div class="row">        	
	            	<div class="col-md-6 col-sm-6 col-xs-12 subscription-align">
	            		<div class="newsletter_icon_wrapper">
	            			<i 
	            			style="color: <?php echo esc_attr( $iconColor ); ?>"
	            			class="<?php echo esc_html( $selectedIcon ); ?>"></i>
	            		</div>
	            		<div class="newsletter_title_wrapper">
		              		<h3><?php echo esc_html( $title ); ?></h3>
		              		<p><?php echo esc_html( $subTitle ); ?></p>
		              	</div>
	            	</div>

	            	<div class="col-md-6 col-sm-6 col-xs-12">
	              		<div class="subscription-inner">
	                		<?php echo do_shortcode( $shortcode ); ?>
	              		</div>
	            	</div>  
	        	</div>
	      	</div>
	      	<?php 
			if( !$containerStatus ){ ?>
		    	</div>
		    	<?php 
			} ?>
    </div>

	<?php

	return ob_get_clean();

}