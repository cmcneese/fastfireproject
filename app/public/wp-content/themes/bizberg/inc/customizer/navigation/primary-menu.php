<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_color_hover',
	'label'       => esc_html__( 'Menu Background Color ( Hover )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_color_hover', '#2fbeef' ),
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
            'sanitize_callback' => 'bizberg_adjustBrightness'
        ),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'header_search',
	'label'       => esc_html__( 'Disable Search', 'bizberg' ),
	'section'     => 'header',
	'default'     => true
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'custom_' . wp_generate_password( 12,false, false ),
    'section'     => 'header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Button Section', 'bizberg' ) . '</div>',
) );

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
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
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
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn:hover, .page-fullwidth-transparent-header .navbar-default .navbar-nav>li>a.menu_custom_btn:hover',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	)
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
			'element'  => 'a.menu_custom_btn'
		),
	)
) );