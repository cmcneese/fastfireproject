<?php

if ( ! defined( 'WPINC' ) ) die;
$sform_settings = get_option('sform-settings'); 
?>
	    
<div class="wrap"><h1 class="<?php if(has_action('load_submissions_table_options')) { echo 'backend2'; } else { echo 'backend'; } ?>"><span class="dashicons dashicons-admin-settings"></span><?php esc_html_e( 'Settings', 'simpleform' ); ?></h1><div id="settings-description"><?php esc_html_e( 'Customize messages and whatever settings you want to better match your needs:','simpleform') ?></div>

<h2 class="nav-tab-wrapper"><a class="nav-tab nav-tab-active" id="general"><?php esc_html_e( 'General','simpleform') ?></a><a class="nav-tab" id="messages"><?php esc_html_e( 'Messages','simpleform') ?></a><a class="nav-tab" id="email"><?php esc_html_e( 'Emails','simpleform') ?></a></h2>
						
<form id="settings" method="post">
<div id="tab-general" class="settings-tab">

<?php
$smtp_configuration = ! empty( $sform_settings['smtp-configuration'] ) ? esc_attr($sform_settings['smtp-configuration']) : 'false';	
$html5_validation = ! empty( $sform_settings['html5-validation'] ) ? esc_attr($sform_settings['html5-validation']) : 'false';
$focus = ! empty( $sform_settings['focus'] ) ? esc_attr($sform_settings['focus']) : 'field';
$ajax_submission = ! empty( $sform_settings['ajax-submission'] ) ? esc_attr($sform_settings['ajax-submission']) : 'false';	
$form_template = ! empty( $sform_settings['form-template'] ) ? esc_attr($sform_settings['form-template']) : 'default'; 

switch ($form_template) {
  case 'basic':
  case 'rounded':
    $template_notes = "&nbsp;";
    break;
  case 'customized':
    $template_notes = esc_attr__('Create a directory inside your active theme’s directory, name it simpleform, copy one of the template files and name it custom-template.php', 'simpleform' );
    break;
    default:
    $template_notes = "&nbsp;";
}

$stylesheet = ! empty( $sform_settings['stylesheet'] ) ? esc_attr($sform_settings['stylesheet']) : 'false';
$cssfile  = ! empty( $sform_settings['stylesheet-file'] ) ? esc_attr($sform_settings['stylesheet-file']) : 'false';
$javascript = ! empty( $sform_settings['javascript'] ) ? esc_attr($sform_settings['javascript']) : 'false';
$uninstall = ! empty( $sform_settings['deletion-all-data'] ) ? esc_attr($sform_settings['deletion-all-data']) : 'true'; 
?>		
	
<table class="form-table"><tbody>
	
<?php
$extra_option = '';
echo apply_filters( 'submissions_settings_filter', $extra_option );
?>

<tr><th class="heading" colspan="2"><span><?php esc_html_e( 'Form Submission Options','simpleform') ?></span></th></tr>	

