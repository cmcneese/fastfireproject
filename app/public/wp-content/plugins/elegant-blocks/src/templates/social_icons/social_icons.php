<?php

function elegant_blocks_social_style( $style ){

	switch ( $style ) {
		case '5':
			return 'mb_social_icon_style_5';
			break;
		case '4':
			return 'mb_social_icon_style_4';
			break;
		case '3':
			return 'mb_social_icon_style_3';
			break;
		case '2':
			return 'mb_social_icon_style_2';
			break;
		default:
			return 'mb_social_icon_style_1';
			break;
	}

}

function elegant_blocks_render_social_icons( $attribute ){

	$style = !empty( $attribute['style'] ) ? absint( $attribute['style'] ) : 1;
	$linksIcons = !empty( $attribute['linksIcons'] ) ? json_decode( $attribute['linksIcons'] ) : '';
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	$textAlign = !empty( $attribute['textAlign'] ) ? $attribute['textAlign'] : 'center';

	// Spacing
	$spacingTop = !empty( $attribute['spacingTop'] ) ? $attribute['spacingTop'] : '50';
	$spacingBottom = !empty( $attribute['spacingBottom'] ) ? $attribute['spacingBottom'] : '50';
	$spacingLeft = !empty( $attribute['spacingLeft'] ) ? $attribute['spacingLeft'] : '50';
	$spacingRight = !empty( $attribute['spacingRight'] ) ? $attribute['spacingRight'] : '50';

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	ob_start();

	if( is_array( $linksIcons ) ){ ?>

		<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

			<div 
			style="text-align: <?php echo esc_attr( $textAlign ); ?>; padding-top: <?php echo absint( $spacingTop ) ?>px; padding-bottom: <?php echo absint( $spacingBottom ) ?>px;padding-left: <?php echo absint( $spacingLeft ) ?>px;padding-right: <?php echo absint( $spacingRight ) ?>px;" 
			class="mb_social_icon <?php echo esc_attr( elegant_blocks_social_style( $style ) ) . ' ' . esc_attr( $className ); ?>">

				<?php
				foreach( $linksIcons as $key => $value ){

					echo '<a class="mb_social_icon_link" target="_blank" href="' . esc_url( $value->value ) . '"><i class="' . esc_attr( $value->key ) . '"></i></a>';

				} ?>

			</div>

		</div>

		<?php

	}

	return ob_get_clean();

}