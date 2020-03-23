<?php
		
if ( ! defined( 'ABSPATH' ) ) { exit; }

$error = false;
$math_one = mt_rand(10,99);
$math_two = mt_rand(1,9);	
$nonce = wp_nonce_field( 'sform_nonce_action', 'sform_nonce', true, false );
$sform_settings = get_option('sform-settings');
$form_attributes = get_option('sform-attributes');
$empty_data = array( 'name' => '','email' => '','subject' => '','message' => '','terms' => '','captcha' => '','captcha_one' => '','captcha_two' => '','username' => '','telephone' => '' );
$data = apply_filters( 'sform_validation', $empty_data );
$form_error = array_slice($data, 10, 1);
$error_class = ! empty($data['error']) ? array_flip($form_error) : '';
$introduction_text = ! empty( $form_attributes['introduction_text'] ) ? stripslashes(wp_kses_post($form_attributes['introduction_text'])) : 'Please fill out the form below with your inquiry and we will get back to you as soon as possible. Mandatory fields are marked with (*).';
$bottom_text = ! empty( $form_attributes['bottom_text'] ) ? stripslashes(wp_kses_post($form_attributes['bottom_text'])) : '';



$required_sign = ! empty( $form_attributes['required_sign'] ) ? esc_attr($form_attributes['required_sign']) : 'true';
// $required_word = ! empty( $form_attributes['required_word'] ) ? esc_attr($form_attributes['required_word']) : esc_attr__( '(required)', 'simpleform' );
$required_word = ! empty( $form_attributes['required_word'] ) ? esc_attr($form_attributes['required_word']) : '';
$required_position = ! empty( $form_attributes['required-position'] ) ? esc_attr($form_attributes['required-position']) : 'required';







$name_field = ! empty( $form_attributes['name_field'] ) ? esc_attr($form_attributes['name_field']) : 'visible';
$name_requirement = ! empty( $form_attributes['name_requirement'] ) ? esc_attr($form_attributes['name_requirement']) : 'required';
$email_field = ! empty( $form_attributes['email_field'] ) ? esc_attr($form_attributes['email_field']) : 'visible';
$email_requirement = ! empty( $form_attributes['email_requirement'] ) ? esc_attr($form_attributes['email_requirement']) : 'required';
$subject_field = ! empty( $form_attributes['subject_field'] ) ? esc_attr($form_attributes['subject_field']) : 'visible';
$subject_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'required';
$captcha_field = ! empty( $form_attributes['captcha_field'] ) ? esc_attr($form_attributes['captcha_field']) : 'hidden';            
$name_label = ! empty( $form_attributes['name_label'] ) ? stripslashes(esc_attr($form_attributes['name_label'])) : esc_attr__( 'Name', 'simpleform' );

$name_field_requirement = $name_requirement == 'required' ? 'true' : 'false';

// EDIT
$required_name_sign = (! isset($error_class['name']) && ! isset($error_class['name_invalid']) && ! empty(esc_attr($data['name']))) || $name_requirement != 'required' || $required_sign != 'true' ? '' : '&lowast;';
// EDIT
$required_name = ( $required_sign == 'true' && $name_field_requirement == 'true' ) || ( $required_sign != 'true' && $name_field_requirement == 'true' && $required_position == 'required' ) || ( $required_sign != 'true' && $name_field_requirement != 'true' && $required_position != 'required' ) ? '' : 'd-none';
// NEW
$required_name_word = (! isset($error_class['name']) && ! isset($error_class['name_invalid']) && ! empty(esc_attr($data['name']))) || ( $required_sign != 'true' && $name_requirement == 'required' && $required_position != 'required' ) || ( $required_sign != 'true' && $name_requirement != 'required' && $required_position == 'required' ) || $required_sign == 'true' ? '' : '&nbsp;'.$required_word;
// NEW
$required_name_label = $required_sign == 'true' ? '<span class="'.$required_name.'">'.$required_name_sign.'</span>' : '<span class="word '.$required_name.'">'.$required_name_word.'</span>';



$name_field_label = $form_attributes['name_spotlight'] == 'hidden' ? '' : '<label for="sform_name">'.$name_label.$required_name_label.'</label>';
$name_placeholder = ! empty( $form_attributes['name_placeholder'] ) ? esc_attr($form_attributes['name_placeholder']) : '';
$email_placeholder = ! empty( $form_attributes['email_placeholder'] ) ? esc_attr($form_attributes['email_placeholder']) : '';
$subject_placeholder = ! empty( $form_attributes['subject_placeholder'] ) ? esc_attr($form_attributes['subject_placeholder']) : '';
$message_placeholder = ! empty( $form_attributes['message_placeholder'] ) ? esc_attr($form_attributes['message_placeholder']) : '';










