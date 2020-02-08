<?php

function elegant_blocks_register_my_cpts_ct_teams() {

	/**
	* Post Type: Clients
	*/

	$labels = array(
		"name" => __( "Clients", "elegant-blocks" ),
		"singular_name" => __( "Client", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Clients", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "eb_clients", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => array( "title", "thumbnail", "revisions" , "editor" ),
	);

	register_post_type( "eb_clients", $args );

	/**
	 * Post Type: Services.
	 */

	$labels = array(
		"name" => __( "Services", "elegant-blocks" ),
		"singular_name" => __( "Service", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Services", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "cp_services", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-analytics",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "cp_services", $args );

	/**
	 * Post Type: Teams.
	 */

	$labels = array(
		"name" => __( "Teams", "elegant-blocks" ),
		"singular_name" => __( "Team", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Teams", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ct_teams", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-admin-users",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "ct_teams", $args );

	/**
	 * Post Type: Sliders.
	 */

	$labels = array(
		"name" => __( "Sliders", "elegant-blocks" ),
		"singular_name" => __( "Slider", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Sliders", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ct_slider", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-images-alt",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "ct_slider", $args );

	/**
	 * Post Type: Testimonials.
	 */

	$labels = array(
		"name" => __( "Testimonials", "elegant-blocks" ),
		"singular_name" => __( "Testimonial", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Testimonials", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ct_testimonials", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-format-status",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "ct_testimonials", $args );

	/**
	 * Post Type: Galleries.
	 */

	$labels = array(
		"name" => __( "Galleries", "elegant-blocks" ),
		"singular_name" => __( "Gallery", "elegant-blocks" ),
	);

	$args = array(
		"label" => __( "Galleries", "elegant-blocks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ct_gallery", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-images-alt",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "ct_gallery", $args );

}

add_action( 'init', 'elegant_blocks_register_my_cpts_ct_teams' );
