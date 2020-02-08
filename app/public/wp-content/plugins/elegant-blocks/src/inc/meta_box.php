<?php

/**
 * Register meta box(es).
 */

add_action( 'add_meta_boxes', 'elegant_blocks_register_meta_boxes' );
function elegant_blocks_register_meta_boxes() {

    add_meta_box( 
    	'team_fields', 
    	__( 'Teams Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_team_fields', 
    	'ct_teams' 
    );

    add_meta_box( 
    	'testimonials_fields', 
    	__( 'Testimonials Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_testimonials_fields', 
    	'ct_testimonials' 
    );

    add_meta_box( 
    	'services_fields', 
    	__( 'Services Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_services_fields', 
    	'cp_services' 
    );

    add_meta_box( 
    	'slider_fields', 
    	__( 'Slider Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_slider_fields', 
    	'ct_slider' 
    );

    add_meta_box( 
    	'clients_fields', 
    	__( 'Client Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_clients_fields', 
    	'eb_clients' 
    );

    add_meta_box( 
    	'icon_fields', 
    	__( 'Icon Fields', 'elegant-blocks' ), 
    	'elegant_blocks_get_icon_fields', 
    	'post' 
    );
}

function elegant_get_fontawesome_5_icons( $post ){

	$icons = bizberg_fontawesome_5_icons();
	$icon = get_post_meta( $post->ID, 'icon', true ); ?>
	
	<div class="fontawesome_search_post_wrapper">

		<div class="icon-wrapper-font">
			<div class="left">
				<label>
			        <?php esc_html_e( 'Icon', 'elegant-blocks' ); ?>
			    </label>
				<input type="text" name="fontawesome_search_post" placeholder="Search Icons" class="fontawesome_search_post">
			</div>

			<div class="right">
				<label>
			        <?php esc_html_e( 'Selected Icon', 'elegant-blocks' ); ?>
			    </label>
			    <i class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		</div>

		<ul class="eb_post_field_fontawesome_select">
			
			<?php 
			foreach ( $icons as $key => $value ) { ?>
				
				<li class="fontawesome-icons-post <?php echo ( $value == $icon ? 'active' : '' ); ?>">
					<a href="javascript:void(0)">
						<i class="<?php echo esc_attr( $value ); ?>" data-value="<?php echo esc_attr( $key ); ?>"></i>
					</a>
				</li>

				<?php
			}
			?>

		</ul>

		<input type="text" name="icon" value="<?php echo esc_attr( $icon ); ?>" placeholder="eg. fa-facebook" class="post_icon_fontawesome">

	</div>

	<?php

}

function elegant_blocks_get_icon_fields( $post ){ ?>

	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">

   			<?php elegant_get_fontawesome_5_icons( $post ); ?>
			
		</div>

	</div>

	<?php
}

function elegant_blocks_get_clients_fields( $post ){ 

	$link = get_post_meta( $post->ID, 'link', true ); ?>

	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="link" value="<?php echo esc_url( $link ); ?>" placeholder="eg. http://example.com">
			<p class="description">If not empty, when click on the image it will redirect to the given url.</p>
		</div>

	</div>

	<?php
}

function elegant_blocks_get_slider_fields( $post ){

	$button_link = get_post_meta( $post->ID, 'button_link', true ); ?>

	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Button Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="button_link" value="<?php echo esc_url( $button_link ); ?>" placeholder="eg. http://example.com">
			<p class="description">If not empty, the slider's button link will be this.</p>
		</div>

	</div>

	<?php
}

function elegant_blocks_get_services_fields( $post ){ 

	$icon = get_post_meta( $post->ID, 'icon', true ); 
	$link = get_post_meta( $post->ID, 'link', true ); ?>

	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">
		   	<?php elegant_get_fontawesome_5_icons( $post ); ?>
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="link" value="<?php echo esc_url( $link ); ?>" placeholder="eg. http://example.com">
			<p class="description">Custom link for service section, it will override default <code>get_permalink()</code> if not empty</p>
		</div>

	</div>

	<?php
}

function elegant_blocks_get_testimonials_fields( $post ){ 

	$position = get_post_meta( $post->ID, 'position', true );
	$rating = get_post_meta( $post->ID, 'rating', true );
	$fb_link = get_post_meta( $post->ID, 'fb_link', true );
	$tw_link = get_post_meta( $post->ID, 'tw_link', true );
	$ig_link = get_post_meta( $post->ID, 'ig_link', true ); 
	$lk_link = get_post_meta( $post->ID, 'lk_link', true ); ?>

	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Company / Position', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="position" value="<?php echo esc_attr( $position ); ?>" placeholder="eg. CEO">
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Rating', 'elegant-blocks' ); ?>
		    </label>
			<select name="testimonial_rating">
				<option value="1" <?php selected( $rating, 1 ); ?>>1</option>
				<option value="2" <?php selected( $rating, 2 ); ?>>2</option>
				<option value="3" <?php selected( $rating, 3 ); ?>>3</option>
				<option value="4" <?php selected( $rating, 4 ); ?>>4</option>
				<option value="5" <?php selected( $rating, 5 ); ?>>5</option>
			</select>
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Facebook Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="fb_link" value="<?php echo esc_url( $fb_link ); ?>" autocomplete="off">
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Twitter Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="tw_link" value="<?php echo esc_url( $tw_link ); ?>" autocomplete="off">
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Instagram Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="ig_link" value="<?php echo esc_url( $ig_link ); ?>" autocomplete="off">
		</div>

		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_html_e( 'Linkedin Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="lk_link" value="<?php echo esc_url( $lk_link ); ?>" autocomplete="off">
		</div>

	</div>

	<?php
}
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */

function elegant_blocks_get_team_fields( $post ) { 

	$position = get_post_meta( $post->ID, 'position', true );
	$facebook = get_post_meta( $post->ID, 'facebook_link', true );
	$twitter = get_post_meta( $post->ID, 'twitter_link', true );
	$google_plus = get_post_meta( $post->ID, 'google_plus_link', true );
	$instagram = get_post_meta( $post->ID, 'instagram_link', true ); ?>
   	
   	<div class="megablocks_wrapper_custom_fields">

   		<div class="megablocks_meta_box_wrapper">
		   	<label>
		        <?php esc_attr_e( 'Position', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="position" value="<?php echo esc_attr( $position ); ?>" placeholder="eg. CEO">
		</div>

		<div class="megablocks_meta_box_wrapper">
			<label>
		        <?php esc_attr_e( 'Facebook Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="facebook" value="<?php echo esc_attr( $facebook ); ?>">
		</div>

		<div class="megablocks_meta_box_wrapper">
			<label>
		        <?php esc_attr_e( 'Twitter Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="twitter" value="<?php echo esc_attr( $twitter ); ?>">
		</div>

		<div class="megablocks_meta_box_wrapper">
			<label>
		        <?php esc_attr_e( 'Google Plus Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="google_plus" value="<?php echo esc_attr( $google_plus ); ?>">
		</div>

		<div class="megablocks_meta_box_wrapper">
			<label>
		        <?php esc_attr_e( 'Instagram Link', 'elegant-blocks' ); ?>
		    </label>
			<input type="text" name="instagram" value="<?php echo esc_attr( $instagram ); ?>">
		</div>

	</div>

   	<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */

add_action( 'save_post', 'elegant_blocks_save_meta_box',10,2 );
function elegant_blocks_save_meta_box( $post_id , $post ) {

	// Break if is quick edit
	if( empty( $_POST ) || $_POST['action'] == 'inline-save' ){
		return;
	}

	$post_type = $post->post_type;

	switch ( $post_type ) {

		case 'eb_clients':
			$link = !empty( $_POST['link'] ) ? esc_url( $_POST['link'] ) : '';
			update_post_meta( $post_id, 'link', $link );
			break;

		case 'ct_testimonials':
			$position = !empty( $_POST['position'] ) ? sanitize_text_field( $_POST['position'] ) : '';
			$rating = !empty( $_POST['testimonial_rating'] ) ? absint( $_POST['testimonial_rating'] ) : '';
			$fb_link = !empty( $_POST['fb_link'] ) ? esc_url( $_POST['fb_link'] ) : '';
			$tw_link = !empty( $_POST['tw_link'] ) ? esc_url( $_POST['tw_link'] ) : '';
			$ig_link = !empty( $_POST['ig_link'] ) ? esc_url( $_POST['ig_link'] ) : '';
			$lk_link = !empty( $_POST['lk_link'] ) ? esc_url( $_POST['lk_link'] ) : '';
			update_post_meta( $post_id, 'position', $position );
			update_post_meta( $post_id, 'rating', $rating );
			update_post_meta( $post_id, 'fb_link', $fb_link );
			update_post_meta( $post_id, 'tw_link', $tw_link );
			update_post_meta( $post_id, 'ig_link', $ig_link );
			update_post_meta( $post_id, 'lk_link', $lk_link );
			break;

		case 'ct_teams':
			$position = !empty( $_POST['position'] ) ? sanitize_text_field( $_POST['position'] ) : '';
			$facebook = !empty( $_POST['facebook'] ) ? sanitize_text_field( $_POST['facebook'] ) : '';
			$twitter = !empty( $_POST['twitter'] ) ? sanitize_text_field( $_POST['twitter'] ) : '';
			$google_plus = !empty( $_POST['google_plus'] ) ? sanitize_text_field( $_POST['google_plus'] ) : '';
			$instagram = !empty( $_POST['instagram'] ) ? sanitize_text_field( $_POST['instagram'] ) : '';

			update_post_meta( $post_id, 'position', $position );
			update_post_meta( $post_id, 'facebook_link', $facebook );
			update_post_meta( $post_id, 'twitter_link', $twitter );
			update_post_meta( $post_id, 'google_plus_link', $google_plus );
			update_post_meta( $post_id, 'instagram_link', $instagram );
			break;

		case 'cp_services':
			$icon = !empty( $_POST['icon'] ) ? sanitize_text_field( $_POST['icon'] ) : '';
			$link = !empty( $_POST['link'] ) ? esc_url( $_POST['link'] ) : '';
			update_post_meta( $post_id, 'icon', $icon );
			update_post_meta( $post_id, 'link', $link );
			break;

		case 'ct_slider':
			$button_link = !empty( $_POST['button_link'] ) ? esc_url( $_POST['button_link'] ) : '';
			update_post_meta( $post_id, 'button_link', $button_link );
			break;

		case 'post':
			$icon = !empty( $_POST['icon'] ) ? sanitize_text_field( $_POST['icon'] ) : '';
			update_post_meta( $post_id, 'icon', $icon );
			break;
		
		default:
			# code...
			break;
	}

}