<?php

if ( ! defined( 'WPINC' ) ) die;
		
$sform_settings = get_option('sform-settings');
$page_description = esc_html__( 'Change easily the way your contact form is displayed. Choose which fields to use and who should see them:','simpleform');
?>

<div class="wrap"><h1 class="<?php if(has_action('load_submissions_table_options')) { echo 'backend2'; } else { echo 'backend'; } ?>"><span class="dashicons dashicons-editor-table"></span><?php esc_html_e( 'Edit Form', 'simpleform' );?></h1>  
 
<div class="page-description"><?php echo $page_description;?></div>

<?php
$form_attributes = get_option('sform-attributes');
$attribute = '';           
$shortcode_values = apply_filters( 'sform_form', $attribute );
$shortcode = $shortcode_values['shortcode'];
$shortcode_name = ! empty($shortcode_values['name']) ? stripslashes(esc_attr($shortcode_values['name'])) : esc_attr__( 'Contact Form','simpleform');
$introduction_text = ! empty( $form_attributes['introduction_text'] ) ? esc_attr($form_attributes['introduction_text']) : esc_attr__( 'Please fill out the form below with your inquiry and we will get back to you as soon as possible. Mandatory fields are marked with (*).', 'simpleform' );
$bottom_text = ! empty( $form_attributes['bottom_text'] ) ? esc_attr($form_attributes['bottom_text']) : '';
$required_sign = ! empty( $form_attributes['required_sign'] ) ? esc_attr($form_attributes['required_sign']) : 'true';
$firstname_field = ! empty( $form_attributes['firstname_field'] ) ? esc_attr($form_attributes['firstname_field']) : 'visible';
$firstname_spotlight = ! empty( $form_attributes['firstname_spotlight'] ) ? esc_attr($form_attributes['firstname_spotlight']) : 'visible';
$firstname_label = ! empty( $form_attributes['firstname_label'] ) ? stripslashes(esc_attr($form_attributes['firstname_label'])) : esc_attr__( 'Firstname', 'simpleform' );
$firstname_placeholder = ! empty( $form_attributes['firstname_placeholder'] ) ? stripslashes(esc_attr($form_attributes['firstname_placeholder'])) : '';
$firstname_requirement = ! empty( $form_attributes['firstname_requirement'] ) ? esc_attr($form_attributes['firstname_requirement']) : 'required';
$lastname_field = ! empty( $form_attributes['lastname_field'] ) ? esc_attr($form_attributes['lastname_field']) : 'hidden';
$lastname_alignment = ! empty( $form_attributes['lastname-alignment'] ) ? esc_attr($form_attributes['lastname-alignment']) : 'name';
$lastname_spotlight = ! empty( $form_attributes['lastname_spotlight'] ) ? esc_attr($form_attributes['lastname_spotlight']) : 'visible';
$lastname_label = ! empty( $form_attributes['lastname_label'] ) ? stripslashes(esc_attr($form_attributes['lastname_label'])) : esc_attr__( 'Lastname', 'simpleform' );
$lastname_placeholder = ! empty( $form_attributes['lastname_placeholder'] ) ? stripslashes(esc_attr($form_attributes['lastname_placeholder'])) : '';
$lastname_requirement = ! empty( $form_attributes['lastname_requirement'] ) ? esc_attr($form_attributes['lastname_requirement']) : 'optional';
$email_field = ! empty( $form_attributes['email_field'] ) ? esc_attr($form_attributes['email_field']) : 'visible';
$email_spotlight = ! empty( $form_attributes['email_spotlight'] ) ? esc_attr($form_attributes['email_spotlight']) : 'visible';
$email_label = ! empty( $form_attributes['email_label'] ) ? stripslashes(esc_attr($form_attributes['email_label'])) : esc_attr__( 'Email', 'simpleform' );
$email_placeholder = ! empty( $form_attributes['email_placeholder'] ) ? stripslashes(esc_attr($form_attributes['email_placeholder'])) : '';
$email_requirement = ! empty( $form_attributes['email_requirement'] ) ? esc_attr($form_attributes['email_requirement']) : 'required';
$phone_field = ! empty( $form_attributes['phone_field'] ) ? esc_attr($form_attributes['phone_field']) : 'hidden';
$phone_alignment = ! empty( $form_attributes['phone-alignment'] ) ? esc_attr($form_attributes['phone-alignment']) : 'email';
$phone_spotlight = ! empty( $form_attributes['phone_spotlight'] ) ? esc_attr($form_attributes['phone_spotlight']) : 'visible';
$phone_label = ! empty( $form_attributes['phone_label'] ) ? stripslashes(esc_attr($form_attributes['phone_label'])) : esc_attr__( 'Phone Number', 'simpleform' );
$phone_placeholder = ! empty( $form_attributes['phone_placeholder'] ) ? stripslashes(esc_attr($form_attributes['phone_placeholder'])) : '';
$phone_requirement = ! empty( $form_attributes['phone_requirement'] ) ? esc_attr($form_attributes['phone_requirement']) : 'optional';
$subject_field = ! empty( $form_attributes['subject_field'] ) ? esc_attr($form_attributes['subject_field']) : 'visible';
$subject_spotlight = ! empty( $form_attributes['subject_spotlight'] ) ? esc_attr($form_attributes['subject_spotlight']) : 'visible';
$subject_label = ! empty( $form_attributes['subject_label'] ) ? stripslashes(esc_attr($form_attributes['subject_label'])) : esc_attr__( 'Subject', 'simpleform' );
$subject_placeholder = ! empty( $form_attributes['subject_placeholder'] ) ? stripslashes(esc_attr($form_attributes['subject_placeholder'])) : '';
$subject_requirement = ! empty( $form_attributes['subject_requirement'] ) ? esc_attr($form_attributes['subject_requirement']) : 'required';
$message_spotlight = ! empty( $form_attributes['message_spotlight'] ) ? esc_attr($form_attributes['message_spotlight']) : 'visible';
$message_label = ! empty( $form_attributes['message_label'] ) ? stripslashes(esc_attr($form_attributes['message_label'])) : esc_attr__( 'Message', 'simpleform' );
$message_placeholder = ! empty( $form_attributes['message_placeholder'] ) ? stripslashes(esc_attr($form_attributes['message_placeholder'])) : '';
$terms_field = ! empty( $form_attributes['terms_field'] ) ? esc_attr($form_attributes['terms_field']) : 'visible';
$terms_label = ! empty( $form_attributes['terms_label'] ) ? stripslashes(esc_attr($form_attributes['terms_label'])) : esc_attr__( 'I have read and agree to the Privacy Policy', 'simpleform' ); 
$terms_requirement = ! empty( $form_attributes['terms_requirement'] ) ? esc_attr($form_attributes['terms_requirement']) : 'required'; 
$captcha_field = ! empty( $form_attributes['captcha_field'] ) ? esc_attr($form_attributes['captcha_field']) : 'hidden';            
$math_captcha_label = ! empty( $form_attributes['captcha_label'] ) ? stripslashes(esc_attr($form_attributes['captcha_label'])) : esc_attr__( 'What does this equal to?', 'simpleform' ); 
$submit_label = ! empty( $form_attributes['submit_label'] ) ? stripslashes(esc_attr($form_attributes['submit_label'])) : esc_attr__( 'Submit', 'simpleform' );
?>	
		
