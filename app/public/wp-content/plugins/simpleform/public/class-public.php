<?php
	
/**
 * Defines the public-specific functionality of the plugin.
 *
 * @since      1.0
 */

class SimpleForm_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	 
	public function enqueue_styles() {
		
    global $post; 
    if( is_page() && strpos($post->post_content,'[simpleform') !== false  ) { 
	  $sform_settings = get_option('sform-settings');
      $form_template = ! empty( $sform_settings['form-template'] ) ? esc_attr($sform_settings['form-template']) : 'default'; 
      switch ($form_template) {
      case 'basic':
      wp_enqueue_style( 'sform-style', plugins_url('/css/basic-bootstrap-template.css',__FILE__)); 	
      break;
      case 'rounded':
      wp_enqueue_style( 'sform-style', plugins_url('/css/rounded-bootstrap-template.css',__FILE__)); 	
      break;
      case 'customized':
       $stylesheet = ! empty( $sform_settings['stylesheet'] ) ? esc_attr($sform_settings['stylesheet']) : 'false';
       if ( $stylesheet == 'false' ) { 
       wp_enqueue_style( 'sform-style', plugins_url('/css/default-template.css',__FILE__)); 	
	   }
      break;
      default:
      wp_enqueue_style( 'sform-style', plugins_url('/css/default-template.css',__FILE__)); 	
      }
    }   
 
    }
    
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	 
	public function enqueue_scripts() {
	
	wp_register_script( 'sform_form_script', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), $this->version, false );
    wp_register_script( 'sform_public_script', plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), $this->version, false );
    wp_localize_script('sform_public_script', 'ajax_sform_processing', array('ajaxurl' => admin_url('admin-ajax.php'), 'sform_loading_img' => plugins_url( 'img/processing.svg',__FILE__ ) ));
	
    $sform_settings = get_option('sform-settings');
    $ajax = ! empty( $sform_settings['ajax-submission'] ) ? esc_attr($sform_settings['ajax-submission']) : 'true'; 
    global $post; 
    if( is_page() && strpos($post->post_content,'[simpleform') !== false  ) { 
       wp_enqueue_script( 'sform_form_script');
       if( $ajax == 'true' ) {
       wp_enqueue_script( 'sform_public_script');
       }        
       $bootstrap = ! empty( $sform_settings['bootstrap'] ) ? esc_attr($sform_settings['bootstrap']) : 'false';
       if ( $bootstrap == 'true' ) { 
	   wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array( 'jquery' ) ); 
	   }
    }   
 
    }

	/**
	 * Apply shortcode and return the contact form for the public-facing side of the site.
	 *
	 * @since    1.0
	 */

    public function sform_shortcode() { 
	    
      include 'partials/form-variables.php'; 
      
	  $sform_settings = get_option('sform-settings');
      $form_template = ! empty( $sform_settings['form-template'] ) ? esc_attr($sform_settings['form-template']) : 'default'; 

      switch ($form_template) {
      case 'basic':
      $template = 'partials/basic-bootstrap-template.php';
      break;
      case 'rounded':
      $template = 'partials/rounded-bootstrap-template.php';
      break;
      case 'customized':
      $template = '';
      break;
      default:
      $template = "partials/default-template.php";
      }
      
      if( empty($template) ):
      if (is_child_theme() ) { include get_stylesheet_directory() . '/simpleform/custom-template.php'; }
      else { include get_template_directory() . '/simpleform/custom-template.php'; }
      else:
	  include $template;
      endif;

      return $contact_form;
      
    } 

	/**
	 * Validate the form data after submission without Ajax
	 *
	 * @since    1.0
	 */
     
     public function formdata_validation($data) {
		
		$form_attributes = get_option('sform-attributes');
		$sform_settings = get_option('sform-settings');
		$ajax = ! empty( $sform_settings['ajax-submission'] ) ? esc_attr($sform_settings['ajax-submission']) : 'true'; 

        $firstname_field = ! empty( $form_attributes['firstname_field'] ) ? esc_attr($form_attributes['firstname_field']) : 'visible';
        $firstname_requirement = ! empty( $form_attributes['firstname_requirement'] ) ? esc_attr($form_attributes['firstname_requirement']) : 'optional';

        $lastname_field = ! empty( $form_attributes['lastname_field'] ) ? esc_attr($form_attributes['lastname_field']) : 'hidden';
        $lastname_requirement = ! empty( $form_attributes['lastname_requirement'] ) ? esc_attr($form_attributes['lastname_requirement']) : 'optional';

        $email_field = ! empty( $form_attributes['email_field'] ) ? esc_attr($form_attributes['email_field']) : 'visible';
        
        $phone_field = ! empty( $form_attributes['phone_field'] ) ? esc_attr($form_attributes['phone_field']) : 'hidden';
        $phone_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'optional';        
        
        $email_requirement = ! empty( $form_attributes['email_requirement'] ) ? esc_attr($form_attributes['email_requirement']) : 'required';
        $subject_field = ! empty( $form_attributes['subject_field'] ) ? esc_attr($form_attributes['subject_field']) : 'visible';
        $subject_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'required';
        $terms_field = ! empty( $form_attributes['terms_field'] ) ? esc_attr($form_attributes['terms_field']) : 'visible';
        $terms_requirement = ! empty( $form_attributes['terms_requirement'] ) ? esc_attr($form_attributes['terms_requirement']) : 'required'; 
        $captcha_field = ! empty( $form_attributes['captcha_field'] ) ? esc_attr($form_attributes['captcha_field']) : 'hidden';            
      
        if( $ajax != 'true' && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submission']) && isset( $_POST['sform_nonce'] ) && wp_verify_nonce( $_POST['sform_nonce'], 'sform_nonce_action' ) ) {
	
        $formdata = array(
			'name' => isset($_POST['sform_name']) ? sanitize_text_field($_POST['sform_name']) : '',
			'lastname' => isset($_POST['sform_lastname']) ? sanitize_text_field($_POST['sform_lastname']) : '',
			'email' => isset($_POST['sform_email']) ? sanitize_email($_POST['sform_email']) : '',
			'phone' => isset($_POST['sform_phone']) ? sanitize_text_field($_POST['sform_phone']) : '',			
			'subject' => isset($_POST['sform_subject']) ? sanitize_text_field($_POST['sform_subject']) : '',			
			'message' => isset($_POST['sform_message']) ? sanitize_textarea_field($_POST['sform_message']) : '',
			'terms' => isset($_POST['sform_privacy']) ? 'true' : 'false',
		    'captcha' => isset( $_POST['sform_captcha'] ) && is_numeric( $_POST['sform_captcha'] ) ? intval($_POST['sform_captcha']) : '',
            'captcha_one' => isset( $_POST['captcha_one'] ) && is_numeric( $_POST['captcha_one'] ) ? intval($_POST['captcha_one']) : 0,
            'captcha_two' => isset( $_POST['captcha_two'] ) && is_numeric( $_POST['captcha_two'] ) ? intval($_POST['captcha_two']) : 0,
			'username' => isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '',
			'telephone' => isset($_POST['telephone']) ? sanitize_text_field($_POST['telephone']) : '',
		);
  	            
        $error = '';		
        
        $firstname_length = '2';
        $firstname_regex = '#[0-9]+#';

        if ( $firstname_field == 'visible' || $firstname_field == 'registered' && is_user_logged_in() || $firstname_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $firstname_requirement == 'required' )	{
          if ( empty($formdata['name']) || strlen($formdata['name']) < $firstname_length ) {
		    if( $error == '' ) { $error = 'name'; }
          }
	      if (  ! empty($formdata['name']) && preg_match($firstname_regex, $formdata['name'] ) ) { 
		    if( $error == '' ) { $error = 'name_invalid'; }
	      }		
        }

        else {	
		  if ( ! empty($formdata['name']) && strlen($formdata['name'])< $firstname_length ) {
		    if( $error == '' ) { $error = 'name'; }
		  }
		  if (  ! empty($formdata['name']) && preg_match($firstname_regex, $formdata['name'] ) ) { 
		    if( $error == '' ) { $error = 'name_invalid'; }
          }
        }

        }

        $data_name = $formdata['name'];



        $lastname_length = '2';
        $lastname_regex = '#[0-9]+#';

        if ( $lastname_field == 'visible' || $lastname_field == 'registered' && is_user_logged_in() || $lastname_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $lastname_requirement == 'required' )	{
          if ( empty($formdata['lastname']) || strlen($formdata['lastname']) < $lastname_length ) {
		    if( $error == '' ) { $error = 'lastname'; }
          }
	      if (  ! empty($formdata['lastname']) && preg_match($lastname_regex, $formdata['lastname'] ) ) { 
		    if( $error == '' ) { $error = 'lastname_invalid'; }
	      }		
        }

        else {	
		  if ( ! empty($formdata['lastname']) && strlen($formdata['lastname'])< $lastname_length ) {
		    if( $error == '' ) { $error = 'lastname'; }
		  }
		  if (  ! empty($formdata['lastname']) && preg_match($lastname_regex, $formdata['lastname'] ) ) { 
		    if( $error == '' ) { $error = 'lastname_invalid'; }
          }
        }

        }

        $data_lastname = $formdata['lastname'];



        if ( $email_field == 'visible' || $email_field == 'registered' && is_user_logged_in() || $email_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $email_requirement == 'required' )	{
	      if ( empty($formdata['email']) || ! is_email($formdata['email']) ) {
		    if( $error == '' ) { $error = 'email'; }
		  }
        }
        else {		
		  if ( ! empty($formdata['email']) && ! is_email($formdata['email']) ) {
		    if( $error == '' ) { $error = 'email'; }
		  }
        }		
		
        }		

		$data_email = $formdata['email'];



        $phone_regex = '/^[0-9\-\(\)\/\+\s]*$/';  // allowed characters: -()/+ and space

        if ( $phone_field == 'visible' || $phone_field == 'registered' && is_user_logged_in() || $phone_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $phone_requirement == 'required' )	{
          if ( empty($formdata['phone']) ) {
		    if( $error == '' ) { $error = 'phone'; }
          }
	      if (  ! empty($formdata['phone']) && ! preg_match($phone_regex, $formdata['phone'] ) ) { 
		    if( $error == '' ) { $error = 'phone_invalid'; }
	      }		
        }
        else {		
		  if (  ! empty($formdata['phone']) && ! preg_match($phone_regex, $formdata['phone'] ) ) { 
		    if( $error == '' ) { $error = 'phone_invalid'; }
          }
        }		
		
        }		

		$data_phone = $formdata['phone'];



        $subject_length = '10';
        $subject_regex = '/^[^#$%&=+*{}|<>]+$/';
		
        if ( $subject_field == 'visible' || $subject_field == 'registered' && is_user_logged_in() || $subject_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $subject_requirement == 'required' )	{
          if ( empty($formdata['subject']) || strlen($formdata['subject']) < $subject_length ) {
		    if( $error == '' ) { $error = 'subject'; }
        }
	    if (  ! empty($formdata['subject']) && ! preg_match($subject_regex, $formdata['subject'] ) ) { 
		    if( $error == '' ) { $error = 'subject_invalid'; }		
    	}		
        
        }
        
        else {	
	        
		if ( ! empty($formdata['subject']) && strlen($formdata['subject']) < $subject_length ) {
		    if( $error == '' ) { $error = 'subject'; }		
		}
		if (  ! empty($formdata['subject']) && ! preg_match($subject_regex, $formdata['subject'] ) ) { 
		    if( $error == '' ) { $error = 'subject_invalid'; }		
        }
        
        }

        }
	
        $data_subject = stripslashes($formdata['subject']);

        $message_length = '10';
        $message_regex = '/^[^#$%&=+*{}|<>]+$/';

	    if ( strlen($formdata['message']) < $message_length ) {
		    if( $error == '' ) { $error = 'message'; }
	    }
	    if (  ! empty($formdata['message']) && ! preg_match($message_regex, $formdata['message'] )  ) { 
		    if( $error == '' ) { $error = 'message_invalid'; }
	    }

        $data_message = $formdata['message'];		
					
        if ( $terms_field == 'visible' || $terms_field == 'registered' && is_user_logged_in() || $terms_field == 'anonymous' && ! is_user_logged_in() )  {

        if ( $terms_requirement == 'required' )	{
	    if ( $formdata['terms'] !=  "true" ) { 
		    if( $error == '' ) { $error = 'terms'; }
	    }
        }

	    $data_terms = $formdata['terms'];

        }
        else {
		    $data_terms = '';
	    }

        if ( $captcha_field == 'visible' || $captcha_field == 'registered' && is_user_logged_in() || $captcha_field == 'anonymous' && ! is_user_logged_in() ) {	

        $captcha_one = $formdata['captcha_one'];
        $captcha_two = $formdata['captcha_two'];
	    $result = $captcha_one + $captcha_two;
        $answer = stripslashes($formdata['captcha']);		

	    if ( empty($captcha_one) || empty($captcha_two) || empty($answer) || $result != $answer ) {
		    if( $error == '' ) {
			$error = 'captcha';
		    $data_captcha_one = '';
		    $data_captcha_two = '';
		   	$data_captcha = '';
	        }
	        else {
		    $data_captcha_one = '';
		    $data_captcha_two = '';
		   	$data_captcha = '';
		    }
	    }
	    else {
		    $data_captcha_one = $formdata['captcha_one'];
		    $data_captcha_two = $formdata['captcha_two'];
		   	$data_captcha = $answer;
	    }

        }
        else {
		    $data_captcha_one = '';
		    $data_captcha_two = '';
		   	$data_captcha = '';
	  }
      
		if ( ! empty($formdata['username']) || ! empty($formdata['telephone']) ) {
		    if( $error == '' ) {
			$error = 'form_honeypot';
		    }
		}
		
	    $username_data = $formdata['username'];
	    $telephone_data = $formdata['telephone'];

		$error = apply_filters('sform_send_email', $formdata, $error );
		
		$data = array('name' => $data_name,'lastname' => $data_lastname,'email' => $data_email,'phone' => $data_phone,'subject' => $data_subject,'message' => $data_message,'terms' => $data_terms,'captcha' => $data_captcha,'captcha_one' => $data_captcha_one,'captcha_two' => $data_captcha_two,'username' => $username_data,'telephone' => $telephone_data,'error' => $error );

	    }
  
        else {	
        $data = array( 'name' => '','lastname' => '','email' => '','phone' =>'','subject' => '','message' => '','terms' => '','captcha' => '','captcha_one' => '','captcha_two' => '','username' => '','telephone' => '' );
		}
		
        return $data;

	}

	/**
	 * Process the form data after submission with post callback function
	 *
	 * @since    1.0
	 */

    public function formdata_processing($formdata, $error) {    

    $sform_settings = get_option('sform-settings');
    $ajax = ! empty( $sform_settings['ajax-submission'] ) ? esc_attr($sform_settings['ajax-submission']) : 'true'; 
 
    if( $ajax != 'true' && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submission']) && isset( $_POST['sform_nonce'] ) && wp_verify_nonce( $_POST['sform_nonce'], 'sform_nonce_action' ) ) {
  	            
    if ( ! empty($formdata['name']) ) { 
    $requester_name = $formdata['name'];      
    $name_value = $formdata['name'];
    }
    else {
	  if ( is_user_logged_in() ) {
		global $current_user;
		$requester_name = ! empty($current_user->user_firstname) ? $current_user->user_firstname : $current_user->display_name;
        $name_value = $requester_name;
      }
      else {
		$requester_name = '';       
		$name_value = '';     
      }
    }
    
    if ( ! empty($formdata['lastname']) ) { 
    $requester_lastname = ' ' . $formdata['lastname'];      
    $lastname_value = ' ' . $formdata['lastname'];
    }
    else {
	  if ( is_user_logged_in() ) {
		global $current_user;
		$requester_lastname = ! empty($current_user->user_lastname) ? ' ' . $current_user->user_lastname : '';
        $lastname_value = ' ' . $requester_lastname;
      }
      else {
		$requester_lastname = '';       
		$lastname_value = '';     
      }
    }

      $requester = $requester_name != '' || $requester_lastname != '' ? trim($requester_name . $requester_lastname) : esc_html__( 'Anonymous', 'simpleform' );
        
    
            
    if ( ! empty($formdata['email']) ) { 
    $email_value = $formdata['email'];
    }
    else {
	  if ( is_user_logged_in() ) {
		global $current_user;
		$email_value = $current_user->user_email;
      }
      else {
		$email_value = '';
      }
    }
            
    if ( ! empty($formdata['phone']) ) { 
    $phone_value = $formdata['phone'];
    }
    else {
	$phone_value = '';       
    }



    if ( ! empty($formdata['subject']) ) { 
    $subject_value = $formdata['subject'];
    $request_subject = $formdata['subject'];
    }
    else {
	$subject_value = '';         
	$request_subject = esc_attr__( 'No Subject', 'simpleform' );	         
    }

    if ($error == '') {
			
    $mailing = 'false';
    $submission_timestamp = time();
    $submission_date = date('Y-m-d H:i:s');

	global $wpdb;
	$table_name = $wpdb->prefix . 'sform_submissions'; 
    $requester_type  = is_user_logged_in() ? 'registered' : 'anonymous';
    $user_ID = is_user_logged_in() ? get_current_user_id() : '0';
    $sform_default_values = array( "date" => $submission_date, "requester_type" => $requester_type, "requester_id" => $user_ID );
    $extra_fields = array('notes' => '');
    $sform_extra_values = array_merge($sform_default_values, apply_filters( 'sform_storing_values', $extra_fields, $requester_name, $requester_lastname, $email_value, $phone_value, $subject_value, $formdata['message'] ));
    
    $success = $wpdb->insert($table_name, $sform_extra_values);

    if ($success)  {

    $notification = ! empty( $sform_settings['notification'] ) ? esc_attr($sform_settings['notification']) : 'true';

    if ($notification == 'true') { 
	       
    $to = ! empty( $sform_settings['notification_recipient'] ) ? esc_attr($sform_settings['notification_recipient']) : esc_attr( get_option( 'admin_email' ) );
    $submission_number = ! empty( $sform_settings['submission_number'] ) ? esc_attr($sform_settings['submission_number']) : 'visible';
    $subject_type = ! empty( $sform_settings['notification_subject'] ) ? esc_attr($sform_settings['notification_subject']) : 'request';
    $subject_text = ! empty( $sform_settings['custom_subject'] ) ? stripslashes(esc_attr($sform_settings['custom_subject'])) : esc_html__('New Contact Request', 'simpleform');
    $subject = $subject_type == 'request' ? $request_subject : $subject_text;
    
    if ( $submission_number == 'visible' ):
          $reference_number = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE date = '%s' ", $submission_date) );
    	  $admin_subject = '#' . $reference_number . ' - ' . $subject;	
     	  else:
     	  $admin_subject = $subject;	
    endif;
     	      	  
    $from_data = '<b>'. esc_html__('From', 'simpleform') .':</b>&nbsp;&nbsp;';
    
    $from_data .= $requester;
    
    if ( ! empty($email_value) ):
    $from_data .= '&nbsp;&nbsp;&lt;&nbsp;' . $email_value . '&nbsp;&gt;';
    else:
    $from_data .= '';
    endif;
    $from_data .= '<br>';
    
    
    if ( ! empty($phone_value) ) { $phone_data = '<b>'. esc_html__('Phone', 'simpleform') .':</b>&nbsp;&nbsp;' . $phone_value .'<br>'; }
    else { $phone_data = ''; }
    $from_data .= $phone_data;
    
         	  
    if ( ! empty($subject_value) ) { $subject_data = '<br><b>'. esc_html__('Subject', 'simpleform') .':</b>&nbsp;&nbsp;' . $subject_value .'<br>'; }
    else { $subject_data = '<br>'; }

    $tzcity = get_option('timezone_string');
    $tzoffset = get_option('gmt_offset');
    if ( ! empty($tzcity))  { 
    $current_time_timezone = date_create('now', timezone_open($tzcity));
    $timezone_offset =  date_offset_get($current_time_timezone);
    $website_timestamp = $submission_timestamp + $timezone_offset; 
    }
    else { 
    $timezone_offset =  $tzoffset * 3600;
    $website_timestamp = $submission_timestamp + $timezone_offset;  
    }
       
    $website_date = date_i18n( get_option( 'date_format' ), $website_timestamp ) . ' ' . esc_html__('at', 'simpleform') . ' ' . date_i18n( get_option('time_format'), $website_timestamp );

    $admin_message_email = '<div style="line-height:18px; padding-top:10px;">' . $from_data . '<b>'. esc_html__('Sent', 'simpleform') .':</b>&nbsp;&nbsp;' . $website_date . $subject_data  . '<br>' .  $formdata['message'] . '</div>'; 
	    
	$headers = "Content-Type: text/html; charset=UTF-8" .  "\r\n";
    if ( ! empty($formdata['email']) || is_user_logged_in() ) { $headers .= "Reply-To: ".$requester." <".$email_value.">" . "\r\n"; }
  
    do_action('check_smtp');
    add_filter( 'wp_mail_from_name', array ( $this, 'sform_notification_sender_name' ) ); 
    add_filter( 'wp_mail_from', array ( $this, 'sform_notification_sender_email' ) );
	$sent = wp_mail($to, $admin_subject, $admin_message_email, $headers); 
    remove_filter( 'wp_mail_from_name', array ( $this, 'sform_notification_sender_name' ) );
    remove_filter( 'wp_mail_from', array ( $this, 'sform_notification_sender_email' ) );
      
	$last_message = '<div style="line-height:18px;">' . $from_data . '<b>'. esc_html__('Date', 'simpleform') .':</b>&nbsp;&nbsp;' . $website_date . $subject_data . '<b>'. esc_html__('Message', 'simpleform') .':</b>&nbsp;&nbsp;' .  $formdata['message'] . '</div>';
    set_transient( 'sform_last_message', $last_message, 0 );

    if ($sent):
      $mailing = 'true';
    endif;

	}

    $confirmation = ! empty( $sform_settings['confirmation_email'] ) ? esc_attr($sform_settings['confirmation_email']) : 'false';
			
		if ( $confirmation == 'true' && ! empty($formdata['email']) ) {
			
		  $from = ! empty( $sform_settings['confirmation_sender_email'] ) ? esc_attr($sform_settings['confirmation_sender_email']) : esc_attr( get_option( 'admin_email' ) );
          $subject = ! empty( $sform_settings['confirmation_subject'] ) ? stripslashes(esc_attr($sform_settings['confirmation_subject'])) : esc_attr__( 'Your request has been received. Thanks!', 'simpleform' );
          $code_name = '[name]';
          $message = ! empty( $sform_settings['confirmation_message'] ) ? stripslashes(wp_kses_post($sform_settings['confirmation_message'])) : printf(__( 'Hi %s', 'simpleform' ),$code_name) . ',<p>' . esc_html__( 'We have received your request. It will be reviewed soon and we’ll get back to you as quickly as possible.', 'simpleform' ) . esc_html__( 'Thanks,', 'simpleform' ) . esc_html__( 'The Support Team', 'simpleform' );          
          $reply_to = ! empty( $sform_settings['confirmation_reply_to'] ) ? esc_attr($sform_settings['confirmation_reply_to']) : $from;
		  $headers = "Content-Type: text/html; charset=UTF-8" . "\r\n";
		  $headers .= "Reply-To: <".$reply_to.">" . "\r\n";
          $reference_number = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE date = '%s' ", $submission_date) );
          
	      $tags = array( '[name]','[request_subject]','[request_message]','[request_id]' );
          $values = array( $name_value,$subject_value,$formdata['message'],$reference_number );
          $content = str_replace($tags,$values,$message);
			
          do_action('check_smtp');
             add_filter( 'wp_mail_from_name', array ( $this, 'sform_confirmation_sender_name' ) ); 
             add_filter( 'wp_mail_from', array ( $this, 'sform_confirmation_sender_email' ) ); 
			 wp_mail($formdata['email'], $subject, $content, $headers);
             remove_filter( 'wp_mail_from_name', array ( $this, 'sform_confirmation_sender_name' ) );
             remove_filter( 'wp_mail_from', array ( $this, 'sform_confirmation_sender_email' ) );

		}
		
    $success_action = ! empty( $sform_settings['success_action'] ) ? esc_attr($sform_settings['success_action']) : 'message';    
    $thank_you_url = ! empty( $sform_settings['thank_you_url'] ) ? esc_url($sform_settings['thank_you_url']) : '';    
    if( $success_action == 'message' ) { $redirect_to = add_query_arg( 'sending', 'success' ); }
    else { $redirect_to = ! empty($thank_you_url) ? $thank_you_url : add_query_arg( 'sending', 'success' ); }

    if ( ! has_filter('sform_post_message') ) { 
      if ( $mailing == 'true' ) {
	   echo '<script type="text/javascript">
	   document.location.href = encodeURI("'.esc_js($redirect_to).'");
	   </script>';  
	   $error = '';
      } 	 
	  else  { $error = 'server_error'; }
	}
	
	else { $error = apply_filters( 'sform_post_message', $mailing ); 
      if ( $error == '' ) {
	   echo '<script type="text/javascript">
	   document.location.href = encodeURI("'.esc_js($redirect_to).'");
	   </script>';  
      } 	 
	}
	 
    } 

    else  {  $error = 'server_error'; }
			
    }

    return $error;

    }
     
}
    
	/**
	 * Process the form data after submission with Ajax callback function
	 *
	 * @since    1.0
	 */
   
    public function formdata_ajax_processing() {
	
      if( 'POST' !== $_SERVER['REQUEST_METHOD'] ) { die ( 'Security checked!'); }
      elseif ( ! wp_verify_nonce( $_POST['sform_nonce'], 'sform_nonce_action' ) )  { die ( 'Security checked!'); }

      else {	
      $name = isset($_POST['sform_name']) ? sanitize_text_field($_POST['sform_name']) : '';
      $email = isset($_POST['sform_email']) ? sanitize_email($_POST['sform_email']) : '';
      $email_data = isset($_POST['sform_email']) ? sanitize_text_field($_POST['sform_email']) : '';
      $lastname = isset($_POST['sform_lastname']) ? sanitize_text_field($_POST['sform_lastname']) : '';
	  $phone = isset($_POST['sform_phone']) ? sanitize_text_field($_POST['sform_phone']) : '';			
      $object = isset($_POST['sform_subject']) ? sanitize_text_field(str_replace("\'", "’", $_POST['sform_subject'])) : '';
      $request = isset($_POST['sform_message']) ? sanitize_textarea_field($_POST['sform_message']) : '';
      $terms = isset($_POST['sform_privacy']) ? 'true' : 'false';
      $captcha_one = isset($_POST['captcha_one']) && is_numeric( $_POST['captcha_one'] ) ? intval($_POST['captcha_one']) : ''; 
      $captcha_two = isset($_POST['captcha_two']) && is_numeric( $_POST['captcha_two'] ) ? intval($_POST['captcha_two']) : '';
      $captcha_result = isset($_POST['captcha_one']) && isset($_POST['captcha_two']) ? $captcha_one + $captcha_two : ''; 
      $captcha_answer = isset($_POST['sform_captcha']) && is_numeric( $_POST['sform_captcha'] ) ? intval($_POST['sform_captcha']) : '';
      $honeypot_username = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
      $honeypot_telephone = isset($_POST['telephone']) ? sanitize_text_field($_POST['telephone']) : '';
      $sform_settings = get_option('sform-settings');
 
      $form_attributes = get_option('sform-attributes');

      $firstname_field = ! empty( $form_attributes['firstname_field'] ) ? esc_attr($form_attributes['firstname_field']) : 'visible';
      $firstname_requirement = ! empty( $form_attributes['firstname_requirement'] ) ? esc_attr($form_attributes['firstname_requirement']) : 'required';
      $lastname_field = ! empty( $form_attributes['lastname_field'] ) ? esc_attr($form_attributes['lastname_field']) : 'hidden';
      $lastname_requirement = ! empty( $form_attributes['lastname_requirement'] ) ? esc_attr($form_attributes['lastname_requirement']) : 'optional';
      $phone_field = ! empty( $form_attributes['phone_field'] ) ? esc_attr($form_attributes['phone_field']) : 'hidden';
      $phone_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'optional';        
      $email_field = ! empty( $form_attributes['email_field'] ) ? esc_attr($form_attributes['email_field']) : 'visible';
      $email_requirement = ! empty( $form_attributes['email_requirement'] ) ? esc_attr($form_attributes['email_requirement']) : 'required';
      $subject_field = ! empty( $form_attributes['subject_field'] ) ? esc_attr($form_attributes['subject_field']) : 'visible';
      $subject_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'required';
      $terms_field = ! empty( $form_attributes['terms_field'] ) ? esc_attr($form_attributes['terms_field']) : 'visible';
      $terms_requirement = ! empty( $form_attributes['terms_requirement'] ) ? esc_attr($form_attributes['terms_requirement']) : 'required'; 
      $captcha_field = ! empty( $form_attributes['captcha_field'] ) ? esc_attr($form_attributes['captcha_field']) : 'hidden';            
      
      if ( ! empty($name) ) { $requester_name = $name; }
      else {
	    if ( is_user_logged_in() ) {
		global $current_user;
		$requester_name = ! empty($current_user->user_firstname) ? $current_user->user_firstname : $current_user->display_name;
        }
        else { $requester_name = ''; }
      }
            
      if ( ! empty($lastname) ) { $requester_lastname = ' ' . $lastname; }
      else {
	    if ( is_user_logged_in() ) {
		global $current_user;
		$requester_lastname = ! empty($current_user->user_lastname) ? ' ' . $current_user->user_lastname : '';
        }
        else { $requester_lastname = ''; }
      }

      $requester = $requester_name != '' || $requester_lastname != '' ? trim($requester_name . $requester_lastname) : esc_html__( 'Anonymous', 'simpleform' );

      if ( ! empty($email) ) { $requester_email = $email; }
      else {
	    if ( is_user_logged_in() ) {
		global $current_user;
		$requester_email = $current_user->user_email;
        }
        else { $requester_email = ''; }
      }

      if ( ! empty($object) ) { 
        $subject_value = $object;
        $request_subject = $object;
      }
      else {
	    $subject_value = '';         
	    $request_subject = esc_attr__( 'No Subject', 'simpleform' );	         
      }

      if ( $firstname_field == 'visible' || $firstname_field == 'registered' && is_user_logged_in() || $firstname_field == 'anonymous' && ! is_user_logged_in() )  {  

        $firstname_length = '2';
        $firstname_regex = '#[0-9]+#';
        $error_name_label = ! empty( $sform_settings['firstname_error_message'] ) ? stripslashes(esc_attr($sform_settings['firstname_error_message'])) : esc_attr__( 'Please enter at least 2 characters', 'simpleform' );
        $error_invalid_name_label = ! empty( $sform_settings['invalid_name_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_name_error'])) : esc_attr__( 'The name contains characters that are not allowed', 'simpleform' );
        $error = ! empty( $sform_settings['name_error'] ) ? stripslashes(esc_attr($sform_settings['name_error'])) : esc_html__('Error occurred validating the name', 'simpleform');

        if ( $firstname_requirement == 'required' )	{
        if ( empty($name) || strlen($name) < $firstname_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_name_label, 'field' => 'name' ));
	    exit; 
        }
	    if (  ! empty($name) && preg_match($firstname_regex, $name ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_name_label, 'field' => 'name' ));
	    exit; 
        }		
        }

        else {	
	    if ( ! empty($name) && strlen($name) < $firstname_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_name_label, 'field' => 'name' ));
	    exit; 
	    }
	    if (  ! empty($name) && preg_match($firstname_regex, $name ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_name_label, 'field' => 'name' ));
	    exit; 
        }
        }

      }


      if ( $lastname_field == 'visible' || $lastname_field == 'registered' && is_user_logged_in() || $lastname_field == 'anonymous' && ! is_user_logged_in() )  {  

        $lastname_length = '2';
        $lastname_regex = '#[0-9]+#';
        $error_lastname_label = ! empty( $sform_settings['lastname_error_message'] ) ? stripslashes(esc_attr($sform_settings['lastname_error_message'])) : esc_attr__( 'Please enter at least 2 characters', 'simpleform' );
        $error_invalid_lastname_label = ! empty( $sform_settings['invalid_lastname_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_lastname_error'])) : esc_attr__( 'The lastname contains characters that are not allowed', 'simpleform' );
        $error = ! empty( $sform_settings['lastname_error'] ) ? stripslashes(esc_attr($sform_settings['lastname_error'])) : esc_html__('Error occurred validating the lastname', 'simpleform');
	
        if ( $lastname_requirement == 'required' )	{
        if ( empty($lastname) || strlen($lastname) < $lastname_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_lastname_label, 'field' => 'lastname' ));
	    exit; 
        }
	    if (  ! empty($lastname) && preg_match($lastname_regex, $lastname ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_lastname_label, 'field' => 'lastname' ));
	    exit; 
        }		
        }

        else {	
	    if ( ! empty($lastname) && strlen($lastname) < $lastname_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_lastname_label, 'field' => 'lastname' ));
	    exit; 
	    }
	    if (  ! empty($lastname) && preg_match($lastname_regex, $lastname ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_lastname_label, 'field' => 'lastname' ));
	    exit; 
        }
        }

      }

      if ( $email_field == 'visible' || $email_field == 'registered' && is_user_logged_in() || $email_field == 'anonymous' && ! is_user_logged_in() )  {  

        $error_email_label = ! empty( $sform_settings['email_error_message'] ) ? stripslashes(esc_attr($sform_settings['email_error_message'])) : esc_attr__( 'Please enter a valid email', 'simpleform' );
        $error = ! empty( $sform_settings['email_error'] ) ? stripslashes(esc_attr($sform_settings['email_error'])) : esc_html__('Error occurred validating the email', 'simpleform');

        if ( $email_requirement == 'required' )	{
	    if ( empty($email) || ! is_email($email) ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_email_label, 'field' => 'email' ));
	    exit;
	    }
        }
  
        else {		
	    if ( ! empty($email_data) && ! is_email($email) ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_email_label, 'field' => 'email' ));
	    exit;
        }
        }		
		
      }	
      
        $phone_regex = '/^[0-9\-\(\)\/\+\s]*$/';  // allowed characters: -()/+ and space

        if ( $phone_field == 'visible' || $phone_field == 'registered' && is_user_logged_in() || $phone_field == 'anonymous' && ! is_user_logged_in() )  {

        $empty_phone_error = ! empty( $sform_settings['empty_phone_error'] ) ? stripslashes(esc_attr($sform_settings['empty_phone_error'])) : esc_attr__( 'Please provide your phone number', 'simpleform' );
        $error_phone_label = ! empty( $sform_settings['phone_error_message'] ) ? stripslashes(esc_attr($sform_settings['phone_error_message'])) : esc_attr__( 'The phone number contains not allowed characters', 'simpleform' );
        $error = ! empty( $sform_settings['phone_error'] ) ? stripslashes(esc_attr($sform_settings['phone_error'])) : esc_attr__( 'Error occurred validating the phone number', 'simpleform' );
        
        if ( $phone_requirement == 'required' )	{
          if ( empty($phone) ) {
          echo json_encode(array('error' => true, 'message' => $error, 'label' => $empty_phone_error, 'field' => 'phone' ));
	      exit; 
          }
	      if (  ! empty($phone) && ! preg_match($phone_regex, $phone ) ) { 
          echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_phone_label, 'field' => 'phone' ));
	      exit; 
	      }		
        }
        else {		
	      if (  ! empty($phone) && ! preg_match($phone_regex, $phone ) ) { 
          echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_phone_label, 'field' => 'phone' ));
	      exit; 
	      }		
        }		
		
        }		
      
      
      if ( $subject_field == 'visible' || $subject_field == 'registered' && is_user_logged_in() || $subject_field == 'anonymous' && ! is_user_logged_in() )  { 

        $subject_length = '10';
        $subject_regex = '/^[^#$%&=+*{}|<>]+$/';
        $error_subject_label = ! empty( $sform_settings['subject_error_message'] ) ? stripslashes(esc_attr($sform_settings['subject_error_message'])) : esc_attr__( 'Please enter a subject at least 10 characters long', 'simpleform' );
        $error_invalid_subject_label = ! empty( $sform_settings['invalid_subject_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_subject_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
        $error = ! empty( $sform_settings['subject_error'] ) ? stripslashes(esc_attr($sform_settings['subject_error'])) : esc_html__('Error occurred validating the subject', 'simpleform');

        if ( $subject_requirement == 'required' )	{
        
        if ( empty($object) || strlen($object) < $subject_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_subject_label, 'field' => 'subject' ));
	    exit; 
        }
	    if (  ! empty($object) && ! preg_match($subject_regex, $object ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_subject_label, 'field' => 'subject' ));
	    exit;
	    }		
        
        }

        else {	
    
    	if ( ! empty($object) && strlen($object) < $subject_length ) {
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_subject_label, 'field' => 'subject' ));
	    exit; 
	    }
	    if (  ! empty($object) && ! preg_match($subject_regex, $object ) ) { 
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_subject_label, 'field' => 'subject' ));
	    exit;
        }
        
        }

      }

      $message_length = '10';
      $message_regex = '/^[^#$%&=+*{}|<>]+$/';
      $error_message_label = ! empty( $sform_settings['object_error_message'] ) ? stripslashes(esc_attr($sform_settings['object_error_message'])) : esc_attr__( 'Please enter a message at least 10 characters long', 'simpleform' );
      $error_invalid_message_label = ! empty( $sform_settings['invalid_message_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_message_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
      
      $error = ! empty( $sform_settings['message_error'] ) ? stripslashes(esc_attr($sform_settings['message_error'])) : esc_html__('Error occurred validating the message', 'simpleform');
     	
      if ( empty($request) || strlen($request) < $message_length ) {
      echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_message_label, 'field' => 'message' ));
	  exit; 
      }

      if (  ! empty($request) && ! preg_match($message_regex, $request )  ) { 
      echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_invalid_message_label, 'field' => 'message' ));
	  exit; 
      }

      if ( $terms_field == 'visible' || $terms_field == 'registered' && is_user_logged_in() || $terms_field == 'anonymous' && ! is_user_logged_in() )  {  

        $error_acceptance_terms_label = ! empty( $sform_settings['terms_error'] ) ? stripslashes(esc_attr($sform_settings['terms_error'])) : esc_attr__( 'Please accept our terms and conditions before submitting form', 'simpleform' );
        if ( $terms_requirement == 'required' )	{
	    if ( $terms !=  "true" ) { 
        echo json_encode(array('error' => true, 'message' => $error_acceptance_terms_label, 'field' => 'privacy' ));
	    exit; 
	    }
        }

      }

      if ( ! empty($honeypot_username) || ! empty($honeypot_telephone) ) { 
	  $error = ! empty( $sform_settings['honeypot_error'] ) ? stripslashes(esc_attr($sform_settings['honeypot_error'])) : esc_html__('Error occurred during processing data', 'simpleform');
      echo json_encode(array('error' => true, 'message' => $error ));
	  exit; 
	  }

	
      if ( ( $captcha_field == 'visible' || $captcha_field == 'registered' && is_user_logged_in() || $captcha_field == 'anonymous' && ! is_user_logged_in() ) && ! empty($captcha_one) && ! empty($captcha_two) && ( empty($captcha_answer) || $captcha_result != $captcha_answer ) ) { 

        $error_captcha_label = ! empty( $sform_settings['captcha_error_message'] ) ? stripslashes(esc_attr($sform_settings['captcha_error_message'])) : esc_attr__( 'Please enter a valid captcha value', 'simpleform' );
	    $error = ! empty( $sform_settings['captcha_error'] ) ? stripslashes(esc_attr($sform_settings['captcha_error'])) : esc_html__('Error occurred validating the captcha', 'simpleform');
        
        echo json_encode(array('error' => true, 'message' => $error, 'label' => $error_captcha_label, 'field' => 'captcha' ));
	    exit; 
      }

      else {

      $mailing = 'false';
      $success_action = ! empty( $sform_settings['success_action'] ) ? esc_attr($sform_settings['success_action']) : 'message';    
      $confirmation_img = plugins_url( 'img/confirmation.png', __FILE__ );
      $thank_string1 = esc_html__( 'We have received your request!', 'simpleform' );
      $thank_string2 = esc_html__( 'Your message will be reviewed soon, and we’ll get back to you as quickly as possible.', 'simpleform' );
      $thank_you_message = ! empty( $sform_settings['success_message'] ) ? stripslashes(wp_kses_post($sform_settings['success_message'])) : '<div class="form confirmation"><h4>' . $thank_string1 . '</h4><br>' . $thank_string2 . '</br><img src="'.$confirmation_img.'" alt="message received"></div>';    
      $thank_you_url = ! empty( $sform_settings['thank_you_url'] ) ? esc_url($sform_settings['thank_you_url']) : '';    
		  		   
	  if( $success_action == 'message' ):
		   $redirect = false;
		   $redirect_url = '';
		   else:
		   $redirect = true;
		   $redirect_url = $thank_you_url;
	  endif;
		   
      $submission_timestamp = time();
      $submission_date = date('Y-m-d H:i:s');
			
	  global $wpdb;
	  $table_name = $wpdb->prefix . 'sform_submissions'; 
      $requester_type  = is_user_logged_in() ? 'registered' : 'anonymous';
      $user_ID = is_user_logged_in() ? get_current_user_id() : '0';
      $sform_default_values = array( "date" => $submission_date, "requester_type" => $requester_type, "requester_id" => $user_ID );      
      $extra_fields = array('notes' => '');
      $sform_extra_values = array_merge($sform_default_values, apply_filters( 'sform_storing_values', $extra_fields, $requester_name, $requester_lastname, $requester_email, $phone, $subject_value, $request ));
      $success = $wpdb->insert($table_name, $sform_extra_values);
      
      $server_error_message = ! empty( $sform_settings['server_error_message'] ) ? stripslashes(esc_attr($sform_settings['server_error_message'])) : esc_attr__( 'Error occurred during processing data. Please try again!', 'simpleform' );

      if ( $success )  {		   

      $notification = ! empty( $sform_settings['notification'] ) ? esc_attr($sform_settings['notification']) : 'true';

      if ($notification == 'true') { 

       $to = ! empty( $sform_settings['notification_recipient'] ) ? esc_attr($sform_settings['notification_recipient']) : esc_attr( get_option( 'admin_email' ) );
       $submission_number = ! empty( $sform_settings['submission_number'] ) ? esc_attr($sform_settings['submission_number']) : 'visible';
       $subject_type = ! empty( $sform_settings['notification_subject'] ) ? esc_attr($sform_settings['notification_subject']) : 'request';
       $subject_text = ! empty( $sform_settings['custom_subject'] ) ? stripslashes(esc_attr($sform_settings['custom_subject'])) : esc_html__('New Contact Request', 'simpleform');
       $subject = $subject_type == 'request' ? $request_subject : $subject_text;

       if ( $submission_number == 'visible' ):
          $reference_number = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE date = '%s' ", $submission_date) );

     	  $admin_subject = '#' . $reference_number . ' - ' . $subject;	
     	  else:
     	  $admin_subject = $subject;	
       endif;
     	  
       $from_data = '<b>'. esc_html__('From', 'simpleform') .':</b>&nbsp;&nbsp;';
       $from_data .= $requester;       
       if ( ! empty($requester_email) ):
       $from_data .= '&nbsp;&nbsp;&lt;&nbsp;' . $requester_email . '&nbsp;&gt;';
       else:
       $from_data .= '';
       endif;
       $from_data .= '<br>';       
       
       if ( ! empty($phone) ) { $phone_data = '<b>'. esc_html__('Phone', 'simpleform') .':</b>&nbsp;&nbsp;' . $phone .'<br>'; }
       else { $phone_data = ''; }
       $from_data .= $phone_data;
     	  
       if ( ! empty($subject_value) ) { $subject_data = '<br><b>'. esc_html__('Subject', 'simpleform') .':</b>&nbsp;&nbsp;' . $subject_value .'<br>'; }
       else { $subject_data = '<br>'; }

       $tzcity = get_option('timezone_string'); 
       $tzoffset = get_option('gmt_offset');
       if ( ! empty($tzcity))  { 
       $current_time_timezone = date_create('now', timezone_open($tzcity));
       $timezone_offset =  date_offset_get($current_time_timezone);
       $website_timestamp = $submission_timestamp + $timezone_offset; 
       }
       else { 
       $timezone_offset =  $tzoffset * 3600;
       $website_timestamp = $submission_timestamp + $timezone_offset;  
       }

       $website_date = date_i18n( get_option( 'date_format' ), $website_timestamp ) . ' ' . esc_html__('at', 'simpleform') . ' ' . date_i18n( get_option('time_format'), $website_timestamp );
		
       $admin_message_email = '<div style="line-height:18px; padding-top:10px;">' . $from_data . '<b>'. esc_html__('Sent', 'simpleform') .':</b>&nbsp;&nbsp;' . $website_date . $subject_data  . '<br>' .  $request . '</div>';    
       $notification_sender_email = ! empty( $sform_settings['notification_sender_email'] ) ? esc_attr($sform_settings['notification_sender_email']) : esc_attr( get_option( 'admin_email' ) );
	   $from =  $notification_sender_email;

	   $headers = "Content-Type: text/html; charset=UTF-8" .  "\r\n";
       if ( ! empty($email) || is_user_logged_in() ) { $headers .= "Reply-To: ".$requester." <".$requester_email.">" . "\r\n"; }
  
       do_action('check_smtp');
       add_filter( 'wp_mail_from_name', array ( $this, 'sform_notification_sender_name' ) ); 
       add_filter( 'wp_mail_from', array ( $this, 'sform_notification_sender_email' ) );
	   $sent = wp_mail($to, $admin_subject, $admin_message_email, $headers); 
       remove_filter( 'wp_mail_from_name', array ( $this, 'sform_notification_sender_name' ) );
       remove_filter( 'wp_mail_from', array ( $this, 'sform_notification_sender_email' ) );
      
	   $last_message = '<div style="line-height:18px;">' . $from_data . '<b>'. esc_html__('Date', 'simpleform') .':</b>&nbsp;&nbsp;' . $website_date . $subject_data . '<b>'. esc_html__('Message', 'simpleform') .':</b>&nbsp;&nbsp;' .  $request . '</div>';
       set_transient( 'sform_last_message', $last_message, 0 ); 

       if ($sent):
         $mailing = 'true';
       endif;

	  } 

      $confirmation = ! empty( $sform_settings['confirmation_email'] ) ? esc_attr($sform_settings['confirmation_email']) : 'false';
			
	   if ( $confirmation == 'true' && ! empty($email) ) {
		  $from = ! empty( $sform_settings['confirmation_sender_email'] ) ? esc_attr($sform_settings['confirmation_sender_email']) : esc_attr( get_option( 'admin_email' ) );
          $subject = ! empty( $sform_settings['confirmation_subject'] ) ? stripslashes(esc_attr($sform_settings['confirmation_subject'])) : esc_attr__( 'Your request has been received. Thanks!', 'simpleform' );
          $code_name = '[name]';
          $message = ! empty( $sform_settings['confirmation_message'] ) ? stripslashes(wp_kses_post($sform_settings['confirmation_message'])) : printf(__( 'Hi %s', 'simpleform' ),$code_name) . ',<p>' . esc_html__( 'We have received your request. It will be reviewed soon and we’ll get back to you as quickly as possible.', 'simpleform' ) . esc_html__( 'Thanks,', 'simpleform' ) . esc_html__( 'The Support Team', 'simpleform' );          
          $reply_to = ! empty( $sform_settings['confirmation_reply_to'] ) ? esc_attr($sform_settings['confirmation_reply_to']) : $from;
		  $headers = "Content-Type: text/html; charset=UTF-8" . "\r\n";
		  $headers .= "Reply-To: <".$reply_to.">" . "\r\n";
          $reference_number = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE date = '%s' ", $submission_date) );

	      $tags = array( '[name]','[request_subject]','[request_message]','[request_id]' );
          $values = array( $name,$object,$request,$reference_number ); 
          $content = str_replace($tags,$values,$message);

          do_action('check_smtp');
             add_filter( 'wp_mail_from_name', array ( $this, 'sform_confirmation_sender_name' ) );
             add_filter( 'wp_mail_from', array ( $this, 'sform_confirmation_sender_email' ) ); 
			 wp_mail($email, $subject, $content, $headers);
             remove_filter( 'wp_mail_from_name', array ( $this, 'sform_confirmation_sender_name' ) );
             remove_filter( 'wp_mail_from', array ( $this, 'sform_confirmation_sender_email' ) );

	   }

       if ( ! has_action('sform_ajax_message') ) {
          if ( $mailing == 'true' ) {
          echo json_encode(array('error' => false, 'redirect' => $redirect, 'redirect_url' => $redirect_url, 'message' => $thank_you_message ));
	      exit;
	      } 
	      else {
          echo json_encode(array('error' => true, 'message' => $server_error_message ));
	      exit;
          } 	  
	   }
	   else { do_action( 'sform_ajax_message', $mailing, $redirect, $redirect_url, $thank_you_message, $server_error_message ); }
            
      } 
      
      else  {
       echo json_encode(array('error' => true, 'message' => $server_error_message ));
	   exit;
      }
	         	
	} 
	 
    wp_die(); 
  
    } 

    }

	/**
	 * Force "From Name" in Notification Email 
	 *
	 * @since    1.0
	 */
   
    public function sform_notification_sender_name() {
   
     $sform_settings = get_option('sform-settings');
     $sender = ! empty( $sform_settings['notification_sender_name'] ) ? esc_attr($sform_settings['notification_sender_name']) : 'requester';
     $custom_sender = ! empty( $sform_settings['custom_sender'] ) ? esc_attr($sform_settings['custom_sender']) : esc_attr( get_bloginfo( 'name' ) ); 
     $attribute = '';  
     $shortcode_values = apply_filters( 'sform_form', $attribute );          
     $form_name = ! empty($shortcode_values['name']) ? $shortcode_values['name'] : esc_attr__( 'Contact Form','simpleform');

     if ( $sender == 'requester') {
	   
       if ( ! empty(sanitize_text_field($_POST['sform_name'])) ) { $sender_name = sanitize_text_field($_POST['sform_name']); }            
       else { 
	    if ( is_user_logged_in() ) {
		 global $current_user;
		 $sender_name = ! empty($current_user->user_firstname) ? $current_user->user_firstname . ' ' . $current_user->last_name : $current_user->display_name;
     	}
        else { $sender_name = esc_html__('Anonymous', 'simpleform');  }
       }
     }
     if ( $sender == 'custom') { $sender_name = $custom_sender; }
     if ( $sender == 'form') { $sender_name = $form_name; }
    
     return $sender_name;
    
    }
  
	/**
	 * Force "From Email" in Notification Email 
	 *
	 * @since    1.0
	 */
   
    public function sform_notification_sender_email() {
 	
     $sform_settings = get_option('sform-settings');
     $notification_sender_email = ! empty( $sform_settings['notification_sender_email'] ) ? esc_attr($sform_settings['notification_sender_email']) : esc_attr( get_option( 'admin_email' ) );

     return $notification_sender_email;
    
    }

	/**
	 * Force "From Name" in Confirmation Email 
	 *
	 * @since    1.0
	 */
   
    public function sform_confirmation_sender_name() {
    
      $sform_settings = get_option('sform-settings');
	  $sender_name = ! empty( $sform_settings['confirmation_sender_name'] ) ? esc_attr($sform_settings['confirmation_sender_name']) : esc_attr( get_bloginfo( 'name' ) ); 
	  
	  return $sender_name;
    }

	/**
	 * Force "From Email" in Confirmation Email 
	 *
	 * @since    1.0
	 */
   
    public function sform_confirmation_sender_email() {
     
      $sform_settings = get_option('sform-settings');
	  $from = ! empty( $sform_settings['confirmation_sender_email'] ) ? esc_attr($sform_settings['confirmation_sender_email']) : esc_attr( get_option( 'admin_email' ) );

      return $from;
    
    }


} 