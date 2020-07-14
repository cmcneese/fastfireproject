<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customitation guidelines:
 * After your modifications are done, you can change style using your personal stylesheet file by enabling the option in the settings page. 
 * Following class selectors cannot be removed: d-none, form-control, error-des, control-label, message. 
**/

// Text above Contact Form   
$form = '<div id="sform-introduction" class="'.$class_direction.'"><p>'.$introduction_text.'</p></div>';

// Confirmation message after ajax submission
$form .= '<div id="sform-confirmation"></div>';

// Contact Form starts here:
$form .= '<form id="sform" method="post" '.$form_attribute.' class="'.$form_class.'">';

// Name field
$firstname_input = $firstname_field == 'visible' || $firstname_field == 'registered' && is_user_logged_in() || $firstname_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group firstname '.$name_row_class.'">'.$firstname_field_label.'<div class="'.$wrap_class.'"><input type="text" id="sform_name" name="sform_name" class="form-control '.$firstname_class.'" value="'.$firstname_value.'" placeholder="'.$firstname_placeholder.'" '.$firstname_attribute.'><div id="name-error" class="error-des"><span>'.$firstname_field_error.'</span></div></div></div>' : '';

// Lastname field
$lastname_input = $lastname_field == 'visible' || $lastname_field == 'registered' && is_user_logged_in() || $lastname_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group lastname '.$name_row_class.'">'.$lastname_field_label.'<div class="'.$wrap_class.'"><input type="text" id="sform_lastname" name="sform_lastname" class="form-control '.$lastname_class.'" value="'.$lastname_value.'" placeholder="'.$lastname_placeholder.'" '.$lastname_attribute.'><div id="lastname-error" class="error-des"><span>'.$lastname_field_error.'</span></div></div></div>': ''; 

// Email field	     		
$email_input = $email_field == 'visible' || $email_field == 'registered' && is_user_logged_in() || $email_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group email '.$email_row_class.'">'.$email_field_label.'<div class="'.$wrap_class.'"><input type="email" name="sform_email" id="sform_email" class="form-control '.$email_class.'" value="'.$email_value.'" placeholder="'.$email_placeholder.'" '.$email_attribute.' ><div id="email-error" class="error-des"><span>'.$email_field_error.'</span></div></div></div>' : '';

// Phone field
$phone_input = $phone_field == 'visible' || $phone_field == 'registered' && is_user_logged_in() || $phone_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group phone '.$email_row_class.'">'.$phone_field_label.'<div class="'.$wrap_class.'"><input type="tel" id="sform_phone" name="sform_phone" class="form-control '.$phone_class.'" value="'.$phone_value.'" placeholder="'.$phone_placeholder.'" '.$phone_attribute.'><div id="phone-error" class="error-des"><span>'.$phone_field_error.'</span></div></div></div>' : ''; 

// Subject field
$subject_input = $subject_field == 'visible' || $subject_field == 'registered' && is_user_logged_in() || $subject_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group '.$row_label.'">'.$subject_field_label.'<div class="'.$wrap_class.'"><input type="text" name="sform_subject" id="sform_subject" class="form-control '.$subject_class.'" '.$subject_attribute.' value="'.$subject_value.'" placeholder="'.$subject_placeholder.'" ><div id="subject-error" class="error-des"><span>'.$subject_field_error.'</span></div></div></div>' : '';

// Message field
$message_input = '<div class="field-group '.$row_label.'">'.$message_field_label.'<div class="'.$wrap_class.'"><textarea name="sform_message" id="sform_message" rows="10" type="textarea" class="form-control '.$message_class.'" required '.$message_maxlength.' placeholder="'.$message_placeholder.'">'.$message_value.'</textarea><div id="message-error" class="error-des"><span>'.$message_field_error.'</span></div></div></div>';

// Terms field
$terms_input = $terms_field == 'visible' || $terms_field == 'registered' && is_user_logged_in() || $terms_field == 'anonymous' && ! is_user_logged_in() ? '<div id="terms" class="form-group '.$inline_class.'"><label class="switch"><input type="checkbox" name="sform_privacy" id="sform_privacy" class="'.$terms_class.'" value="'.$checkbox_value.'" '.$terms_attribute.'><span class="slider round"></span></label><label for="sform_privacy" class="control-label '.$terms_class.'">'.$terms_label.'<span class="'.$required_terms.'">'.$required_terms_sign.'</span></label></div>' : '';

// Captcha field
$captcha_input = $captcha_field == 'visible' || $captcha_field == 'registered' && is_user_logged_in() || $captcha_field == 'anonymous' && ! is_user_logged_in() ? '<div class="field-group '.$row_label.'" id="captcha-container"><label for="sform_captcha" '.$label_class.'>'.$captcha_label.'<span>'.$required_captcha_sign.'</span></label><div id="captcha-question-wrap" class="'.$captcha_class.'">'.$captcha_hidden.'<input id="captcha-question" type="text" class="form-control" readonly="readonly" tabindex="-1" value="'.$captcha_question.'" /><input type="number" id="sform_captcha" name="sform_captcha" class="form-control '.$captcha_class.'" '.$captcha_attribute.' value="'.$captcha_value.'" /></div><div id="captcha-error" class="error-des"><span class="'.$captcha_error_class.'">'.$captcha_field_error.'</span></div></div>' : '';

// Form fields assembling
$form .= $firstname_input . $lastname_input . $email_input . $phone_input . $subject_input . $message_input . $terms_input . $captcha_input . $hidden_fields;

// Contact Form error message
$form .= '<div id="sform-message" class="'.$wrap_class.'"><span tabindex="-1" class="message '.$alert_class.'">'.$error_fields_message.'</span>'.$error_script.$noscript.'</div>';

// Submit field
$form .= '<div id="sform-submit-wrap" class="'.$wrap_class.'"><button name="submission" id="submission" type="submit" class="btn btn-outline-secondary rounded-pill">'.$submit_label.'</button></div></form>'; 

// Text below Contact Form
$form .= '<div id="sform-bottom" class="'.$class_direction.'"><p>'.$bottom_text.'</p></div>';

// Switch from displaying contact form to displaying success message if ajax submission is disabled
$contact_form = isset( $_GET['sending'] ) && $_GET['sending'] == 'success' ? $thank_you_message : $form;