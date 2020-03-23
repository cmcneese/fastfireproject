<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customitation guidelines:
 * After your modifications are done, you can change style using your personal stylesheet file by enabling the option in the settings page. 
 * Following class selectors cannot be removed: d-none, form-control, error-des, control-label, message. 
**/

// Text above Contact Form   
$form = '<div id="sform-introduction"><p>'.$introduction_text.'</p></div>';

// Confirmation message after ajax submission
$form .= '<div id="sform-confirmation"></div>';

// Contact Form starts here:
$form .= '<form id="sform" method="post">';

// First honeypot field
$form .= '<div class="d-none"><label for="name">Username</label><input type="text" name="username" value="" /></div>';

// Name field
if ( $name_field == 'visible' || $name_field == 'registered' && is_user_logged_in() || $name_field == 'anonymous' && ! is_user_logged_in() ) { 
$form .= '<div class="field-group">'.$name_field_label.'<input type="text" id="sform_name" name="sform_name" class="form-control '.$name_class.'" value="'.$name_value.'" placeholder="'.$name_placeholder.'" '.$name_attribute.'><div id="name-error" class="error-des"><span>'.$name_field_error.'</span></div></div>'; 
}

// Email field	     		
if ( $email_field == 'visible' || $email_field == 'registered' && is_user_logged_in() || $email_field == 'anonymous' && ! is_user_logged_in() ) { 
$form .= '<div class="field-group">'.$email_field_label.'<input type="email" name="sform_email" id="sform_email" class="form-control '.$email_class.'" value="'.$email_value.'" placeholder="'.$email_placeholder.'" '.$email_attribute.' ><div id="email-error" class="error-des"><span>'.$email_field_error.'</span></div></div>';
}

// Subject field
if ( $subject_field == 'visible' || $subject_field == 'registered' && is_user_logged_in() || $subject_field == 'anonymous' && ! is_user_logged_in() ) { 
$form .= '<div class="field-group">'.$subject_field_label.'<input type="text" name="sform_subject" id="sform_subject" class="form-control '.$subject_class.'" '.$subject_attribute.' value="'.$subject_value.'" placeholder="'.$subject_placeholder.'" ><div id="subject-error" class="error-des"><span>'.$subject_field_error.'</span></div></div>';
}

// Message field
$form .= '<div class="field-group">'.$message_field_label.'<textarea name="sform_message" id="sform_message" rows="10" type="textarea" class="form-control '.$message_class.'" required minlength="10" placeholder="'.$message_placeholder.'">'.$message_value.'</textarea><div id="message-error" class="error-des"><span>'.$message_field_error.'</span></div></div>';

// Terms field
if ( $terms_field == 'visible' || $terms_field == 'registered' && is_user_logged_in() || $terms_field == 'anonymous' && ! is_user_logged_in() ) { 
$form .= '<div id="terms" class="form-group"><label class="switch"><input type="checkbox" name="sform_privacy" id="sform_privacy" class="'.$terms_class.'" value="'.$checkbox_value.'" '.$terms_attribute.'><span class="slider round"></span></label><label for="sform_privacy" class="control-label '.$terms_class.'">'.$terms_label.'<span class="'.$required_terms.'">'.$required_terms_sign.'</span></label></div>';

}

// Second honeypot field
$form .= '<div class="d-none"><label for="telephone">Telephone</label><input type="text" name="telephone" value="" /></div>';

// Captcha field
if ( $captcha_field == 'visible' || $captcha_field == 'registered' && is_user_logged_in() || $captcha_field == 'anonymous' && ! is_user_logged_in() ) { 
$form .= '<div class="field-group" id="captcha-container"><label for="sform_captcha">'.$captcha_label.'<span>'.$required_captcha_sign.'</span></label><div id="captcha-question-wrap" class="'.$captcha_class.'">'.$captcha_hidden.'<input id="captcha-question" type="text" class="form-control" readonly="readonly" tabindex="-1" value="'.$captcha_question.'" /><input type="number" id="sform_captcha" name="sform_captcha" class="form-control '.$captcha_class.'" '.$captcha_attribute.' value="'.$captcha_value.'" /></div><div id="captcha-error" class="error-des"><span class="'.$captcha_error_class.'">'.$captcha_field_error.'</span></div></div>';
}

// Contact Form error message
$form .= '<div id="sform-message"><span tabindex="-1" class="message '.$alert_class.'">'.$error_fields_message.'</span>'.$error_script.'</div>';

// Security hidden fields
$form .= '<div class="d-none">'.$nonce.'</div>'; 

// Submit field
$form .= '<div id="sform-submit-wrap"><button name="submission" id="submission" type="submit" class="btn btn-outline-secondary rounded-pill">'.$submit_label.'</button></div></form>'; 

// Text below Contact Form
$form .= '<div id="sform-bottom"><p>'.$bottom_text.'</p></div>';

// Switch from displaying contact form to displaying success message if ajax submission is disabled
$contact_form = isset( $_GET['sending'] ) && $_GET['sending'] == 'success' ? $thank_you_message : $form;