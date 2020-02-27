<?php

/**
 * Defines the admin-specific functionality of the plugin.
 *
 * @since      1.0
 */
	 
class SimpleForm_Admin {

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
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0
     */  
     
    public function sform_admin_menu() {
	    
      $hook = add_menu_page(__('Contacts', 'simpleform'),esc_html__('Contacts', 'simpleform'),'activate_plugins','sform-submissions',array($this,'display_submissions_page'),'dashicons-email-alt', 24 );
   
      global $sform_submissions_page;
      $sform_submissions_page = add_submenu_page('sform-submissions', esc_html__('Submissions','simpleform'), esc_html__('Submissions','simpleform'), 'activate_plugins', 'sform-submissions', array($this,'display_submissions_page'));

      global $sform_contact_options_page;
      $sform_contact_options_page = add_submenu_page('sform-submissions', esc_html__('Edit Form', 'simpleform'), esc_html__('Edit Form', 'simpleform'), 'activate_plugins', 'sform-editing', array($this,'display_editing_page'));

      global $sform_settings_page;
      $sform_settings_page = add_submenu_page('sform-submissions', esc_html__('Settings', 'simpleform'), esc_html__('Settings', 'simpleform'), 'manage_options', 'sform-settings', array($this,'display_settings_page'));

      do_action( 'load_submissions_table_options' );
      do_action('sform_submissions_submenu');

   }
  
    /**
     * Render the submissions page for this plugin.
     *
     * @since    1.0
     */
     
    public function display_submissions_page() {
      
      include_once( 'partials/submissions.php' );
    }

    /**
     * Render the editing page for this plugin.
     *
     * @since    1.0
     */
    
    public function display_editing_page() {
     
      include_once( 'partials/editing.php' );
    
    }

    /**
     * Render the settings page for this plugin.
     * @since    1.0
     */
    
