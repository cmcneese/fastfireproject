<?php

/**
 * Register a menu page.
 */

add_action( 'admin_menu', 'elegant_blocks_menu_page' );
function elegant_blocks_menu_page() {

    add_menu_page(
        esc_html__( 'Elegant Blocks', 'elegant-blocks' ),
        esc_html__( 'Elegant Blocks', 'elegant-blocks' ),
        'manage_options',
        'elegant-blocks-settings',
        'elegant_blocks_settings_page',
        'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="-2 -2 26 26" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="m26 119l204 67l0 292l-203-69m254 70l205-70l0-288l-204 64m-26-34l188-61l-188-57l-193 57" transform="scale(0.04 0.04)"></path></svg>')
    );

    //call register settings function
	add_action( 'admin_init', 'elegant_blocks_register_plugin_settings' );

}

function elegant_blocks_register_plugin_settings() {

	$settings = array( 
		'elegant_blocks_bootstrap_status', 
		'elegant_blocks_google_font_status',
		'elegant_blocks_block_status' ,
		'elegant_blocks_google_map_api',
		'elegant_blocks_google_map_script',
		'elegant_blocks_disable_smaller_images_on_import'
	);

	//register our settings
	foreach ( $settings as $value ) {
		register_setting( 'elegant_blocks_register_plugin_settings_group', $value );
	}
	
}