<form id="sform-attributes" method="post"><table class="form-table"><tbody>

<tr><th class="first option"><span><?php esc_html_e('Shortcode','simpleform') ?></span></th><td class="shortcode text"><span id="field1">[<?php echo $shortcode ?>]</span><input type="button" id="shortcode-copy" class="copy" value="<?php esc_html_e('Copy','simpleform') ?>"></td></tr>
		
<tr><th class="option"><span><?php esc_html_e('Form Name','simpleform') ?></span></th><td class="text"><input class="sform" name="shortcode_name" placeholder="<?php esc_html_e('Enter a name for this Form','simpleform') ?>" id="shortcode_name" type="text" value="<?php echo $shortcode_name; ?>"></td></tr>

<tr><th class="last option"><span><?php esc_html_e('Used in','simpleform') ?></span></th><td class="used_page">
		
<?php	
$args = array('post_type' => 'page', 'posts_per_page' => -1, 'meta_query' => array( array( 'key' => 'simpleform', 'value' => '['.$shortcode.']') ));
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	$counter = $the_query->post_count; 
    while ( $the_query->have_posts() ) {
    $the_query->the_post(); 
    ?>
    <a href="<?php the_permalink(); ?>"target="_blank" style="text-decoration: none;"><?php the_title(); ?></a><br/>
    <?php 
	}
}
else {
	$counter = 0;
}
wp_reset_postdata();

