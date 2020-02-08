<?php

function bizberg_get_footer_links(){

	return array
    (
        array
        (
            'icon' => 'fab fa-facebook-f',
            'link' => '#'
        ),

        array
        (
            'icon' => 'fab fa-twitter',
            'link' => '#'
        ),

        array
        (
            'icon' => 'fab fa-instagram',
            'link' => '#'
        ),

        array
        (
            'icon' => 'fab fa-google-plus-g',
            'link' => '#'
        ),

        array
        (
            'icon' => 'fab fa-youtube',
            'link' => '#'
        )

    );

}

add_action( 'pt-ocdi/after_import', 'bizberg_after_import' );
function bizberg_after_import( $selected_import ) {

	$import_file_name = $selected_import['import_file_name'];
	$args = array(
		'menu_locations' => array(
			'menu-1' => 'main-menu',
			'footer' => 'footer-menu'
		),
		'show_on_front' => 'page',
		'theme_mod' => array(
			'footer_social_links' => bizberg_get_footer_links()
		),
		'db_options' => array(
			'elegant_blocks_google_map_api' => 'AIzaSyDZJXMxXjptG6-57dwtYacooM3C66rXX7U'
		)
	);

	switch ( $import_file_name ) {

		case 'Education Free':			
			$args['default_page']['page_on_front'] = 'education-free';
			bizberg_set_defaults( $args );
			break;

		default:
			# code...
			break;
	}

}

// function bizberg_set_page_theme_mod( $slug ){

// 	switch ( $slug ) {

// 		case 'homepage-free':
// 			set_theme_mod( 'custom_logo' , bizberg_get_attachment_by_post_name( 'untitled-111' ) );	
// 			break;
		
// 		default:
// 			# code...
// 			break;
// 	}

// }

// function bizberg_get_attachment_by_post_name( $post_name ) {

//     $args = array(
//         'posts_per_page' => 1,
//         'post_type'      => 'attachment',
//         'name'           => trim( $post_name ),
//     );

//     $get_attachment = new WP_Query( $args );

//     if ( empty( $get_attachment->posts[0]->ID ) ) {
//         return false;
//     }

//     return absint( $get_attachment->posts[0]->ID );
// }

function bizberg_get_taxonomy_id_by_slug( $slug , $taxonomy ){

 	$term = get_term_by( 'slug', $slug, $taxonomy ); 

 	if( !empty($term->term_id) )
 		return absint( $term->term_id );
 	else
 		return '';

}

function bizberg_set_exercpt_empty(){

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);

	$post_query = new WP_Query( $args );

	if( $post_query->have_posts() ):

		while( $post_query->have_posts() ): $post_query->the_post();

			global $post;
			$excerpt = get_the_excerpt( $post );

			if( empty( sanitize_text_field( $excerpt ) ) ){

				$my_post = array(
					'ID' => $post->ID,
				  	'post_excerpt' => ''
				);
					 
				wp_update_post( $my_post );
			}

		endwhile;

		wp_reset_postdata();

	endif;

}

function bizberg_set_testimonials_meta_data(){

	$data = array(
		array(
			'position' => 'Design Lead',
			'rating' => '4'
		),
		array(
			'position' => 'Networking Lead',
			'rating' => '5'
		),
	);

	$args = array(
		'post_type' => 'ct_testimonials',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);

	$query_testimonials = new WP_Query( $args );
	$count = 0;

	if( $query_testimonials->have_posts() ):

		while( $query_testimonials->have_posts() ): $query_testimonials->the_post();

			global $post;
			update_post_meta( $post->ID, 'position', $data[$count]['position'] );
			update_post_meta( $post->ID, 'rating', $data[$count]['rating'] );
			update_post_meta( $post->ID, 'fb_link', '#' );
			update_post_meta( $post->ID, 'tw_link', '#' );
			update_post_meta( $post->ID, 'ig_link', '#' );
			update_post_meta( $post->ID, 'lk_link', '#' );
			$count++;

		endwhile;

	endif;

}

function bizberg_set_team_meta_data(){

	$terms = array( 'team' );
	$chefs = array( 'Programming Teacher' , 'Math Teacher' , 'Account Teacher' , 'MBBS Teacher' );

	foreach ( $terms as $term ) {
		
		$args = array(
			'post_type' => 'ct_teams',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'ct_team_category',
					'field'    => 'slug',
					'terms'    => $term,
				),
			),
		);

		$count = 0;

		$query_team = new WP_Query( $args );

		if( $query_team->have_posts() ):

			while( $query_team->have_posts() ): $query_team->the_post();

				global $post;

				switch ( $term ) {

					case 'team':
						update_post_meta( $post->ID, 'position', $chefs[$count] );					
						break;
					
					default:
						# code...
						break;
				}

				update_post_meta( $post->ID, 'facebook_link', '#' );
				update_post_meta( $post->ID, 'twitter_link', '#' );
				update_post_meta( $post->ID, 'google_plus_link', '#' );
				update_post_meta( $post->ID, 'instagram_link', '#' );

				$count++;

			endwhile;

		endif;

	}

}

