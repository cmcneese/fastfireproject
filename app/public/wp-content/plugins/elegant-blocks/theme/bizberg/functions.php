<?php

function bizberg_set_page_theme_mod( $slug ){

	switch ( $slug ) {

		case 'restaurant-homepage':
		case 'restaurant-pro':
			set_theme_mod( 'general-settings' , '#bb9f5d' );
			set_theme_mod( 'header_menu_color_hover' , '#bb9f5d' );
			set_theme_mod( 'header_button_color' , '#bb9f5d' );
			set_theme_mod( 'header_button_color_hover' , '#bb9f5d' );
			set_theme_mod( 'custom_logo' , bizberg_get_attachment_by_post_name( 'yellow-2' ) );			
			break;

		case 'construction-free':
		case 'construction-pro':
			set_theme_mod( 'general-settings' , '#fcb80b' );
			set_theme_mod( 'header_menu_color_hover' , '#fcb80b' );
			set_theme_mod( 'header_button_color' , '#fcb80b' );
			set_theme_mod( 'header_button_color_hover' , '#fcb80b' );
			set_theme_mod( 'custom_logo' , bizberg_get_attachment_by_post_name( 'yellow-2' ) );			
			break;

		case 'charity-free':
		case 'charity-pro':
			set_theme_mod( 'general-settings' , '#e0be53' );
			set_theme_mod( 'header_menu_color_hover' , '#e0be53' );
			set_theme_mod( 'header_button_color' , '#e0be53' );
			set_theme_mod( 'header_button_color_hover' , '#e0be53' );
			set_theme_mod( 'custom_logo' , bizberg_get_attachment_by_post_name( 'yellow-2' ) );			
			break;

		case 'nature-free':
		case 'nature-pro':
			set_theme_mod( 'general-settings' , '#6ab43e' );
			set_theme_mod( 'header_menu_color_hover' , '#6ab43e' );
			set_theme_mod( 'header_button_color' , '#6ab43e' );
			set_theme_mod( 'header_button_color_hover' , '#6ab43e' );
			set_theme_mod( 'custom_logo' , bizberg_get_attachment_by_post_name( 'green-2' ) );			
			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_attachment_by_post_name( $post_name ) {

    $args = array(
        'posts_per_page' => 1,
        'post_type'      => 'attachment',
        'name'           => trim( $post_name ),
    );

    $get_attachment = new WP_Query( $args );

    if ( empty( $get_attachment->posts[0]->ID ) ) {
        return false;
    }

    return absint( $get_attachment->posts[0]->ID );
}

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

		case 'Homepage 1':			
			$args['default_page']['page_on_front'] = 'default-home';
			bizberg_set_defaults( $args );
			break;

		case 'Homepage 2':			
			$args['default_page']['page_on_front'] = 'homepage-2';
			bizberg_set_defaults( $args );
			break;

		case 'Homepage 3':	
			$args['default_page']['page_on_front'] = 'homepage-3';
			bizberg_set_defaults( $args );
			break;

		case 'Gradient Slider 1':
			$args['default_page']['page_on_front'] = 'gradient-slider-1';
			bizberg_set_defaults( $args );
			break;

		case 'Gradient Slider 2':
			$args['default_page']['page_on_front'] = 'gradient-slider-2';
			bizberg_set_defaults( $args );
			break;

		case 'Gradient Slider 3':
			$args['default_page']['page_on_front'] = 'gradient-slider-3';
			bizberg_set_defaults( $args );
			break;

		case 'Simple Homepage':
			$args['default_page']['page_on_front'] = 'simple-homepage';
			bizberg_set_defaults( $args );
			break;

		case 'Restaurant Homepage':
			$args['default_page']['page_on_front'] = 'restaurant-homepage';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'restaurant-homepage' );

			break;

		case 'Restaurant 2 Homepage':
			$args['default_page']['page_on_front'] = 'restaurant-2-free';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'restaurant-homepage' );

			break;

		case 'Restaurant 2 PRO Homepage':
			$args['default_page']['page_on_front'] = 'restaurant-2-pro-version';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'restaurant-homepage' );

			break;

		case 'Education Homepage':
			$args['default_page']['page_on_front'] = 'education-free';
			bizberg_set_defaults( $args );
			break;

		case 'Medical Homepage':
			$args['default_page']['page_on_front'] = 'medical-free';
			bizberg_set_defaults( $args );
			break;

		case 'Restaurant Homepage PRO':
			$args['default_page']['page_on_front'] = 'restaurant-pro';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'restaurant-pro' );
			break;

		case 'Education Homepage PRO':
			$args['default_page']['page_on_front'] = 'education-pro';
			bizberg_set_defaults( $args );
			break;

		case 'Construction PRO':
			$args['default_page']['page_on_front'] = 'construction-pro';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'construction-pro' );
			break;

		case 'Charity PRO':
			$args['default_page']['page_on_front'] = 'charity-pro';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'charity-pro' );
			break;

		case 'Nature PRO':
			$args['default_page']['page_on_front'] = 'nature-pro';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'nature-pro' );
			break;

		case 'Transparent Header':
			$args['default_page']['page_on_front'] = 'transparent-header';
			bizberg_set_defaults( $args );
			break;

		case 'Medical Homepage PRO':
			$args['default_page']['page_on_front'] = 'medical-pro';
			bizberg_set_defaults( $args );
			break;

		case 'Transparent Header Gradient Slider':
			$args['default_page']['page_on_front'] = 'transparent-header-gradient-slider';
			bizberg_set_defaults( $args );
			break;

		case 'Theme Color ( Red )':
			$args['default_page']['page_on_front'] = 'homepage-red';
			bizberg_set_defaults( $args );
			break;

		case 'Theme Color ( Yellow )':
			$args['default_page']['page_on_front'] = 'homepage-yellow';
			bizberg_set_defaults( $args );
			break;

		case 'Theme Color ( Green )':
			$args['default_page']['page_on_front'] = 'homepage-green';
			bizberg_set_defaults( $args );
			break;

		case 'Theme Color ( Black )':
			$args['default_page']['page_on_front'] = 'homepage-black';
			bizberg_set_defaults( $args );
			break;

		case 'Construction Homepage':
			$args['default_page']['page_on_front'] = 'construction-free';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'construction-free' );
			break;

		case 'Charity Homepage':
			$args['default_page']['page_on_front'] = 'charity-free';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'charity-free' );
			break;

		case 'Nature Homepage':
			$args['default_page']['page_on_front'] = 'nature-free';
			bizberg_set_defaults( $args );

			// Set theme mod according to page settings
			bizberg_set_page_theme_mod( 'nature-free' );
			break;

		case 'Wedding Homepage':
			$args['default_page']['page_on_front'] = 'wedding-free';
			bizberg_set_defaults( $args );
			break;

		case 'Wedding PRO':
			$args['default_page']['page_on_front'] = 'wedding-planner-pro';
			bizberg_set_defaults( $args );
			break;

		default:
			# code...
			break;
	}

}

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

