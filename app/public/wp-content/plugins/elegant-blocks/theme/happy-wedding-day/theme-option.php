<?php
/**
 * Register Happy Wedding Day Theme Page
 */
add_action('admin_menu', 'elegant_blocks_register_theme_page');
function elegant_blocks_register_theme_page() {
    add_submenu_page(
        'themes.php',
        esc_attr__( 'Happy Wedding Day Options', 'elegant-blocks' ),
        esc_attr__( 'Happy Wedding Day Options', 'elegant-blocks' ),
        'manage_options',
        'elegant-blocks-bizberg-theme-options',
        'elegant_blocks_theme_options_callback'
    );
}
 
/**
 * Display callback for the submenu page.
 */
function elegant_blocks_theme_options_callback() { 

	$my_theme = wp_get_theme(); ?>

    <div class="wrap bizberg_wrapper">
        
        <div class="bizberg_header">
        	<div class="bizberg_container">
	        	<div class="bizberg_header_left">
	        		<img src="<?php echo esc_url( ELEGANTBLOCKS_PLUGIN_URL . '/src/images/happy-wedding-day.png' ); ?>">
	        		<span class="theme_version"><?php echo esc_html( $my_theme->get( 'Version' ) ); ?></span>
	        	</div>
        	</div>
        </div>

        <div class="bizberg_container">

        	<div class="column_60">

	    		<div class="customizer_settings">    		
		    		<h3><?php esc_html_e( 'Links to Customizer Settings', 'elegant-blocks' ); ?></h3>
		    		<ul>
		    			<li>
		    				<span class="dashicons dashicons-format-image"></span> 
		    				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=custom_logo' ) ); ?>">
		    					<?php esc_html_e( 'Upload Logo', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>
		    			<li>
		    				<span class="dashicons dashicons-align-center"></span>
		    				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=header_search' ) ); ?>">
		    					<?php esc_html_e( 'Header Settings', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>
		    			<li>
		    				<span class="dashicons dashicons-welcome-write-blog"></span>
		    				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=sidebar_settings' ) ); ?>">
		    					<?php esc_html_e( 'Blog Layout', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>
		    			<li>
		    				<span class="dashicons dashicons-admin-settings"></span>
		    				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=footer_social_links' ) ); ?>">
		    					<?php esc_html_e( 'Footer Social Icons', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>
		    			<li>
		    				<?php 
		    				$query['autofocus[section]'] = 'sidebar-widgets-sidebar-2';
							$section_link = add_query_arg( $query, admin_url( 'customize.php' ) );
							?>
		    				<span class="dashicons dashicons-align-left"></span>
		    				<a target="_blank" href="<?php echo esc_url( $section_link ); ?>">
		    					<?php esc_html_e( 'Sidebar Widgets', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>
		    			<li>
		    				<?php 
		    				$query_nav_menus['autofocus[section]'] = 'general-settings';
							$menu_locations = add_query_arg( $query_nav_menus, admin_url( 'customize.php' ) );
							?>
		    				<span class="dashicons dashicons-align-left"></span>
		    				<a target="_blank" href="<?php echo esc_url( $menu_locations ); ?>">
		    					<?php esc_html_e( 'Theme Color', 'elegant-blocks' ); ?>
		    				</a>
		    			</li>    			
		    		</ul>
	    		</div>
	    	
	    		<div class="customizer_settings pro">
	    		
		    		<h3><?php esc_html_e( 'Installation and Updates', 'elegant-blocks' ); ?></h3>

		    		<ul>

			    		<?php 
			    		foreach ( elegant_blocks_bizberg_pro_installation_updates() as $value ) { ?>
			    		 	
			    			<li>
				    			<a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank">
				    				<?php echo esc_html( $value['title'] ); ?>
				    			</a>
				    			<span class="link_wrapper">
				    				<a href="<?php echo esc_url( $value['link'] ); ?>">
					    				Learn More »
					    			</a>	
				    			</span>
				    						    			
				    		</li>

			    		 	<?php
			    		} ?>

		    		</ul>

	    		</div>

	    		<div class="customizer_settings pro">
	    		
		    		<h3><?php esc_html_e( 'Free Version Options', 'elegant-blocks' ); ?></h3>

		    		<ul>

			    		<?php 
			    		foreach ( elegant_blocks_bizberg_free_features() as $value ) { ?>
			    		 	
			    			<li>
				    			<a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank">
				    				<?php echo esc_html( $value['title'] ); ?>
				    			</a>
				    			<span class="link_wrapper">
				    				<a href="<?php echo esc_url( $value['link'] ); ?>">
					    				Learn More »
					    			</a>	
				    			</span>
				    						    			
				    		</li>

			    		 	<?php
			    		} ?>

		    		</ul>
		    		
	    		</div>

	    		<div class="customizer_settings pro">
	    		
		    		<h3><?php esc_html_e( 'PRO Version Options', 'elegant-blocks' ); ?></h3>

		    		<ul>

			    		<?php 
			    		foreach ( elegant_blocks_bizberg_pro_features() as $value ) { ?>
			    		 	
			    			<li>
				    			<a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank">
				    				<?php echo esc_html( $value['title'] ); ?>
				    			</a>
				    			<span class="link_wrapper">
				    				<a href="<?php echo esc_url( $value['link'] ); ?>">
					    				Learn More »
					    			</a>	
				    			</span>
				    						    			
				    		</li>

			    		 	<?php
			    		} ?>

		    		</ul>
	    		</div>

	    		<div class="customizer_settings pro">
	    		
		    		<h3><?php esc_html_e( 'Elegant Blocks for Happy Wedding Day Lite', 'elegant-blocks' ); ?></h3>

		    		<ul>

			    		<?php 
			    		foreach ( elegant_blocks_bizberg_pro_blocks() as $value ) { ?>
			    		 	
			    			<li>
				    			<a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank">
				    				<?php echo esc_html( $value['title'] ); ?>
				    			</a>
				    			<span class="link_wrapper">
				    				<a href="<?php echo esc_url( $value['link'] ); ?>">
					    				Learn More »
					    			</a>	
				    			</span>
				    						    			
				    		</li>

			    		 	<?php
			    		} ?>

		    		</ul>
	    		</div>

	    	</div>

	    	<div class="column_40">

	    		<div class="customizer_settings import_site_wrapper">    		
		    		<h3><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e( 'Import Starter Theme', 'elegant-blocks' ); ?></h3>
		    		<img src="<?php echo esc_url( ELEGANTBLOCKS_PLUGIN_URL . '/src/images/wedding-starter-sites.jpg' ); ?>">

		    		<?php 
		    		if( class_exists( 'OCDI_Plugin' ) ){ ?>
			    		<p>You can create sites in one click, <a href="<?php echo admin_url( 'themes.php?page=cyclone-one-click-demo-import' ); ?>">click here</a> to import demo pages.</p>
			    		<?php 
			    	} else { ?>
			    		<p>Import your site in one click and start your project in style!
			    			Install all required plugins first. </br></br> <a class="button button-primary" href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>">Install Plugins</a></p>
			    		<?php 
			    	} ?>

		    	</div>

		    	<div class="customizer_settings support_wrapper">    		
		    		<h3><span class="dashicons dashicons-admin-tools"></span><?php esc_html_e( 'Support', 'elegant-blocks' ); ?></h3>
		    		<p>If you have any problem, visit our <a href="<?php echo esc_url( elegant_blocks_professional_education_consultancy_get_support_forum_link() ); ?>" target="_blank">support forum</a>.</p>		    		
		    	</div>

		    	<div class="customizer_settings review_wrapper">    		
		    		<h3><span class="dashicons dashicons-heart"></span><?php esc_html_e( 'Give us 5 star rating ???', 'elegant-blocks' ); ?></h3>
		    		<p>If you like the theme please give us a 5 star rating. <a href="https://wordpress.org/support/theme/happy-wedding-day/reviews/?rate=5#new-post" target="_blank">Click here</a> to show your love.</p>
		    	</div>
			    
		    	<?php
		    	if( empty( elegant_blocks_professional_education_consultancy_pro_status() ) ){ ?>
			    	<div class="customizer_settings upgrade_wrapper">    		
			    		<h3><span class="dashicons dashicons-megaphone"></span><?php esc_html_e( 'Upgrade to PRO', 'elegant-blocks' ); ?></h3>
			    		<p>If you love the free version then you will love the PRO Version. With more features and more options. <a href="https://cyclonethemes.com/downloads/bizberg-pro/" target="_blank">Click Here</a> to buy the PRO Version.</p>
			    	</div>
			    	<?php 
		    	} ?>

        	</div>

        </div>        

    </div>
    <?php
}

function elegant_blocks_professional_education_consultancy_pro_status(){

	$theme = wp_get_theme();

	switch ( $theme->get( 'TextDomain' ) ) {
		
		case 'professional-education-consultancy':
			return false;
			break;

		case 'professional-education-consultancy-pro':
			return true;
			break;

	}

}

function elegant_blocks_professional_education_consultancy_get_support_forum_link(){

	$theme = wp_get_theme();

	switch ( $theme->get( 'TextDomain' ) ) {

		case 'happy-wedding-day':
			return 'https://cyclonethemes.com/forums/forum/free-version/happy-wedding-day-lite/';
			break;
		
		default:
			# code...
			break;
	}

}

function elegant_blocks_bizberg_free_features(){

	return array(
		array(
			'title' => 'Site Logo',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse1'
		),
		array(
			'title' => 'Theme Color',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse2'
		),
		array(
			'title' => 'Menu Hover Color',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse3'
		),
		array(
			'title' => 'Header Button',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse4'
		),
		array(
			'title' => 'Search Icon on Header',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse5'
		),
		array(
			'title' => 'Sidebar Widgets',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse6'
		),
		array(
			'title' => 'Breadcrumb Image',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse7'
		),
		array(
			'title' => 'Breadcrumb Title & Subtitle',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse8'
		),
		array(
			'title' => 'Blog Homepage Layout',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse9'
		),
		array(
			'title' => 'Content Length & Read More Text on Category Page',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse10'
		),
		array(
			'title' => '404 Image',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse11'
		),
		array(
			'title' => 'Footer Social Icons',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4149_collapse12'
		),
	);

}

function elegant_blocks_bizberg_pro_features(){

	return array(
		array(
			'title' => 'Top Header Bar',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse1'
		),
		array(
			'title' => 'Footer Mega Grid Columns',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse2'
		),
		array(
			'title' => 'Preloader',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse3'
		),
		array(
			'title' => 'Copyright Text',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse4'
		),
		array(
			'title' => 'Copyright/Footer Layout',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse5'
		),
		array(
			'title' => 'Footer Social Icons',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4001_collapse6'
		),
	);

}

function elegant_blocks_bizberg_pro_installation_updates(){

	return array(
		array(
			'title' => 'Activate License',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_3905_collapse1'
		),
		array(
			'title' => 'Manually Install Bizberg via FTP',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_3905_collapse2'
		),
		array(
			'title' => 'Installing Recommended Plugins',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_3905_collapse4'
		),
		array(
			'title' => 'Install Bizberg Starter Sites',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_3938_collapse1'
		),
	);

}

function elegant_blocks_bizberg_pro_blocks(){

	return array(
		array(
			'title' => 'Slider Block',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4167_collapse1'
		),
		array(
			'title' => 'Blog Block',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4167_collapse2'
		),
		array(
			'title' => 'Team Block',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4167_collapse3'
		),
		array(
			'title' => 'Gallery Block',
			'link' => 'https://cyclonethemes.com/documentation/bizberg-documentation/#ac_4167_collapse4'
		),
	);

}