function bizberg_set_defaults( $args ){

	$args['search_replace'][] = 'education-free';

	/**
	* Set theme mod content
	*/	

	foreach ( $args['theme_mod'] as $key => $value) {
		set_theme_mod( $key, $value );
	}

	/**
	* Search & Replace Content
	*/

	foreach ( $args['search_replace'] as $value ) {
		bizberg_search_replace_content( $value );
	}

	/**
	* Set wp_options
	*/

	if( !empty( $args['db_options'] ) ){
		foreach ( $args['db_options'] as $option_key => $value) {
			update_option( $option_key, $value );
		}
	}

	/**
	* Set Default Homepage
	*/

	if( !empty( $args['default_page'] ) ){

		foreach ( $args['default_page'] as $option_key => $slug ) {
			$result = get_page_by_path( $slug );
			if ( $result ) {		
				update_option( $option_key, $result->ID );
			}
		}

	}	

	/**
	* Set 'show_on_front' to 'page'
	*/

	if( !empty( $args['show_on_front'] ) && $args['show_on_front'] == 'page' ){
		update_option( 'show_on_front', 'page' );
	}	

	/**
	* Set Menus
	*/

	if ( !empty( $args['menu_locations'] ) ) {

		$nav_settings  = array();
		$current_menus = wp_get_nav_menus();

		if ( ! empty( $current_menus ) && ! is_wp_error( $current_menus ) ) {
			foreach ( $current_menus as $menu ) {
				foreach ( $args['menu_locations'] as $location => $menu_slug ) {
					if ( $menu->slug === $menu_slug ) {
						$nav_settings[ $location ] = $menu->term_id;
					}
				}
			}
		}

		set_theme_mod( 'nav_menu_locations', $nav_settings );
	}

}

function bizberg_search_replace_content( $slug ){

	switch ( $slug ) {

		case 'education-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			$content = str_replace( '"serviceSubTitle":"n"' , '"serviceSubTitle":""' , $content );

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'slider' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"2"' , $category_new , $content );

			// Get Services Term ID
			// $services_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'construction-services' , $tax = 'services_cat' );
			// $category_new = '"selectedServicesCategoryID":"' . $services_cat_id . '"';
			// $content = str_replace( '"selectedServicesCategoryID":"41"' , $category_new , $content );
			
			// Get Gallery Term ID
			// $gallery_cat_id = bizberg_get_taxonomy_id_by_slug( 
			// 	$cat_name = 'construction-gallery', 
			// 	$tax = 'ct_gallery_category' 
			// );
			// $category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			// $content = str_replace( '"selectedGalleryCategoryID":"40"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'team' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":4' , $category_new , $content );
			
			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonials' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"5"' , $category_new , $content );

			// Get Progress Bar
			$courses_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'education-progress-bar' , $tax = 'category' );
			$category_new = '"categories":"' . $courses_cat_id . '"';
			$content = str_replace( '"categories":"3"' , $category_new , $content );

			// Get Blog
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'blog' , $tax = 'category' );
			$category_new = '"selectedPostCategoryID":"' . $post_cat_id . '"';
			$content = str_replace( '"selectedPostCategoryID":"1"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content,
			);

			// Update the post into the database
			wp_update_post( $my_post );

			break;

		default:
			# code...
			break;
	}

	bizberg_set_exercpt_empty();
	bizberg_set_team_meta_data();
	bizberg_set_testimonials_meta_data();
	// bizberg_set_font_icons_services();

}

function bizberg_set_contact_form_7_id( $name ){

	$contact_OBJ = get_page_by_title( $name, OBJECT, 'wpcf7_contact_form');
	
	if( !empty( $contact_OBJ->ID ) ){
		return absint( $contact_OBJ->ID );
	} else {
		return '';
	}	

}

function bizberg_set_font_icons_services(){

	$args = array(
		'post_type' => 'cp_services',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);

	$icons = array( 'fa fa-cubes' , 'fas fa-tachometer-alt' , 'fal fa-newspaper' );

	$services_query = new WP_Query( $args );
	$count = 0;

	if( $services_query->have_posts() ):

		while( $services_query->have_posts() ): $services_query->the_post();

			global $post;
			$icon = get_post_meta( $post->ID, 'icon', true );
			if( empty( sanitize_text_field( $icon ) ) ){
				update_post_meta( $post->ID, 'icon', $icons[$count] );	
				$count++;
			}

		endwhile;

		wp_reset_postdata();

	endif;

}