<?php 
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen Theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', 
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/** Enqueues/Adds FontAwesome **/
add_action( 'wp_enqueue_scripts', 'crunchify_enqueue_fontawesome' );
function crunchify_enqueue_fontawesome() {
        wp_enqueue_style('font-awesome', 'https://cdn.crunchify.com/wp-content/icon/font-awesome/css/font-awesome.min.css');
}