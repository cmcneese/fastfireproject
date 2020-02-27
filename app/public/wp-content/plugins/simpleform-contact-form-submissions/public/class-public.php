<?php
	
/**
 * Defines the public-specific functionality of the plugin.
 *
 * @since      1.0
 */

class SimpleForm_Submissions_Public {

	/**
	 * The name of this plugin.
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
	 * Get the client IP address.
	 *
	 * @since    1.0
	 */
	 
	public function get_client_ip() {
		
     // Nothing to do without any reliable information
    if (!isset ($_SERVER['REMOTE_ADDR'])) {
        $client_ip = 'UNKNOWN';
    }
    else {
      // Fetch the IP address when user is from shared Internet services
      if(isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1') {
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      }
      // Fetch the IP address when user is behind the proxy
      elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1') {
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      elseif(isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'] != '127.0.0.1') {
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      }
      elseif(isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'] != '127.0.0.1') {
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      }
      elseif(isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'] != '127.0.0.1') {
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
      }
      // In all other cases, REMOTE_ADDR is the only IP we can trust
      else {
         $ipaddress = $_SERVER['REMOTE_ADDR'];
      }
      
      // Check for multiple IP addresses that are passed through
      $ip_list = explode(',', $ipaddress);
         // Only last IP in the list) can be trusted
         if(isset($ip_list[1])) {
         $ipaddress = trim($ip_list[0]);
      }
      
      // Validate IP
      $client_ip = filter_var($ipaddress, FILTER_VALIDATE_IP) ? $ipaddress : 'INVALID';
      return $client_ip;
    }

    }

	/**
	 * Change form data values when form is submitted.
	 *
	 * @since    1.0
	 */
	 
     public function add_storing_fields_values($form_values, $requester_name, $requester_email, $request_subject, $request) { 
	
      $sform_settings = get_option('sform-settings');
      $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';	
      $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';	
      $ip_address = $sform_settings['ip-storing'] == 'true' ? $this->get_client_ip() : 'not stored';

      if ( $data_storing == 'true' ) {
       $form_values = array(
       "name" => $requester_name,
       "email" => $requester_email,
       "subject" => $request_subject,
       "object" => $request,
       "ip" => $ip_address, 
       "status" => 'new',
       );
      }    
      else {
       $form_values = array( 
       "name" => 'not stored',
       "email" => 'not stored',
       "subject" => 'not stored',
       "object" => 'not stored',
       "ip" => 'not stored',
       "status" => '',
       ); 
      }   
     
      return  $form_values;
     
     }

	/**
	 * Display confirmation message if notification email has been disabled.
	 *
	 * @since    1.0
	 */

     public function sform_display_message( $mailing, $redirect, $redirect_url, $thank_you_message, $server_error_message ){ 
	
      $sform_settings = get_option('sform-settings');	
      $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';	

      if ( $data_storing == 'true' || $mailing == 'true' ) {
       echo json_encode(array('error' => false, 'redirect' => $redirect, 'redirect_url' => $redirect_url, 'message' => $thank_you_message ));
	   exit;
      }
      else { 
       echo json_encode(array('error' => true, 'message' => $server_error_message ));
	   exit;
      }
	 
     }	

	/**
	 * Display confirmation message if notification email has been disabled and ajax is disabled.
	 *
	 * @since    1.0
	 */

    public function sform_display_post_message( $mailing ){ 
	
     $sform_settings = get_option('sform-settings');	
     $data_storing = ! empty( $sform_settings['data-storing'] ) ? esc_attr($sform_settings['data-storing']) : 'true';	

     if ( $data_storing == 'true' || $mailing == 'true' ) { $error = ''; }
     else { $error = 'server_error'; }
	
     return $error;

    }	


} 