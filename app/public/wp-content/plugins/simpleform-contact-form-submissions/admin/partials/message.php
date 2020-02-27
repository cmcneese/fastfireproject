<?php
if ( ! defined( 'WPINC' ) ) die;

global $wpdb;
$table_name = $wpdb->prefix . 'sform_submissions'; 
$id = isset( $_REQUEST['id'] ) ? absint($_REQUEST['id']) : '';

if (!empty($id)) { $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A); }
add_meta_box('sform_entrie_meta_box', __('Request ID', 'simpleform-submissions').': ' . $id, array ($this, 'sform_entrie_meta_box_handler'), 'view_sform_entrie', 'normal', 'default');
$sform_settings = get_option('sform-settings'); 
$icon = version_compare(get_bloginfo('version'),'5.0', '>=') ? 'dashicons-buddicons-pm' : 'dashicons-media-text';
?>

<div class="wrap"><h1 class="backend2"><span class="dashicons <?php echo $icon; ?>"></span><?php esc_html_e( 'Submitted Message', 'simpleform-submissions' );?>
<span class="backlist"><a class="return-list" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=sform-submissions');?>">
<?php _e('Back to Submissions list', 'simpleform-submissions')?></a></span></h1>  
<input type="hidden" name="id" value="<?php echo esc_attr($item['id']) ?>"/><div class="metabox-holder" id="poststuff"><div id="post-body"><div id="post-body-content">
<?php do_meta_boxes('view_sform_entrie', 'normal', $item); ?></div></div></div></div>