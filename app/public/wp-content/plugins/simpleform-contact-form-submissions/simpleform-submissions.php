<?php

/**
 *
 * Plugin Name:  SimpleForm Contact Form Submissions
 * Description:  You are afraid of losing important messages? This data storage plugin for SimpleForm save contact form submissions into WordPress database and allows you to easily manage the submitted messages from dashboard.
 * Version:      1.3
 * Author:       WPSForm Team
 * Author URI:   https://wpsform.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:  simpleform-submissions
 * Domain Path:  /languages
 *
 */

if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Plugin constants.
 *
 * @since    1.0
 */
 
define( 'SIMPLEFORM_SUBMISSIONS_NAME', 'SimpleForm Contact Form Submissions' ); 
define( 'SIMPLEFORM_SUBMISSIONS_VERSION', '1.3' ); 
define( 'SIMPLEFORM_SUBMISSIONS_DB_VERSION', '1.3' ); 

/**
 * The code that runs during plugin activation.
 *
 * @since    1.0
 */
 
function activate_simpleform_submissions($network_wide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	SimpleForm_Submissions_Activator::activate($network_wide);
}

/** 
 * Change table when a new site into a network is created.
 *
 * @since    1.0
 */ 

function simpleform_submissions_db_on_create_blog($params) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	SimpleForm_Submissions_Activator::on_create_blog($params);
}

if ( version_compare(get_bloginfo('version'),'5.1', '>=') ) { 
    add_action( 'wp_insert_site', 'simpleform_submissions_db_on_create_blog'); 
} 
else { 
	add_action( 'wpmu_new_blog', 'simpleform_submissions_db_on_create_blog'); 
}

/**
 * The code that runs during plugin deactivation.
 *
 * @since    1.0
 */
 
function deactivate_simpleform_submissions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	SimpleForm_Submissions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simpleform_submissions' );
register_deactivation_hook( __FILE__, 'deactivate_simpleform_submissions' );

/**
 * The core plugin class.
 *
 * @since    1.0
 */
 
require plugin_dir_path( __FILE__ ) . '/includes/class-core.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0
 */
 
function run_SimpleForm_Submissions() {

	$plugin = new SimpleForm_Submissions();
	$plugin->run();

}

run_SimpleForm_Submissions();