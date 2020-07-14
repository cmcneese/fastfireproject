<?php

/**
 * The customized class that extends the WP_List_Table class.
 *
 * @since      1.0
 */
		
if ( ! defined( 'ABSPATH' ) ) { exit; }

class SForms_Submissions_List_Table extends WP_List_Table  {

	/**
	 * Override the parent constructor to pass our own arguments.
	 *
	 * @since    1.0
	 */

    function __construct() {
        parent::__construct(array(
           'singular' => 'sform-entrie',
           'plural' => 'sform-entries',
           'ajax'      => false 
        ));
    }
     
	/**
	 * Return string of conditions for MySQL query.
	 *
	 * @since    1.3
	 */   
	
    function get_query_conditions() { 
        $sform_settings = get_option('sform-settings');	
        $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';
    	$keyword = ( isset( $_REQUEST['s'] ) ) ? sanitize_text_field($_REQUEST['s']) : '';
        if( $keyword != '') {	 
          if ( $ip_storing == 'true'  ) { $where_keyword = 'WHERE object != %s AND object != %s AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR ip LIKE %s OR email LIKE %s OR phone LIKE %s)'; }
          else { $where_keyword = 'WHERE object != %s AND object != %s AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR email LIKE %s OR phone LIKE %s)'; }
        }
        else { $where_keyword = 'WHERE object != %s AND object != %s'; }
	    $date = ( isset( $_REQUEST['date'] ) ? sanitize_text_field($_REQUEST['date']) : '');
        if( $date != ''){	 
	      if ( $date == 'last_day' ) { $where_date = " AND ( date >= UTC_TIMESTAMP() - INTERVAL 24 HOUR )"; }
	      if ( $date == 'last_week' ) { $where_date = " AND ( date >= UTC_TIMESTAMP() - INTERVAL 7 DAY )"; }
	      if ( $date == 'last_month' ) { $where_date = " AND ( date >= UTC_TIMESTAMP() - INTERVAL 30 DAY )"; }
	      if ( $date == 'current_year' ) { $where_date = " AND ( YEAR(date) = YEAR(CURDATE()) )"; }
	      if ( $date == 'last_year' ) { $where_date = " AND ( date >= UTC_TIMESTAMP() - INTERVAL 1 YEAR )"; }
	      if ( $date != 'last_day' && $date != 'last_week' && $date != 'last_month' && $date != 'current_year' && $date != 'last_year' ) { $where_date = " AND ( YEAR(date) = %d )"; }
	    }
        else { $where_date = ""; }
        $where = $where_keyword . $where_date;
        return $where;
    }
     
	/**
	 * Return array of placeholders for MySQL query.
	 *
	 * @since    1.3
	 */   
	
    function get_query_placeholders() { 
        $sform_settings = get_option('sform-settings');	
        $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';
    	global $wpdb;
    	$keyword = isset( $_REQUEST['s'] ) ? sanitize_text_field($_REQUEST['s']) : '';
		$search = !empty($keyword) ? '%'.$wpdb->esc_like($keyword).'%' : '';						
		$value1 = ''; 
		$value2 = 'not stored'; 
        if( $keyword != ''){	 
          if ( $ip_storing == 'true'  ) { $placeholders_array = array($value1, $value2, $search, $search, $search, $search, $search, $search, $search); }
          else { $placeholders_array = array($value1, $value2, $search, $search, $search, $search, $search, $search); }
        }
        else { $placeholders_array = array($value1, $value2); }
	    $date = ( isset( $_REQUEST['date'] ) ? sanitize_text_field($_REQUEST['date']) : '');
        if( $date != ''){	 
	      if ( $date == 'last_day' ) { $date_placeholders = array(); }
	      if ( $date == 'last_week' ) { $date_placeholders = array(); }
	      if ( $date == 'last_month' ) { $date_placeholders = array(); }
	      if ( $date == 'current_year' ) { $date_placeholders = array(); }
	      if ( $date == 'last_year' ) { $date_placeholders = array(); }
	      if ( $date != 'last_day' && $date != 'last_week' && $date != 'last_month' && $date != 'current_year' && $date != 'last_year' ) { $date_placeholders = array($date); }
	    }
        else { $date_placeholders = array(); }
        $placeholders = array_merge($placeholders_array, $date_placeholders);
        return $placeholders;
    }
     
