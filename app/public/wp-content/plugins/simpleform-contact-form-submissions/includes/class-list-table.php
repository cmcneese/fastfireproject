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
	   $query_args_deleted = array(
			'page'		=> wp_unslash( $_REQUEST['page'] ),
            'paged' => $pagenum,
            'order' => $search_order,
            'orderby' => $search_orderby,
			'action'	=> 'delete',
			'id'		=> esc_attr($item['id']),
			'_wpnonce'	=> wp_create_nonce( 'delete_nonce' ),
		);
		$delete_link = esc_url( add_query_arg( $query_args_deleted, $admin_page_url ) );
        $actions = array(
            'view' => sprintf('<a href="?page='.$this->_args['singular'].'&id=%s">%s</a>', esc_attr($item['id']), __('View', 'simpleform-submissions')),
            'delete' => '<a href="' . $delete_link . '">' . __( 'Delete', 'simpleform-submissions' ) . '</a>',            
        );        
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
	 * Return array of bult actions if has any.
	 *
	 * @since    1.0
	 */

    function get_bulk_actions() {
        $actions = array('bulk-delete' => __('Delete', 'simpleform-submissions'));
        return $actions;
    }

	/**
	 * Process the bulk actions.
	 *
	 * @since    1.0
	 */

    function process_bulk_action() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sform_submissions'; 
        if ('delete' === $this->current_action()) {
	        $nonce = isset ( $_REQUEST['_wpnonce'] ) ? wp_unslash($_REQUEST['_wpnonce']) : '';
			if ( ! wp_verify_nonce( $nonce, 'delete_nonce' ) ) { $this->invalid_nonce_redirect();}
            else {
            $id = isset($_REQUEST['id']) ? absint($_REQUEST['id']) : '';
            if (!empty($id)) { $wpdb->query( $wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id) ); }
            }
        }
        		
		if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] === 'bulk-delete' ) || ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] === 'bulk-delete' ) ) {
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
            if (!empty($ids)) { $wpdb->query( $wpdb->prepare("DELETE FROM $table_name WHERE id IN($placeholders)", $ids) ); }
            }
		}
    }
    
	/**
	 * Die when the nonce check fails.
	 *
	 * @since    1.0
	 */

	function invalid_nonce_redirect() {
		wp_die( __( 'Invalid Nonce', 'simpleform-submissions' ),__( 'Error', 'simpleform-submissions' ),
				array( 'response' 	=> 403, 'back_link' =>  esc_url( add_query_arg( array( 'page' => wp_unslash( $_REQUEST['page'] ) ) , admin_url( 'admin.php' ) ) ) ) );
	}
	
	/**
	 * Overwrite the pagination.
	 *
	 * @since 1.0
	 */
	 
	function pagination( $which ) {
		if ( empty( $this->_pagination_args ) ) {
			return;
		}

		$total_items     = $this->_pagination_args['total_items'];
		$total_pages     = $this->_pagination_args['total_pages'];
		$infinite_scroll = false;
		if ( isset( $this->_pagination_args['infinite_scroll'] ) ) {
			$infinite_scroll = $this->_pagination_args['infinite_scroll'];
		}

		if ( 'top' === $which && $total_pages > 1 ) {
			$this->screen->render_screen_reader_content( 'heading_pagination' );
		}

		$output = '<span class="displaying-num">' . sprintf(_n( '%s submission', '%s submissions', $total_items, 'simpleform-submissions' ),number_format_i18n( $total_items )) . '</span>';

		$current              = $this->get_pagenum();
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
	 * Overwrite the table navigation removing the wp_nonce_field execution.
	 *
	 * @since    1.0
	 */

    function display_tablenav( $which ) {
       wp_nonce_field( 'bulk-' . $this->_args['plural'] );
       ?><div class="tablenav <?php echo esc_attr( $which ); ?>"><div class="alignleft actions"><?php $this->bulk_actions(); ?></div>
        <?php
        $this->extra_tablenav( $which );
        $this->pagination( $which );
        ?><br class="clear" /></div><?php
    }    
    
	/**
	 * Override search_box() function.
	 *
	 * @since    1.1
	 */
    
    function search_box( $text, $input_id ) { 
	  $placeholder_text = __('Enter keyword to search', 'simpleform-submissions');
      ?>
      <p class="search-box">
      <label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
      <input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>" placeholder="<?php echo apply_filters('sforms_search_box', $placeholder_text) ?>" />
      <?php submit_button( $text, 'button', false, false, array('id' => 'search-submit') );  ?>
      </p>
      <?php 
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements.
	 *
	 * @since    1.0
	 */
 
 	function prepare_items() {
			global $wpdb;
			$per_page = $this->get_items_per_page('submissions_per_page', 10); 
			$current_page = $this->get_pagenum();
			if ( 1 < $current_page ) { $paged = $per_page * ( $current_page - 1 ); } 
			else { $paged = 0; }
            $this->process_bulk_action();
			$table_name = $wpdb->prefix . 'sform_submissions';
			$keyword = ( isset( $_REQUEST['s'] ) ) ? sanitize_text_field($_REQUEST['s']) : '';
			$search = '%'.$wpdb->esc_like($keyword).'%';						
		    $value1 = ''; 
		    $value2 = 'not stored'; 
            $sform_settings = get_option('sform-settings');	
            $ip_storing = ! empty( $sform_settings['ip-storing'] ) ? esc_attr($sform_settings['ip-storing']) : 'true';
		    $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id'; 
		    $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';
            if( $keyword != ''){	 
             if ( $ip_storing == 'true'  ) {
	         $sql1 = $wpdb->prepare("SELECT * FROM $table_name WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR ip LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY $orderby $order LIMIT %d OFFSET %d", $value1, $value2, $search, $search, $search, $search, $search, $search, $search, $per_page, $paged );
	         $sql2 = $wpdb->prepare("SELECT COUNT(id) FROM $table_name WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR ip LIKE %s OR email LIKE %s OR phone LIKE %s)", $value1, $value2, $search, $search, $search, $search, $search, $search, $search );
            }
             else {	
			 $sql1 = $wpdb->prepare("SELECT * FROM $table_name WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR email LIKE %s OR phone LIKE %s) ORDER BY $orderby $order LIMIT %d OFFSET %d", $value1, $value2, $search, $search, $search, $search, $search, $search, $per_page, $paged );
	         $sql2 = $wpdb->prepare("SELECT COUNT(id) FROM $table_name WHERE ( object != %s AND object != %s ) AND (name LIKE %s OR lastname LIKE %s OR subject LIKE %s OR object LIKE %s OR email LIKE %s OR phone LIKE %s)", $value1, $value2, $search, $search, $search, $search, $search, $search );
             }
            }
            else {	
			 $sql1 = $wpdb->prepare("SELECT * FROM $table_name WHERE object != %s AND object != %s ORDER BY $orderby $order LIMIT %d OFFSET %d", $value1, $value2, $per_page, $paged );
	         $sql2 = $wpdb->prepare("SELECT COUNT(id) FROM $table_name WHERE object != %s AND object != %s", $value1, $value2 );
            }
            $items = $wpdb->get_results( $sql1, ARRAY_A );
			$columns = $this->get_columns();
			$hidden = array();
			$sortable = $this->get_sortable_columns();
			$this->_column_headers = $this->get_column_info();
            $count = $wpdb->get_var( $sql2 );
			$this->items = $items;
			$this->set_pagination_args( array(
				'total_items' => $count,
				'per_page'    => $per_page,
				'total_pages' => ceil( $count / $per_page )
			) );
		}
		
}