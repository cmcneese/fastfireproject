<?php

function elegant_blocks_register_my_taxes_ct_team_category() {

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'client_cat', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "client_cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		);
	register_taxonomy( "client_cat", array( "eb_clients" ), $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'services_cat', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "services_cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		);
	register_taxonomy( "services_cat", array( "cp_services" ), $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'ct_team_category', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "ct_team_category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "ct_team_category", array( "ct_teams" ), $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'ct_slider_category', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "ct_slider_category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "ct_slider_category", array( "ct_slider" ), $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'ct_testimonial_category', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "ct_testimonial_category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "ct_testimonial_category", array( "ct_testimonials" ), $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "elegant-blocks" ),
		"singular_name" => __( "Category", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Categories", "elegant-blocks" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'ct_gallery_category', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "ct_gallery_category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "ct_gallery_category", array( "ct_gallery" ), $args );
	
}

add_action( 'init', 'elegant_blocks_register_my_taxes_ct_team_category' );