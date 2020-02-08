<?php

require get_stylesheet_directory() . '/inc/customizer.php';

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
* Changed the blog layout to 3 columns
*/
add_filter( 'bizberg_sidebar_settings', 'building_construction_architecture_sidebar_settings' );
function building_construction_architecture_sidebar_settings(){
	return '4';
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