<?php

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'custom_' . wp_generate_password( 12,false, false ),
    'section'     => 'footer_settings',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Social Icons', 'bizberg' ) . '</div>',
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