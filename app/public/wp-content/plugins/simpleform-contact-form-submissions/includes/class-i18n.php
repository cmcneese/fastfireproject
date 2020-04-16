<?php

/**
 * The class that defines the internationalization functionality.
 *
 * @since      1.0
 */

class SimpleForm_Submissions_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0
	 */

	public function load_plugin_textdomain() {
		
		$locale         = apply_filters( 'plugin_locale', get_locale(), 'simpleform-submissions' );
		$mofile         = 'simpleform-submissions-'.$locale.'mo';
		$glotpress_file = WP_LANG_DIR . '/plugins/simpleform-submissions/' . $mofile;
		if ( file_exists( $glotpress_file ) ) { load_textdomain( 'simpleform-submissions', $glotpress_file ); } 
		else { load_plugin_textdomain( 'simpleform-submissions', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' ); }
		
    }

}