<tr><th class="first option"><span><?php esc_html_e('SMTP Server Configuration', 'simpleform' ) ?></span></th><td class="first checkbox"><label for="smtp-configuration"><input name="smtp-configuration" type="checkbox" class="sform" id="smtp-configuration" value="false" <?php checked( $smtp_configuration, 'true'); ?> ><?php esc_html_e('Hide the SMTP Server Configuration section in the Emails tab if you do not want to use it','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Ajax Submission','simpleform') ?></span></th><td class="checkbox"><label for="ajax-submission"><input type="checkbox" class="sform" name="ajax-submission" id="ajax-submission" value="true" <?php checked( $ajax_submission, 'true'); ?> ><?php esc_html_e('Perform form submission via AJAX instead of a standard HTML request','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('HTML5 Browser Validation', 'simpleform' ) ?></span></th><td class="checkbox"><label for="html5-validation"><input name="html5-validation" type="checkbox" class="sform" id="html5-validation" value="false" <?php checked( $html5_validation, 'true'); ?> ><?php esc_html_e('Disable the browser default form validation','simpleform') ?></label></td></tr>

<tr><th class="option"><span style="cursor: default"><?php esc_html_e( 'Focus on Form Errors', 'simpleform' ) ?></span></th><td class="last radio"><fieldset><label for="field"><input id="field" type="radio" name="focus" value="field" <?php checked( $focus, 'field'); ?> ><?php esc_html_e( 'Set focus to first invalid field', 'simpleform' ) ?></label><label for="alert"><input id="alert" type="radio" name="focus" value="alert" <?php checked( $focus, 'alert'); ?> ><?php esc_html_e( 'Set focus to message below the form', 'simpleform' ) ?></label></fieldset></td></tr>

<tr><th class="heading" colspan="2"><span><?php esc_html_e('Customization Options', 'simpleform' ) ?></span></th></tr>
		
<tr><th class="first option"><span><?php esc_html_e('Form Template','simpleform') ?></span></th><td class="first select notes"><select name="form-template" id="form-template" class="sform"><option value="default" <?php selected( $form_template, 'default'); ?>><?php esc_html_e('Default','simpleform') ?></option><option value="basic" <?php selected( $form_template, 'basic'); ?>><?php esc_html_e('Bootstrap Style','simpleform') ?></option><option value="rounded" <?php selected( $form_template, 'rounded'); ?>><?php esc_html_e('Rounded Bootstrap Style','simpleform') ?></option><option value="customized" <?php selected( $form_template, 'customized'); ?>><?php esc_html_e('Customized','simpleform') ?></option></select><p id="template-notice" class="description"><?php echo $template_notes ?></p></td></tr>

<tr><th class="option"><span><?php esc_html_e( 'Form CSS Stylesheet', 'simpleform' ) ?></span></th><td class="checkbox"><label for="stylesheet"><input id="stylesheet" name="stylesheet" type="checkbox" class="sform" value="true" <?php checked( $stylesheet, 'true'); ?> ><?php esc_html_e( 'Disable SimpleForm CSS stylesheet and use your own CSS stylesheet', 'simpleform' ); ?></label></td></tr>

<tr class="trstylesheet <?php if ($stylesheet !='true') { echo 'unseen'; } ?>"><th class="option"><span><?php esc_html_e( 'CSS Stylesheet File', 'simpleform' ) ?></span></th><td class="checkbox notes"><label for="stylesheet-file"><input id="stylesheet-file" name="stylesheet-file" type="checkbox" class="sform" value="" <?php checked( $cssfile, 'true'); ?> ><?php esc_html_e( 'Include custom CSS code into a separate file', 'simpleform' ); ?></label><p id="stylesheet-description" class="description"><?php if ($cssfile !='true') { esc_html_e('Keep unchecked if you want to use custom CSS code and include it somewhere in your theme’s code without using an additional file', 'simpleform' ); } else { esc_html_e('Create a directory inside your active theme’s directory, name it simpleform, add your CSS stylesheet file and name it custom-style.css', 'simpleform' ); } ?></p></td></tr>

<tr><th class="option"><span><?php esc_html_e( 'Custom JavaScript Code', 'simpleform' ) ?></span></th><td class="last checkbox notes"><label for="javascript"><input id="javascript" name="javascript" type="checkbox" class="sform" value="" <?php checked( $javascript, 'true'); ?> ><?php esc_html_e( 'Add your custom JavaScript code to your form', 'simpleform' ); ?></label><p id="javascript-description" class="description"><?php if ($javascript !='true') { esc_html_e('Keep unchecked if you want to use custom JavaScript code and include it somewhere in your theme’s code without using an additional file', 'simpleform' ); } else { esc_html_e('Create a directory inside your active theme’s directory, name it simpleform, add your JavaScript file and name it custom-script.js', 'simpleform' ); } ?></p></td></tr>

<tr><th class="heading" colspan="2"><span><?php esc_html_e( 'Uninstall Options','simpleform') ?></span></th></tr>	

<tr><th class="option first"><span><?php esc_html_e('Uninstall', 'simpleform' ) ?></span></th><td class="wide checkbox"><label for="deletion-all-data"><input name="deletion-all-data" type="checkbox" class="sform" id="deletion-all-data" value="false" <?php checked( $uninstall, 'true'); ?> ><?php esc_html_e( 'Delete all data and settings when the plugin is uninstalled', 'simpleform' ) ?></label></td></tr>

</tbody></table>
</div>

<div id="tab-messages" class="settings-tab unseen">
		
<?php
$empty_fields_message = ! empty( $sform_settings['empty_fields_message'] ) ? stripslashes(esc_attr($sform_settings['empty_fields_message'])) : esc_attr__( 'There were some errors that need to be fixed', 'simpleform' );
$characters_length = ! empty( $sform_settings['characters_length'] ) ? esc_attr($sform_settings['characters_length']) : 'true';
$form_attributes = get_option('sform-attributes');
$firstname_field = ! empty( $form_attributes['firstname_field'] ) ? esc_attr($form_attributes['firstname_field']) : 'visible';
$lastname_field = ! empty( $form_attributes['lastname_field'] ) ? esc_attr($form_attributes['lastname_field']) : 'hidden';
$required_name = ! empty( $form_attributes['firstname_requirement'] ) ? esc_attr($form_attributes['firstname_requirement']) : 'required';
$required_lastname = ! empty( $form_attributes['lastname_requirement'] ) ? esc_attr($form_attributes['lastname_requirement']) : 'optional';
$required_email = ! empty( $form_attributes['email_requirement'] ) ? esc_attr($form_attributes['email_requirement']) : 'required';
$required_phone = ! empty( $form_attributes['phone_requirement'] ) ? esc_attr($form_attributes['phone_requirement']) : 'optional';
$required_subject = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'required';
$email_field = ! empty( $form_attributes['email_field'] ) ? esc_attr($form_attributes['email_field']) : 'visible';
$phone_field = ! empty( $form_attributes['phone_field'] ) ? esc_attr($form_attributes['phone_field']) : 'hidden';
$subject_field = ! empty( $form_attributes['subject_field'] ) ? esc_attr($form_attributes['subject_field']) : 'visible';
$terms_field = ! empty( $form_attributes['terms_field'] ) ? esc_attr($form_attributes['terms_field']) : 'visible';
$captcha_field = ! empty( $form_attributes['captcha_field'] ) ? esc_attr($form_attributes['captcha_field']) : 'hidden';  
$empty_name_error = isset( $form_attributes['empty_name_error'] ) ? esc_attr($form_attributes['empty_name_error']) : esc_attr__( 'Please provide your name', 'simpleform' );
$empty_lastname_error = isset( $form_attributes['empty_lastname_error'] ) ? esc_attr($form_attributes['empty_lastname_error']) : esc_attr__( 'Please provide your lastname', 'simpleform' );
$empty_email_error = ! empty( $sform_settings['empty_email_error'] ) ? stripslashes(esc_attr($sform_settings['empty_email_error'])) : esc_attr__( 'Please provide your email address', 'simpleform' );
$empty_phone_error = ! empty( $sform_settings['empty_phone_error'] ) ? stripslashes(esc_attr($sform_settings['empty_phone_error'])) : esc_attr__( 'Please provide your phone number', 'simpleform' );
$empty_subject_error = ! empty( $sform_settings['empty_subject_error'] ) ? stripslashes(esc_attr($sform_settings['empty_subject_error'])) : esc_attr__( 'Please enter request subject', 'simpleform' );
$empty_message_error = ! empty( $sform_settings['empty_message_error'] ) ? stripslashes(esc_attr($sform_settings['empty_message_error'])) : esc_attr__( 'Please enter your message', 'simpleform' );
$empty_captcha_error = ! empty( $sform_settings['empty_captcha_error'] ) ? stripslashes(esc_attr($sform_settings['empty_captcha_error'])) : esc_attr__( 'Please enter an answer', 'simpleform' );
$firstname_length = isset( $form_attributes['firstname_minlength'] ) ? esc_attr($form_attributes['firstname_minlength']) : '2';
$firstname_numeric_error = $characters_length == 'true' && ! empty( $sform_settings['firstname_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['firstname_error_message']) == $firstname_length ? stripslashes(esc_attr($sform_settings['firstname_error_message'])) : sprintf( __('Please enter at least %d characters', 'simpleform' ), $firstname_length );
$firstname_generic_error = $characters_length != 'true' && ! empty( $sform_settings['firstname_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['firstname_error_message']) == '' ? stripslashes(esc_attr($sform_settings['firstname_error_message'])) : esc_attr__('Please type your full name', 'simpleform' );
$firstname_error_message = $characters_length == 'true' ? $firstname_numeric_error : $firstname_generic_error;
$lastname_length = isset( $form_attributes['lastname_minlength'] ) ? esc_attr($form_attributes['lastname_minlength']) : '2';
$subject_length = isset( $form_attributes['subject_minlength'] ) ? esc_attr($form_attributes['subject_minlength']) : '5';
$message_length = isset( $form_attributes['message_minlength'] ) ? esc_attr($form_attributes['message_minlength']) : '10';
$invalid_firstname_error_message = ! empty( $sform_settings['invalid_name_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_name_error'])) : esc_attr__( 'The name contains not allowed characters', 'simpleform' );
$name_error = ! empty( $sform_settings['name_error'] ) ? stripslashes(esc_attr($sform_settings['name_error'])) : esc_attr__( 'Error occurred validating the name', 'simpleform' );
$lastname_numeric_error = $characters_length == 'true' && ! empty( $sform_settings['lastname_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['lastname_error_message']) == $lastname_length ? stripslashes(esc_attr($sform_settings['lastname_error_message'])) : sprintf( __('Please enter at least %d characters', 'simpleform' ), $lastname_length );
$lastname_generic_error = $characters_length != 'true' && ! empty( $sform_settings['lastname_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['lastname_error_message']) == '' ? stripslashes(esc_attr($sform_settings['lastname_error_message'])) : esc_attr__('Please type your full lastname', 'simpleform' );
$lastname_error_message = $characters_length == 'true' ? $lastname_numeric_error : $lastname_generic_error;
$invalid_lastname_error_message = ! empty( $sform_settings['invalid_lastname_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_lastname_error'])) : esc_attr__( 'The lastname contains not allowed characters', 'simpleform' );
$lastname_error = ! empty( $sform_settings['lastname_error'] ) ? stripslashes(esc_attr($sform_settings['lastname_error'])) : esc_attr__( 'Error occurred validating the lastname', 'simpleform' );
$email_error_message = ! empty( $sform_settings['email_error_message'] ) ? stripslashes(esc_attr($sform_settings['email_error_message'])) : esc_attr__( 'Please enter a valid email', 'simpleform' );
$email_error = ! empty( $sform_settings['email_error'] ) ? stripslashes(esc_attr($sform_settings['email_error'])) : esc_attr__( 'Error occurred validating the email', 'simpleform' );
$phone_error_message = ! empty( $sform_settings['phone_error_message'] ) ? stripslashes(esc_attr($sform_settings['phone_error_message'])) : esc_attr__( 'The phone number contains not allowed characters', 'simpleform' );
$phone_error = ! empty( $sform_settings['phone_error'] ) ? stripslashes(esc_attr($sform_settings['phone_error'])) : esc_attr__( 'Error occurred validating the phone number', 'simpleform' );
$subject_numeric_error = $characters_length == 'true' && ! empty( $sform_settings['subject_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['subject_error_message']) == $subject_length ? stripslashes(esc_attr($sform_settings['subject_error_message'])) : sprintf( __('Please enter a subject at least %d characters long', 'simpleform' ), $subject_length );
$subject_generic_error = $characters_length != 'true' && ! empty( $sform_settings['subject_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['subject_error_message']) == '' ? stripslashes(esc_attr($sform_settings['subject_error_message'])) : esc_attr__('Please type a short and specific subject', 'simpleform' );
$subject_error_message = $characters_length == 'true' ? $subject_numeric_error : $subject_generic_error;
$invalid_subject_error_message = ! empty( $sform_settings['invalid_subject_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_subject_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$subject_error = ! empty( $sform_settings['subject_error'] ) ? stripslashes(esc_attr($sform_settings['subject_error'])) : esc_attr__( 'Error occurred validating the subject', 'simpleform' );
$message_numeric_error = $characters_length == 'true' && ! empty( $sform_settings['object_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['object_error_message']) == $message_length ? stripslashes(esc_attr($sform_settings['object_error_message'])) : sprintf( __('Please enter a message at least %d characters long', 'simpleform' ), $message_length );
$message_generic_error = $characters_length != 'true' && ! empty( $sform_settings['object_error_message'] ) && preg_replace('/[^0-9]/', '', $sform_settings['object_error_message']) == '' ? stripslashes(esc_attr($sform_settings['object_error_message'])) : esc_attr__('Please type a clearer message so we can respond appropriately', 'simpleform' );
$object_error_message = $characters_length == 'true' ? $message_numeric_error : $message_generic_error;
$invalid_object_error_message = ! empty( $sform_settings['invalid_message_error'] ) ? stripslashes(esc_attr($sform_settings['invalid_message_error'])) : esc_attr__( 'Enter only alphanumeric characters and punctuation marks', 'simpleform' );
$message_error = ! empty( $sform_settings['message_error'] ) ? stripslashes(esc_attr($sform_settings['message_error'])) : esc_attr__( 'Error occurred validating the message', 'simpleform' );
$terms_error_message = ! empty( $sform_settings['terms-error'] ) ? stripslashes(esc_attr($sform_settings['terms-error'])) : esc_attr__( 'Please accept our privacy policy before submitting form', 'simpleform' );
$captcha_error_message = ! empty( $sform_settings['captcha_error_message'] ) ? stripslashes(esc_attr($sform_settings['captcha_error_message'])) : esc_attr__( 'Please enter a valid captcha value', 'simpleform' );
$captcha_error = ! empty( $sform_settings['captcha_error'] ) ? stripslashes(esc_attr($sform_settings['captcha_error'])) : esc_attr__( 'Error occurred validating the captcha', 'simpleform' );
$honeypot_error = ! empty( $sform_settings['honeypot_error'] ) ? stripslashes(esc_attr($sform_settings['honeypot_error'])) : esc_attr__( 'Failed honeypot validation', 'simpleform' );
$server_error_message = ! empty( $sform_settings['server_error_message'] ) ? stripslashes(esc_attr($sform_settings['server_error_message'])) : esc_attr__( 'Error occurred during processing data. Please try again!', 'simpleform' );
$success_action = ! empty( $sform_settings['success_action'] ) ? esc_attr($sform_settings['success_action']) : 'message';
$confirmation_img = SIMPLEFORM_URL . 'public/img/confirmation.png';
$confirmation_page = ! empty( $sform_settings['confirmation_page'] ) ? esc_attr($sform_settings['confirmation_page']) : '';
$edit_post_link = '<a href="' . get_edit_post_link($confirmation_page) . '" target="_blank" style="text-decoration: none; color: #9ccc79;">' . __( 'Publish now','simpleform') . '</a>';	
$post_status = $confirmation_page != '' && get_post_status($confirmation_page) == 'draft' ? __( 'Page in draft status not yet published','simpleform').'&nbsp;-&nbsp;'.$edit_post_link : '&nbsp;';
$thank_string1 = esc_html__( 'We have received your request!', 'simpleform' );
$thank_string2 = esc_html__( 'Your message will be reviewed soon, and we’ll get back to you as quickly as possible.', 'simpleform' );
$thank_you_message = ! empty( $sform_settings['success_message'] ) ? stripslashes(esc_attr($sform_settings['success_message'])) : '<div class="form confirmation"><h4>' . $thank_string1 . '</h4><br>' . $thank_string2 . '</br><img src="'.$confirmation_img.'" alt="message received"></div>';
?>	

<table class="form-table"><tbody>
	
<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Fields Error Messages', 'simpleform' ) ?></span></th></tr>

<tr><th id="" class="first option"><span><?php esc_html_e('Multiple Fields Error','simpleform') ?></span></th><td id="" class="first text"><input class="sform" name="empty_fields_message" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of multiple empty fields','simpleform') ?>" id="empty_fields_message" type="text" value="<?php echo $empty_fields_message; ?>" \></td></tr>

<tr><th class="option"><span><?php esc_html_e('Length Error Message Type', 'simpleform' ) ?></span></th><td class="checkbox notes"><label for="characters_length"><input name="characters_length" type="checkbox" class="sform" id="characters_length" value="true" <?php checked( $characters_length, 'true'); ?> ><?php esc_html_e('Include the minimum number of required characters in length error message','simpleform') ?></label><p id="characters-description" class="description"><?php if ($characters_length =='true') { esc_html_e('Keep unchecked if you want to use generic error message without showing the minimum number of required characters', 'simpleform' ); } else { esc_html_e('Keep checked if you want to show the minimum number of required characters and you want to make sure that\'s exactly the number you setted for that specific field', 'simpleform' ); } ?></p></td></tr>

<tr class="<?php if ( $firstname_field =='hidden' || $required_name == 'optional' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Name Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_name_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty name field','simpleform') ?>" id="empty_name_error" type="text" value="<?php echo $empty_name_error; ?>" \></td></tr>

<tr class="<?php if ( $firstname_field =='hidden' || $firstname_length == 0) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Name Length Error','simpleform') ?></span></th><td class="text"><input class="sform" name="firstname_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of name not enough long','simpleform') ?>" id="firstname_error_message" type="text" value="<?php echo $firstname_error_message; ?>" \></td></tr>
        
<tr class="<?php if ( $firstname_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Name Error','simpleform') ?></span></th><td class="text"><input type="text" class="sform" id="invalid_name_error" name="invalid_name_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid name','simpleform') ?>" value="<?php echo $invalid_firstname_error_message; ?>" \></td></tr>

<tr class="<?php if ( $firstname_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Name Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="name_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in name field','simpleform') ?>" id="name_error" type="text" value="<?php echo $name_error; ?>" \></td></tr>

<tr class="<?php if ( $lastname_field =='hidden' || $required_lastname == 'optional' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Lastname Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_lastname_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty lastname field','simpleform') ?>" id="empty_lastname_error" type="text" value="<?php echo $empty_lastname_error; ?>" \></td></tr>
		
<tr class="<?php if ( $lastname_field =='hidden' || $lastname_length == 0) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Lastname Length Error','simpleform') ?></span></th><td id="td-name-error" class="text"><input class="sform" name="lastname_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of lastname not enough long','simpleform') ?>" id="lastname_error_message" type="text" value="<?php echo $lastname_error_message; ?>" \></td></tr>
        
<tr class="<?php if ( $lastname_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Lastname Error','simpleform') ?></span></th><td class="text"><input type="text" class="sform" id="invalid_lastname_error" name="invalid_lastname_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid lastname','simpleform') ?>" value="<?php echo $invalid_lastname_error_message; ?>" \></td></tr>

<tr class="<?php if ( $lastname_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Lastname Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="lastname_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in lastname field','simpleform') ?>" id="lastname_error" type="text" value="<?php echo $lastname_error; ?>" \></td></tr>

<tr class="<?php if ( $email_field =='hidden' || $required_email == 'optional' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Email Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_email_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty email field','simpleform') ?>" id="empty_email_error" type="text" value="<?php echo $empty_email_error; ?>" \></td></tr>

<tr class="<?php if ( $email_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Email Error','simpleform') ?></span></th><td class="text"><input class="sform" name="email_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid email','simpleform') ?>" id="email_error_message" type="text" value="<?php echo $email_error_message; ?>" \></td></tr>

<tr class="<?php if ( $email_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Email Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="email_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in email field','simpleform') ?>" id="email_error" type="text" value="<?php echo $email_error; ?>" \></td></tr>

<tr class="<?php if ( $phone_field =='hidden' || $required_phone == 'optional' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Phone Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_phone_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty phone field','simpleform') ?>" id="empty_phone_error" type="text" value="<?php echo $empty_phone_error; ?>" \></td></tr>

<tr class="<?php if ( $phone_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Phone Error','simpleform') ?></span></th><td class="text"><input class="sform" name="phone_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid phone number','simpleform') ?>" id="phone_error_message" type="text" value="<?php echo $phone_error_message; ?>" \></td></tr>

<tr class="<?php if ( $phone_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Phone Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="phone_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in phone field','simpleform') ?>" id="phone_error" type="text" value="<?php echo $phone_error; ?>" \></td></tr>

<tr class="<?php if ( $subject_field =='hidden' || $required_subject == 'optional') {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Subject Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_subject_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty subject field','simpleform') ?>" id="empty_subject_error" type="text" value="<?php echo $empty_subject_error; ?>" \></td></tr>

<tr class="<?php if ( $subject_field =='hidden' || $subject_length == 0) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Subject Length Error','simpleform') ?></span></th><td class="text"><input type="text" class="sform" id="subject_error_message" name="subject_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of subject not enough long','simpleform') ?>" value="<?php echo $subject_error_message; ?>" \></td></tr>

<tr class="<?php if ( $subject_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Subject Error','simpleform') ?></span></th><td class="text"><input class="sform" name="invalid_subject_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid subject','simpleform') ?>" id="invalid_subject_error" type="text" value="<?php echo $invalid_subject_error_message; ?>" \></td></tr>

<tr class="<?php if ( $subject_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Subject Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="subject_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in subject field','simpleform') ?>" id="subject_error" type="text" value="<?php echo $subject_error; ?>" \></td></tr>

<tr><th class="option"><span><?php esc_html_e('Empty Message Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_message_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty message field','simpleform') ?>" id="empty_message_error" type="text" value="<?php echo $empty_message_error; ?>" \></td></tr>

<tr><th class="option"><span><?php esc_html_e('Message Length Error','simpleform') ?></span></th><td class="text"><input type="text" class="sform" name="object_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of message not enough long','simpleform') ?>" id="object_error_message"  value="<?php echo $object_error_message; ?>" \></td></tr>
		
<tr><th class="option"><span><?php esc_html_e('Invalid Message Error','simpleform') ?></span></th><td class="text"><input class="sform" name="invalid_message_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid message','simpleform') ?>" id="invalid_message_error" type="text" value="<?php echo $invalid_object_error_message; ?>" \></td></tr>

<tr><th class="option"><span><?php esc_html_e('Message Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="message_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in message field','simpleform') ?>" id="message_error" type="text" value="<?php echo $message_error; ?>" \></td></tr>

<tr class="<?php if ( $terms_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Consent Checkbox Error','simpleform') ?></span></th><td class="text"><input class="sform" name="terms-error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of not provided consent','simpleform') ?>" id="terms-error" type="text" value="<?php echo $terms_error_message; ?>" \></td></tr>

<tr class="<?php if ( $captcha_field =='hidden') {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Empty Captcha Error','simpleform') ?></span></th><td class="text"><input class="sform" name="empty_captcha_error" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of empty captcha field','simpleform') ?>" id="empty_captcha_error" type="text" value="<?php echo $empty_captcha_error; ?>" \></td></tr>

<tr class="<?php if ( $captcha_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Invalid Captcha Error','simpleform') ?></span></th><td class="text"><input class="sform" name="captcha_error_message" placeholder="<?php esc_html_e('Please enter an inline error message to be displayed below the field in case of invalid captcha value','simpleform') ?>" id="captcha_error_message" type="text" value="<?php echo $captcha_error_message; ?>" \></td></tr>

<tr class="<?php if ( $captcha_field =='hidden' ) {echo 'unseen';}?>"><th class="option"><span><?php esc_html_e('Captcha Field Error','simpleform') ?></span></th><td class="text"><input class="sform" name="captcha_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of error in captcha field','simpleform') ?>" id="captcha_error" type="text" value="<?php echo $captcha_error; ?>" \></td></tr>

<tr><th class="last option"><span><?php esc_html_e('Honeypot Error','simpleform') ?></span></th><td class="last text"><input class="sform" name="honeypot_error" placeholder="<?php esc_html_e('Please enter an error message to be displayed below the form in case of a honeypot field is filled in','simpleform') ?>" id="honeypot_error" type="text" value="<?php echo $honeypot_error; ?>" \></td></tr>

<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Submission Error Messages','simpleform') ?></span></th></tr>

<tr><th id="thserver" class="wide option"><span><?php esc_html_e( 'Server Error','simpleform') ?></span></th><td id="tdserver" class="wide text"><input class="sform" name="server_error_message" placeholder="<?php esc_html_e( 'Please enter an error message to be displayed below the form in case an error occurs on during processing data','simpleform') ?>" id="server_error_message" type="text" value="<?php echo $server_error_message; ?>" \></td></tr>

<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Success Action','simpleform') ?></span></th></tr>

<tr><th class="first option"><span><?php esc_html_e( 'Confirmation Type', 'simpleform' ) ?></span></th><td class="first radio"><fieldset><label for="success-message"><input id="success-message" type="radio" name="success_action" value="message" <?php checked( $success_action, 'message'); ?> ><?php esc_html_e( 'Display confirmation message','simpleform') ?></label><label for="success-redirect"><input id="success-redirect" type="radio" name="success_action" value="redirect" <?php checked( $success_action, 'redirect'); ?> ><?php esc_html_e( 'Redirect to confirmation page','simpleform') ?></label></fieldset></td></tr>
 
<tr class="trsuccessmessage <?php if ($success_action !='message') { echo 'unseen'; }?>"><th class="last option"><span><?php esc_html_e( 'Confirmation Message', 'simpleform' ) ?></span></th><td class="textarea"><textarea class="sform" name="success_message" id="success_message" placeholder="<?php esc_html_e( 'Please enter a thank you message when the form is submitted', 'simpleform' ) ?>" ><?php echo $thank_you_message; ?></textarea><p class="description"><?php esc_html_e( 'The html tags for formatting message are allowed', 'simpleform' ) ?></p></td></tr>
				
<tr class="trsuccessredirect <?php if ($success_action !='redirect') { echo 'unseen'; }?>" ><th class="last option"><span><?php esc_html_e( 'Confirmation Page', 'simpleform' ) ?></span></th><td class="last select notes"><?php $pages = get_pages( array( 'sort_column' => 'post_title', 'sort_order' => 'ASC', 'post_type' => 'page', 'post_status' =>  array('publish','draft') ) ); if ( $pages ) { ?><select name="confirmation_page" class="sform" id="confirmation_page" style="width: 400px !important; max-width: 400px;"><option value=""><?php esc_html_e( 'Select page where user is redirected when form is sent', 'simpleform' ) ?></option><?php foreach ($pages as $page) { ?><option value="<?php echo $page->ID; ?>" tag="<?php echo $page->post_status; ?>" <?php selected( $confirmation_page, $page->ID ); ?>><?php echo $page->post_title; ?></option><?php } ?></select><?php } ?><p id="post-status" class="description"><?php echo $post_status ?></p></td></tr>

</tbody></table>
</div>

<div id="tab-email" class="settings-tab unseen">

<?php
$server_smtp = ! empty( $sform_settings['server_smtp'] ) ? esc_attr($sform_settings['server_smtp']) : 'false';
$smtp_host = ! empty( $sform_settings['smtp_host'] ) ? esc_attr($sform_settings['smtp_host']) : '';
$smtp_encryption = ! empty( $sform_settings['smtp_encryption'] ) ? esc_attr($sform_settings['smtp_encryption']) : 'ssl';
$smtp_port = ! empty( $sform_settings['smtp_port'] ) ? esc_attr($sform_settings['smtp_port']) : '465';
$smtp_authentication = ! empty( $sform_settings['smtp_authentication'] ) ? esc_attr($sform_settings['smtp_authentication']) : 'true';
$smtp_username = ! empty( $sform_settings['smtp_username'] ) ? stripslashes(esc_attr($sform_settings['smtp_username'])) : '';
$smtp_password = ! empty( $sform_settings['smtp_password'] ) ? stripslashes(esc_attr($sform_settings['smtp_password'])) : '';
$username_placeholder = defined( 'SFORM_SMTP_USERNAME' ) && ! empty(trim(SFORM_SMTP_USERNAME)) ? SFORM_SMTP_USERNAME : esc_html__( 'Enter the username for SMTP authentication', 'simpleform' ); 
$password_placeholder = defined( 'SFORM_SMTP_PASSWORD' ) && ! empty(trim(SFORM_SMTP_PASSWORD)) ? '•••••••••••••••' : esc_html__( 'Enter the password for SMTP authentication', 'simpleform' );
$notification = ! empty( $sform_settings['notification'] ) ? esc_attr($sform_settings['notification']) : 'true';
$notification_recipient = ! empty( $sform_settings['notification_recipient'] ) ? esc_attr($sform_settings['notification_recipient']) : esc_attr( get_option( 'admin_email' ) );
$notification_sender_email = ! empty( $sform_settings['notification_sender_email'] ) ? esc_attr($sform_settings['notification_sender_email']) : esc_attr( get_option( 'admin_email' ) );
$notification_sender_name = ! empty( $sform_settings['notification_sender_name'] ) ? esc_attr($sform_settings['notification_sender_name']) : 'requester';
$custom_sender = ! empty( $sform_settings['custom_sender'] ) ? stripslashes(esc_attr($sform_settings['custom_sender'])) : esc_attr( get_bloginfo( 'name' ) );
$notification_subject = ! empty( $sform_settings['notification_subject'] ) ? esc_attr($sform_settings['notification_subject']) : 'request';
$custom_subject = ! empty( $sform_settings['custom_subject'] ) ? stripslashes(esc_attr($sform_settings['custom_subject'])) : esc_html__('New Contact Request', 'simpleform');
$submission_number = ! empty( $sform_settings['submission_number'] ) ? esc_attr($sform_settings['submission_number']) : 'visible';
$confirmation_email = ! empty( $sform_settings['confirmation_email'] ) ? esc_attr($sform_settings['confirmation_email']) : 'false';	
$confirmation_sender_email = ! empty( $sform_settings['confirmation_sender_email'] ) ? esc_attr($sform_settings['confirmation_sender_email']) : esc_attr( get_option( 'admin_email' ) );
$confirmation_sender_name = ! empty( $sform_settings['confirmation_sender_name'] ) ? stripslashes(esc_attr($sform_settings['confirmation_sender_name'])) : esc_attr( get_bloginfo( 'name' ) );
$confirmation_subject = ! empty( $sform_settings['confirmation_subject'] ) ? stripslashes(esc_attr($sform_settings['confirmation_subject'])) : esc_html__( 'Your request has been received. Thanks!', 'simpleform' );
$code_name = '[name]';
$confirmation_message = ! empty( $sform_settings['confirmation_message'] ) ? stripslashes(esc_attr($sform_settings['confirmation_message'])) : sprintf(__( 'Hi %s', 'simpleform' ),$code_name) . ',<p>' . esc_html__( 'We have received your request. It will be reviewed soon and we’ll get back to you as quickly as possible.', 'simpleform' ) . '<p>' . esc_html__( 'Thanks,', 'simpleform' ) . '<br>' . esc_html__( 'The Support Team', 'simpleform' );          
$confirmation_reply_to = ! empty( $sform_settings['confirmation_reply_to'] ) ? esc_attr($sform_settings['confirmation_reply_to']) : $confirmation_sender_email;
?>	  	

<table class="form-table"><tbody>
		
<tr class="smtp heading <?php if ($smtp_configuration =='true') {echo 'unseen';}?>"><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'SMTP Server Configuration', 'simpleform' ) ?></span><span id="smpt-warnings"><?php esc_html_e( 'Show Configuration Warnings', 'simpleform' ) ?></span></th></tr>		
		
<tr class="smtp smpt-warnings unseen"><td colspan="2"><div class="description"><h4><?php esc_html_e( 'Improve the email deliverability sent from your website by configuring WordPress to work with a SMTP server', 'simpleform' ) ?></h4><?php esc_html_e( 'By default, WordPress uses the PHP mail() function to send emails, a basic feature in built in PHP. However, if own website is hosted on shared server it is very likely that the mail() function has been disabled by own hosting provider due to the abuse risk it presents. If you are experiencing problems with email reception, that may be exactly the reason why you\'re not receiving emails. The best and recommended solution is to use a SMTP server to send all outgoing emails, a dedicated machine that takes care of the whole email delivery process. One important function of the SMTP server is to prevent spam using authentication mechanisms that only allow authorized users to deliver emails. So, using a SMTP server for outgoing email makes it less likely that email sent out from your website being marked as spam and lowers the risk of email getting lost somewhere. As sender, you have a choice of multiple SMTP servers to forward your emails: you can choose your internet service provider, your email provider, your hosting service provider, you can use a specialized provider or you can even use your personal SMTP server. Obviously, the best option would be the specialized provider, but it is not necessary to subscribe to a paid service for having a good service, especially if there are not special needs and no need to send marketing or transactional emails. We suggest to use your own hosting service provider’s SMTP server or your own email provider initially. If you have a hosting plan, you just need to create a new email account that uses your domain name if you haven\'t already. Then use configuration information that your hosting provider gives you to connect to his own SMTP server filling all the fields in this section. If you haven\'t a hosting plan yet and your website is still running on localhost, you can use your preferred email address to send email, just enter data provided by your email provider (Gmail, Yahoo, Hotmail, etc...). Don’t forget to enable less secure apps on your email account. Furthermore, be careful to enter only your email address for that account, or an alias, into the "From Email Address" and the "Reply-To Email Address" fields, since public SMTP servers have spam filters particularly strong and do not allow to override the email headers. Always remember to change configuration data as soon as your website is put online, because your hosting provider may block outgoing SMTP connections. If you want to continue using your preferred email address, ask your hosting provider if the port used is open for traffic outbound.', 'simpleform' ) ?><p><?php printf( __('The SMPT login credentials are stored in your website database. We highly recommend you setup your login credentials in your WordPress configuration file for improved security. To do this, leave blank the %1$s field and the %2$s field and add the lines below to your %3$s file:', 'simpleform'), '<i>SMTP Username</i>', '<i>SMTP Password</i>', '<code>wp-config.php</code>' ) ?></p><pre><?php echo 'define( \'SFORM_SMTP_USERNAME\', \'email\' ); // ' .  esc_html__('Your full email address (e.g. name@domain.com)', 'simpleform' ) ?><br><?php echo 'define( \'SFORM_SMTP_PASSWORD\', \'password\' ); // '. esc_html__('Your account\'s password', 'simpleform' ); ?></pre><?php esc_html_e( 'Anyway, this section is optional. Ignore it and do not enter data if you want to use a dedicated plugin to take care of outgoing email or if you don\'t have to.', 'simpleform' ) ?></p>
</div></td></tr>
	
<tr id="trsmtpon" class="smtp smpt-settings <?php if ($smtp_configuration =='true') {echo 'unseen';}?>"><th id="thsmtp" class="option <?php if ($server_smtp !='true') { echo 'wide'; } else { echo 'first'; } ?>"><span><?php esc_html_e('Outgoing Server SMTP', 'simpleform' ) ?></span></th><td id="tdsmtp" class="checkbox notes <?php if ($server_smtp !='true') { echo 'wide'; } else { echo 'first'; } ?>"><label for="server_smtp"><input type="checkbox" class="sform" id="server_smtp" name="server_smtp" value="false" <?php checked( $server_smtp, 'true'); ?> ><?php esc_html_e( 'Enable a SMTP server for outgoing email if you havent\'t already', 'simpleform' ); ?></label><p id="smtp-notice" class="description" style="<?php if ($server_smtp !='true') { echo 'visibility:hidden'; } else { echo 'visibility:visible'; } ?>"><?php esc_html_e('Uncheck if you want to use a dedicated plugin to take care of outgoing email', 'simpleform' ) ?></p></td></tr>

<tr class="smtp smpt-settings trsmtp <?php if ($server_smtp !='true') { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e( 'SMTP Host Address', 'simpleform' ) ?></span></th><td class="text notes"><input class="sform" name="smtp_host" placeholder="<?php esc_html_e( 'Enter the server address for outgoing email', 'simpleform' ) ?>" id="smtp_host" type="text" value="<?php echo $smtp_host; ?>" \><p class="description"><?php esc_html_e( 'Your outgoing email server address', 'simpleform' ) ?></p></td></tr>	
		
<tr class="smtp smpt-settings trsmtp <?php if ($server_smtp !='true') { echo 'unseen'; }?>" ><th class="option" ><span><?php esc_html_e( 'Type of Encryption', 'simpleform' ) ?></span></th><td class="radio notes"><fieldset><label for="no-encryption"><input id="no-encryption" type="radio" name="smtp_encryption" value="none" <?php checked( $smtp_encryption, 'none'); ?> ><?php esc_html_e( 'None','simpleform') ?></label><label for="ssl-encryption"><input id="ssl-encryption" type="radio" name="smtp_encryption" value="ssl" <?php checked( $smtp_encryption, 'ssl'); ?> ><?php esc_html_e( 'SSL','simpleform') ?></label><label for="tls-encryption" ><input id="tls-encryption" type="radio" name="smtp_encryption" value="tls" <?php checked( $smtp_encryption, 'tls'); ?> ><?php esc_html_e( 'TLS','simpleform') ?></label></fieldset><p class="description"><?php esc_html_e( 'If your SMTP provider support both SSL and TLS options, we recommend using TLS encryption', 'simpleform' ) ?></p></td></tr>

<tr class="smtp smpt-settings trsmtp <?php if ($server_smtp !='true') { echo 'unseen'; }?>" ><th class="option"><span><?php esc_html_e( 'SMTP Port', 'simpleform' ) ?></span></th><td class="text notes"><input name="smtp_port" id="smtp_port" type="number" class="sform" value="<?php echo $smtp_port;?>" style="width: 90px; text-align: center;" maxlength="4"><p class="description"><?php esc_html_e( 'The port that will be used to relay outgoing email to your email server', 'simpleform' ) ?></p></td></tr>
	
<tr id="form-fields-label" class="smtp smpt-settings trsmtp <?php if ($server_smtp !='true') { echo 'unseen'; }?>"><th id="thauthentication" class="option"><span><?php esc_html_e( 'SMTP Authentication', 'simpleform' ) ?></span></th><td class="checkbox notes" id="tdauthentication"><label for="smtp_authentication"><input id="smtp_authentication" name="smtp_authentication" type="checkbox" class="sform" value="true" <?php checked( $smtp_authentication, 'true'); ?> ><?php esc_html_e( 'Enable SMTP Authentication', 'simpleform' ); ?></label><p class="description"><?php esc_html_e( 'This options should always be checked', 'simpleform' ) ?> </p></td></tr>

<tr valign="top" class="smtp smpt-settings trsmtp trauthentication <?php if ($server_smtp !='true' || $smtp_authentication !='true' ) { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e( 'SMTP Username','simpleform') ?></span></th><td class="text notes"><input class="sform" name="smtp_username" placeholder="<?php echo $username_placeholder ?>" id="smtp_username" type="text" value="<?php echo $smtp_username; ?>" \><p class="description"><?php esc_html_e( 'The username to login to SMTP email server (your email). Please read the above warnings for improved security','simpleform') ?></p></td></tr>	
		
<tr class="smtp smpt-settings trsmtp trauthentication <?php if ($server_smtp !='true' || $smtp_authentication !='true' ) { echo 'unseen'; }?>"><th class="last option"><span><?php esc_html_e( 'SMTP Password','simpleform') ?></span></th><td class="last text notes"><input class="sform" name="smtp_password" placeholder="<?php echo $password_placeholder ?>" id="smtp_password" type="text" value="<?php echo $smtp_password; ?>" \><p class="description"><?php esc_html_e( 'The password to login to SMTP email server (your password). Please read the above warnings for improved security','simpleform') ?></p></td></tr>	
<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Notification Email', 'simpleform' ); ?></span></th></tr>
		
<tr><th id="thnotification" class="option <?php if ($notification !='true') { echo 'wide'; } else { echo 'first'; } ?>" ><span ><?php esc_html_e( 'Enable Notification', 'simpleform' ); ?></span></th><td id="tdnotification"  class="checkbox <?php if ($notification !='true') { echo 'wide'; } else { echo 'first'; } ?>"><label for="notification"><input name="notification" type="checkbox" class="sform" id="notification" value="true" <?php checked( $notification, 'true'); ?> ><?php esc_html_e( 'Send notification email when a new request is submitted', 'simpleform' ); ?></label></td></tr>
   
<tr class="trnotification <?php if ($notification !='true') { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e( 'Address All Submissions To', 'simpleform' ) ?></span></th><td class="text notes"><input class="sform" name="notification_recipient" placeholder="<?php esc_html_e( 'Enter the email address which notification is sent to', 'simpleform' ) ?>" id="notification_recipient" type="text" value="<?php echo $notification_recipient; ?>" ><p class="description"><?php esc_html_e( 'Form submissions are sent to this email. It is recommended to enter that one used to respond to the requests', 'simpleform' ) ?></p></td></tr>
	       
<tr class="trnotification trfromemail <?php if ($notification !='true') { echo 'unseen'; }?>"><th class="option"><span style="cursor: default"><?php esc_html_e( 'From Email Address', 'simpleform' ) ?></span></th><td class="text notes"><input class="sform" name="notification_sender_email" placeholder="<?php printf(__( 'Enter the email address which notification is sent from. If blank, %s will be used', 'simpleform' ), $notification_recipient) ?>" id="notification_sender_email" type="text" value="<?php echo $notification_sender_email; ?>" \><p class="description"><?php esc_html_e( 'To avoid that emails sent out from your website being marked as spam, it is recommended to use one associated with own website\'s domain', 'simpleform' ) ?></p></td></tr>      
       
<tr class="trnotification trfromemail <?php if ($notification !='true') { echo 'unseen'; }?>" ><th class="option"><span><?php esc_html_e( 'From Name', 'simpleform' ) ?></span></th><td class="radio"><fieldset><label for="requester-name"><input id="requester-name" type="radio" name="notification_sender_name" value="requester" <?php checked( $notification_sender_name, 'requester'); ?> ><?php esc_html_e( 'Use requester name', 'simpleform' ) ?></label><label for="form-name"><input id="form-name" type="radio" name="notification_sender_name" value="form" <?php checked( $notification_sender_name, 'form'); ?> ><?php esc_html_e( 'Use contact form name', 'simpleform' ) ?></label><label for="custom-name"><input id="custom-name" type="radio" name="notification_sender_name" value="custom" <?php checked( $notification_sender_name, 'custom'); ?> ><?php esc_html_e( 'Use custom name', 'simpleform' ) ?></label><br></fieldset></td></tr>
	
<tr class="trnotification trcustomname <?php if ( $notification != 'true' || $notification_sender_name != 'custom') { echo 'unseen'; }?>" ><th class="option"><span><?php esc_html_e( 'Custom Sender Name', 'simpleform' ) ?></span></th><td class="text"><input class="sform" name="custom_sender" placeholder="<?php esc_html_e( 'Enter the name which notification is sent from', 'simpleform' ) ?>" id="custom_sender" type="text" value="<?php echo $custom_sender; ?>" \></td></tr>

<tr class="trnotification <?php if ($notification !='true') { echo 'unseen'; }?>" ><th class="option"><span style="cursor: default"><?php esc_html_e( 'Email Subject', 'simpleform' ) ?></span></th><td class="radio"><fieldset><label for="request-subject"><input id="request-subject" type="radio" name="notification_subject" value="request" <?php checked( $notification_subject, 'request'); ?> ><?php esc_html_e( 'Use requester submission subject', 'simpleform' ) ?></label><label for="custom-subject"><input id="custom-subject" type="radio" name="notification_subject" value="custom" <?php checked( $notification_subject, 'custom'); ?> ><?php esc_html_e( 'Use default notification subject', 'simpleform' ) ?></label></fieldset></td></tr>
 
<tr class="trnotification trcustomsubject <?php if ( $notification != 'true' || $notification_subject != 'custom') { echo 'unseen'; }?>" ><th class="option"><span><?php esc_html_e( 'Default Subject', 'simpleform' ) ?></span></th><td class="text"><input class="sform" name="custom_subject" placeholder="<?php esc_html_e( 'Enter the subject with which notification is sent', 'simpleform' ) ?>" id="custom_subject" type="text" value="<?php echo $custom_subject; ?>" \></td></tr>

<tr class="trnotification <?php if ($notification !='true') { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e('Submission ID','simpleform') ?></span></th><td class="last checkbox"><label for="submission_number"><input name="submission_number" type="checkbox" class="sform" id="submission_number" value="hidden" <?php checked( $submission_number, 'hidden'); ?> ><?php esc_html_e( 'Hide submission ID inside notification subject', 'simpleform' ); ?></label></td></tr>

<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Confirmation Email', 'simpleform' ) ?></span></th></tr>

<tr class="trname"><th id="thconfirmation" class="option <?php if ($confirmation_email !='true') { echo 'wide'; } else { echo 'first'; } ?>"><span><?php esc_html_e( 'Enable Confirmation', 'simpleform' ) ?></span></th><td id="tdconfirmation" class="checkbox <?php if ($confirmation_email !='true') { echo 'wide'; } else { echo 'first'; } ?>"><label for="confirmation_email"><input name="confirmation_email" type="checkbox" class="sform" id="confirmation_email" value="false" <?php checked( $confirmation_email, 'true'); ?> ><?php esc_html_e( 'Send confirmation email to requester', 'simpleform' ); ?></label></td></tr>

<tr class="trconfirmation <?php if ($confirmation_email !='true') { echo 'unseen'; }?>"><th class="option" ><span><?php esc_html_e( 'From Email Address', 'simpleform' ) ?></span></th><td class="text notes"><input class="sform" name="confirmation_sender_email" placeholder="<?php printf(__( 'Enter the email address which confirmation is sent from. If blank, %s will be used', 'simpleform' ), $confirmation_sender_email) ?>" id="confirmation_sender_email" type="text" value="<?php echo $confirmation_sender_email; ?>" \><p class="description"><?php esc_html_e( 'To avoid that emails sent out from your website being marked as spam, it is recommended to use one associated with own website\'s domain', 'simpleform' ) ?></p></td></tr>

<tr class="trconfirmation <?php if ($confirmation_email !='true') { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e( 'From Name', 'simpleform' ) ?></span></th><td class="text"><input class="sform" name="confirmation_sender_name" placeholder="<?php esc_html_e( 'Enter the name which confirmation is sent from', 'simpleform' ) ?>" id="confirmation_sender_name" type="text" value="<?php echo $confirmation_sender_name; ?>" \></td></tr>

<tr class="trconfirmation <?php if ($confirmation_email !='true') { echo 'unseen'; }?>"><th class="option"><span><?php esc_html_e( 'Email Subject', 'simpleform' ) ?></span></th><td class="text"><input class="sform" name="confirmation_subject" placeholder="<?php esc_html_e( 'Enter the subject with which confirmation email is sent to user', 'simpleform' ) ?>" id="confirmation_subject" type="text" value="<?php echo $confirmation_subject; ?>" \></td></tr>

<tr id="trmessage" class="trconfirmation <?php if ($confirmation_email !='true') { echo 'unseen'; }?>"><th><span><?php esc_html_e( 'Email Message', 'simpleform' ) ?></span></th><td><textarea name="confirmation_message" id="confirmation_message" class="sform" placeholder="<?php esc_html_e( 'Enter the message to send to user for an acknowledgement of request receipt', 'simpleform' ) ?>" ><?php echo $confirmation_message; ?></textarea><p class="description"><?php esc_html_e( 'To prevent formatting problems, please use the html tags. Are also accepted the following shortcodes:', 'simpleform' ) ?> [name] [request_subject] [request_message] [request_id]</p></td></tr>

<tr class="trconfirmation <?php if ($confirmation_email !='true') { echo 'unseen'; }?>"><th class="last option"><span><?php esc_html_e( 'Reply-To Email Address', 'simpleform' ) ?></span></th><td class="last text notes"><input class="sform" name="confirmation_reply_to" placeholder="<?php esc_html_e( 'Enter the email address to use for reply-to, if reply must be addressed to a different email address', 'simpleform' ) ?>" id="confirmation_reply_to" type="text" value="<?php echo $confirmation_reply_to; ?>" \><p class="description"><?php esc_html_e( 'Leave it blank to use From Email Address as the reply-to value. Public servers do not allow to override it, please visit the plugin FAQ', 'simpleform' ) ?></p></td></tr>

</tbody></table>
</div>

<div id="submit-wrap"><div id="alert-wrap">
<noscript><div id="noscript"><?php esc_html_e('You need JavaScript enabled to save settings. Please activate it. Thanks!', 'simpleform' ) ?></div></noscript>
<div id="message-wrap" class="message"></div>
</div>

<input type="submit" class="submit-button" id="save_sform_options" name="save_sform_options" value="<?php esc_html_e( 'Save Changes', 'simpleform' ) ?>">

<?php wp_nonce_field( 'ajax-verification-nonce', 'verification_nonce'); ?>
</form></div>