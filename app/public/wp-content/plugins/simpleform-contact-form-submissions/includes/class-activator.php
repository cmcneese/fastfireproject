<?php

/**
 * The class instantiated during the plugin activation.
 *
 * @since      1.0
 */

class SimpleForm_Submissions_Activator {

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
         self::check_main_plugin();
         self::change_db();
         restore_current_blog();
        }
      } else {
         self::check_main_plugin();
         self::change_db();
      }
    } else {
        self::check_main_plugin();
        self::change_db();
    }
    
    }
    
    /**
     * Check if the main plugin SimpleForms is installed (active or inactive) on the site.
     *
     * @since    1.0
     */
 
    public static function check_main_plugin() {
	    
	    if ( ! class_exists( 'SimpleForm' ) ) {
    
        $plugin_file = 'simpleform/simpleform.php';
        if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_file ) ) {
	        $admin_url = is_multisite() ? network_admin_url( 'plugin-install.php' ) : admin_url( 'plugin-install.php' );
			deactivate_plugins( basename( __FILE__ ) );
			wp_die( '<div id="admin-notice">' . sprintf( __( 'Before proceeding to activate this plugin, you need to install and activate <a href="%1s" target="_blank">SimpleForm</a> plugin.<p>Search it in the <a href="%2s">WordPress repository</a>', 'sform-submissions' ), esc_url( 'https://wordpress.org/plugins/simpleform/' ), add_query_arg( array( 's' => 'SimpleForm', 'tab' => 'search', 'type' => 'term' ), $admin_url ) ) . '</div>' );
			
	    }
        else {
            $admin_url = is_network_admin() ? network_admin_url( 'plugins.php' ) : admin_url( 'plugins.php' );
			deactivate_plugins( basename( __FILE__ ) );
			wp_die( '<div id="admin-notice">' . sprintf( __( 'Before proceeding to activate this plugin, you need to activate <b>SimpleForm</b> plugin.<p>Back to the <a href="%s">Plugins</a> page', 'sform-submissions' ), esc_url( $admin_url ) ) . '</div>' );
	    }
			
	    }
			
	    else { 
		    
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );		  
		if ( is_network_admin() && ! is_plugin_active_for_network( 'simpleform/simpleform.php' )  )  {   
			deactivate_plugins( basename( __FILE__ ) );
			wp_die( '<div id="admin-notice">' . sprintf( __( 'Before proceeding to activate this plugin, you need to activate <b>SimpleForm</b> plugin.<p>Back to the <a href="%s">Plugins</a> page', 'sform-submissions' ), esc_url( network_admin_url( 'plugins.php' ) ) ) . '</div>' );
	    }

	    }

    }
	
    /**
     * Modifies the database table.
     *
     * @since    1.0
     */
 
    public static function change_db() {

        $current_version = SIMPLEFORM_SUBMISSIONS_DB_VERSION;

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $installed_version = get_option('sform_sub_db_version', '1');
        $prefix = $wpdb->prefix;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	 	$installed_version_number = str_replace('.', '', $installed_version);
        $installed_number = str_pad($installed_version_number, 5, '0');
	 	$current_version_number = str_replace('.', '', $current_version);
        $current_number = str_pad($current_version_number, 5, '0');
        if ( $installed_number < $current_number ) {
        
          $submissions_table = $prefix . 'sform_submissions';
          $sql = "CREATE TABLE " . $submissions_table . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            requester_type tinytext NOT NULL,
            requester_id int(15) NOT NULL,
            name tinytext NOT NULL,
            lastname tinytext NOT NULL,
            email VARCHAR(200) NOT NULL,
            ip VARCHAR(128) NOT NULL,	
            phone VARCHAR(50) NOT NULL,
            subject tinytext NOT NULL,
            object text NOT NULL,
            date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,            
            status tinytext NOT NULL,
            notes text NOT NULL,
            PRIMARY KEY  (id)
          ) ". $charset_collate .";";
          dbDelta($sql);
          
          // Edit default value if date column exists
          $columns = $wpdb->get_row("SELECT * FROM ". $submissions_table);
          if( isset($columns->date) ){
          $wpdb->query("ALTER TABLE " . $submissions_table . " CHANGE date date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");    
          } 

          update_option('sform_sub_db_version', $current_db_version);

        }
   
    }
    
    /**
     *  Create a table whenever a new blog is created in a WordPress Multisite installation.
     *
     * @since    1.0
     */

    public static function on_create_blog($params) {
       
       if ( is_plugin_active_for_network( 'simpleform-submissions/simpleform-submissions.php' ) ) {
       switch_to_blog( $params->blog_id );
       self::check_main_plugin();
       self::change_db();
       restore_current_blog();
       }

    }    
  
}