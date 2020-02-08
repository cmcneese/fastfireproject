<?php
/**
* Plugin Name: Elegant Blocks - Amazing Gutenberg Blocks
* Description: Elegant Blocks is an assemblage of unique blocks specifically designed for CycloneThemes Themes.
* Author: ravisakya, cyclonetheme
* Author URI: https://cyclonethemes.com/
* Version: 1.7
* License: GPL2+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* 
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get theme details
$theme = wp_get_theme();

/**
 * Redirect after activation
 */

register_activation_hook( __FILE__ , 'elegant_blocks_activation');
add_action( 'admin_init', 'elegant_blocks_redirect' , 999 );

function elegant_blocks_activation() {
    add_option( 'elegant_blocks_do_activation_redirect' , true );
}

function elegant_blocks_redirect() {

    if ( get_option( 'elegant_blocks_do_activation_redirect', false ) ) {

    	// Get theme details
		$theme = wp_get_theme();		

		// Give access to only selected themes
		$available_themes = array( 
			'bizberg', 
			'bizberg-pro',
			'pizza-hub',
			'pizza-hub-pro',
			'dr-life-saver',
			'dr-life-saver-pro',
			'professional-education-consultancy',
			'professional-education-consultancy-pro',
			'happy-wedding-day',
			'ngo-charity-fundraising',
			'building-construction-architecture',
			'education-business',
			'green-eco-planet'
		);

		if( in_array( $theme->get( 'TextDomain' ) , $available_themes ) ){
			
			delete_option( 'elegant_blocks_do_activation_redirect' );

			if( class_exists( 'OCDI_Plugin' ) ){
				wp_redirect( 'themes.php?page=cyclone-one-click-demo-import' );
			} else {
				wp_redirect( 'themes.php?page=elegant-blocks-bizberg-theme-options' );
			}

     		exit;
		}

		delete_option( 'elegant_blocks_do_activation_redirect' );
    	
    }

}

/**
 * Block Initializer.
 */

require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

/**
 * Add Template Files
 */

require_once plugin_dir_path( __FILE__ ) . 'src/templates/team/team_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/blog/blog_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/slider/slider_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/testimonial/testimonial_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/gallery/gallery_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/calltoaction/call_to_action_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/instagram/instagram_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/services/services_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/tabs/tabs.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/accordion/accordion.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/social_icons/social_icons.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/pricing_table/pricing-table.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/progress_bar/progress-bar.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/heading/heading.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/countup/countup.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/shape_divider/shape-divider.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/map/map.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/clients/clients.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/text/text_1.php';

// Container
require_once plugin_dir_path( __FILE__ ) . 'src/templates/container/container.php';

// Predesign Templates
require_once plugin_dir_path( __FILE__ ) . 'src/templates/description/description_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/banner/banner_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/video/video_1.php';
require_once plugin_dir_path( __FILE__ ) . 'src/templates/newsletter/newsletter_1.php';

/**
 * Add necessary files
 */

require_once plugin_dir_path( __FILE__ ) . 'src/inc/post_types.php';
require_once plugin_dir_path( __FILE__ ) . 'src/inc/taxonomy.php';
require_once plugin_dir_path( __FILE__ ) . 'src/inc/meta_box.php';
require_once plugin_dir_path( __FILE__ ) . 'src/inc/settings.php';
require_once plugin_dir_path( __FILE__ ) . 'src/inc/fontawesome-5-icons.php';

/**
* Google Fonts
*/

require_once plugin_dir_path( __FILE__ ) . 'src/inc/google-fonts.php';

/**
 * For Themes
 */

switch ( $theme->get( 'TextDomain' ) ) {

	case 'green-eco-planet':
		require_once plugin_dir_path( __FILE__ ) . 'theme/green-eco-planet/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/green-eco-planet/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/green-eco-planet/functions.php';
		break;
		
	case 'education-business':
		require_once plugin_dir_path( __FILE__ ) . 'theme/education-business/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/education-business/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/education-business/functions.php';
		break;

	case 'building-construction-architecture':
		require_once plugin_dir_path( __FILE__ ) . 'theme/building-construction-architecture/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/building-construction-architecture/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/building-construction-architecture/functions.php';
		break;

	case 'ngo-charity-fundraising':
		require_once plugin_dir_path( __FILE__ ) . 'theme/ngo-charity-fundraising/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/ngo-charity-fundraising/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/ngo-charity-fundraising/functions.php';
		break;
		
	case 'happy-wedding-day':
		require_once plugin_dir_path( __FILE__ ) . 'theme/happy-wedding-day/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/happy-wedding-day/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/happy-wedding-day/functions.php';
		break;

	case 'professional-education-consultancy-pro':
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/demo-pro/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/functions.php';
		break;

	case 'professional-education-consultancy':
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/professional-education-consultancy/functions.php';
		break;

	case 'dr-life-saver-pro':
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/demo-pro/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/functions.php';
		break;

	case 'dr-life-saver':
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/dr-life-saver/functions.php';
		break;

	case 'pizza-hub-pro':
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/demo-pro/pro.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/functions.php';
		break;

	case 'pizza-hub':
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/pizza-hub/functions.php';
		break;

	case 'bizberg':
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/demo/demo.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/functions.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/all-themes-customizer.php';
		break;

	case 'bizberg-pro':
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/demo-pro/pro.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/theme-option.php';
		require_once plugin_dir_path( __FILE__ ) . 'theme/bizberg/functions.php';
		break;
	
	default:
		# code...
		break;

}