$email_label = ! empty( $form_attributes['email_label']  ) ? stripslashes(esc_attr($form_attributes['email_label'])) : esc_attr__( 'Email', 'simpleform' );
$email_field_requirement = $email_requirement == 'required' ? 'true' : 'false';



$required_email_sign = (! isset($error_class['email']) && ! empty(esc_attr($data['email']))) || $email_requirement != 'required' || $required_sign != 'true' ? '' : '&lowast;';


$required_email = ( $required_sign == 'true' && $email_field_requirement == 'true' ) || ( $required_sign != 'true' && $email_field_requirement == 'true' && $required_position == 'required' ) || ( $required_sign != 'true' && $email_field_requirement != 'true' && $required_position != 'required' ) ? '' : 'd-none';

$required_email_word = (! isset($error_class['email']) && ! empty(esc_attr($data['email']))) || ( $required_sign != 'true' && $email_requirement == 'required' && $required_position != 'required' ) || ( $required_sign != 'true' && $email_requirement != 'required' && $required_position == 'required' ) || $required_sign == 'true' ? '' : '&nbsp;'.$required_word;

$required_email_label = $required_sign == 'true' ? '<span class="'.$required_email.'">'.$required_email_sign.'</span>' : '<span class="word '.$required_email.'">'.$required_email_word.'</span>';












$subject_label = ! empty( $form_attributes['subject_label'] ) ? stripslashes(esc_attr($form_attributes['subject_label'])) : esc_attr__( 'Subject', 'simpleform' );
$subject_field_requirement = $subject_requirement == 'required' ? 'true' : 'false';

$required_subject = ( $required_sign == 'true' && $subject_field_requirement == 'true' ) || ( $required_sign != 'true' && $subject_field_requirement == 'true' && $required_position == 'required' ) || ( $required_sign != 'true' && $subject_field_requirement != 'true' && $required_position != 'required' ) ? '' : 'd-none';



$required_subject_sign = (! isset($error_class['subject']) && ! isset($error_class['subject_invalid']) && ! empty(esc_attr($data['subject']))) || $subject_requirement != 'required' || $required_sign != 'true' ? '' : '&lowast;';

$required_subject_word = ( (! isset($error_class['subject']) && ! isset($error_class['subject_invalid']) && ! empty(esc_attr($data['subject']))) ) || ( $subject_requirement == 'required' && $required_position != 'required' ) || ( $required_sign != 'true' && $subject_requirement != 'required' && $required_position == 'required' ) || ( $required_sign != 'true' && $subject_requirement == 'required' && $required_position != 'required' ) || $required_sign == 'true' ? '' : '&nbsp;'.$required_word;

$required_subject_label = $required_sign == 'true' ? '<span class="'.$required_subject.'">'.$required_subject_sign.'</span>' : '<span class="word '.$required_subject.'">'.$required_subject_word.'</span>';






$message_label = ! empty( $form_attributes['message_label'] ) ? stripslashes(esc_attr($form_attributes['message_label'])) : esc_attr__( 'Message', 'simpleform' );
$required_message_sign = ! isset($error_class['message']) && ! isset($error_class['message_invalid']) && ! empty(esc_attr($data['message'])) || $required_sign != 'true' ? '' : '&lowast;';

$required_message_word = ( ! isset($error_class['message']) && ! isset($error_class['message_invalid']) && ! empty(esc_attr($data['message']))) || ( $required_sign != 'true' && $required_position != 'required' ) || $required_sign == 'true' ? '' : '&nbsp;'.$required_word;

$required_message_label = $required_sign == 'true' ? '<span>'.$required_message_sign.'</span>' : '<span class="word">'.$required_message_word.'</span>';



$email_field_label = $form_attributes['email_spotlight'] == 'hidden' ? '' : '<label for="sform_email">'.$email_label.$required_email_label.'</label>';
$subject_field_label = $form_attributes['subject_spotlight'] == 'hidden' ? '' : '<label for="sform_subject">'.$subject_label.$required_subject_label.'</label>';
$message_field_label = $form_attributes['message_spotlight'] == 'hidden' ? '' : '<label for="sform_message">'.$message_label.$required_message_label.'</label>';





