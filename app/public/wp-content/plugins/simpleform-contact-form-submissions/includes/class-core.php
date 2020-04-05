<?php

/**
 * The core plugin class
 *
 * @since      1.0
 */

class SimpleForm_Submissions {

	/**
	 * The loader responsible for maintaining and registering all hooks.
	 *
	 * @since    1.0
	 */
	 
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0
	 */

	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0
	 */

	protected $version;
	
	
	/**
	 * The error message.
	 *
	 * @since    1.0
	 */
    protected $error = null;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0
	 */

	public function __construct() {
		
		if ( defined( 'SIMPLEFORM_SUBMISSIONS_VERSION' ) ) { $this->version = SIMPLEFORM_SUBMISSIONS_VERSION; } 
		else { $this->version = '1.0'; }
		$this->plugin_name = 'simpleform-submissions';
		$this->requirements_matching();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Define the controls for the plugin compatibility.
	 *
	 * @since    1.0
	 */
	 
	private function requirements_matching() {

		if ( ! $this->is_core_active() ) {
			$this->add_error( sprintf( __( 'Core plugin missing. %1$s requires <b>SimpleForm</b> to be active.', 'simpleform-submissions' ), SIMPLEFORM_SUBMISSIONS_NAME ) );
		}

		if ( is_a( $this->error, 'WP_Error' ) ) {
		    add_action( 'admin_notices', array( $this, 'display_error' ), 10, 0 );
			add_action( 'admin_init',    array( $this, 'deactivate' ), 10, 0 );
			return false;
		}		

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0
	 */
	 
	private function load_dependencies() {

		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		// The class responsible for defining internationalization functionality of the plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		// The class responsible for defining all actions that occur in the admin area.		 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';

		// The class responsible for defining all actions that occur in the public-facing side of the site.		 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';
		
		// The base class for displaying a list of submissions in an ajaxified HTML table.
        if ( ! class_exists( 'WP_List_Table' ) ) {
	    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
        }
        
        // The customized class that extends the base class
        require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/class-list-table.php';

		$this->loader = new SimpleForm_Submissions_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0
	 */
	 
	private function set_locale() {

		$plugin_i18n = new SimpleForm_Submissions_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	
	/**
	 * Register all hooks related to the admin area functionality of the plugin.
	 *
	 * @since    1.0
	 */
	
	private function define_admin_hooks() {

		$plugin_admin = new SimpleForm_Submissions_Admin( $this->get_plugin_name(), $this->get_version() );

		// Register the stylesheets for the admin area
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		// Register the scripts for the admin area
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// Add new submenu page to Contact admin menu
	    $this->loader->add_action('admin_menu', $plugin_admin, 'admin_menu' );
	    // Add submissions related fields in settings page
		$this->loader->add_filter( 'submissions_settings_filter', $plugin_admin, 'submissions_settings_fields' );
        // Add submissions related fields values in the settings options array
		$this->loader->add_filter( 'sform_submissions_settings_filter', $plugin_admin, 'add_array_submissions_settings' );
        // Validate submissions related fields in Settings page
		$this->loader->add_filter( 'sforms_validate_submissions_settings', $plugin_admin, 'validate_submissions_fields' );
        // Display submissions list in dashboard
		$this->loader->add_action( 'submissions_list', $plugin_admin, 'display_submissions_list' );
        // Add screen option tab
		$this->loader->add_action( 'load_submissions_table_options', $plugin_admin, 'submissions_table_options' );
        // Save screen options
		$this->loader->add_filter( 'set-screen-option', $plugin_admin, 'sforms_set_option', 10, 3 );
        // Deactivate plugin if SimpleForm is missing
		$this->loader->add_action( 'admin_init', $plugin_admin, 'detect_core_deactivation' );
		// Fallback for database table updating if code that runs during plugin activation fails 
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, 'simpleform_db_version_check' );
    
	}

	/**
	 * Register all hooks related to the public-facing functionality of the plugin.
	 *
	 * @since    1.0
	 */
	
	private function define_public_hooks() {

		$plugin_public = new SimpleForm_Submissions_Public( $this->get_plugin_name(), $this->get_version() );

		// Change form data values when form is submitted 
        $plugin_data = get_plugin_data( WP_PLUGIN_DIR.'/simpleform/simpleform.php');
        if ( version_compare ( $plugin_data['Version'], '1.5', '<') ):
		$this->loader->add_filter( 'sform_storing_values', $plugin_public, 'add_storing_fields_values_vo', 10, 5 );
		else:
		$this->loader->add_filter( 'sform_storing_values', $plugin_public, 'add_storing_fields_values', 10, 7 );
		endif;
				
        // Display confirmation message if notification email has been disabled 
		$this->loader->add_action( 'sform_ajax_message', $plugin_public, 'sform_display_message', 10, 5 );
        // Display confirmation message if notification email has been disabled and ajax is disabled 
 		$this->loader->add_filter( 'sform_post_message', $plugin_public, 'sform_display_post_message', 10, 1 );

	}


	/**
	 * Check if the core plugin is listed in the active plugins in the WordPress database.
	 *
	 * @since    1.0
	 */

	protected function is_core_active() {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		if ( is_plugin_active_for_network( 'simpleform/simpleform.php' ) ) {
        return true;
        }
        
        else {		
    		if ( in_array( 'simpleform/simpleform.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		    } 
		    else { return false; }
		}

	}


	/**
	 * Add a new error to the WP_Error object and create the object if it doesn't exist yet.
	 *
	 * @since    1.0
	 */

	public function add_error( $message ) {
		if ( ! is_object( $this->error ) || ! is_a( $this->error, 'WP_Error' ) ) {
			$this->error = new WP_Error();
		}
		$this->error->add( 'addon_error', $message );
	}


	/**
	 * Display error. Get all the error messages and display them in the admin notices.
	 *
	 * @since    1.0
	 */

	public function display_error() {
		if ( ! is_a( $this->error, 'WP_Error' ) ) {
			return;
		}
		$message = $this->error->get_error_messages(); ?>
		<div class="error">
			<p>
				<?php
				if ( count( $message ) > 1 ) {
					echo '<ul>';
					foreach ( $message as $msg ) {
						echo "<li>$msg</li>";
					}
					echo '</li>';
				} else {
					echo $message[0];
				}
				?>
			</p>
		</div>
	<?php
	}


	/**
	 * Deactivate the addon. If the requirements aren't met we try to deactivate the addon completely.
	 *
	 * @since    1.0
	 */

	public function deactivate() {
		if ( function_exists( 'deactivate_plugins' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        // Disable Message which Appears when activating WordPress plugin
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }		
		}
	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0
	 */
	 
	public function run() {
		
		$this->loader->run();
		
	}

	/**
	 * Retrieve the name of the plugin.
	 *
	 * @since     1.0
	 */
	 
	public function get_plugin_name() {
		
		return $this->plugin_name;
		
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0
	 */
	 
	public function get_loader() {
		
		return $this->loader;
		
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0
	 */
	 
	public function get_version() {
		
		return $this->version;
		
	}

}