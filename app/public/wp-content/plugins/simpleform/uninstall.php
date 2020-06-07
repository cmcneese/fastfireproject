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

// Drop shortcodes table.
$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'sform_shortcodes' );

// Drop submissions table.
$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'sform_submissions' );

// Delete pre-built pages for contact form and thank you message
$form_page_option = get_option( 'sform_contact_page' );
$confirmation_page_option = get_option( 'sform_confirmation_page' );
if ( $form_page_option && get_post_status($form_page_option) ) { wp_delete_post( $form_page_option, true); }
if ( $confirmation_page_option && get_post_status($confirmation_page_option) ) { wp_delete_post( $confirmation_page_option, true); }

// Search shortcode and remove it from content of any page or post
$pattern = '/\[simpleform\]/';
global $wpdb;
$table_post = $wpdb->prefix . 'posts';
$results = $wpdb->get_results("SELECT ID,post_content FROM {$table_post} WHERE post_content LIKE '%[simpleform%' AND ( post_type = 'page' OR post_type = 'post') ");		    
if ( $results){
foreach ($results as $post) { 
$new_content = preg_replace ( $pattern, '' , $post->post_content );
$post_id = $post->ID;	
$wpdb->update( $table_post, array( 'post_content' => $new_content ), array( 'ID' => $post_id ) );
}
}
  
// Delete plugin options
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'sform\_%'" );
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'sform\-%'" );

// Remove any transients we've left behind.
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE ('%\_transient\_sform\_%')" );

} 
else {
    global $wpdb;
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );
    $original_blog_id = get_current_blog_id();

    foreach ( $blog_ids as $blog_id ) {
      switch_to_blog( $blog_id );

      // Drop shortcodes table.
      $wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'sform_shortcodes' );

      // Drop submissions table.
      $wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'sform_submissions' );

      // Delete pre-built pages for contact form and thank you message
      $form_page_option = get_option( 'sform_contact_page' );
      $confirmation_page_option = get_option( 'sform_confirmation_page' );
      if ( $form_page_option && get_post_status($form_page_option) ) { wp_delete_post( $form_page_option, true); }
      if ( $confirmation_page_option && get_post_status($confirmation_page_option) ) { wp_delete_post( $confirmation_page_option, true); }

      // Search shortcode and remove it from content of any page or post
      $pattern = '/\[simpleform\]/';
      global $wpdb;
      $table_post = $wpdb->prefix . 'posts';
      $results = $wpdb->get_results("SELECT ID,post_content FROM {$table_post} WHERE post_content LIKE '%[simpleform%' AND ( post_type = 'page' OR post_type = 'post') ");		    
      if ( $results){
      foreach ($results as $post) { 
      $new_content = preg_replace ( $pattern, '' , $post->post_content );
      $post_id = $post->ID;	
      $wpdb->update( $table_post, array( 'post_content' => $new_content ), array( 'ID' => $post_id ) );
      }
      }
  
      // Delete plugin options
      $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'sform\_%'" );
      $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'sform\-%'" );

      // Remove any transients we've left behind.
      $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE ('%\_transient\_sform\_%')" );

    }

    switch_to_blog( $original_blog_id );
}