$terms_field = ! empty( $form_attributes['terms_field'] ) ? esc_attr($form_attributes['terms_field']) : 'visible';
$checkbox_requirement = ! empty( $form_attributes['terms_requirement'] ) ? esc_attr($form_attributes['terms_requirement']) : 'required'; 
$required_terms = $checkbox_requirement == 'required' ? '' : 'd-none';
$checkbox_value = ! empty(esc_attr($data['terms'])) ? esc_attr($data['terms']) : 'false';
$required_terms_sign = (! isset($error_class['terms']) && esc_attr($data['terms']) == 'true') || $required_sign != 'true' || $checkbox_requirement != 'required' ? '' : '&lowast;';

$required_terms_label = '<span class="'.$required_terms.'">'.$required_terms_sign.'</span>';

 


$terms_label = ! empty( $form_attributes['terms_label'] ) ? stripslashes(wp_kses_post($form_attributes['terms_label'])) : esc_attr__( 'I have read and agree to the Privacy Policy', 'simpleform' );
$captcha_label = ! empty( $form_attributes['captcha_label'] ) ? stripslashes(esc_attr($form_attributes['captcha_label'])) : esc_attr__( 'What does this equal to?', 'simpleform' );
$captcha_one = $captcha_field != 'hidden' && $data['captcha_one'] != '' ? esc_attr($data['captcha_one']) : esc_attr( $math_one );
$captcha_two = $captcha_field != 'hidden' && $data['captcha_two'] != '' ? esc_attr($data['captcha_two']) : esc_attr( $math_two );
$captcha_hidden = '<input id="captcha_one" type="hidden" name="captcha_one" value="'.$captcha_one .'"/><input id="captcha_two" type="hidden" name="captcha_two" value="'. $captcha_two .'"/>';
$captcha_question = $captcha_one . '&nbsp;&nbsp;+&nbsp;&nbsp;' . $captcha_two.'&nbsp;&nbsp;=';
$required_captcha_sign = (! isset($error_class['captcha']) && ! empty(esc_attr($data['captcha']))) || $required_sign != 'true' ? '' : '&lowast;';

$required_captcha_label = '<span>'.$required_captcha_sign.'</span>';

