<?php

/**
 * Defines the admin-specific functionality of the plugin.
 *
 * @since      1.0
 */
	 
class SimpleForm_Submissions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0
	 */
	
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0
	 */
	
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0
	 */
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
     * Add new submenu page to Contact admin menu.
     *
     * @since    1.0
     */  
     
    public function admin_menu() {
	    
      $sform_settings = get_option('sform-settings');
      $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';	

      if ( $data_storing == 'true') {
	    global $sform_entrie_page;
        $sform_entrie_page = add_submenu_page(null, __('View Request', 'simpleform-submissions'), __('View Request', 'simpleform-submissions'), 'activate_plugins', 'sform-entrie', array ($this, 'view_sform_entrie') );
      }

   }
  
    /**
     * Render the submitted message page for this plugin.
     *
     * @since    1.0
     */
     
    public function view_sform_entrie() {
      
      include_once( 'partials/message.php' );
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0
	 */
    
    public function enqueue_styles($hook) {

     global $sforms_submissions_page;
	 global $sform_entrie_page;
	 if( $hook != $sforms_submissions_page && $hook != $sform_entrie_page )
	 return;
	 
	 wp_enqueue_style('sform_submissions_style', plugins_url('/css/admin.css',__FILE__));
	      
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0
	 */
	
	public function enqueue_scripts($hook){
	    		
     global $sforms_submissions_page;
	 if( $hook == $sforms_submissions_page )
	 return;

     wp_enqueue_script( 'sform_submissions', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
     wp_localize_script( 'sform_submissions', 'sform_submissions_object', array( 'enable' => esc_html__( 'Check if you want to add the submissions list in dashboard and enable the form data storing', 'simpleform-submissions' ), 'disable' => esc_html__( 'Uncheck if you want to remove the submissions list in dashboard and disable the form data storing', 'simpleform-submissions' ) )); 
	      
	}
	
	/**
	 * Add submissions related fields in settings page.
	 *
	 * @since    1.0
	 */
	
    public function submissions_settings_fields( $rcpt_settings ) {
	
     $sform_settings = get_option('sform-settings');
     $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';
     $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';
     ?>
		
     <tr><th class="heading" colspan="2"><span><?php esc_html_e( 'Administration Options','simpleform-submissions') ?></span></th></tr>	
	 
	 <tr><th id="thstoring" class="option <?php if ($data_storing !='true') { echo 'wide'; } else { echo 'first'; } ?>"><span><?php esc_html_e('Data Storing', 'simpleform-submissions' ) ?></span></th><td id="tdstoring" class="checkbox notes <?php if ($data_storing !='true') { echo 'wide'; } else { echo 'first'; } ?>"><label for="data-storing"><input type="checkbox" class="sform" name="data-storing" id="data-storing" value="true" <?php checked( $data_storing, 'true'); ?>><?php _e( 'Enable the form data storing in the database ( data will be included only within the notification email if unchecked )', 'simpleform-submissions' ); ?></label><p id="storing-description" class="description"><?php if ($data_storing !='true') { esc_html_e('Check if you want to add the submissions list in dashboard and enable the form data storing', 'simpleform-submissions' ); } else { esc_html_e('Uncheck if you want to remove the submissions list in dashboard and disable the form data storing', 'simpleform-submissions' ); } ?></p></td></tr>
						  
	 <tr class="trstoring <?php if ($data_storing !='true') {echo 'unseen';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('IP Address Storing', 'simpleform-submissions' ) ?></span></th><td class="checkbox last"><label for="ip-storing"><input id="ip-storing" name="ip-storing" type="checkbox" class="sform" value="true" <?php checked( $ip_storing, 'true'); ?> ><?php _e( 'Enable IP address storing in the database', 'simpleform-submissions' ); ?></label></td></tr>
		
     <?php
		
    }	

	/**
	 * Add submissions related fields values in the settings options array.
	 *
	 * @since    1.0
	 */
	
    public function add_array_submissions_settings() {
  
     $data_storing = isset($_POST['data-storing']) ? 'true' : 'false';
     $ip_storing = isset($_POST['ip-storing']) ? 'true' : 'false';
     if ( $data_storing == 'false' )  { $ip_storing = 'false'; }
     $new_items = array( 'data-storing' => $data_storing, 'ip-storing' => $ip_storing );
  
     return  $new_items;

    }

	/**
	 * Validate submissions related fields in Settings page.
	 *
	 * @since    1.0
	 */
	
    public function validate_submissions_fields(){
       $data_storing = isset($_POST['data-storing']) ? 'true' : 'false';
       $notification = isset($_POST['notification']) ? 'true' : 'false';       
	   if ( $data_storing == 'false' && $notification == 'false' ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__('Data Storing option and Enable Notification option cannot be both disabled. Please keep at least one option enabled!', 'simpleform-submissions')  ));
	        exit; 
        }
    
    }
	
	/**
	 * Display submissions list in dashboard.
	 *
	 * @since    1.0
	 */
	
    public function display_submissions_list(){
    	
     $sform_settings = get_option('sform-settings');
     $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';	

     if ( $data_storing == 'true' ) {	
      $table = new SForms_Submissions_List_Table();
      $table->prepare_items();
      $table->views(); 
     ?>
     <form id="submissions-table" method="get"><input type="hidden" name="page" value="<?php echo sanitize_key($_REQUEST['page']) ?>"/>
     <?php $table->search_box( __( 'Search' ), 'simpleform-submissions');
     $table->display(); ?></form><?php
     }

     else {
      global $wpdb;
      $table_name = $wpdb->prefix . 'sform_submissions';
      $where_day = 'WHERE date >= UTC_TIMESTAMP() - INTERVAL 24 HOUR';
      $where_week = 'WHERE date >= UTC_TIMESTAMP() - INTERVAL 7 DAY';
      $where_month = 'WHERE date >= UTC_TIMESTAMP() - INTERVAL 30 DAY';
      $where_year = 'WHERE date >= UTC_TIMESTAMP() - INTERVAL 1 YEAR';
      $count_all = $wpdb->get_var("SELECT COUNT(id) FROM $table_name ");
      $count_last_day = $wpdb->get_var("SELECT COUNT(id) FROM $table_name $where_day ");
      $count_last_week = $wpdb->get_var("SELECT COUNT(id) FROM $table_name $where_week ");
      $count_last_month = $wpdb->get_var("SELECT COUNT(id) FROM $table_name $where_month ");
      $count_last_year = $wpdb->get_var("SELECT COUNT(id) FROM $table_name $where_year ");
      $total_received = $count_all;
      $last_message = stripslashes(get_transient('sform_last_message'));
      ?>

      <div><ul id="submissions-data"><li class="type"><span class="label"><?php esc_html_e( 'Received', 'simpleform' ); ?></span><span class="value"><?php echo $total_received; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'This Year', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_year; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'Last Month', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_month; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'Last Week', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_week; ?></span></li><li><span class="label"><?php esc_html_e( 'Last Day', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_day; ?></span></li></ul></div>
<?php
	  $icon = version_compare(get_bloginfo('version'),'5.0', '>=') ? 'dashicons-buddicons-pm' : 'dashicons-media-text';
	  if ( get_transient( 'sform_last_message' ) ) {
	  echo '<div id="last-submission"><h3><span class="dashicons '.$icon.'"></span>'.esc_html__('Last Message Received', 'simpleform' ).'</h3>'.$last_message . '</div>'; echo '<div id="submissions-notice" class="unseen"><h3><span class="dashicons dashicons-editor-help"></span>'.esc_html__('Before you go crazy looking for the received messages', 'simpleform' ).'</h3>'.esc_html__('Submissions data are not store into the WordPress database. Open the General Tab in Settings page, and check the Data Storing option for enable the display of messages in dashboard. By default, only last message is being temporarily stored. Therefore, it is recommended to verify the correct SMTP server configuration in case of use, and always keep the notification email enabled if you want to be sure to receive messages.', 'simpleform-submissions' ).'</div>';
	  }
	  else  {
	  echo '<div id="empty-submission"><h3><span class="dashicons dashicons-info"></span>'.esc_html__('Empty Inbox', 'simpleform' ).'</h3>'.esc_html__('So far, no message has been received yet!', 'simpleform' ).'<p>'.esc_html__('Submissions data are not store into the WordPress database. Open the General Tab in Settings page, and check the Data Storing option for enable the display of messages in dashboard. By default, only last message is being temporarily stored. Therefore, it is recommended to verify the correct SMTP server configuration in case of use, and always keep the notification email enabled if you want to be sure to receive messages.', 'simpleform-submissions' ).'</div>';
	  }

     }
	
    }

	/**
	 * Add screen option tab.
	 *
	 * @since    1.0
	 */

    public function submissions_table_options() {
	
	global $sform_submissions_page;
	add_action("load-$sform_submissions_page", array ($this, 'sforms_submissions_list_options') );
    
    }

	/**
	 * Setup function that registers the screen option.
	 *
	 * @since    1.0
	 */

    public function sforms_submissions_list_options() {

     $sform_settings = get_option('sform-settings');
     $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';
  
     if ( $data_storing == 'true' ) {
      global $table;
      global $sform_submissions_page;
      $screen = get_current_screen();
      if(!is_object($screen) || $screen->id != $sform_submissions_page)
      return;
      $args = array( 'label' => esc_attr__('Number of submissions per page', 'simpleform-submissions'),'default' => 10,'option' => 'submissions_per_page');
      add_screen_option( 'per_page', $args );
      $table = new SForms_Submissions_List_Table(); 
     }
  
    }

	/**
	 * Save screen options.
	 *
	 * @since    1.0
	 */

    public function sforms_set_option($status, $option, $value) {
      
      if ( 'submissions_per_page' == $option ) return $value;
      return $status;
    
    }
	
	/**
	 * Render the meta box in the submitted message page.
	 *
	 * @since    1.0
	 */
	
    public function sform_entrie_meta_box_handler($item) {
	    
     ?>
	 <div class="datarow">
	 <div class="thdata first"><?php esc_html_e('From', 'simpleform-submissions' ) ?></div>
	 <div class="tddata first"><?php
	    $requester_id = esc_attr($item['requester_id']); 
        if ( isset($requester_id) && $requester_id != 0 ) {
	    $user_info = get_user_by( 'id', $requester_id );
	    $page_user = get_edit_user_link( $requester_id );
		$user_firstname = ! empty($user_info->first_name) ? $user_info->first_name : $user_info->display_name;
		$user_lastname = ! empty($user_info->last_name) ? $user_info->last_name : '';
	    $firstname = $item['name'] != '' && $item['name'] != 'not stored' ? esc_attr($item['name']) : $user_firstname;	    
	    $lastname = $item['lastname'] != '' && $item['lastname'] != 'not stored' ? esc_attr($item['lastname']) : $user_lastname;
        $request_author = trim($firstname.' '.$lastname). ' [ <a href="'.$page_user.'" target="_blank" class="nodecoration">'.$user_info->user_login.'</a> ]<br>'.esc_html__('Registered user', 'simpleform-submissions' );
	    }
        else {
	    $firstname = $item['name'] != '' && $item['name'] != 'not stored' ? esc_attr($item['name']) : '';
	    $lastname = $item['lastname'] != '' && $item['lastname'] != 'not stored' ? esc_attr($item['lastname']) : '';
	    if ( !empty($firstname) || !empty($lastname) ):
	    $request_author =  trim($firstname.' '.$lastname) . '<br>'.esc_html__('Anonymous user', 'simpleform-submissions' );
	    else:
	    $request_author =  esc_html__('Anonymous user', 'simpleform-submissions' );
	    endif;
        }
	    echo $request_author; ?></div>	 
	 </div>
	 
	 <?php
	 $email = $item['email'] != '' && $item['email'] != 'not stored' ? esc_attr($item['email']) : '';
     if ( ! empty($email) ) { ?>
	 <div class="datarow">
     <div class="thdata"><?php esc_html_e('Email', 'simpleform-submissions' ) ?></div>		
	 <div class="tddata"><?php echo $email ?></div>
	 </div>
   	 <?php }	 
	 
     $form_attributes = get_option('sform-attributes');
     $phone_field = ! empty( $form_attributes['phone_field'] ) ? esc_attr($form_attributes['phone_field']) : 'hidden';

	 $phone = $item['phone'] != '' && $item['phone'] != 'not stored' ? esc_attr($item['phone']) : '';
     if ( ! empty($phone) ) { 
     ?>
	 <div class="datarow">
	 <div class="thdata"><?php esc_html_e('Phone', 'simpleform-submissions' ) ?></div>
	 <div class="tddata"><?php echo $phone ?></div>
	 </div>
	 <?php } ?>	 	 
	 
	 <div class="datarow">
	 <div class="thdata"><?php esc_html_e('Date', 'simpleform-submissions' ) ?></div>
	 <div class="tddata"><?php $tzcity = get_option('timezone_string'); $tzoffset = get_option('gmt_offset');
       if ( ! empty($tzcity))  { 
       $current_time_timezone = date_create('now', timezone_open($tzcity));
       $timezone_offset =  date_offset_get($current_time_timezone);
       $submission_timestamp = strtotime(esc_attr($item['date'])) + $timezone_offset; 
       }
       else { 
       $timezone_offset =  $tzoffset * 3600;
       $submission_timestamp = strtotime(esc_attr($item['date'])) + $timezone_offset;  
       }
       echo date_i18n(get_option('date_format'),$submission_timestamp).' '.esc_html__('at', 'simpleform-submissions').' '.date_i18n(get_option('time_format'),$submission_timestamp );?>
     </div>
	 </div>
	 
	 <?php     
	 $ip_address = $item['ip'] != '' && $item['ip'] != 'not stored' ? esc_attr($item['ip']) : '';
     if ( ! empty($ip_address) ) { 
     ?>
	 <div class="datarow">
	 <div class="thdata"><?php esc_html_e('IP', 'simpleform-submissions' ) ?></div>
	 <div class="tddata"><?php echo $ip_address ?></div>
	 </div>
	 <?php }
	 
	 $subject = $item['subject'] != '' && $item['subject'] != 'not stored' ? esc_attr($item['subject']) : '';
     if ( ! empty($subject) ) { ?>
	 <div class="datarow">
	 <div class="thdata"><?php esc_html_e('Subject', 'simpleform-submissions' ) ?></div>
	 <div class="tddata"><span id="subject-input"><?php echo $subject ?></span></div>	
   	 </div>
   	 <?php } ?>
   	 
	 <div class="datarow">
     <div class="thdata last"><?php esc_html_e('Message', 'simpleform-submissions' ) ?></div>
     <div class="tddata last"><?php echo esc_attr($item['object'])?></div>
     </div>	
 	 <?php
    
    }
    
	/**
	 * Deactivate plugin if SimpleForm is missing.
	 *
	 * @since    1.0
	 */

    public function detect_core_deactivation() {
	    
	  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	  		  
      if ( is_network_admin() && ! is_plugin_active_for_network( 'simpleform/simpleform.php' ) ) {
      deactivate_plugins('simpleform-submissions/simpleform-submissions.php');  
      }
      
      else {
       if ( ! class_exists( 'SimpleForm' ) ) {
       deactivate_plugins('simpleform-submissions/simpleform-submissions.php');  
       }
      }
    
    }

	/**
	 * Fallback for database table updating if code that runs during plugin activation fails.
	 *
	 * @since    1.1.3
	 */

    public function simpleform_db_version_check() { 
	    
          global $wpdb;
          $prefix = $wpdb->prefix;
          $submissions_table = $prefix . 'sform_submissions';
          $result = $wpdb->query("SHOW COLUMNS from {$submissions_table} LIKE 'lastname'");
          if( !$result){
          $wpdb->query("ALTER TABLE " . $submissions_table . " CHANGE date date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD COLUMN lastname tinytext NOT NULL AFTER name, ADD COLUMN phone VARCHAR(50) NOT NULL AFTER email");          
          }            
         
    }
           
}