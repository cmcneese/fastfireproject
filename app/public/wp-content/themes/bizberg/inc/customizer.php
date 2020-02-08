<?php

/**
 * Enqueue style for custom customize control.
 */

add_action( 'customize_controls_enqueue_scripts', 'bizberg_custom_customize_enqueue' );
function bizberg_custom_customize_enqueue() {
	wp_enqueue_style( 'bizberg-customize-controls', get_template_directory_uri() . '/inc/sections/customizer.css' );
	wp_register_script( 'bizberg-customize-custom-js', get_template_directory_uri() . '/inc/sections/customs.js' );
	$translation_array = array(
    	'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
    	'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'demo_import_page' => admin_url( 'themes.php?page=cyclone-one-click-demo-import' )
	);
	wp_localize_script( 'bizberg-customize-custom-js', 'bizberg', $translation_array );
	wp_enqueue_script( 'bizberg-customize-custom-js' );

}

add_action( 'customize_register', 'bizberg_upgrade_to_pro_msg' );
function bizberg_upgrade_to_pro_msg( $wp_customize ){

	wp_enqueue_style( 'bizberg-customize-controls-init', get_template_directory_uri() . '/inc/sections/customizer-init.css' );

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/sections/controls.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Bizberg_Customize_Section' );

	// Register sections.
	$wp_customize->add_section(
		new Bizberg_Customize_section(
			$wp_customize,
			'theme_upsell',
			array(
				'priority' => 1,
			)
		)
	);

}