	/**
	 * Return a list of views available for the submissions.
	 *
	 * @since    1.3
	 */   
	
	function get_views() { 
        $views = array();
        $current = ( !empty($_REQUEST['view']) ? $_REQUEST['view'] : 'inbox');
        $search_order = isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc')) ? $_REQUEST['order'] : '';
        $search_orderby = isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array('subject', 'email', 'date')) ? $_REQUEST['orderby'] : ''; 
	    global $wpdb;
        $where = $this->get_query_conditions();
        $placeholders = $this->get_query_placeholders();        
        $sql = $wpdb->prepare("SELECT status FROM {$wpdb->prefix}sform_submissions $where", $placeholders );
        $status_array = $wpdb->get_col($sql);
        $count_sql_inbox = count($status_array) - count(array_keys($status_array, "trash"));
        $count_sql_trashed = count(array_keys($status_array, "trash"));
        $count_inbox = !is_null($count_sql_inbox) ? $count_sql_inbox : 0;
        $class = ($current == 'inbox' ? ' class="current"' :'');
        $all_url = remove_query_arg( array( 'view', 'paged' ) );
        $views['inbox'] = "<a id='view-all' href='{$all_url }' {$class} >".__( 'Inbox', 'simpleform-submissions' )."</a> (" . $count_inbox . ")";   
        $count_trashed = !is_null($count_sql_trashed) ? $count_sql_trashed : 0;
        $old_query_or_uri = remove_query_arg('paged');
        $trashed_url = add_query_arg( 'view','trash', $old_query_or_uri);
        $class = ($current == 'trash' ? ' class="current"' :'');
        $views['trash'] = "<a id='view-trash' href='{$trashed_url}' {$class} >".__( 'Trash', 'simpleform-submissions' )."</a> (" . $count_trashed . ")";
        $sform_screen_options = $current . ';' . $count_inbox . ';' . $count_trashed . ';' . $search_order . ';' . $search_orderby;
        update_option( 'sform_screen_options', $sform_screen_options, false );
        return $views;
    }
    
	/**
	 * Define the columns that are going to be used in the table.
	 *
	 * @since    1.0
	 */

    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'subject' => __('Subject', 'simpleform-submissions'),
            'object' => __('Message', 'simpleform-submissions'), 
            'email' => __('Email', 'simpleform-submissions'),
            'entry' => __('Date', 'simpleform-submissions')
        );
        return $columns;
    }    
      
	/**
	 * Text displayed when no record data is available.
	 *
	 * @since    1.0
	 */

    function no_items() {
      _e('No submissions found', 'simpleform-submissions');
    }    
    
	/**
	 * Render the checkbox column.
	 *
	 * @since    1.0
	 */

    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            esc_attr($item['id'])
        );
    }
   
	/**
	 * Render the subject column with actions.
	 *
	 * @since    1.0
	 */

    function column_subject($item) {
	   $pagenum = isset( $_REQUEST['paged'] ) ? absint($_REQUEST['paged']) : 0;
	   $admin_page_url =  admin_url( 'admin.php' );
	   $search_orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : ''; 
	   $search_order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : '';
       $search_date = isset ( $_REQUEST['date'] ) ? sanitize_text_field($_REQUEST['date']) : '';
       $search_key = isset( $_REQUEST['s'] ) ? sanitize_text_field($_REQUEST['s']) : '';
       $search_view = isset( $_REQUEST['view'] ) ? sanitize_text_field($_REQUEST['view']) : 'inbox';
       $sform_screen_options = get_option( 'sform_screen_options' );
 	   if ( $item['status'] == 'trash' )  {    
   		 $current_page = $this->get_pagenum();
		 $sform_count_trashed = explode(';', $sform_screen_options)[2];
		 $per_page = $this->get_items_per_page('edit_submission_per_page', 20);
         $total_pages = ceil( ($sform_count_trashed - 1) / $per_page );
		 if ( $current_page > $total_pages ) { $pagenum = $total_pages; } 
		 else { $pagenum = $pagenum; }
  	     $query_args_restored = array(
			'page'		=> wp_unslash( $_REQUEST['page'] ),
			'view'      => $search_view,
            'date'  => $search_date, 
            's' => $search_key,
            'paged' => $pagenum,
            'order' => $search_order,
            'orderby' => $search_orderby,
			'action'	=> 'untrash',
			'id'		=> esc_attr($item['id']),
			'_wpnonce'	=> wp_create_nonce( 'restore_nonce' ),
		 );
		 $restore_link = esc_url( add_query_arg( $query_args_restored, $admin_page_url ) );		    
 	     $query_args_delete = array(
			'page'		=> wp_unslash( $_REQUEST['page'] ),
			'view'      => $search_view,
            'paged' => $pagenum,
            'order' => $search_order,
            'orderby' => $search_orderby,
            'date'  => $search_date, 
            's' => $search_key,
			'action'	=> 'delete',
			'id'		=> esc_attr($item['id']),
			'_wpnonce'	=> wp_create_nonce( 'delete_nonce' ),
		 );
		 $delete_link = esc_url( add_query_arg( $query_args_delete, $admin_page_url ) );
         $actions = array(
            'view' => sprintf('<a href="?page='.$this->_args['singular'].'&id=%s&view='.$search_view.'&paged='.$current_page.'&order='.$search_order.'&orderby='.$search_orderby.'&date='.$search_date.'&s='.$search_key.'">%s</a>', esc_attr($item['id']), __('View', 'simpleform-submissions')),
            'untrash' => sprintf('<a href="' . $restore_link . '">' . __( 'Restore', 'simpleform-submissions') . '</a>'),
            'delete' => '<a href="' . $delete_link . '">' . __( 'Delete', 'simpleform-submissions' ) . '</a>',            
         );        
         }
        else  { 
   		 $current_page = $this->get_pagenum();
	     $sform_count_inbox =  explode(';', $sform_screen_options)[1];
		 $per_page = $this->get_items_per_page('edit_submission_per_page', 20);
         $total_pages = ceil( ($sform_count_inbox - 1) / $per_page );
		 if ( $current_page > $total_pages ) { $pagenum = $total_pages; } 
		 else { $pagenum = $pagenum; }
    	 $query_args_trash = array(
			'page'		=> wp_unslash( $_REQUEST['page'] ),
			'view'      => $search_view,
            'date'  => $search_date, 
            's' => $search_key,
            'paged' => $pagenum,
            'order' => $search_order,
            'orderby' => $search_orderby,
			'action'	=> 'trash',
			'id'		=> esc_attr($item['id']),
			'_wpnonce'	=> wp_create_nonce( 'trash_nonce' ),
		 );
		 $trash_link = esc_url( add_query_arg( $query_args_trash, $admin_page_url ) );		            
         $actions = array(
            'view' => sprintf('<a href="?page='.$this->_args['singular'].'&id=%s&view='.$search_view.'&paged='.$current_page.'&order='.$search_order.'&orderby='.$search_orderby.'&date='.$search_date.'&s='.$search_key.'">%s</a>', esc_attr($item['id']), __('View', 'simpleform-submissions')),
            'trash' => sprintf('<a href="' . $trash_link . '">' . __( 'Move to Trash', 'simpleform-submissions' ) . '</a>'),
         );
        }
	    $subject = $item['subject'] != '' && $item['subject'] != 'not stored' ? esc_attr($item['subject']) : esc_attr__( 'No Subject', 'simpleform-submissions' );
        return sprintf('%s %s', $subject, $this->row_actions($actions));
    }
    
	/**
	 * Render the message column.
	 *
	 * @since    1.0
	 */

    function column_object($item) {
        return esc_attr($item['object']);
    }

	/**
	 * Render the email column.
	 *
	 * @since    1.0
	 */

    function column_email($item) {
	   $email = $item['email'] != '' && $item['email'] != 'not stored' ? esc_attr($item['email']) : esc_attr__( 'No Email', 'simpleform-submissions' );	    
       return '<span style="letter-spacing: -0.5px;">' . $email . '</span>' ;
    }

	/**
	 * Render the date column.
	 *
	 * @since    1.0
	 */

    function column_entry($item) {
        $tzcity = get_option('timezone_string'); 
        $tzoffset = get_option('gmt_offset');
        if ( ! empty($tzcity))  { 
        $current_time_timezone = date_create('now', timezone_open($tzcity));
        $timezone_offset =  date_offset_get($current_time_timezone);
        $submission_timestamp = strtotime($item['date']) + $timezone_offset; 
        }
        else { 
        $timezone_offset =  $tzoffset * 3600;
        $submission_timestamp = strtotime(esc_attr($item['date'])) + $timezone_offset;  
        }
        return date_i18n(get_option('date_format'),$submission_timestamp).' '.esc_html__('at', 'simpleform-submissions').' '.date_i18n(get_option('time_format'),$submission_timestamp );
    }

	/**
	 * Decide which columns to activate the sorting functionality on.
	 *
	 * @since    1.0
	 */

    function get_sortable_columns() {
       $sortable_columns = array('subject' => array('subject', true),'email' => array('email', true),'entry' => array('date', true));
       return $sortable_columns;
    }

	/**
	 * Process the bulk actions.
	 *
	 * @since    1.0
	 */

    function process_bulk_action() {
       global $wpdb;
       if ('delete' === $this->current_action()) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'delete_nonce' ) ) { $this->invalid_nonce_redirect(); }
            else { $id = isset($_REQUEST['id']) ? absint($_REQUEST['id']) : '';
             if (!empty($id)) { 
	            $success = $wpdb->query( $wpdb->prepare("DELETE FROM {$wpdb->prefix}sform_submissions WHERE status = 'trash' AND id = %d", $id) ); 
   	            if ( $success ):    
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( __( 'Submission with ID: %s permanently deleted', 'simpleform-submissions' ), $id ) .'</p></div>'; 
                set_transient( 'sform_action_notice', $action_notice, 5 ); 
                endif; 
	         }
            }
      }
      if ('trash' === $this->current_action() ) { 
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'trash_nonce' ) ) { $this->invalid_nonce_redirect(); }
			else { $id = isset($_REQUEST['id']) ? absint($_REQUEST['id']) : '';
             if (!empty($id)) { 
	            $trash_date = date('Y-m-d H:i:s');
	            $success = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}sform_submissions SET status = 'trash', trash_date = '$trash_date' WHERE status = 'new' AND id = %d", $id) );
	            if ( $success ):    
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( __( 'Submission with ID: %s successfully moved to the Trash', 'simpleform-submissions' ), $id ) .'</p></div>'; 
                set_transient( 'sform_action_notice', $action_notice, 5 ); 
                endif; 
             }
            }
       }
       if ('untrash' === $this->current_action()) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'restore_nonce' ) ) { $this->invalid_nonce_redirect(); }
			else { $id = isset($_REQUEST['id']) ? absint($_REQUEST['id']) : '';
             if (!empty($id)) { 
	            $success = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}sform_submissions SET status = 'new', trash_date = '0000-00-00 00:00:00' WHERE status = 'trash' AND id = %d", $id) );
 	            if ( $success ):    
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( __( 'Submission with ID: %s successfully restored from the Trash', 'simpleform-submissions' ), $id ) .'</p></div>'; 
                set_transient( 'sform_action_notice', $action_notice, 5 ); 
                endif; 
             }   
            }
       }
	   if ( 'bulk-delete' === $this->current_action() ) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'bulk-sform-entries' ) ) { $this->invalid_nonce_redirect(); }
			else {   	        
            // Force $ids to be an array if it's not already one by creating a new array and adding the current value
            $ids = isset($_REQUEST['id']) && is_array($_REQUEST['id']) ? $_REQUEST['id'] : array($_REQUEST['id']);
            // Ensure that the values passed are all positive integers
            $ids = array_map('absint', $ids);
            // Count the number of values
            $ids_count = count($ids);
            // Prepare the right amount of placeholders in an array
            $placeholders_array = array_fill(0, $ids_count, '%s');
            // Chains all the placeholders into a comma-separated string
            $placeholders = implode(',', $placeholders_array);
            if (!empty($ids)) { 	            
	            $success = $wpdb->query( $wpdb->prepare("DELETE FROM {$wpdb->prefix}sform_submissions WHERE status = 'trash' AND id IN($placeholders)", $ids) ); }
 	            if ( $success ):    
	            $messages = implode(',', $ids); 
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( _n( 'Submission with ID: %s permanently deleted', 'Submissions with ID: %s permanently deleted', $ids_count, 'simpleform-submissions' ), $messages ) .'</p></div>'; 
              set_transient( 'sform_action_notice', $action_notice, 5 ); 
                endif; 
            }
	   }
	   if ( 'bulk-trash' === $this->current_action() ) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'bulk-sform-entries' ) ) { $this->invalid_nonce_redirect(); }
			else {   	        
              $ids = isset($_REQUEST['id']) && is_array($_REQUEST['id']) ? $_REQUEST['id'] : array($_REQUEST['id']);
              $ids = array_map('absint', $ids);
              $ids_count = count($ids);
              $placeholders_array = array_fill(0, $ids_count, '%s');
              $placeholders = implode(',', $placeholders_array);
              if (!empty($ids)) { 	            
	            $trash_date = date('Y-m-d H:i:s');
	            $success = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}sform_submissions SET status = 'trash', trash_date = '$trash_date' WHERE status = 'new' AND id IN($placeholders)", $ids) ); 
 	            if ( $success ):    
	            $messages = implode(',', $ids); 
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( _n( 'Submission with ID: %s successfully moved to the Trash', 'Submissions with ID: %s successfully moved to the Trash', $ids_count, 'simpleform-submissions' ), $messages ) .'</p></div>'; 
                set_transient( 'sform_action_notice', $action_notice, 5 ); 
                endif; 
              }                
            }
	   }
	   if ( 'bulk-untrash' === $this->current_action() ) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'bulk-sform-entries' ) ) { $this->invalid_nonce_redirect(); }
			else {   	        
              $ids = isset($_REQUEST['id']) && is_array($_REQUEST['id']) ? $_REQUEST['id'] : array($_REQUEST['id']);
              $ids = array_map('absint', $ids);
              $ids_count = count($ids);
              $placeholders_array = array_fill(0, $ids_count, '%s');
              $placeholders = implode(',', $placeholders_array);
              if (!empty($ids)) { 	      
	            $success = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}sform_submissions SET status = 'new', trash_date = '0000-00-00 00:00:00' WHERE status = 'trash' AND id IN($placeholders)", $ids) ); 
            	if ( $success ):
			    $messages = implode(',', $ids); 
	            $action_notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( _n( 'Submission with ID: %s successfully restored from the Trash', 'Submissions with ID: %s successfully restored from the Trash', $ids_count, 'simpleform-submissions' ), $messages ) .'</p></div>'; 
                set_transient( 'sform_action_notice', $action_notice, 5 ); 
 	            endif; 
              }                
            }
		}
    }
    
	/**
	 * Die when the nonce check fails.
	 *
	 * @since    1.0
	 */

	function invalid_nonce_redirect() {
		wp_die( __( 'Invalid Nonce', 'simpleform-submissions' ),__( 'Error', 'simpleform-submissions' ), array( 'response' 	=> 403, 'back_link' =>  esc_url( add_query_arg( array( 'page' => wp_unslash( $_REQUEST['page'] ) ) , admin_url( 'admin.php' ) ) ) ) );
	}
	
	/**
	 * Overwrite the pagination.
	 *
	 * @since 1.0
	 */
	 
	function pagination( $which ) {
		if ( empty( $this->_pagination_args ) ) { return; }
		$total_items = $this->_pagination_args['total_items'];
		$total_pages = $this->_pagination_args['total_pages'];
		$infinite_scroll = false;
		if ( isset( $this->_pagination_args['infinite_scroll'] ) ) { $infinite_scroll = $this->_pagination_args['infinite_scroll']; }
		if ( 'top' === $which && $total_pages > 1 ) { $this->screen->render_screen_reader_content( 'heading_pagination' ); }
		$output = '<span class="displaying-num">' . sprintf(_n( '%s submission', '%s submissions', $total_items, 'simpleform-submissions' ),number_format_i18n( $total_items )) . '</span>';
		$current = $this->get_pagenum();
		$removable_query_args = wp_removable_query_args();
		$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		$current_url = remove_query_arg( $removable_query_args, $current_url );
		$page_links = array();
		$total_pages_before = '<span class="paging-input">';
		$total_pages_after  = '</span></span>';
		$disable_first = false;
		$disable_last  = false;
		$disable_prev  = false;
		$disable_next  = false;
		if ( $current == 1 ) {
			$disable_first = true;
			$disable_prev  = true;
		}
		if ( $current == 2 ) {
			$disable_first = true;
		}
		if ( $current == $total_pages ) {
			$disable_last = true;
			$disable_next = true;
		}
		if ( $current == $total_pages - 1 ) {
			$disable_last = true;
		}
		if ( $disable_first ) {
			$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>';
		} else {
			$page_links[] = sprintf(
				"<a class='first-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
				esc_url( remove_query_arg( 'paged', $current_url ) ),
				__( 'First page' ),
				'&laquo;'
			);
		}
		if ( $disable_prev ) {
			$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>';
		} else {
			$page_links[] = sprintf(
				"<a class='prev-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
				esc_url( add_query_arg( 'paged', max( 1, $current - 1 ), $current_url ) ),
				__( 'Previous page' ),
				'&lsaquo;'
			);
		}
		if ( 'bottom' === $which ) {
			$html_current_page  = $current;
			$total_pages_before = '<span class="screen-reader-text">' . __( 'Current Page' ) . '</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">';
		} else {
			$html_current_page = sprintf(
				"%s<input class='current-page' id='current-page-selector' type='text' name='paged' value='%s' size='%d' aria-describedby='table-paging' /><span class='tablenav-paging-text'>",
				'<label for="current-page-selector" class="screen-reader-text">' . __( 'Current Page' ) . '</label>',
				$current,
				strlen( $total_pages )
			);
		}
		$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
		$page_links[]     = $total_pages_before . sprintf(
			_x( '%1$s of %2$s', 'paging' ),
			$html_current_page,
			$html_total_pages
		) . $total_pages_after;

		if ( $disable_next ) {
			$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>';
		} else {
			$page_links[] = sprintf(
				"<a class='next-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
				esc_url( add_query_arg( 'paged', min( $total_pages, $current + 1 ), $current_url ) ),
				__( 'Next page' ),
				'&rsaquo;'
			);
		}
		if ( $disable_last ) {
			$page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span>';
		} else {
			$page_links[] = sprintf(
				"<a class='last-page button' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
				esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
				__( 'Last page' ),
				'&raquo;'
			);
		}
		$pagination_links_class = 'pagination-links';
		if ( ! empty( $infinite_scroll ) ) {
			$pagination_links_class .= ' hide-if-js';
		}
		$output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';
		if ( $total_pages ) {
			$page_class = $total_pages < 2 ? ' one-page' : '';
		} else {
			$page_class = ' no-pages';
		}
		$this->_pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";
		echo $this->_pagination;
	}

	/**
	 * Add a date filter.
	 *
	 * @since 1.2
	 */
	 
    function extra_tablenav( $which ) {
        global $wpdb;
        if ( $which == "top" ){
			$keyword = ( isset( $_REQUEST['s'] ) ) ? sanitize_text_field($_REQUEST['s']) : '';
	    	$search = !empty($keyword) ? '%'.$wpdb->esc_like($keyword).'%' : '';						
		    $value1 = ''; 
		    $value2 = 'not stored'; 
            $sform_settings = get_option('sform-settings');	
            $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';
            $view = isset( $_REQUEST['view'] ) ? sanitize_text_field($_REQUEST['view']) : 'inbox';
            if( $keyword != ''){	 
             if ( $ip_storing == 'true'  ) {
	         $sql_oldest_date = $wpdb->prepare("SELECT date FROM {$wpdb->prefix}sform_submissions WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR ip LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY date LIMIT 1", $value1, $value2, $search, $search, $search, $search, $search, $search, $search );
	         $sql_last_date = $wpdb->prepare("SELECT date FROM {$wpdb->prefix}sform_submissions WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR ip LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY date DESC LIMIT 1", $value1, $value2, $search, $search, $search, $search, $search, $search, $search );
            }
             else {	
	         $sql_oldest_date = $wpdb->prepare("SELECT date FROM {$wpdb->prefix}sform_submissions WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY date LIMIT 1", $value1, $value2, $search, $search, $search, $search, $search, $search );
	         $sql_last_date = $wpdb->prepare("SELECT date FROM {$wpdb->prefix}sform_submissions WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY date DESC LIMIT 1", $value1, $value2, $search, $search, $search, $search, $search, $search );
             }
            }
            else {	 
	         $sql_oldest_date = "SELECT date FROM {$wpdb->prefix}sform_submissions ORDER BY date LIMIT 1";
 	         $sql_last_date = "SELECT date FROM {$wpdb->prefix}sform_submissions ORDER BY date DESC LIMIT 1";
            }
            $date_oldest = $wpdb->get_var($sql_oldest_date);
            $last_date = $wpdb->get_var($sql_last_date);
            $current_year = date('Y', strtotime('now'));
            $oldest_year = date('Y', strtotime($date_oldest));
            $years_time_range = $current_year - $oldest_year;
    	    if ( strtotime($date_oldest) <= strtotime('-1 days') ) {
            echo '<select name="date" class="" id="date" style="max-width: none !important;">
            <option value="">' . __('All Dates', 'simpleform-submissions') .'</option>';
    	      if ( strtotime($last_date) >= strtotime('-1 days') ) {
		       $selected = '';
               if( isset($_REQUEST['date']) && $_REQUEST['date'] == 'last_day' && strtotime('-1 days') <= strtotime($last_date) ){
               $selected = ' selected = "selected"';   
               }
               echo '<option value="last_day" '.$selected.'>' . __('Last Day', 'simpleform-submissions') .'</option>';
               }
    	       if ( strtotime($last_date) >= strtotime('-7 days') ) {
		       $selected = '';
               if( isset($_REQUEST['date']) && $_REQUEST['date'] == 'last_week' && strtotime('-7 days') <= strtotime($last_date) ){
               $selected = ' selected = "selected"';   
               }
               echo '<option value="last_week" '.$selected.'>' . __('Last Week', 'simpleform-submissions') .'</option>';
               }
    	       if ( strtotime($last_date) >= strtotime('-30 days') ) {
		       $selected = '';
               if( isset($_REQUEST['date']) && $_REQUEST['date'] == 'last_month'  && strtotime('-30 days') <= strtotime($last_date) ){
               $selected = ' selected = "selected"';   
               }
               echo '<option value="last_month" '.$selected.'>' . __('Last Month', 'simpleform-submissions') .'</option>';
               }
    	       if ( strtotime($last_date) >= strtotime('first day of january this year') ) {
		       $selected = '';
               if( isset($_REQUEST['date']) && $_REQUEST['date'] == 'current_year'  && strtotime('first day of january this year') <= strtotime($last_date) ){
               $selected = ' selected = "selected"';   
               }
               echo '<option value="current_year" '.$selected.'>' . __('Current Year', 'simpleform-submissions') .'</option>';
               }
    	       if ( strtotime($last_date) >= strtotime('-1 year') ) {
		       $selected = '';
               if( isset($_REQUEST['date']) && $_REQUEST['date'] == 'last_year'  && strtotime('-1 year') <= strtotime($last_date) ){
               $selected = ' selected = "selected"';   
               }
               echo '<option value="last_year" '.$selected.'>' . __('Last Year', 'simpleform-submissions') .'</option>';
               }
               for ($i=1; $i<=$years_time_range; $i++) {
               $option_year = $current_year - $i;
               $request_year = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sform_submissions WHERE YEAR(date)='$option_year' ", ARRAY_A);            
	           if ( $request_year ) { 
		           $selected = '';
	               if( isset($_REQUEST['date']) && $_REQUEST['date'] == $option_year ) {
                   $selected = ' selected = "selected"';                    	
                   }
                   echo '<option value="'.$option_year.'" '.$selected.'>' . $option_year .'</option>';
	           }
            }
	        echo '</select>';
        } 
        echo '<input id="my-post-query-submit" class="button" type="submit" value="'. __("Filter", "simpleform-submissions") .'" name="" style="margin-right: 10px;">';
        } 
    } 
    
	/**
	 * Overwrite the table navigation removing the wp_nonce_field execution.
	 *
	 * @since    1.0
	 */

    function display_tablenav( $which ) {
       wp_nonce_field( 'bulk-' . $this->_args['plural'] );
       echo '<div class="tablenav ' . esc_attr( $which ) .'"><div class="alignleft actions">'; 
       $this->bulk_actions(); 
       echo '</div>';
       $this->extra_tablenav( $which );
       $this->pagination( $which );
       echo '<br class="clear" /></div>';
    }    
    
	/**
	 * Override search_box() function.
	 *
	 * @since    1.1
	 */
    
    function search_box( $text, $input_id ) {
      echo '<p class="search-box"><label class="screen-reader-text" for="'.$input_id.'">'.$text.':</label><input type="search" id="'.$input_id.'" name="s" value="';
      _admin_search_query(); 
      echo '" placeholder="' . __('Enter keyword to search', 'simpleform-submissions') .'" />';
      submit_button( $text, 'button', false, false, array('id' => 'search-submit') );
      echo '</p>';
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements.
	 *
	 * @since    1.0
	 */
 
 	function prepare_items() {
	    $per_page = $this->get_items_per_page('edit_submission_per_page', 20);
        $view = ( isset($_REQUEST['view']) ? sanitize_text_field($_REQUEST['view']) : 'inbox');
        if ($view == 'inbox') { $filter_by_view = " AND status != 'trash'"; }
        if ($view == 'trash') { $filter_by_view = " AND status = 'trash'"; }
	    $current_page = $this->get_pagenum();
		if ( 1 < $current_page ) { $paged = $per_page * ( $current_page - 1 ); } 
		else { $paged = 0; }
        $this->process_bulk_action();
	    $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id'; 
		$order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';
		global $wpdb;
        $where = $this->get_query_conditions() . $filter_by_view;
        $placeholders = $this->get_query_placeholders();
        $pagination_placeholders = array_merge($placeholders, array($per_page, $paged) );
        $sql1 = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}sform_submissions $where ORDER BY $orderby $order LIMIT %d OFFSET %d", $pagination_placeholders );
	    $sql2 = $wpdb->prepare("SELECT COUNT(id) FROM {$wpdb->prefix}sform_submissions $where", $placeholders );
        $items = $wpdb->get_results( $sql1, ARRAY_A );
		$this->_column_headers = $this->get_column_info();
        $count = $wpdb->get_var( $sql2 );
		$this->items = $items;
		$this->set_pagination_args( array('total_items' => $count,'per_page' => $per_page,'total_pages' => ceil( $count / $per_page )) );
    }
		
}