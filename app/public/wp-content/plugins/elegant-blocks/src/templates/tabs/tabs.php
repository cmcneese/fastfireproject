<?php

function elegant_blocks_tab_style( $style ){

	switch ( $style ) {

		case '4':
			return 'tab_style_4';
			break;

		case '3':
			return 'tab_style_3';
			break;

		case '2':
			return 'tab_style_2';
			break;
		
		default:
			return 'tab_style_1';
			break;
	}

}

function elegant_blocks_render_tabs( $attribute ){

	$catID = !empty( $attribute['selectedPostCategoryID'] ) ? absint( $attribute['selectedPostCategoryID'] ) : ''; 
	$style = !empty( $attribute['style'] ) ? absint( $attribute['style'] ) : 1; 
	$className = !empty( $attribute['className'] ) ? $attribute['className'] : '';

	$animation = !empty( $attribute['animation'] ) ? $attribute['animation'] : 'fadeInUp'; 
	$backgroundColor = !empty( $attribute['backgroundColor'] ) ? $attribute['backgroundColor'] : '#1ABC9C';

	// Desktop Spacing
	$spacingTop = !empty( $attribute['spacingTop'] ) ? $attribute['spacingTop'] : '50';
	$spacingBottom = !empty( $attribute['spacingBottom'] ) ? $attribute['spacingBottom'] : '50';
	$spacingLeft = !empty( $attribute['spacingLeft'] ) ? $attribute['spacingLeft'] : '50';
	$spacingRight = !empty( $attribute['spacingRight'] ) ? $attribute['spacingRight'] : '50';

	// Tablet Spacing
	$tabletSpacingTop = !empty( $attribute['tabletSpacingTop'] ) ? $attribute['tabletSpacingTop'] : '50';
	$tabletSpacingBottom = !empty( $attribute['tabletSpacingBottom'] ) ? $attribute['tabletSpacingBottom'] : '50';
	$tabletSpacingLeft = !empty( $attribute['tabletSpacingLeft'] ) ? $attribute['tabletSpacingLeft'] : '15';
	$tabletSpacingRight = !empty( $attribute['tabletSpacingRight'] ) ? $attribute['tabletSpacingRight'] : '15';

	// Mobile Spacing
	$mobileSpacingTop = !empty( $attribute['mobileSpacingTop'] ) ? $attribute['mobileSpacingTop'] : '50';
	$mobileSpacingBottom = !empty( $attribute['mobileSpacingBottom'] ) ? $attribute['mobileSpacingBottom'] : '50';
	$mobileSpacingLeft = !empty( $attribute['mobileSpacingLeft'] ) ? $attribute['mobileSpacingLeft'] : '5';
	$mobileSpacingRight = !empty( $attribute['mobileSpacingRight'] ) ? $attribute['mobileSpacingRight'] : '5';

	$containerStatus = !empty( $attribute['containerStatus'] ) ? true : false;

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'cat' => $catID
	); 

	$tabs_query = new WP_Query( $args );
	$rand = wp_generate_password( 20, false, false );
	$tabID = 'mb_tabs_' . $rand;

	ob_start();

	if( $tabs_query->have_posts() ): ?>

		<div class="<?php echo ( $containerStatus ? 'container' : '' ); ?>">

			<div 
			style="padding-top: <?php echo absint( $spacingTop ) ?>px;padding-bottom: <?php echo absint( $spacingBottom ) ?>px;padding-left: <?php echo absint( $spacingLeft ) ?>px;padding-right: <?php echo absint( $spacingRight ) ?>px;"
			class="<?php echo esc_attr( elegant_blocks_tab_style( $style ) ) . ' ' . esc_attr( $className ); ?> eb_tabs" 
			id="<?php echo esc_attr( $tabID ); ?>">			

				<ul class="nav nav-tabs">

					<?php 
					$count = 0;
					$i = array();
					while( $tabs_query->have_posts() ): $tabs_query->the_post(); 

						global $post;

						$rand = wp_generate_password( 20, false, false );
						$i[] = $rand;?>

			    		<li class="<?php echo esc_attr( $count == 0 ? 'active' : '' ); ?>">
			    			<a data-toggle="tab" href="#<?php echo esc_attr( 'mb_tab_' . $rand ); ?>">
			    				<?php the_title(); ?>
			    			</a>
			    		</li>

			    		<?php
			    		$count++;
			    	endwhile; ?>

			  	</ul>

			  	<div class="tab-content">

			  		<?php 
			  		$count1 = 0;
			  		while( $tabs_query->have_posts() ): $tabs_query->the_post(); ?>

				    	<div id="<?php echo esc_attr( 'mb_tab_' . $i[$count1] ); ?>" class="animated <?php echo esc_attr( $animation ); ?> tab-pane <?php echo esc_attr( $count1 == 0 ? 'active' : '' ); ?>">
				      		<?php the_content(); ?>
				    	</div>

						<?php
			    		$count1++;
			    	endwhile; ?>		    	

			  	</div>

			</div>

		</div>

		<style>

		#<?php echo esc_attr( $tabID ); ?>.tab_style_4 .nav-tabs>li.active>a, 
		#<?php echo esc_attr( $tabID ); ?>.tab_style_4 .nav-tabs>li.active>a:focus, 
		#<?php echo esc_attr( $tabID ); ?>.tab_style_4 .nav-tabs>li.active>a:hover{
			background: <?php echo esc_attr( $backgroundColor ); ?>;
		}

		#<?php echo esc_attr( $tabID ); ?>.tab_style_4 > ul{
			border-right: 5px solid <?php echo esc_attr( $backgroundColor ); ?>;
		}

		#<?php echo esc_attr( $tabID ); ?>.tab_style_2 .nav-tabs>li.active>a, 
		#<?php echo esc_attr( $tabID ); ?>.tab_style_2 .nav-tabs>li.active>a:focus, 
		#<?php echo esc_attr( $tabID ); ?>.tab_style_2 .nav-tabs>li.active>a:hover {
		    background: <?php echo esc_attr( $backgroundColor ); ?>;
		    border: 1px solid <?php echo esc_attr( $backgroundColor ); ?>;
		}
		#<?php echo esc_attr( $tabID ); ?>.tab_style_2 > ul.nav-tabs {
		    border-bottom: 5px solid <?php echo esc_attr( $backgroundColor ); ?>;
		}

		/* 
          ##Device = Tablets, Ipads (portrait)
        */    

        @media (min-width: 768px) and (max-width: 1024px) , (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            #<?php echo esc_attr( $tabID ); ?> {
            	padding-top: <?php echo absint( $tabletSpacingTop ) ?>px !important;
            	padding-bottom: <?php echo absint( $tabletSpacingBottom ) ?>px !important;
            	padding-left: <?php echo absint( $tabletSpacingLeft ) ?>px !important;
            	padding-right: <?php echo absint( $tabletSpacingRight ) ?>px !important;
            }
        }

        /* 
          ##Device = Most of the Smartphones Mobiles (Portrait)
        */

        @media (min-width: 300px) and (max-width: 767px) {
	    	#<?php echo esc_attr( $tabID ); ?> {
            	padding-top: <?php echo absint( $mobileSpacingTop ) ?>px !important;
            	padding-bottom: <?php echo absint( $mobileSpacingBottom ) ?>px !important;
            	padding-left: <?php echo absint( $mobileSpacingLeft ) ?>px !important;
            	padding-right: <?php echo absint( $mobileSpacingRight ) ?>px !important;
            }
        }

		</style>

		<?php
	
	endif;
	$content = ob_get_clean();
	return $content;

}