add_action( 'init' , 'bizberg_kirki_fields' );
function bizberg_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	/**
	* Logo Settings
	*/

	Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'logo_height',
		'label'       => esc_html__( 'Logo Height', 'bizberg' ),
		'section'     => 'title_tagline',
		'default'     => 51,
		'priority'    => 9, 
		'choices'     => [
			'min'  => 51,
			'max'  => 100,
			'step' => 1,
		],
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.bizberg_header_wrapper .logo img',
				'function' => 'style',
				'property' => 'max-height',
				'suffix'   => 'px',
				'media_query' => '@media (min-width: 1025px) and (max-width: 2000px)'
			)
		),
		'output'   => array(
			array(
				'element'  => '.bizberg_header_wrapper .logo img',
				'property'      => 'max-height',
				'value_pattern' => '$px',
				'media_query' => '@media (min-width: 1025px) and (max-width: 2000px)'
			)
		)
	] );

	Kirki::add_field( 'bizberg', [
		'type'        => 'radio-buttonset',
		'settings'    => 'sticky_logo_height',
		'label'       => esc_html__( 'Apply default logo height on sticky menu', 'bizberg' ),
		'description' => esc_html__( 'If checked, it will ignore the above height and use default height for the logo on sitcky menu.', 'bizberg' ),
		'section'     => 'title_tagline',
		'default'     => '51px',
		'priority'    => 9,
		'choices'     => [
			'51px'    => esc_html__( 'Enable', 'bizberg' ),
			''   => esc_html__( 'Disable', 'bizberg' )
		],
		'output'   => array(
			array(
				'element'  => '.navbar.sticky .bizberg_header_wrapper .logo img',
				'property'      => 'max-height',
				'value_pattern' => '$'
			)
		)
	] );

	/**
	* General Settings
	*/

	Kirki::add_section( 'general-settings', array(
	    'title'          => esc_html__( 'General Settings', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'color',
		'settings'    => 'general-settings',
		'label'       => esc_html__( 'Theme Color', 'bizberg' ),
		'section'     => 'general-settings',
		'default'     => apply_filters( 'bizberg_theme_color', '#2fbeef' ),
		'output'    => array(
			array(
				'element'  => 'a:focus',
				'property'      => 'outline',
				'value_pattern' => '1px dashed $'
			),
			array(
				'element'  => 'a,.breadcrumb-wrapper .breadcrumb .active,#sidebar a,a:hover, a:focus,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, #blog .blog-post.blog-large .entry-date a,#blog .blog-post.blog-large .entry-title a:hover,#blog .blog-post .entry-meta > span > a:hover, nav.comment-navigation a:hover,.bizberg_post_date a,.bizberg_detail_user_wrapper a:hover,div#respond h3#reply-title small a',
				'property' => 'color'
			),
			array(
				'element'  => '.search-form input#searchsubmit,#back-to-top a,.btn-primary, a.btn-primary, p.form-submit .submit, .reply a, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"],.result-paging-wrapper ul.paging li.active a, .result-paging-wrapper ul.paging li a:hover, .navigation.pagination a:hover, .navigation.pagination span:hover, .navigation.pagination span.current,#sidebar .widget h2.widget-title:before, .widget.widget_tag_cloud a:hover, .tagcloud.tags a:hover,.bizberg_detail_cat:after,.bizberg_post_date a:after,div#respond h3#reply-title:after',
				'property' => 'background'
			),
			array(
				'element'  => 'ul.sidebar-cat li a:hover, ul.archive li a:hover, .widget.widget_categories li a:hover, .widget.widget_archive li a:hover, .widget.widget_pages li a:hover, .widget.widget_meta li a:hover, .widget.widget_nav_menu li a:hover, .widget.widget_recent_entries li a:hover, .widget.widget_recent_comments li a:hover, .widget.widget_archive li:hover, .widget.widget_categories li:hover',
				'property' => 'color',
				'suffix' => ' !important'
			),
			array(
				'element'  => '.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, nav.comment-navigation a:hover,#blog .blog-post.blog-large .entry-date a:after,div#respond h3#reply-title small a, .bizberg_default_page .single_page h3:after',
				'property' => 'border-color'
			),
			array(
				'element'  => '.btn-primary, a.btn-primary, p.form-submit .submit, .reply a, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"]',
				'property' => 'border-color',
				'sanitize_callback' => 'bizberg_adjustBrightness',
				// 'suffix'   => ' !important'
			),
			array(
				'element'  => '.btn-primary:hover, a.btn-primary:hover, p.form-submit .submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover',
				'property' => 'background',
				'sanitize_callback' => 'bizberg_adjustBrightness',
			),
			array(
				'element'  => '.btn-primary:hover, a.btn-primary:hover, p.form-submit .submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover',
				'property' => 'border-color',
			)
		)
	) );

	/** 
	* Sticky Menu Options
	*/

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'custom_' . wp_generate_password( 12,false, false ),
	    'section'     => 'general-settings',
	    'default'     => '<hr><h2>' . esc_html__( 'Sticky Menu Option', 'bizberg' ) . '</h2><hr>',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'enable_desktop_sticky_menu_status',
		'label'       => esc_html__( 'Enable Sticky Menu on Desktop', 'bizberg' ),
		'section'     => 'general-settings',
		'default'     => true,
		'output'    => array(
			array(
				'element'  => '.navbar.sticky',
				'property' => 'position',
				'value_pattern' => 'relative$',
				'media_query' => '@media (min-width: 1025px) and (max-width: 1824px)'
			),
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'enable_mobile_sticky_menu_status',
		'label'       => esc_html__( 'Enable Sticky Menu on Mobile/Tablet', 'bizberg' ),
		'section'     => 'general-settings',
		'default'     => true,
		'output'    => array(
			array(
				'element'  => '.navbar.sticky',
				'property' => 'position',
				'value_pattern' => 'relative$',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'slider',
		'settings'    => 'main_menu_dropdown_height',
		'label'       => esc_html__( 'Dropdown Height', 'bizberg' ),
		'section'     => 'general-settings',
		'default'     => 200,
		'choices'     => array(
			'min'  => 200,
			'max'  => 300,
			'step' => 10,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_mobile_sticky_menu_status',
				'operator' => '==',
				'value'    => true,
			)
		),
		'output'    => array(
			array(
				'element'  => '.navbar .slicknav_nav',
				'property' => 'max-height',
				'value_pattern' => '$px',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
			array(
				'element'  => '.navbar .slicknav_nav',
				'property' => 'overflow-y',
				'value_pattern' => 'scroll',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
		),
	) );

	/** 
	* Color option for main menu
	*/

	Kirki::add_field( 'bizberg', array(
		'type'        => 'color',
		'settings'    => 'header_menu_color_hover',
		'label'       => esc_html__( 'Menu Color ( Hover )', 'bizberg' ),
		'section'     => 'header',
		'default'     => apply_filters( 'bizberg_header_menu_color_hover', '#2fbeef' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'header .navbar-default .navbar-nav > li > a:hover,.navbar-nav > li:hover, .header-search .search-form input#searchsubmit, .header-search .search-form input#searchsubmit:visited',
				'function' => 'style',
				'property' => 'background',
				'suffix'   => ' !important'
			),
			array(
				'element'  => 'header .navbar-default .navbar-nav > li > a:hover,.header-search .search-form input#searchsubmit, .header-search .search-form input#searchsubmit:visited',
				'property' => 'border-color',
				'function' => 'css',
				'suffix'   => ' !important'
			),
			array(
				'element'  => '.navbar-nav li ul',
				'property' => 'border-top-color',
				'function' => 'css',
				'suffix'   => ' !important'
			),
			array(
				'element'  => '.navbar-nav li ul li a:hover,.page-fullwidth-transparent-header header .navbar-default .navbar-nav > li > a:hover,.page-fullwidth-transparent-header .navbar-nav > li:hover > a',
				'property' => 'color',
				'function' => 'css',
				'suffix'   => ' !important'
			),
		),
		'output'    => array(
			array(
				'element'  => '.navbar-nav li ul li a:hover,.page-fullwidth-transparent-header header .navbar-default .navbar-nav > li > a:hover,.page-fullwidth-transparent-header .navbar-nav > li:hover > a',
				'property' => 'color',
				'suffix'   => ' !important'
			),
			array(
				'element'  => 'header .navbar-default .navbar-nav > li > a:hover,.navbar-nav > li:hover,.header-search .search-form input#searchsubmit, .header-search .search-form input#searchsubmit:visited',
				'property' => 'background',
				'suffix'   => ' !important'
			),
			array(
				'element'  => '.navbar-nav > li.header_btn_wrapper:hover,.navbar-nav > li.search_wrapper:hover,.page-fullwidth-transparent-header .navbar-nav > li:hover',
				'property' => 'background',
				'suffix'   => ' !important',
				'value_pattern' => 'none'
			),
			array(
				'element'  => '.navbar-nav li ul',
				'property' => 'border-top-color',
				'suffix'   => ' !important'
			),
			array(
                'element'  => 'header .navbar-default .navbar-nav > li > a:hover',
                'property' => 'border-color',
                'sanitize_callback' => 'bizberg_adjustBrightness',
            ),
		)
	) );

	/** 
	* Color option on button on main menu
	*/

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'custom_' . wp_generate_password( 12,false, false ),
	    'section'     => 'header',
	    'default'     => '<hr><h2>' . esc_html__( 'Button Section', 'bizberg' ) . '</h2><hr>',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'color',
		'settings'    => 'header_button_color',
		'label'       => esc_html__( 'Button Color', 'bizberg' ),
		'section'     => 'header',
		'default'     => apply_filters( 'bizberg_header_button_color', '#2fbeef' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.menu_custom_btn',
				'function' => 'css',
				'property' => 'background',
				'suffix'   => ' !important'
			),
		),
		'output'    => array(
			array(
				'element'  => '.menu_custom_btn',
				'property' => 'background',
				'suffix'   => ' !important'
			),
		)
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'color',
		'settings'    => 'header_button_color_hover',
		'label'       => esc_html__( 'Button Color ( Hover )', 'bizberg' ),
		'section'     => 'header',
		'default'     => apply_filters( 'bizberg_header_button_color_hover', '#1098c6' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn:hover, .page-fullwidth-transparent-header .navbar-default .navbar-nav>li>a.menu_custom_btn:hover',
				'function' => 'style',
				'property' => 'background',
				'suffix'   => ' !important'
			),
		),
		'output'    => array(
			array(
				'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn:hover, .page-fullwidth-transparent-header .navbar-default .navbar-nav>li>a.menu_custom_btn:hover',
				'property' => 'background',
				'suffix'   => ' !important'
			),
		)
	) );

	Kirki::add_config( 'bizberg', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_panel( 'theme_options', array(
	    'title'       => esc_html__( 'Theme Options', 'bizberg' ),
	) );

	Kirki::add_section( 'header', array(
	    'title'          => esc_html__( 'Header', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'header_search',
		'label'       => esc_html__( 'Disable Search', 'bizberg' ),
		'section'     => 'header',
		'default'     => false
	) );

	/** 
	* Button on main menu
	*/

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'header_button',
		'label'       => esc_html__( 'Disable Button', 'bizberg' ),
		'section'     => 'header',
		'default'     => true,
		'partial_refresh' => array(
			'header_btn_wrapper1' => array(
				'selector'        => '.header_btn_wrapper',
				'render_callback' => 'bizberg_get_menu_btn',
			)
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'header_button_label',
		'label'       => esc_html__( 'Button Label', 'bizberg' ),
		'section'     => 'header',
		'default'     => esc_html__( 'Buy Now', 'bizberg' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => false,
			)
		),
		'partial_refresh' => array(
			'header_btn_wrapper' => array(
				'selector'        => '.header_btn_wrapper',
				'render_callback' => 'bizberg_get_menu_btn',
			)
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'header_button_link',
		'label'       => esc_html__( 'Button Link', 'bizberg' ),
		'section'     => 'header',
		'default'     => '#',
		'active_callback' => array(
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => false,
			)
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'dimensions',
		'settings'    => 'header_btn_border_radius',
		'label'       => esc_html__( 'Border Radius', 'bizberg' ),
		'section'     => 'header',
		'default'     => array(
			'top-left-radius'  => '28px',
			'top-right-radius'  => '28px',
			'bottom-left-radius' => '28px',
			'bottom-right-radius' => '28px',
		),
		'choices'     => array(
			'labels' => array(
				'top-left-radius'  => esc_html__( 'Top Left Radius', 'bizberg' ),
				'top-right-radius'  => esc_html__( 'Top Right Radius', 'bizberg' ),
				'bottom-left-radius' => esc_html__( 'Bottom Left Radius', 'bizberg' ),
				'bottom-right-radius' => esc_html__( 'Bottom Right Radius', 'bizberg' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => false,
			)
		),
		'output'    => array(
			array(
				'property' => 'border',
				'element'  => 'a.menu_custom_btn',
			),
		)
	) );

	Kirki::add_section( 'homepage', array(
	    'title'          => esc_html__( 'Blog Homepage', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'slider_banner',
		'label'       => esc_html__( 'Banner / Slider', 'bizberg' ),
		'section'     => 'homepage',
		'default'     => 'banner',
		'choices'     => array(
			'banner'   => esc_html__( 'Banner', 'bizberg' ),
			'slider' => esc_html__( 'Slider', 'bizberg' ),
		)
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'banner_title',
		'label'       => esc_html__( 'Banner Title', 'bizberg' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_title' => array(
				'selector'        => '.banner_title',
				'render_callback' => 'bizberg_get_banner_title',
			)
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'banner_subtitle',
		'label'       => esc_html__( 'Banner Subtitle', 'bizberg' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_subtitle' => array(
				'selector'        => '.banner_subtitle',
				'render_callback' => 'bizberg_get_banner_subtitle',
			)
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'image',
		'settings'    => 'banner_image',
		'label'       => esc_html__( 'Select Banner Image', 'bizberg' ),
		'section'     => 'homepage',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		)
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'select',
		'settings'    => 'slider_category',
		'label'       => esc_html__( 'Select Slider Category', 'bizberg' ),
		'section'     => 'homepage',
		'multiple'    => 1,
		'choices'     => bizberg_get_post_categories(),
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'slider',
			),
		),

	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'sidebar_settings',
		'label'       => esc_html__( 'Sidebar', 'bizberg' ),
		'section'     => 'homepage',
		'default'     => apply_filters( 'bizberg_sidebar_settings', '1' ),
		'choices'     => array(
			'1'   => esc_html__( 'Right Sidebar', 'bizberg' ),
			'2' => esc_html__( 'Left Sidebar', 'bizberg' ),
			'3'  => esc_html__( 'No Sidebar ( Two Columns )', 'bizberg' ),
			'4'  => esc_html__( 'No Sidebar ( Three Columns )', 'bizberg' ),
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'excerpt_length',
		'label'       => esc_html__( 'Excerpt Length', 'bizberg' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'bizberg' ),
		'section'     => 'homepage',
		'default'     => 60
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'text',
		'settings'    => 'read_more_text',
		'label'       => esc_html__( 'Read More Text', 'bizberg' ),
		'section'     => 'homepage'
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'hide_author',
		'label'       => esc_html__( 'Hide Author', 'bizberg' ),
		'section'     => 'homepage'
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'checkbox',
		'settings'    => 'hide_category',
		'label'       => esc_html__( 'Hide category', 'bizberg' ),
		'section'     => 'homepage'
	) );

	Kirki::add_section( 'footer_settings', array(
	    'title'          => esc_html__( 'Footer', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 40,

	) );

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'custom_' . wp_generate_password( 12,false, false ),
	    'section'     => 'footer_settings',
	    'default'     => '<hr><h2>' . esc_html__( 'Social Icons', 'bizberg' ) . '</h2><hr>',
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'repeater',
		'label'       => esc_html__( 'Social Links', 'bizberg' ),
		'section'     => 'footer_settings',
		'row_label' => array(
			'type' => 'text',
			'value' => esc_html__( 'Social Link', 'bizberg' ),
		),
		'settings'    => 'footer_social_links',
		'fields' => array(
			'icon' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'bizberg' ),
				'description' => sprintf( 
					__( 'You can get icons from %s', 'bizberg' ), 
    				'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
    			),
    			'default' => 'fab fa-facebook-f'
			),
			'link' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'bizberg' ),
				'default' => '#'				
			),			
		),
		'partial_refresh' => array(
			'footer_social_links' => array(
				'selector'        => '.footer_social_links',
				'render_callback' => 'bizberg_get_footer_social_links',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_grid_copyright_layout',
				'operator' => '!=',
				'value'    => '3',
			)
		),
	) );	

	Kirki::add_section( 'detail_page', array(
	    'title'          => esc_html__( 'Detail Page', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'detail_page_img_position',
		'label'       => esc_html__( 'Image Position', 'bizberg' ),
		'section'     => 'detail_page',
		'default'     => 'left',
		'choices'     => array(
			'left'   => esc_html__( 'Left', 'bizberg' ),
			'center' => esc_html__( 'Center', 'bizberg' )
		),
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'detail_page_author_section',
		'label'       => esc_html__( 'Author Info', 'bizberg' ),
		'section'     => 'detail_page',
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__( 'Show', 'bizberg' ),
			'hide' => esc_html__( 'Hide', 'bizberg' )
		),
	) );

	Kirki::add_section( '404_settings', array(
	    'title'          => esc_html__( '404 Page', 'bizberg' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'image',
		'settings'    => '404_background_image',
		'label'       => esc_html__( 'Background Image', 'bizberg' ),
		'section'     => '404_settings',
		'default'     => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'transport' => 'postMessage',
	    'js_vars'   => array(
			array(
				'element'  => '.error-section',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'output' => array(
			array(
				'element'  => '.error-section',
				'property' => 'background-image'
			)
		),
	) );

}