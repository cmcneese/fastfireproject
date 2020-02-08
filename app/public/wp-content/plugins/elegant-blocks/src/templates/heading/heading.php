<?php

function elegant_blocks_render_heading( $attribute ){

	$tag = !empty( $attribute['headingTag'] ) ? $attribute['headingTag'] : 'h2'; 
	$alignment = !empty( $attribute['alignment'] ) ? $attribute['alignment'] : 'center'; 
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	/**
	* Title
	*/

	$title = !empty( $attribute['title'] ) ? $attribute['title'] : 'Title'; 
	$headingFontSize = !empty( $attribute['headingFontSize'] ) ? $attribute['headingFontSize'] : 20;
	$headingColor = !empty( $attribute['headingColor'] ) ? $attribute['headingColor'] : '#000';  
	$headingSpacing = !empty( $attribute['headingSpacing'] ) ? $attribute['headingSpacing'] : 0;  

	/**
	* Sub-Title
	*/

	$subtitle = !empty( $attribute['subtitle'] ) ? $attribute['subtitle'] : ''; 
	$subHeadingFontSize = !empty( $attribute['subHeadingFontSize'] ) ? $attribute['subHeadingFontSize'] : 15;
	$subHeadingColor = !empty( $attribute['subHeadingColor'] ) ? $attribute['subHeadingColor'] : '#000'; 
	$subHeadingSpacing = !empty( $attribute['subHeadingSpacing'] ) ? $attribute['subHeadingSpacing'] : 0; 

	/**
	* Separator
	*/ 

	$separatorStyle = !empty( $attribute['separatorStyle'] ) ? $attribute['separatorStyle'] : 'solid'; 
	$separatorThickness = !empty( $attribute['separatorThickness'] ) ? $attribute['separatorThickness'] : '2'; 
	$separatorWidth = !empty( $attribute['separatorWidth'] ) ? $attribute['separatorWidth'] : '20'; 
	$separatorColor = !empty( $attribute['separatorColor'] ) ? $attribute['separatorColor'] : '#000'; 
	$separatorSpacing = !empty( $attribute['separatorSpacing'] ) ? $attribute['separatorSpacing'] : 0;

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	$rand = wp_generate_password( 20, false, false );
	$id = 'mb_heading_id_' . $rand;

	ob_start(); ?>

	<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>"> 

		<div class="mb_heading_wrapper <?php echo esc_attr( $className ); ?>" id="<?php echo esc_attr( $id ); ?>">
			<<?php echo esc_attr( $tag ); ?>>
				<?php echo wp_kses_post( $title ); ?>
			</<?php echo esc_attr( $tag ); ?>>

			<div class="mb_separator_heading_wrapper">
				<div class="mb_separator_heading"></div>
			</div>

			<?php 
			if( !empty( $subtitle ) ){ ?>
				<p><?php echo wp_kses_post( $subtitle ); ?></p>
				<?php 
			}?>

		</div>

	</div>

	<style>

		#<?php echo esc_attr( $id ); ?>.mb_heading_wrapper{
			text-align: <?php echo esc_attr( $alignment ); ?>;
		}	

		#<?php echo esc_attr( $id ) . ' ' . esc_attr( $tag ); ?>{
			font-size: <?php echo absint( $headingFontSize ); ?>px;
			color: <?php echo esc_attr( $headingColor ); ?>;
			margin-bottom: <?php echo absint( $headingSpacing ); ?>px;
		}

		#<?php echo esc_attr( $id ); ?> p{
			font-size: <?php echo absint( $subHeadingFontSize ); ?>px;
			color: <?php echo esc_attr( $subHeadingColor ); ?>;
			margin-bottom: <?php echo absint( $subHeadingSpacing ); ?>px;
		}

		#<?php echo esc_attr( $id ); ?> .mb_separator_heading{
			border-top-style: <?php echo esc_attr( $separatorStyle ); ?>;
			border-top-width: <?php echo esc_attr( $separatorThickness ); ?>px;
			width: <?php echo absint( $separatorWidth ); ?>%;
			color: <?php echo esc_attr( $separatorColor ); ?>;
			margin-bottom: <?php echo absint( $separatorSpacing ); ?>px;
			display: inline-block;
		}

	</style>

	<?php

	return ob_get_clean();

}