$submit_label = ! empty($form_attributes['submit_label'] ) ? stripslashes(esc_attr($form_attributes['submit_label'])) : esc_attr__( 'Submit', 'simpleform' );
$name_length = ! empty( $sform_settings['name_length'] ) ? esc_attr($sform_settings['name_length']) : '2';
$error_name_label = ! empty( $sform_settings['firstname_error_message'] ) ? stripslashes(esc_attr($sform_settings['firstname_error_message'])) : esc_attr__( 'Please enter at least 2 characters', 'simpleform' );
$name_regex = ! empty( $sform_settings['firstname_regex'] ) ? $sform_settings['firstname_regex'] : '/^[^0-9\"\/:!?\#$%&()_=+*{}\[\];|<\@>]+$/';
$error_invalid_name_label = ! empty( $sform_settings['invalid_name_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_name_error'])) : esc_attr__( 'The name contains characters that are not allowed', 'simpleform' );
$subject_length = ! empty( $sform_settings['subject_length'] ) ? esc_attr($sform_settings['subject_length']) : '10';
$error_subject_label = ! empty( $sform_settings['subject_error_message'] ) ? stripslashes(esc_attr($sform_settings['subject_error_message'])) : esc_attr__( 'Please enter a subject at least 10 characters long', 'simpleform' );
$subject_regex = ! empty( $sform_settings['subject_regex'] ) ? $sform_settings['subject_regex'] : '/^[^\"\/\#$%&()_=+*{}\[\];|<\@>]+$/';
$error_invalid_subject_label = ! empty( $sform_settings['invalid_subject_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_subject_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$message_length = ! empty( $sform_settings['message_length'] ) ? esc_attr($sform_settings['message_length']) : '10';
$message_regex = ! empty( $sform_settings['message_regex'] ) ? $sform_settings['message_regex'] : '/^[^\$%&=+*{}|<>]+$/';
$error_message_label = ! empty( $sform_settings['object_error_message'] ) ? stripslashes(esc_attr($sform_settings['object_error_message'])) : esc_attr__( 'Please enter a message at least 10 characters long', 'simpleform' );
$error_invalid_message_label = ! empty( $sform_settings['invalid_message_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_message_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$confirmation_img = SIMPLEFORM_URL . 'public/img/confirmation.png';
$thank_string1 = esc_html__( 'We have received your request!', 'simpleform' );
$thank_string2 = esc_html__( 'Your message will be reviewed soon, and we’ll get back to you as quickly as possible.', 'simpleform' );
$thank_you_message = ! empty( $sform_settings['success_message'] ) ? stripslashes(wp_kses_post($sform_settings['success_message'])) : '<div class="form confirmation"><h4>' . $thank_string1 . '</h4><br>' . $thank_string2 . '</br><img src="'.$confirmation_img.'" alt="message received"></div>';
$blocking_error = ! empty( $sform_settings['blocking-error'] ) ? stripslashes(esc_attr($sform_settings['blocking-error'])) : esc_attr__( 'We are unable to process your request at this time. Please try again later!', 'simpleform' );
$error_name_label = ! empty( $sform_settings['firstname_error_message'] ) ? stripslashes(esc_attr($sform_settings['firstname_error_message'])) : esc_attr__( 'Please enter at least 2 characters', 'simpleform' );
$error_invalid_name_label = ! empty( $sform_settings['invalid_name_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_name_error'])) : esc_attr__( 'The name contains characters that are not allowed', 'simpleform' );
$error_email_label = ! empty( $sform_settings['email_error_message'] ) ? stripslashes(esc_attr($sform_settings['email_error_message'])) : esc_attr__( 'Please enter a valid email address', 'simpleform' );
$error_subject_label = ! empty( $sform_settings['subject_error_message'] ) ? stripslashes(esc_attr($sform_settings['subject_error_message'])) : esc_attr__( 'Please enter a subject at least 10 characters long', 'simpleform' );
$error_invalid_subject_label = ! empty( $sform_settings['invalid_subject_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_subject_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$error_message_label = ! empty( $sform_settings['object_error_message'] ) ? stripslashes(esc_attr($sform_settings['object_error_message'])) : esc_attr__( 'Please enter a message at least 10 characters long', 'simpleform' );
$error_invalid_message_label = ! empty( $sform_settings['invalid_message_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_message_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$error_captcha_label = ! empty( $sform_settings['captcha_error_message'] ) ? stripslashes(esc_attr($sform_settings['captcha_error_message'])) : esc_attr__( 'Please enter a valid captcha value', 'simpleform' );
$name_error = ! empty( $sform_settings['name_error'] ) ? stripslashes(esc_attr($sform_settings['name_error'])) : esc_attr__( 'Error occurred validating the name', 'simpleform' );
$email_error = ! empty( $sform_settings['email_error'] ) ? stripslashes(esc_attr($sform_settings['email_error'])) : esc_attr__( 'Error occurred validating the email', 'simpleform' );
$subject_error = ! empty( $sform_settings['subject_error'] ) ? stripslashes(esc_attr($sform_settings['subject_error'])) : esc_attr__( 'Error occurred validating the subject', 'simpleform' );
$message_error = ! empty( $sform_settings['message_error'] ) ? stripslashes(esc_attr($sform_settings['message_error'])) : esc_attr__( 'Error occurred validating the message', 'simpleform' );
$terms_error_message = ! empty( $sform_settings['terms_error'] ) ? stripslashes(esc_attr($sform_settings['terms_error'])) : esc_attr__( 'Please accept our terms and conditions before submitting form', 'simpleform' );
$captcha_error = ! empty( $sform_settings['captcha_error'] ) ? stripslashes(esc_attr($sform_settings['captcha_error'])) : esc_attr__( 'Error occurred validating the captcha', 'simpleform' );
$honeypot_error = ! empty( $sform_settings['honeypot_error'] ) ? stripslashes(esc_attr($sform_settings['honeypot_error'])) : esc_attr__( 'Error occurred during processing data', 'simpleform' );
$server_error_message = ! empty( $sform_settings['server_error_message'] ) ? stripslashes(esc_attr($sform_settings['server_error_message'])) : esc_attr__( 'Error occurred during processing data. Please try again!', 'simpleform' );
$empty_fields_message = __('Mandatory fields must be filled in', 'simpleform' ); 
$empty_name_error = ! empty( $sform_settings['empty_name_error'] ) ? stripslashes(esc_attr($sform_settings['empty_name_error'])) : esc_attr__( 'Please provide your name', 'simpleform' );
$empty_email_label = ! empty( $sform_settings['empty_email_error'] ) ? stripslashes(esc_attr($sform_settings['empty_email_error'])) : esc_attr__( 'Please provide your email address', 'simpleform' );
$empty_subject_error = ! empty( $sform_settings['empty_subject_error'] ) ? stripslashes(esc_attr($sform_settings['empty_subject_error'])) : esc_attr__( 'Please enter request subject', 'simpleform' );
$empty_message_error = ! empty( $sform_settings['empty_message_error'] ) ? stripslashes(esc_attr($sform_settings['empty_message_error'])) : esc_attr__( 'Please enter a message', 'simpleform' );
$empty_captcha_error = ! empty( $sform_settings['empty_captcha_error'] ) ? stripslashes(esc_attr($sform_settings['empty_captcha_error'])) : esc_attr__( 'Please enter a captcha value', 'simpleform' );
$name_class = isset($error_class['name']) || isset($error_class['name_invalid']) ? 'is-invalid' : '';
$name_attribute = $name_requirement == 'required' ? 'required' : '';
$name_value = esc_attr($data['name']);
$name_field_error  = isset($error_class['name']) ? esc_attr($error_name_label) : '';
$name_field_error .= isset($error_class['name_invalid']) ? esc_attr($error_invalid_name_label) : '';
$name_field_error .= !isset($error_class['name']) && !isset($error_class['name_invalid']) ? $empty_name_error : '';
$email_class = isset($error_class['email']) ? 'is-invalid' : '';
$email_attribute = $email_requirement == 'required' ? 'required' : '';
$email_value = esc_attr($data['email']);
$email_field_error = isset($error_class['email']) ? esc_attr($error_email_label) : '';
$email_field_error .= !isset($error_class['email']) ? $empty_email_label : '';
$subject_class = isset($error_class['subject']) || isset($error_class['subject_invalid']) ? 'is-invalid' : '';
$subject_attribute = $subject_requirement == 'required' ? 'required' : '';
$subject_value = esc_attr($data['subject']);
$subject_field_error  = isset($error_class['subject']) ? esc_attr($error_subject_label) : '';
$subject_field_error .= isset($error_class['subject_invalid']) ? esc_attr($error_invalid_subject_label) : '';
$subject_field_error .= !isset($error_class['subject']) && !isset($error_class['subject_invalid']) ? $empty_subject_error : '';
$message_class = isset($error_class['message']) || isset($error_class['message_invalid']) ? 'is-invalid' : '';
$message_value = esc_textarea($data['message']);
$message_field_error  = isset($error_class['message']) ? esc_attr($error_message_label) : '';
$message_field_error .= isset($error_class['message_invalid']) ? esc_attr($error_invalid_message_label) : '';
$message_field_error  .= !isset($error_class['message']) && !isset($error_class['message_invalid']) ? $empty_message_error : '';
$terms_class = isset($error_class['terms']) ? 'is-invalid' : '';
$terms_attribute = checked($checkbox_value, "true", false);
$captcha_class = isset($error_class['captcha']) ? 'is-invalid' : '';
$captcha_attribute = ' min="11" max="108" data-maxlength="3" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required';
$captcha_value = esc_attr($data['captcha']);
$captcha_error_class = isset($error_class['captcha']) ? 'd-block' : '';
$captcha_field_error = isset($error_class['captcha']) ? esc_attr($error_captcha_label) : '';
$captcha_field_error .= !isset($error_class['captcha']) ? $empty_captcha_error : '';
$error_class = ! isset($error_class) ? '' : $error_class; 
$alert_class = ! empty($error_class) ? 'visible' : '';
$error_fields_message = (isset($error_class['name']) || isset($error_class['name_invalid']) ? $name_error : '').''.(isset($error_class['email']) ? $email_error : '').''.(isset($error_class['subject']) || isset($error_class['subject_invalid']) ? $subject_error : '').''.(isset($error_class['message']) || isset($error_class['message_invalid']) ? $message_error : '').''.(isset($error_class['terms']) ? $terms_error_message : '').''.(isset($error_class['captcha']) ? $captcha_error : '').''.(isset($error_class['form_honeypot']) ? $honeypot_error : '').''.(isset($error_class['server_error']) ? $server_error_message : '');
$error_fields_message .= empty($error_class) ? $empty_fields_message : '';
$error_script = ! empty($error_class) ? '<script type="text/javascript">jQuery(document).ready(function ($) { setTimeout(function(){ $(".message").focus(); }, 200); });</script>' : '';