function elegant_blocks_settings_page(){ 

	$bootstrap_status = absint( get_option( 'elegant_blocks_bootstrap_status' ) ); 
	$google_font_status = absint( get_option( 'elegant_blocks_google_font_status' ) ); 
	$block_status = get_option( 'elegant_blocks_block_status' , array() ); 
	$google_map_api = get_option( 'elegant_blocks_google_map_api' ); 
	$google_map_script = get_option( 'elegant_blocks_google_map_script' ); 
	$elegant_blocks_disable_smaller_images_on_import = get_option( 'elegant_blocks_disable_smaller_images_on_import' ); 

	$available_blocks = array(
		'Accordion' => 'elegant-blocks-plugin/accordion',
		'Blog' => 'elegant-blocks-plugin/blog-1',
		'Call To Action' => 'elegant-blocks-plugin/calltoaction',
		'Gallery' => 'elegant-blocks-plugin/gallery',
		'Heading' => 'elegant-blocks-plugin/heading',
		'Instagram' => 'elegant-blocks-plugin/instagram',
		'Pricing Table' => 'elegant-blocks-plugin/pricing-table',
		'Progress Bar' => 'elegant-blocks-plugin/progress-bar',
		'Services' => 'elegant-blocks-plugin/services',
		'Slider' => 'elegant-blocks-plugin/slider',
		'Social Icons' => 'elegant-blocks-plugin/social-icons',
		'Tabs' => 'elegant-blocks-plugin/tabs',
		'Team' => 'elegant-blocks-plugin/team',
		'Testimonials' => 'elegant-blocks-plugin/testimonials'
	); ?>

	<div class="elegant-blocks-settings-page-wrapper">

		<div class="elegant-blocks-settings-left">
			
			<div class="wrap">

				<div class="elegant-blocks-settings-sidebar-heading">

					<h2><?php esc_html_e( 'Elegant Blocks Settings Page', 'elegant-blocks' ); ?></h2>

				</div>

				<form method="post" action="options.php">
				    <?php settings_fields( 'elegant_blocks_register_plugin_settings_group' ); ?>
				    <?php do_settings_sections( 'elegant_blocks_register_plugin_settings_group' ); ?>

				    <table class="form-table">

				        <tr valign="top">
					        <th scope="row">
					        	<?php esc_html_e( 'Disable Google Map Script', 'elegant-blocks' ); ?>		
					        </th>
					        <td>					        
					        	<input 
					        	type="checkbox" 
					        	name="elegant_blocks_google_map_script" 
					        	value="1" 
					        	<?php echo ( $google_map_script == 1 ? 'checked' : '' ); ?>
					        	/> 	
					        </td>
				        </tr>

				        <tr valign="top">
					        <th scope="row">
					        	<?php esc_html_e( 'Google Map API', 'elegant-blocks' ); ?>		
					        </th>
					        <td>					        
					        	<input 
					        	type="text" 
					        	name="elegant_blocks_google_map_api" 
					        	value="<?php echo esc_attr( $google_map_api ); ?>" 
					        	size="45" 
					        	/>
					        	<p class="description">You can get google api from <a target="blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">here</a></p>  	
					        </td>
				        </tr>

				        <tr valign="top">
					        <th scope="row">
					        	<?php esc_html_e( 'Disable Bootstrap Plugin', 'elegant-blocks' ); ?>		
					        </th>
					        <td>					        
					        	<input 
					        	type="checkbox" 
					        	name="elegant_blocks_bootstrap_status" 
					        	value="1" 
					        	<?php checked( $bootstrap_status, 1 ) ?> />
					        	<p class="description">If <code>checked</code>, it will disable the bootstrap css & js coming from the plugin.</p>  	
					        </td>
				        </tr>
				         
				        <tr valign="top">
					        <th scope="row">
					        	<?php esc_html_e( 'Disable Google Fonts', 'elegant-blocks' ); ?>
					        </th>
					        <td>
					        	<input 
					        	type="checkbox" 
					        	name="elegant_blocks_google_font_status" 
					        	value="1" 
					        	<?php checked( $google_font_status, 1 ) ?> />
					        	<p class="description">If <code>checked</code>, it will disable the google fonts coming from the plugin.</p> 
					        </td>
				        </tr>
				        
				        <tr valign="top">
					        <th scope="row">Disable Blocks</th>
					        <td class="disable_blocks_wrapper">

					        	<?php 
					        	foreach ( $available_blocks as $key => $value ) { ?>

					        		<label>
						        		<input 
							        	type="checkbox" 
							        	name="elegant_blocks_block_status[]" 
							        	value="<?php echo esc_attr( $value ); ?>"
							        	<?php echo ( !empty( $block_status ) && in_array( $value , $block_status ) ? 'checked' : '' ); ?> />
							        	<?php echo esc_attr( $key ); ?>
							        </label>

					        	 	<?php
					        	} ?>
					        	
					        </td>
				        </tr>

				        <tr valign="top">
					        <th scope="row">
					        	<?php esc_html_e( 'Disable generation of smaller images (thumbnails) during the content import', 'elegant-blocks' ); ?>		
					        </th>
					        <td>					        
					        	<input 
					        	type="checkbox" 
					        	name="elegant_blocks_disable_smaller_images_on_import" 
					        	value="1" 
					        	<?php echo ( $elegant_blocks_disable_smaller_images_on_import == 1 ? 'checked' : '' ); ?>
					        	/> 	
					        	<p>This will greatly improve the time needed to import the content (images), but only the original sized images will be imported.</p>
					        </td>
				        </tr>
				        
				    </table>
				    
				    <?php submit_button(); ?>

				</form>

			</div>

		</div>

		<div class="elegant-blocks-settings-right">

			<div class="elegant-blocks-settings-sidebar-heading">
				<h2><?php esc_html_e( 'Quickstart', 'elegant-blocks' ); ?></h2>
			</div>

			<div class="elegant-blocks-settings-right-container">
				
				<h3>Gutenberg Editor</h3>

				<?php
				if( function_exists( 'register_block_type' ) ){ ?>
					<p><span class="dashicons dashicons-yes"></span>Gutenberg is active.</p>
					<?php
				} else { ?>
					<p><span class="dashicons dashicons-no"></span>Gutenberg is not active.</p>
					<?php
				} ?>

				<hr>

				<h3>Elegant Blocks Theme</h3>

				<a href="https://cyclonethemes.com/downloads/bizberg-pro/" class="eb_related_themes" target="_blank">
					<h4>Bizberg</h4>
					<img src="<?php echo ELEGANTBLOCKS_PLUGIN_URL; ?>src/images/bizberg-starter-sites.jpg">
				</a>

			</div>
		</div>
		
	</div>

	<?php
}