    public function display_settings_page() {
      
      include_once( 'partials/settings.php' );
    
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0
	 */
    
    public function enqueue_styles($hook) {
	    		
     global $sform_submissions_page;
     global $sform_contact_options_page;
     global $sform_settings_page;
     global $sform_support_page;
	   
     if( $hook != $sform_submissions_page && $hook != $sform_contact_options_page &&  $hook != $sform_settings_page ) 
     return;

	 wp_enqueue_style('sform-style', plugins_url('/css/admin.css',__FILE__)); 
	      
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0
	 */
	
	public function enqueue_scripts($hook){
	    		
     global $sform_submissions_page;
     global $sform_contact_options_page;
     global $sform_settings_page;
     global $sform_support_page;
	   
     if( $hook != $sform_submissions_page && $hook != $sform_contact_options_page &&  $hook != $sform_settings_page ) 
     return;

     wp_enqueue_script( 'sform_saving_options', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
     wp_localize_script( 'sform_saving_options', 'ajax_sform_settings_options_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 	'copy' => esc_html__( 'Copy', 'simpleform' ), 'copied' => esc_html__( 'Copied', 'simpleform' ), 'saving' => esc_html__( 'Saving data in progress', 'simpleform' ), 'loading' => esc_html__( 'Saving settings in progress', 'simpleform' ), 'customized' => esc_html__( 'Create a directory inside your active theme’s directory, name it simpleform, copy one of the template files and name it custom-template.php', 'simpleform' ), 'bootstrap' => esc_html__( 'In order to use this template, you need to load Bootstrap’s JS library', 'simpleform' ), 'show' => esc_html__( 'Show Configuration Warnings', 'simpleform' ), 'hide' => esc_html__( 'Hide Configuration Warnings', 'simpleform' ) )); 
	      
	}
	
	/**
	 * Enable SMTP server for outgoing emails
	 *
	 * @since    1.0
	 */

	public function check_smtp_server() {
		
       $sform_settings = get_option('sform-settings');
       $server_smtp = ! empty( $sform_settings['server_smtp'] ) ? esc_attr($sform_settings['server_smtp']) : 'false';
       if ( $server_smtp == 'true' ) { add_action( 'phpmailer_init', array($this,'sform_enable_smtp_server') ); }
       else { remove_action( 'phpmailer_init', 'sform_enable_smtp_server' ); }
   
   }

	/**
	 * Save SMTP server configuration.
	 *
	 * @since    1.0
	 */
	
    public function sform_enable_smtp_server( $phpmailer ) {
   
      $sform_settings = get_option('sform-settings');
      $smtp_host = ! empty( $sform_settings['smtp_host'] ) ? esc_attr($sform_settings['smtp_host']) : '';
      $smtp_encryption = ! empty( $sform_settings['smtp_encryption'] ) ? esc_attr($sform_settings['smtp_encryption']) : '';
      $smtp_port = ! empty( $sform_settings['smtp_port'] ) ? esc_attr($sform_settings['smtp_port']) : '';
      $smtp_authentication = isset( $sform_settings['smtp_authentication'] ) ? esc_attr($sform_settings['smtp_authentication']) : '';
      $smtp_username = ! empty( $sform_settings['smtp_username'] ) ? esc_attr($sform_settings['smtp_username']) : '';
      $smtp_password = ! empty( $sform_settings['smtp_password'] ) ? esc_attr($sform_settings['smtp_password']) : '';
      $username = defined( 'SFORM_SMTP_USERNAME' ) ? SFORM_SMTP_USERNAME : $smtp_username;
      $password = defined( 'SFORM_SMTP_PASSWORD' ) ? SFORM_SMTP_PASSWORD : $smtp_password;
      
      $phpmailer->isSMTP();
      $phpmailer->Host       = $smtp_host;
      $phpmailer->SMTPAuth   = $smtp_authentication;
      $phpmailer->Port       = $smtp_port;
      $phpmailer->SMTPSecure = $smtp_encryption;
      $phpmailer->Username   = $username;
      $phpmailer->Password   = $password;

    }

	/**
	 * Edit the contact form fields.
	 *
	 * @since    1.0
	 */
	
    public function shortcode_costruction() {

      if( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {	die ( 'Security checked!'); }

      if ( ! wp_verify_nonce( $_POST['verification_nonce'], "ajax-verification-nonce")) { exit("Security checked!"); }   

      if ( ! current_user_can('update_plugins')) { exit("Security checked!"); }   
   
      else { 
	   
       $shortcode_name = isset($_POST['shortcode_name']) ? sanitize_text_field($_POST['shortcode_name']) : '';
       $introduction_text = isset($_POST['introduction_text']) ? wp_kses_post(trim($_POST['introduction_text'])) : 'Please fill out the form below with your inquiry and we will get back to you as soon as possible. Mandatory fields are marked with (*).'; 
       $bottom_text = isset($_POST['bottom_text']) ? wp_kses_post(trim($_POST['bottom_text'])) : '';    
       $name_field = isset($_POST['name_field']) ? sanitize_text_field($_POST['name_field']) : 'visible';
       $name_label = isset($_POST['name_label']) ? sanitize_text_field(trim($_POST['name_label'])) : '';
       $name_requirement = isset($_POST['name_requirement']) ? 'required' : 'optional';
       $email_field = isset($_POST['email_field']) ? sanitize_text_field($_POST['email_field']) : 'visible';
       $email_label = isset($_POST['email_label']) ? sanitize_text_field(trim($_POST['email_label'])) : '';
       $email_requirement = isset($_POST['email_requirement']) ? 'required' : 'optional';
       $subject_field = isset($_POST['subject_field']) ? sanitize_text_field($_POST['subject_field']) : 'visible';
       $subject_label = isset($_POST['subject_label']) ? sanitize_text_field(trim($_POST['subject_label'])) : '';
       $subject_requirement = isset($_POST['subject_requirement']) ? 'required' : 'optional';
       $message_label = isset($_POST['message_label']) ? sanitize_text_field(trim($_POST['message_label'])) : '';
       $terms_field = isset($_POST['terms_field']) ? sanitize_text_field($_POST['terms_field']) : 'visible';
       $terms_label = isset($_POST['terms_label']) ? wp_filter_post_kses(trim($_POST['terms_label'])) : '';
       $terms_requirement = isset($_POST['terms_requirement']) ? 'required' : 'optional';
       $captcha_field = isset($_POST['captcha_field']) ? sanitize_text_field($_POST['captcha_field']) : 'hidden';
       $captcha_label = isset($_POST['captcha_label']) ? sanitize_text_field(trim($_POST['captcha_label'])) : '';
       $submit_label = isset($_POST['submit_label']) ? sanitize_text_field(trim($_POST['submit_label'])) : '';

       global $wpdb;
       $table_shortcodes = $wpdb->prefix . 'sform_shortcodes';
       $update_shortcode = $wpdb->update($table_shortcodes, array('name' => $shortcode_name ), array('shortcode' => 'simpleform' ));
       $update_result = $update_shortcode ? 'done' : '';
 
       $form_attributes = array('form_name' => $shortcode_name, 'introduction_text' => $introduction_text, 'bottom_text' => $bottom_text, 'name_field' => $name_field, 'name_label' => $name_label, 'name_requirement' => $name_requirement, 'email_field' => $email_field, 'email_label' => $email_label, 'email_requirement' => $email_requirement, 'subject_field' => $subject_field, 'subject_label' => $subject_label, 'subject_requirement' => $subject_requirement, 'message_label' => $message_label, 'terms_field' => $terms_field, 'terms_label' => $terms_label, 'terms_requirement' => $terms_requirement, 'captcha_field' => $captcha_field, 'captcha_label' => $captcha_label, 'submit_label' => $submit_label );      

       $update_attributes = update_option('sform-attributes', $form_attributes); 
       if ($update_attributes) { $update_result .= 'done'; }

       if ( $update_result ) {
       echo json_encode(array('error' => false, 'update' => true, 'message' => esc_html__( 'The Contact Form has been updated', 'simpleform' ) ));
	   exit;
       }
   
       else {
       echo json_encode(array('error' => false, 'update' => false, 'message' => esc_html__( 'The Contact Form has already been updated', 'simpleform' ) ));
	   exit;
       }
      
       die();
      }

    }
   
	/**
	 * Edit settings
	 *
	 * @since    1.0
	 */
	
    public function sform_edit_options() {

      if( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {	die ( 'Security checked!'); }

      if ( ! wp_verify_nonce( $_POST['verification_nonce'], "ajax-verification-nonce")) { exit("Security checked!"); }   

      if ( ! current_user_can('update_plugins')) { exit("Security checked!"); }   
   
      else {
       $smtp_configuration = isset($_POST['smtp-configuration']) ? 'true' : 'false';       
       $ajax_submission = isset($_POST['ajax-submission']) ? 'true' : 'false';
       $template = isset($_POST['form-template']) ? sanitize_text_field($_POST['form-template']) : 'default';
       $bootstrap = isset($_POST['bootstrap']) ? 'true' : 'false';
       $stylesheet = isset($_POST['stylesheet']) ? 'true' : 'false';
       $uninstall = isset($_POST['deletion-all-data']) ? 'true' : 'false';
       $firstname_error_message = isset($_POST['firstname_error_message']) ? sanitize_text_field(trim($_POST['firstname_error_message'])) : '';
       $invalid_firstname_error_message = isset($_POST['invalid_name_error']) ? sanitize_text_field(trim($_POST['invalid_name_error'])) : '';
       $name_error = isset($_POST['name_error']) ? sanitize_text_field(trim($_POST['name_error'])) : '';
       $email_error_message = isset($_POST['email_error_message']) ? sanitize_text_field(trim($_POST['email_error_message'])) : '';
       $email_error = isset($_POST['email_error']) ? sanitize_text_field(trim($_POST['email_error'])) : '';       
       $subject_error_message = isset($_POST['subject_error_message']) ? sanitize_text_field(trim($_POST['subject_error_message'])) : '';
       $invalid_subject_error_message = isset($_POST['invalid_subject_error']) ? sanitize_text_field(trim($_POST['invalid_subject_error'])) : '';
       $subject_error = isset($_POST['subject_error']) ? sanitize_text_field(trim($_POST['subject_error'])) : '';
       $object_error_message = isset($_POST['object_error_message']) ? sanitize_text_field(trim($_POST['object_error_message'])) : '';
       $invalid_object_error_message = isset($_POST['invalid_message_error']) ? sanitize_text_field(trim($_POST['invalid_message_error'])) : '';
       $message_error = isset($_POST['message_error']) ? sanitize_text_field(trim($_POST['message_error'])) : '';
       $terms_error = isset($_POST['terms-error']) ? sanitize_text_field(trim($_POST['terms-error'])) : '';
       $captcha_error_message = isset($_POST['captcha_error_message']) ? sanitize_text_field(trim($_POST['captcha_error_message'])) : '';
       $captcha_error = isset($_POST['captcha_error']) ? sanitize_text_field(trim($_POST['captcha_error'])) : '';
       $honeypot_error = isset($_POST['honeypot_error']) ? sanitize_text_field(trim($_POST['honeypot_error'])) : '';
       $server_error_message = isset($_POST['server_error_message']) ? sanitize_text_field(trim($_POST['server_error_message'])) : '';
       $success_action =  isset($_POST['success_action']) ? sanitize_key($_POST['success_action']) : '';
       $success_message = isset($_POST['success_message']) ? wp_kses_post(trim($_POST['success_message'])) : '';
       $confirmation_page = isset($_POST['confirmation_page']) ? sanitize_text_field($_POST['confirmation_page']) : '';
       $thank_you_url = ! empty($confirmation_page) ? esc_url_raw(get_the_guid( $confirmation_page )) : '';  
       $server_smtp = isset($_POST['server_smtp']) ? 'true' : 'false';
       $smtp_host = isset($_POST['smtp_host']) ? sanitize_text_field(trim($_POST['smtp_host'])) : '';
       $smtp_encryption = isset($_POST['smtp_encryption']) ? sanitize_key($_POST['smtp_encryption']) : '';
       $smtp_port = isset($_POST['smtp_port']) ? sanitize_text_field(trim($_POST['smtp_port'])) : '';
       $smtp_authentication = isset($_POST['smtp_authentication']) ? 'true' : 'false';
       $smtp_username = isset($_POST['smtp_username']) ? sanitize_text_field(trim($_POST['smtp_username'])) : '';
       $smtp_password = isset($_POST['smtp_password']) ? sanitize_text_field(trim($_POST['smtp_password'])) : '';
       $username = defined( 'SFORM_SMTP_USERNAME' ) ? SFORM_SMTP_USERNAME : $smtp_username;
       $password = defined( 'SFORM_SMTP_PASSWORD' ) ? SFORM_SMTP_PASSWORD : $smtp_password;
       $notification = isset($_POST['notification']) ? 'true' : 'false';       
       $notification_recipient = isset($_POST['notification_recipient']) ? sanitize_text_field(trim($_POST['notification_recipient'])) : '';
       $notification_sender_email = isset($_POST['notification_sender_email']) ? sanitize_text_field(trim($_POST['notification_sender_email'])) : '';
       $notification_sender_name = isset($_POST['notification_sender_name']) ? sanitize_key($_POST['notification_sender_name']) : '';
       $custom_sender = isset($_POST['custom_sender']) ? sanitize_text_field(trim($_POST['custom_sender'])) : '';
       $notification_subject = isset($_POST['notification_subject']) ? sanitize_key($_POST['notification_subject']) : '';
       $custom_subject = isset($_POST['custom_subject']) ? sanitize_text_field(trim($_POST['custom_subject'])) : '';
       $submission_number = isset($_POST['submission_number']) ? 'hidden' : 'visible';
       $confirmation_email = isset($_POST['confirmation_email']) ? 'true' : 'false';
       $confirmation_sender_email = isset($_POST['confirmation_sender_email']) ? sanitize_text_field(trim($_POST['confirmation_sender_email'])) : '';
       $confirmation_sender_name = isset($_POST['confirmation_sender_name']) ? sanitize_text_field(trim($_POST['confirmation_sender_name'])) : '';
       $confirmation_subject = isset($_POST['confirmation_subject']) ? sanitize_text_field(trim($_POST['confirmation_subject'])) : '';
       $confirmation_message = isset($_POST['confirmation_message']) ? wp_kses_post(trim($_POST['confirmation_message'])) : '';
       $confirmation_reply_to = isset($_POST['confirmation_reply_to']) ? sanitize_text_field(trim($_POST['confirmation_reply_to'])) : '';
              
       if ( $template == 'default' ||  $template == 'customized' )  { $bootstrap = 'false'; }
       if ( $template != 'customized' )  { $stylesheet = 'false'; }
       if ( $smtp_configuration == 'true'  )  { $server_smtp = 'false'; }

       if ( $server_smtp == 'true' && $notification == 'false' && $confirmation_email == 'false' )  { 
	        echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'The SMTP server for outgoing email cannot be enabled if notification or confirmation email are not enabled', 'simpleform' ) ));
	        exit; 
       }
        
	   if (  $server_smtp == 'true' && empty($smtp_host) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter the SMTP address', 'simpleform' ) ));
	        exit; 
       }

	   if (  $server_smtp == 'true' && empty($smtp_encryption) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter the encryption type to relay outgoing email to SMTP server', 'simpleform' )  ));
	        exit; 
       }

	   if (  $server_smtp == 'true' && empty($smtp_port) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter the port to relay outgoing email to SMTP server', 'simpleform' )  ));
	        exit; 
       }
        
	   if (  $server_smtp == 'true' && ! ctype_digit(strval($smtp_port)) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter a valid port to relay outgoing email to SMTP server', 'simpleform' ) ));
	        exit; 
       }

	   if (  $server_smtp == 'true' && $smtp_authentication == 'true' && empty( $username ) ) { 
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter username to login to SMTP server', 'simpleform' )  ));
	        exit; 
       }
	
	   if (  $server_smtp == 'true' && $smtp_authentication == 'true' &&  ! empty($username) && ! is_email( $username ) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter a valid email address to login to SMTP server', 'simpleform' )  ));
	        exit; 
       }
        
	   if (  $server_smtp == 'true' && $smtp_authentication == 'true' && empty( $password ) ) {
            echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'Please enter password to login to SMTP server', 'simpleform' )  ));
	        exit; 
       }
                
       if (has_action('sforms_validate_submissions_settings')):
	       do_action('sforms_validate_submissions_settings');	
	   else:
       if ( $notification == 'false' )  { 
 	        echo json_encode(array('error' => true, 'update' => false, 'message' => esc_html__( 'You need to enable the notification email', 'simpleform' ) ));
	        exit; 
       }
	   endif;
	
       $sform_settings = array(
	             'smtp-configuration' => $smtp_configuration,
                 'ajax-submission' => $ajax_submission,
                 'form-template' => $template,
                 'bootstrap' => $bootstrap,
                 'stylesheet' => $stylesheet,
                 'deletion-all-data' => $uninstall, 
                 'firstname_error_message' => $firstname_error_message, 
                 'invalid_name_error' => $invalid_firstname_error_message, 
                 'name_error' => $name_error,      
                 'email_error_message' => $email_error_message,  
                 'email_error' => $email_error,  
                 'subject_error_message' => $subject_error_message, 
                 'invalid_subject_error' => $invalid_subject_error_message,  
                 'subject_error' => $subject_error,                    
                 'object_error_message' => $object_error_message,    
                 'invalid_message_error' => $invalid_object_error_message,
                 'message_error' => $message_error,
                 'terms_error' => $terms_error,
                 'captcha_error_message' => $captcha_error_message,    
                 'captcha_error' => $captcha_error,    
                 'honeypot_error' => $honeypot_error,    
                 'server_error_message' => $server_error_message,         
                 'success_action' => $success_action,         
                 'success_message' => $success_message, 
                 'confirmation_page' => $confirmation_page,        
                 'thank_you_url' => $thank_you_url,
                 'server_smtp' => $server_smtp,
                 'smtp_host' => $smtp_host,
                 'smtp_encryption' => $smtp_encryption,
                 'smtp_port' => $smtp_port,
                 'smtp_authentication' => $smtp_authentication,
                 'smtp_username' => $smtp_username,
                 'smtp_password' => $smtp_password,
                 'notification' => $notification,
                 'notification_recipient' => $notification_recipient,
                 'notification_sender_email' => $notification_sender_email,
                 'notification_sender_name' => $notification_sender_name,
                 'custom_sender' => $custom_sender,
                 'notification_subject' => $notification_subject,
                 'custom_subject' => $custom_subject,
                 'submission_number' => $submission_number,  
                 'confirmation_email' => $confirmation_email, 
                 'confirmation_sender_email' => $confirmation_sender_email,
                 'confirmation_sender_name' => $confirmation_sender_name,
                 'confirmation_subject' => $confirmation_subject,
                 'confirmation_message' => $confirmation_message,
                 'confirmation_reply_to' => $confirmation_reply_to,                 
                 ); 
 
      $submissions_fields = array('additional_fields' => '');
      $additional_sform_settings = array_merge($sform_settings, apply_filters( 'sform_submissions_settings_filter', $submissions_fields ));
      $update_result = update_option('sform-settings', $additional_sform_settings); 

      if ( $update_result ) {
	  echo json_encode( array( 'error' => false, 'update' => true, 'message' => esc_html__( 'Settings have successfully saved', 'simpleform' ) ) ); 
	  exit; 
      }
      else {
	  echo json_encode( array( 'error' => false, 'update' => false, 'message' => esc_html__( 'Settings have already been saved', 'simpleform' ) ) );                      		    
	  exit; 	   
      }
  	         
      die();
      
     }

    }   
    
	/**
	 * Return shortcode properties
	 *
	 * @since    1.0
	 */
	
    public function sform_form_filter() { 
		
     global $wpdb;
     $table_name = $wpdb->prefix . 'sform_shortcodes';
     $form_values = $wpdb->get_row( "SELECT * FROM $table_name ", ARRAY_A );   
     return $form_values;
     
    } 

    /**
     * Deleting the table whenever a single site into a network is deleted.
     *
     * @since    1.2
     */

    public function on_delete_blog($tables) {
      
      global $wpdb;
      $tables[] = $wpdb->prefix . 'sform_submissions';
      return $tables;
			
    }

    
    
    
       
}