<?php

if ( ! defined( 'WPINC' ) ) die;

$sform_settings = get_option('sform-settings');
$last_message = stripslashes(get_transient('sform_last_message'));
?>
     
<div class="wrap"><h1 class="<?php if(has_action('load_submissions_table_options')) { echo 'backend2'; } else { echo 'backend'; } ?>"><span class="dashicons dashicons-email-alt" ></span><?php esc_html_e( 'Submissions', 'simpleform' );?></h1>   
    
<?php
 if ( has_action( 'submissions_list' ) ):
 do_action( 'submissions_list' );
 else:
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
?>
	 
<div><ul id="submissions-data"><li class="type"><span class="label"><?php esc_html_e( 'Received', 'simpleform' ); ?></span><span class="value"><?php echo $total_received; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'This Year', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_year; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'Last Month', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_month; ?></span></li><li class="type"><span class="label"><?php esc_html_e( 'Last Week', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_week; ?></span></li><li><span class="label"><?php esc_html_e( 'Last Day', 'simpleform' ); ?></span><span class="value"><?php echo $count_last_day; ?></span></li></ul></div>

<?php
	$icon = version_compare(get_bloginfo('version'),'5.0', '>=') ? 'dashicons-buddicons-pm' : 'dashicons-media-text';
    $plugin_file = 'simpleform-contact-form-submissions/simpleform-submissions.php';
    $admin_url = is_network_admin() ? network_admin_url( 'plugins.php' ) : admin_url( 'plugins.php' );
	if ( get_transient( 'sform_last_message' ) ) {
	echo '<div id="last-submission"><h3><span class="dashicons '.$icon.'"></span>'.esc_html__('Last Message Received', 'simpleform' ).'</h3>'.$last_message . '</div>';
    if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_file ) ) {		
	echo '<div id="submissions-notice" class="hidden"><h3><span class="dashicons dashicons-editor-help"></span>'.esc_html__('Before you go crazy looking for the received messages', 'simpleform' ).'</h3>'. esc_html__( 'Submissions data are not store into the WordPress database. This feature can be enabled with SimpleForm Contact Form Submissions addon. You find it on the WordPress.org plugin repository. By default, only last message is being temporarily stored. Therefore, it is recommended to verify the correct SMTP server configuration in case of use, and always keep the notification email enabled if you want to be sure to receive messages.', 'simpleform' ) .'</div>'; 	
	}
	else {
    if ( ! class_exists( 'SimpleForm_Submissions' ) ) {	
	echo '<div id="submissions-notice" class="hidden"><h3><span class="dashicons dashicons-editor-help"></span>'.esc_html__('Before you go crazy looking for the received messages', 'simpleform' ).'</h3>'. esc_html__('Submissions data are not store into the WordPress database by default. You can easily add this feature with SimpleForm Contact Form Submissions addon activation. Go to the Plugins page.', 'simpleform' ) .'</div>';	
	}
	}
	}
	else  {
    if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_file ) ) {		
	echo '<div id="empty-submission"><h3><span class="dashicons dashicons-info"></span>'.esc_html__('Empty Inbox', 'simpleform' ).'</h3>'.
esc_html__('So far, no message has been received yet!', 'simpleform' ).'<p>'.sprintf( __('Please note that submissions data are not store into the WordPress database by default. You can easily add this feature with <a href="%s" target="_blank">SimpleForm Contact Form Submissions</a> addon. You find it on the WordPress.org plugin repository.', 'simpleform' ), esc_url( 'https://wordpress.org/plugins/simpleform-contact-form-submissions/' ) ).'</div>';
	}
	else {
    if ( ! class_exists( 'SimpleForm_Submissions' ) ) {	
     echo '<div id="empty-submission"><h3><span class="dashicons dashicons-info"></span>'.esc_html__('Empty Inbox', 'simpleform' ).'</h3>'.
esc_html__('So far, no message has been received yet!', 'simpleform' ).'<p>'.sprintf( __('Submissions data are not store into the WordPress database by default. You can easily add this feature with <b>SimpleForm Contact Form Submissions</b> addon activation. Go to the <a href="%s">Plugins</a> page.', 'simpleform' ), esc_url( $admin_url ) ) . '</div>';
	}
	}
	}

 endif;
?>

</div>