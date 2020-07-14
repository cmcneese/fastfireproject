<?php

/**
 * The class instantiated during the plugin activation.
 *
 * @since      1.0
 */
 
class SimpleForm_Activator {

	/**
     * Run default functionality during plugin activation.
     *
     * @since    1.0
     */

    public static function activate($network_wide) {
	    
    if ( function_exists('is_multisite') && is_multisite() ) {
	  if($network_wide) {
        global $wpdb;
        $blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );

        foreach ( $blog_ids as $blog_id ) {
         switch_to_blog( $blog_id );
         self::sform_pages();
         self::create_db();
         self::default_data_entry();
         restore_current_blog();
        }
      } else {
         self::sform_pages();
         self::create_db();
    	 self::default_data_entry();
      }
    } else {
        self::sform_pages();
        self::create_db();
    	self::default_data_entry();
    }
    
    }

    /**
     *  Create the Contact Form page and the Thank You page if not exist.
     *
     * @since    1.6.1
     */

    public static function sform_pages() {

 	   $form_page_option = get_option( 'sform_contact_page' );
	   $confirmation_page_option = get_option( 'sform_confirmation_page' );
       if ( !$form_page_option && !$confirmation_page_option) {
       $form_page = array( 'post_type' => 'page', 'post_content' => '[simpleform]', 'post_title' => __( 'Contact Us', 'simpleform' ), 'post_status' => 'draft' );
       $thank_string1 = esc_html__( 'Thank you for contacting us.', 'simpleform' );
       $thank_string2 = esc_html__( 'Your message will be reviewed soon, and we’ll get back to you as quickly as possible.', 'simpleform' );
       $confirmation_img = SIMPLEFORM_URL . 'public/img/confirmation.png';
       $thank_you_message = '<div class="form confirmation"><h4>' . $thank_string1 . '</h4><br>' . $thank_string2 . '</br><img src="'.$confirmation_img.'" alt="message received"></div>'; 
       $confirmation_page = array( 'post_type' => 'page', 'post_content' => $thank_you_message, 'post_title' => __( 'Thanks!', 'simpleform' ), 'post_status' => 'draft' );
       $form_page_ID = wp_insert_post ($form_page);
       $confirmation_page_ID = wp_insert_post ($confirmation_page);
       if($form_page_ID) { add_option( 'sform_contact_page', $form_page_ID ); }
       if($confirmation_page_ID) { add_option( 'sform_confirmation_page', $confirmation_page_ID ); }
       }
       else { 
        if ( $form_page_option && get_post_status($form_page_option) == 'trash' ) { 
	    wp_update_post(array( 'ID' => $form_page_option, 'post_status' => 'draft' ));; 
	    }
        if ( $confirmation_page_option && get_post_status($confirmation_page_option) == 'trash' ) { 
	    wp_update_post(array( 'ID' => $confirmation_page_option, 'post_status' => 'draft' ));; 
	    }
       }
    }

    /**
     * Create custom tables.
     *
     * @since    1.0
     */
 
    public static function create_db() {

        $current_db_version = SIMPLEFORM_DB_VERSION; 

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $installed_version = get_option('sform_db_version');
        $prefix = $wpdb->prefix;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        if ( $installed_version != $current_db_version ) {
        
          $shortcodes_table = $prefix . 'sform_shortcodes';
          $sql = "CREATE TABLE " . $shortcodes_table . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            shortcode tinytext NOT NULL,
            name tinytext NOT NULL,
            PRIMARY KEY  (id) 
          ) ". $charset_collate .";";
          dbDelta($sql);

          $submissions_table = $prefix . 'sform_submissions';
          $sql = "CREATE TABLE " . $submissions_table . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            requester_type tinytext NOT NULL,
            requester_id int(15) NOT NULL,
            date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            notes text NOT NULL,
            PRIMARY KEY  (id)
          ) ". $charset_collate .";";
          dbDelta($sql);
          
          update_option('sform_db_version', $current_db_version);
          
        }
   
    }
  
    /**
     * Save default properties.
     *
     * @since    1.0
     */

    public static function default_data_entry() {
	  
        global $wpdb;
        $prefix = $wpdb->prefix;
        $shortcodes_table = $prefix . 'sform_shortcodes';
        $shortcode = 'simpleform';
        $name = 'Contact Form';
        $shortcode_data = $wpdb->get_results("SELECT * FROM {$shortcodes_table}");
        if(count($shortcode_data) == 0) { $wpdb->insert( $shortcodes_table, array( 'shortcode' => $shortcode, 'name' => $name ) ); }

    }
    
    /**
     *  Create a table whenever a new blog is created in a WordPress Multisite installation.
     *
     * @since    1.2
     */

    public static function on_create_blog($params) {
       
       if ( is_plugin_active_for_network( 'simpleform/simpleform.php' ) ) {
       switch_to_blog( $params->blog_id );
       self::create_db();
       self::default_data_entry();
       restore_current_blog();
       }

    }    
    
}