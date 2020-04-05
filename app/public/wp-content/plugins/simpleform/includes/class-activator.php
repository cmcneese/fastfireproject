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
        $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
        foreach ( $blog_ids as $blog_id ) {
         switch_to_blog( $blog_id );
         self::create_db();
         self::default_data_entry();
         restore_current_blog();
        }
      } else {
         self::create_db();
    	 self::default_data_entry();
      }
    } else {
        self::create_db();
    	self::default_data_entry();
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

        if ( $installed_db_version < $current_db_version ) {
        
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
        $shortcode_data = $wpdb->get_results("SELECT * from $shortcodes_table");
        if(count($shortcode_data) == 0) { $wpdb->insert( $shortcodes_table, array( 'shortcode' => $shortcode, 'name' => $name ) ); }

    }
    
    /**
     *  Create a table whenever a new blog is created in a WordPress Multisite installation.
     *
     * @since    1.2
     */

    public static function on_create_blog($params) {
       
       if ( is_plugin_active_for_network( 'simpleform-demo/simpleform-demo.php' ) ) {
       switch_to_blog( $params->blog_id );
       self::create_db();
       self::default_data_entry();
       restore_current_blog();
       }

    }    
    
    
    

}