global $wpdb;
$table_post = $wpdb->prefix . 'posts';
$results = $wpdb->get_results("SELECT post_title, guid FROM $table_post WHERE post_content LIKE '%[$shortcode]%' AND ( post_type = 'page' OR post_type = 'post') ");		    
$num = count($results);	
$pages = '';		
if ( $results){
foreach ($results as $post) { $pages .= '<a href="' . $post->guid . '" target="_blank" style="text-decoration: none;">' . $post->post_title . '</a><br/>'; }
}
$total_pages = $num + $counter;
if ( $total_pages > 0 ):
$message =  '<p class="description">' . sprintf( _n( 'Page currently containing the shortcode', 'Pages currently containing the shortcode', $total_pages, 'simpleform' ), $total_pages ) . ' [' . $shortcode . ']</p>';
else:
$message = '<p class="description inused">' . esc_attr__('Still not used. Create a new page or choose an existing one and add the shortcode','simpleform') . ' [' . $shortcode . ']</p>';
endif;
echo $pages . $message . '</td></tr>';	
?>

<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Form Description','simpleform') ?></span></th></tr>
 
<tr><th class="first option"><span><?php esc_html_e( 'Text above Form', 'simpleform' ) ?></span></th><td class="first textarea"><textarea class="sform description" name="introduction_text" id="introduction_text" placeholder="<?php esc_html_e( 'Enter the text that must be displayed above the form. It can be used to provide a description or instructions for filling in the form.', 'simpleform' ) ?>" ><?php echo $introduction_text ?></textarea><p class="description"><?php esc_html_e( 'The html tags for formatting message are allowed', 'simpleform' ) ?></p></td></tr>

<tr><th class="last textarea option"><span><?php esc_html_e( 'Text below Form', 'simpleform' ) ?></span></th><td class="last textarea"><textarea class="sform description" name="bottom_text" id="bottom_text" placeholder="<?php esc_html_e( 'Enter the text that must be displayed below the form. It can be used to provide additional information.', 'simpleform' ) ?>" ><?php echo $bottom_text ?></textarea><p class="description"><?php esc_html_e( 'The html tags for formatting message are allowed', 'simpleform' ) ?></p></td></tr>

<tr><th class="heading" colspan="2"><span id="misc"><?php esc_html_e( 'Form Appearance','simpleform') ?></span></th></tr>

<tr><th id="thsign" class="option wide"><span><?php esc_html_e('Required Field Sign', 'simpleform' ) ?></span></th><td id="tdsign" class="checkbox wide"><label for="required_sign"><input type="checkbox" class="sform" id="required_sign" name="required_sign" value="true" <?php checked( $required_sign, 'true'); ?> ><?php esc_html_e( 'Use an asterisk at the end of the label to mark a required field', 'simpleform' ); ?></label></td></tr>

<tr><th class="heading" colspan="2"><span><?php esc_html_e('Form Fields','simpleform') ?></span></th></tr>

