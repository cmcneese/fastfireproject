<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @since      1.0
 */

// Prevent direct access. Exit if file is not called by WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Confirm user has decided to remove all data, otherwise stop.
$sform_settings = get_option('sform-settings');

if ( isset( $sform_settings['deletion-all-data'] ) && esc_attr($sform_settings['deletion-all-data']) == 'false' ) {
	return;
}

if ( !is_multisite() )  {
  global $wpdb;
  $prefix = $wpdb->prefix;
  $submissions_table = $prefix . 'sform_submissions';
  $wpdb->query("ALTER TABLE $submissions_table DROP COLUMN name, DROP COLUMN lastname, DROP COLUMN email, DROP COLUMN phone, DROP COLUMN subject, DROP COLUMN object, DROP COLUMN ip, DROP COLUMN status, DROP COLUMN trash_date");
  $previous_db_version = get_option('sform_db_pre_version');
  update_option('sform_db_version', $previous_db_version);
  delete_option('sform_db_pre_version');
  $sform_addon_settings = array( 'data-storing' => $sform_settings['data-storing'], 'ip-storing' => $sform_settings['ip-storing'] );
  $sform_core_settings = array_diff_key($sform_settings,$sform_addon_settings);
  update_option('sform-settings', $sform_core_settings);
  delete_option( 'sform_sub_db_version' );
  delete_option( 'sform_screen_options' );
  delete_transient( 'sform_action_notice' );
} 
else {
    global $wpdb;
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    $original_blog_id = get_current_blog_id();
    foreach ( $blog_ids as $blog_id ) {
        switch_to_blog( $blog_id );
        $prefix = $wpdb->prefix;
        $submissions_table = $prefix . 'sform_submissions';
        $wpdb->query("ALTER TABLE $submissions_table DROP COLUMN name, DROP COLUMN lastname, DROP COLUMN email, DROP COLUMN phone, DROP COLUMN subject, DROP COLUMN object, DROP COLUMN ip, DROP COLUMN status, DROP COLUMN trash_date");    
        $previous_db_version = get_option('sform_db_pre_version');
        update_option('sform_db_version', $previous_db_version);
        delete_option('sform_db_pre_version');
        $sform_addon_settings = array( 'data-storing' => $sform_settings['data-storing'], 'ip-storing' => $sform_settings['ip-storing'] );
        $sform_core_settings = array_diff_key($sform_settings,$sform_addon_settings);
        update_option('sform-settings', $sform_core_settings);
        delete_option( 'sform_sub_db_version' );
        delete_option( 'sform_screen_options' );
        delete_transient( 'sform_action_notice' );
   }
    switch_to_blog( $original_blog_id );
}