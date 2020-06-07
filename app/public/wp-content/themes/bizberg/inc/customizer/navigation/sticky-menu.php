<?php

/** 
* Sticky Menu Options
*/

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'enable_desktop_sticky_menu_status',
	'label'       => esc_html__( 'Enable Sticky Menu on Desktop', 'bizberg' ),
	'section'     => 'sticky_menu_options',
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
	'section'     => 'sticky_menu_options',
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
	'section'     => 'sticky_menu_options',
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