<tr><th class="first option"><span><?php esc_html_e('Firstname Field','simpleform') ?></span></th><td class="first select"><select name="firstname_field" id="firstname_field" class="sform"><option value="visible" <?php selected( $firstname_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $firstname_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $firstname_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $firstname_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>
								
<tr class="trname <?php if ( $firstname_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Firstname Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="namelabel"><input name="firstname_spotlight" type="checkbox" class="sform field-label" id="namelabel" value="<?php echo $firstname_spotlight ?>" <?php checked( $firstname_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for firstname field','simpleform') ?></label></td></tr>

<tr class="trname namelabel <?php if ( $firstname_field =='hidden' || $firstname_spotlight =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Firstname Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="firstname_label" placeholder="<?php esc_html_e('Enter a label for Firstname field','simpleform') ?>" id="firstname_label" type="text" value='<?php echo $firstname_label; ?>'</td></tr>		
		
<tr class="trname <?php if ( $firstname_field =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Firstname Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="firstname_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Firstname field. If blank, will not be used!','simpleform') ?>" id="firstname_placeholder" type="text" value='<?php echo $firstname_placeholder; ?>'</td></tr>		
<tr class="trname <?php if ( $firstname_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Firstname Field Requirement','simpleform') ?></span></th><td class="checkbox"><label for="firstname_requirement"><input name="firstname_requirement" type="checkbox" class="sform" id="firstname_requirement" value="required" <?php checked( $firstname_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Lastname Field','simpleform') ?></span></th><td class="select"><select name="lastname_field" id="lastname_field" class="sform"><option value="visible" <?php selected( $lastname_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $lastname_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $lastname_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $lastname_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>

<tr class="trlastname <?php if ( $lastname_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option" ><span><?php esc_html_e( 'Lastname Field Layout', 'simpleform' ) ?></span></th><td class="radio"><fieldset><label for="single-line"><input id="single-line" type="radio" name="lastname-alignment" value="alone" <?php checked( $lastname_alignment, 'alone'); ?> ><?php esc_html_e( 'Place on a single line','simpleform') ?></label><label for="name-line" ><input id="name-line" type="radio" name="lastname-alignment" value="name" <?php checked( $lastname_alignment, 'name'); ?> ><?php esc_html_e( 'Place next to firstname field on the same line','simpleform') ?></label></fieldset></td></tr>

<tr class="trlastname <?php if ( $lastname_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Lastname Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="lastnamelabel"><input name="lastname_spotlight" type="checkbox" class="sform field-label" id="lastnamelabel" value="visible" <?php checked( $lastname_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for lastname field','simpleform') ?></label></td></tr>

<tr class="trlastname lastnamelabel <?php if ( $lastname_field =='hidden' || $lastname_spotlight =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Lastname Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="lastname_label" placeholder="<?php esc_html_e('Enter a label for Lastname field','simpleform') ?>" id="lastname_label" type="text" value='<?php echo $lastname_label; ?>'</td></tr>		

<tr class="trlastname <?php if ( $lastname_field =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Lastname Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="lastname_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Lastname field. If blank, will not be used!','simpleform') ?>" id="lastname_placeholder" type="text" value='<?php echo $lastname_placeholder; ?>'</td></tr>		
<tr class="trlastname <?php if ( $lastname_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Lastname Field Requirement','simpleform') ?></span></th><td class="checkbox"><label for="lastname_requirement"><input name="lastname_requirement" type="checkbox" class="sform" id="lastname_requirement" value="required" <?php checked( $lastname_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Email Field','simpleform') ?></span></th><td class="select"><select name="email_field" id="email_field" class="sform"><option value="visible" <?php selected( $email_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $email_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $email_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $email_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>
		
<tr class="tremail <?php if ( $email_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Email Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="emaillabel"><input name="email_spotlight" type="checkbox" class="sform field-label" id="emaillabel" value="visible" <?php checked( $email_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for email field','simpleform') ?></label></td></tr>

<tr class="tremail emaillabel <?php if ( $email_field =='hidden' || $email_spotlight =='hidden' ) { echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span ><?php esc_html_e('Email Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="email_label" placeholder="<?php esc_html_e('Enter a label for Email field','simpleform') ?>" id="email_label" type="text" value="<?php echo $email_label; ?>"</td></tr>

<tr class="tremail <?php if ( $email_field =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Email Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="email_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Email field. If blank, will not be used!','simpleform') ?>" id="email_placeholder" type="text" value='<?php echo $email_placeholder; ?>'</td></tr>		
		
<tr class="tremail <?php if ( $email_field =='hidden') { echo 'hidden';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('Email Field Requirement','simpleform') ?></span></th><td class="checkbox"><label for="email_requirement"><input name="email_requirement" type="checkbox" class="sform" id="email_requirement" value="required" <?php checked( $email_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Phone Field','simpleform') ?></span></th><td class="select"><select name="phone_field" id="phone_field" class="sform"><option value="visible" <?php selected( $phone_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $phone_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $phone_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $phone_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>

<tr class="trphone <?php if ( $phone_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option" ><span><?php esc_html_e( 'Phone Field Layout', 'simpleform' ) ?></span></th><td class="radio"><fieldset><label for="single-line"><input id="single-line" type="radio" name="phone-alignment" value="alone" <?php checked( $phone_alignment, 'alone'); ?> ><?php esc_html_e( 'Place on a single line','simpleform') ?></label><label for="email-line" ><input id="email-line" type="radio" name="phone-alignment" value="email" <?php checked( $phone_alignment, 'email'); ?> ><?php esc_html_e( 'Place next to email field on the same line','simpleform') ?></label></fieldset></td></tr>

<tr class="trphone <?php if ( $phone_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Phone Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="phonelabel"><input name="phone_spotlight" type="checkbox" class="sform field-label" id="phonelabel" value="visible" <?php checked( $phone_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for phone field','simpleform') ?></label></td></tr>

<tr class="trphone phonelabel <?php if ( $phone_field =='hidden' || $phone_spotlight =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Phone Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="phone_label" placeholder="<?php esc_html_e('Enter a label for Phone field','simpleform') ?>" id="phone_label" type="text" value='<?php echo $phone_label; ?>'</td></tr>		

<tr class="trphone <?php if ( $phone_field =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Phone Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="phone_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Phone field. If blank, will not be used!','simpleform') ?>" id="phone_placeholder" type="text" value='<?php echo $phone_placeholder; ?>'</td></tr>		

<tr class="trphone <?php if ( $phone_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Phone Field Requirement','simpleform') ?></span></th><td class="checkbox"><label for="phone_requirement"><input name="phone_requirement" type="checkbox" class="sform" id="phone_requirement" value="required" <?php checked( $phone_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Subject Field','simpleform') ?></span></th><td class="select"><select name="subject_field" id="subject_field" class="sform"><option value="visible" <?php selected( $subject_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $subject_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $subject_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $subject_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>

<tr class="trsubject <?php if ( $subject_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Subject Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="subjectlabel"><input name="subject_spotlight" type="checkbox" class="sform field-label" id="subjectlabel" value="visible" <?php checked( $subject_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for subject field','simpleform') ?></label></td></tr>

<tr class="trsubject subjectlabel <?php if ($subject_field =='hidden' || $subject_spotlight =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Subject Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="subject_label" placeholder="<?php esc_html_e('Enter a label for Subject field','simpleform') ?>" id="subject_label" type="text" value="<?php echo $subject_label; ?>"></td></tr>

<tr class="trsubject <?php if ( $subject_field =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>" ><th class="option"><span><?php esc_html_e('Subject Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="subject_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Subject field. If blank, will not be used!','simpleform') ?>" id="subject_placeholder" type="text" value='<?php echo $subject_placeholder; ?>'</td></tr>		

<tr class="trsubject <?php if ($subject_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('Subject Field Requirement','simpleform') ?></span></th><td class="checkbox"><label for="subject_requirement"><input name="subject_requirement" type="checkbox" class="sform" id="subject_requirement" value="required" <?php checked( $subject_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label></td></tr>

<tr><th class="option"><span><?php esc_html_e('Message Field Label Visibility','simpleform') ?></span></th><td class="checkbox"><label for="messagelabel"><input name="message_spotlight" type="checkbox" class="sform field-label" id="messagelabel" value="visible" <?php checked( $message_spotlight, 'hidden'); ?>><?php esc_html_e('Hide label for message field','simpleform') ?></label></td></tr>

<tr class="messagelabel <?php if ( $message_spotlight =='hidden' ) {echo 'hidden';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('Message Field Label','simpleform') ?></span></th><td class="text"><input class="sform" name="message_label" placeholder="<?php esc_html_e('Enter a label for Message field','simpleform') ?>" id="message_label" type="text" value="<?php echo $message_label; ?>"</td></tr>

<tr><th class="option"><span><?php esc_html_e('Message Field Placeholder','simpleform') ?></span></th><td class="text"><input class="sform" name="message_placeholder" placeholder="<?php esc_html_e('Enter a placeholder for Message field. If blank, will not be used!','simpleform') ?>" id="message_placeholder" type="text" value='<?php echo $message_placeholder; ?>'</td></tr>

<tr><th class="option"><span><?php esc_html_e('Terms Field','simpleform') ?></span></th><td class="select"><select name="terms_field" id="terms_field" class="sform"><option value="visible" <?php selected( $terms_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $terms_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $terms_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $terms_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>

<tr class="trterms <?php if ($terms_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('Terms Field Label','simpleform') ?></span></th><td class="text notes"><input class="sform" name="terms_label" placeholder="<?php esc_html_e('Enter a label for Terms field','simpleform') ?>" id="terms_label" type="text" value="<?php echo $terms_label; ?>" \><p id="description-terms" class="description"><?php esc_html_e('Entering URL requires the use of html tags','simpleform') ?></p></td></tr>

<tr class="trterms <?php if ($terms_field =='hidden') {echo 'hidden';} else {echo 'visible';} ?>"><th class="option"><span><?php esc_html_e('Terms Field Requirement','simpleform') ?></span></th><td class="checkbox notes"><label for="terms_requirement"><input name="terms_requirement" type="checkbox" class="sform" id="terms_requirement" value="required" <?php checked( $terms_requirement, 'required'); ?>><?php esc_html_e('Make this field required','simpleform') ?></label><p class="description"><?php esc_html_e('If you’re collecting personal data this field is required for requesting the user explicit consent','simpleform') ?></p></td></tr>

<tr><th class="option"><span><?php esc_html_e('Captcha Field','simpleform') ?></span></th><td class="select"><select name="captcha_field" id="captcha_field" class="sform"><option value="visible" <?php selected( $captcha_field, 'visible'); ?>><?php esc_html_e('Display to all users','simpleform') ?></option><option value="registered" <?php selected( $captcha_field, 'registered'); ?>><?php esc_html_e('Display only to registered users','simpleform') ?></option><option value="anonymous" <?php selected( $captcha_field, 'anonymous'); ?>><?php esc_html_e('Display only to anonymous users','simpleform') ?></option><option value="hidden" <?php selected( $captcha_field, 'hidden'); ?>><?php esc_html_e('Do not display','simpleform') ?></option></select></td></tr>

<tr class="trcaptcha trcaptchalabel <?php if ( $captcha_field !='hidden' ) {echo 'visible';} else {echo 'hidden';} ?>"><th class="option"><span><?php esc_html_e('Captcha Field Label','simpleform') ?></span></th><td class="text"><input type="text" class="sform" id="captcha_label" name="captcha_label" placeholder="<?php esc_html_e('Enter a label for Captcha field','simpleform') ?>" value="<?php echo $math_captcha_label ?>"></td></tr>

<tr><th class="last option"><span><?php esc_html_e('Submit Field Label','simpleform') ?></span></th><td class="last text"><input type="text" id="submit_label" class="sform" name="submit_label" placeholder="<?php esc_html_e('Enter a label for Submit field','simpleform') ?>" value="<?php echo $submit_label ?>"</td></tr>

</tbody></table>

<div id="submit-wrap"><div id="message-wrap" class="message"></div>	
<input type="submit" class="submit-button" id="sform-edit-form" name="sform-edit-form"  value="<?php esc_html_e( 'Save Changes', 'simpleform' ) ?>">	

<?php  wp_nonce_field( 'ajax-verification-nonce', 'verification_nonce'); ?>
</form></div>