function bizberg_set_font_icons_posts(){

	$cat_name = array( 
		'what-we-offer-restaurant', 
		'about-us',
		'our-services'
	);

	$offer_restaurant_icons = array( 
		'fa fa-coffee', 
		'fa fa-beer', 
		'fa fa-users', 
		'fal fa-utensils-alt' 
	);

	$about_us_icons = array( 
		'fal fa-headphones-alt', 
		'fal fa-alarm-clock', 
		'fal fa-star', 
		'fal fa-laptop' 
	);

	$our_services_icons = array( 
		'fab fa-sketch', 
		'fal fa-layer-group', 
		'fal fa-hammer-war', 
		'fal fa-tachometer-alt-fastest' 
	);

	foreach ( $cat_name as $value ) {
		
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'category_name' => $value
		);

		$post_query = new WP_Query( $args );
		$count = 0;

		if( $post_query->have_posts() ):

			while( $post_query->have_posts() ): $post_query->the_post();

				global $post;

				switch ( $value ) {

					case 'what-we-offer-restaurant':
						update_post_meta( $post->ID, 'icon', $offer_restaurant_icons[$count] );
						break;

					case 'about-us':
						update_post_meta( $post->ID, 'icon', $about_us_icons[$count] );
						break;

					case 'our-services':
						update_post_meta( $post->ID, 'icon', $our_services_icons[$count] );
						break;
					
					default:
						# code...
						break;
				}

				$count++;

			endwhile;

		endif;

	}

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

	$terms = array( 'team' , 'our-chefs' , 'doctors' );
	$team = array( 'Accountant' , 'Co-founder' , 'CEO' , 'Web Designer' );
	$chefs = array( 'Supervisor' , 'Junior Chef' , 'Senior Chef' , 'Quality Checker' );
	$medical = array( 'Prosthodontist' , 'Dental Hygienist' , 'Associate Dentist' , 'Oral Health Therapist' );

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
						update_post_meta( $post->ID, 'position', $team[$count] );
						break;

					case 'our-chefs':
						update_post_meta( $post->ID, 'position', $chefs[$count] );					
						break;

					case 'doctors':
						update_post_meta( $post->ID, 'position', $medical[$count] );				
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

	$args['search_replace'][] = 'default-home';
	$args['search_replace'][] = 'homepage-2';
	$args['search_replace'][] = 'homepage-3';
	$args['search_replace'][] = 'gradient-slider-1';
	$args['search_replace'][] = 'gradient-slider-2';
	$args['search_replace'][] = 'gradient-slider-3';
	$args['search_replace'][] = 'simple-homepage';
	$args['search_replace'][] = 'restaurant-homepage';
	$args['search_replace'][] = 'restaurant-2-free';
	$args['search_replace'][] = 'restaurant-2-pro-version';
	$args['search_replace'][] = 'education-free';
	$args['search_replace'][] = 'medical-free';
	$args['search_replace'][] = 'restaurant-pro';
	$args['search_replace'][] = 'education-pro';
	$args['search_replace'][] = 'medical-pro';
	$args['search_replace'][] = 'construction-pro';
	$args['search_replace'][] = 'charity-pro';
	$args['search_replace'][] = 'nature-pro';
	$args['search_replace'][] = 'transparent-header';
	$args['search_replace'][] = 'transparent-header-gradient-slider';
	$args['search_replace'][] = 'homepage-red';
	$args['search_replace'][] = 'homepage-yellow';
	$args['search_replace'][] = 'homepage-green';
	$args['search_replace'][] = 'homepage-black';
	$args['search_replace'][] = 'about-us';
	$args['search_replace'][] = 'about-us-layout-2';
	$args['search_replace'][] = 'our-team';
	$args['search_replace'][] = 'our-services';
	$args['search_replace'][] = 'pricing-plans';
	$args['search_replace'][] = 'construction-free';
	$args['search_replace'][] = 'charity-free';
	$args['search_replace'][] = 'nature-free';
	$args['search_replace'][] = 'wedding-free';
	$args['search_replace'][] = 'wedding-planner-pro';

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

