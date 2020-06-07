<?php

/**
 * The class instantiated during the plugin's deactivation.
 *
 * @since      1.0
 */

class SimpleForm_Deactivator {

	/**
	 * Run during plugin deactivation.
	 *
	 * @since    1.6.1
	 */
	public static function deactivate() {
		
      // Edit pre-built pages status for contact form and thank you message
      $form_page_option = get_option( 'sform_contact_page' );
      $confirmation_page_option = get_option( 'sform_confirmation_page' );
      if ( $form_page_option && get_post_status($form_page_option) ) { 
	    wp_update_post(array( 'ID' => $form_page_option, 'post_status' => 'trash' ));; 
	  }
      if ( $confirmation_page_option && get_post_status($confirmation_page_option) ) { 
	    wp_update_post(array( 'ID' => $confirmation_page_option, 'post_status' => 'trash' ));; 
	  }

	}

}