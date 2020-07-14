<?php

add_action( 'wp_enqueue_scripts', 'building_construction_architecture_chld_thm_parent_css' );
function building_construction_architecture_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'building_construction_architecture_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );
    
}

/**
* Change the theme color
*/
add_filter( 'bizberg_theme_color', 'building_construction_architecture_change_theme_color' );
function building_construction_architecture_change_theme_color(){
    return '#fcb80b';
}

/**
* Change the header menu color hover
*/
add_filter( 'bizberg_header_menu_color_hover', 'building_construction_architecture_header_menu_color_hover' );
function building_construction_architecture_header_menu_color_hover(){
    return '#fcb80b';
}

/**
* Change the button color of header
*/
add_filter( 'bizberg_header_button_color', 'building_construction_architecture_header_button_color' );
function building_construction_architecture_header_button_color(){
    return '#fcb80b';
}

/**
* Change the button hover color of header
*/
add_filter( 'bizberg_header_button_color_hover', 'building_construction_architecture_header_button_color_hover' );
function building_construction_architecture_header_button_color_hover(){
    return '#fcb80b';
}

/**
* Add necessary plugins for the theme
*/

add_filter( 'bizberg_recommended_plugins', function( $plugins ){

    if( empty( $plugins ) ){
        return $plugins;
    }

    $disable_plugins = array(
        'elegant-blocks',
        'ultimate-addons-for-gutenberg'
    );

    foreach ( $plugins as $key => $value ) {        
        if( in_array( $value['slug'], $disable_plugins ) ){
            unset( $plugins[$key] );
        }
    }

    $new_plugins = array(
        array(
            'name' => esc_html__( 'Elementor Page Builder', 'building-construction-architecture' ),
            'slug' => 'elementor',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Essential Addons for Elementor', 'building-construction-architecture' ),
            'slug' => 'essential-addons-for-elementor-lite',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Cyclone Demo Importer', 'building-construction-architecture' ),
            'slug' => 'cyclone-demo-importer',
            'required' => false
        )
    );

    return array_merge( array_values( $plugins ) , $new_plugins );

});