add_filter( 'bizberg_predesigned_sites', 'bizberg_predesigned_sites_customizer' );
function bizberg_predesigned_sites_customizer(){

	return array(
		array(
			'title' => 'Simple Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/simple-homepage/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-7.jpg'
		),
		array(
			'title' => 'Transparent Header PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/transparent-header/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/transparent-header.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Homepage 1',
			'preview_link' => 'https://bizberg.cyclonethemes.com/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-1.jpg'
		),
		array(
			'title' => 'Homepage 2',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-2/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-2.jpg'
		),
		array(
			'title' => 'Homepage 3',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-3/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-3.jpg'
		),
		array(
			'title' => 'Gradient Slider 1',
			'preview_link' => 'https://bizberg.cyclonethemes.com/gradient-slider-1/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-4.jpg'
		),
		array(
			'title' => 'Gradient Slider 2',
			'preview_link' => 'https://bizberg.cyclonethemes.com/gradient-slider-2/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-5.jpg'
		),
		array(
			'title' => 'Gradient Slider 3',
			'preview_link' => 'https://bizberg.cyclonethemes.com/gradient-slider-3/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/homepage-6.jpg'
		),
		array(
			'title' => 'Theme Color ( Red )',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-red/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/color-red.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Theme Color ( Yellow )',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-yellow/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/color-yellow.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Theme Color ( Green )',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-green/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/color-green.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Theme Color ( Black )',
			'preview_link' => 'https://bizberg.cyclonethemes.com/homepage-black/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/color-black.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Restaurant Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/restaurant-homepage/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/restaurant-free.jpg'
		),
		array(
			'title' => 'Restaurant 2 Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/reataurant-2-free/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/restaurant-2-free.jpg'
		),
		array(
			'title' => 'Restaurant Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/restaurant-pro/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/restaurant-pro-1.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Education Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/education-free/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/education-free.jpg'
		),
		array(
			'title' => 'Education Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/education-pro/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/education-pro.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Medical Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/medical-free/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/medical-free.jpg'
		),
		array(
			'title' => 'Medical Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/medical-pro/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/medical-pro-1.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Construction Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/construction-free/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/construction-free.jpg'
		),
		array(
			'title' => 'Construction Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/construction-pro/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/construction-pro.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Charity Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/charity-free/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/charity-free.jpg'
		),
		array(
			'title' => 'Charity Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/charity-pro/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/charity-pro.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Nature Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/nature-free/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/nature-free.jpg'
		),
		array(
			'title' => 'Nature Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/nature-pro/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/nature-pro.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Wedding Homepage',
			'preview_link' => 'https://bizberg.cyclonethemes.com/wedding-free/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/wedding-free.jpg'
		),
		array(
			'title' => 'Wedding Homepage PRO',
			'preview_link' => 'https://bizberg.cyclonethemes.com/wedding-planner-pro/',
			'image' => 'https://cyclonethemes.com/wp-content/uploads/2018/06/wedding-pro.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'About Us',
			'preview_link' => 'https://bizberg.cyclonethemes.com/about-us/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/about-us.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'About Us ( Layout 2 )',
			'preview_link' => 'https://bizberg.cyclonethemes.com/about-us-layout-2/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/about-us-2.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Team',
			'preview_link' => 'https://bizberg.cyclonethemes.com/our-team/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/our-team.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Services',
			'preview_link' => 'https://bizberg.cyclonethemes.com/our-services/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/services.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'Pricing Plan',
			'preview_link' => 'https://bizberg.cyclonethemes.com/pricing-plans/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/pricing.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
		array(
			'title' => 'FAQ',
			'preview_link' => 'https://bizberg.cyclonethemes.com/frequently-asked-questions/',
			'image' => ELEGANTBLOCKS_PLUGIN_URL . '/src/images/screen/faq.jpg',
			'pro' => 'https://cyclonethemes.com/downloads/bizberg-pro/'
		),
	);

}