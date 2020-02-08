<?php

// Disable generation of smaller images (thumbnails) during the content import
if( get_option( 'elegant_blocks_disable_smaller_images_on_import' ) == 1 ){
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );	
}


add_filter( 'pt-ocdi/import_files', 'bizberg_import_files' );
function bizberg_import_files() {
  	return array(
  		array(
      		'import_file_name'             => esc_html__( 'Simple Homepage', 'bizberg' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-7.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/simple-homepage/' ),
	    ),
    	array(
      		'import_file_name'             => esc_html__( 'Homepage 1', 'bizberg' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-1.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage 2', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . '-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-2.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-2/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage 3', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-3.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-3/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gradient Slider 1', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'Gradient Slider' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-4.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/gradient-slider-1/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gradient Slider 2', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'Gradient Slider' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-5.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/gradient-slider-2/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gradient Slider 3', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'Gradient Slider' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/homepage-6.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/gradient-slider-3/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Restaurant Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/restaurant-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/restaurant-homepage/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Restaurant 2 Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/restaurant-2-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/reataurant-2-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Education Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/education-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/education-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Medical Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/medical-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/medical-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Construction Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/construction-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/construction-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Charity Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/charity-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/charity-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Nature Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/nature-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/nature-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Wedding Homepage', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' ),
	      	'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/wedding-free.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/wedding-free/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Restaurant Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/restaurant-pro-1.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/restaurant-pro/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Education Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/education-pro.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/education-pro/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Medical Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/medical-pro-1.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/medical-pro/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Construction Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/construction-pro.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/construction-pro/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Wedding Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/wedding-pro.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/wedding-planner-pro/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Charity Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/charity-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/charity-pro/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Nature Homepage PRO', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/nature-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/nature-pro/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Transparent Header', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'Header' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/transparent-header.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/transparent-header/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Theme Color ( Red )', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' , 'Color Option' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/color-red.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-red/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Theme Color ( Yellow )', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' , 'Color Option' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/color-yellow.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-yellow/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Theme Color ( Green )', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' , 'Color Option' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/color-green.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-green/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Theme Color ( Black )', 'bizberg' ),
	      	'categories'                   => array( 'Homepage' , 'PRO' , 'Color Option' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/color-black.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/homepage-black/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'About Us', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/about-us.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/about-us/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'About Us ( Layout 2 )', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/about-us-2.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/about-us-layout-2/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Our Team', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/our-team.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/our-team/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Services', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/services.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/our-services/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Pricing Plan', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/pricing.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/pricing-plans/' ),
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'FAQ', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => ELEGANTBLOCKS_PLUGIN_URL . 'src/images/screen/faq.jpg',
	      	'preview_url'                  => esc_url( 'https://bizberg.cyclonethemes.com/frequently-asked-questions/' ),
	    ),
  	);
}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="transparent header"] button,
	    	.js-ocdi-gl-item[data-name="theme color ( red )"] button,
	    	.js-ocdi-gl-item[data-name="theme color ( yellow )"] button,
	    	.js-ocdi-gl-item[data-name="theme color ( green )"] button,
	    	.js-ocdi-gl-item[data-name="theme color ( black )"] button,
	    	.js-ocdi-gl-item[data-name="about us"] button,
	    	.js-ocdi-gl-item[data-name="about us ( layout 2 )"] button,
	    	.js-ocdi-gl-item[data-name="our team"] button,
	    	.js-ocdi-gl-item[data-name="services"] button,
	    	.js-ocdi-gl-item[data-name="pricing plan"] button,
	    	.js-ocdi-gl-item[data-name="faq"] button,
	    	.js-ocdi-gl-item[data-name="restaurant homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="medical homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="education homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="construction homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="charity homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="nature homepage pro"] button,
	    	.js-ocdi-gl-item[data-name="wedding homepage pro"] button
	    	{
			    display: none;
			}
	  	</style>

		<?php
	}
	
}

function bizberg_search_replace_content( $slug ){

	switch ( $slug ) {

		case 'default-home':
		case 'homepage-2':
		case 'homepage-3':
		case 'simple-homepage':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"33"' , $category_new , $content );

			// Get Services Term ID
			$services_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'business-services' , $tax = 'services_cat' );
			$category_new = '"selectedServicesCategoryID":"' . $services_cat_id . '"';
			$content = str_replace( '"selectedServicesCategoryID":"31"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"34"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'team' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":42' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Client Term ID
			$client_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'clients' , $tax = 'client_cat' );
			$category_new = '"selectedClientCatID":"' . $client_cat_id . '"';
			$content = str_replace( '"selectedClientCatID":"32"' , $category_new , $content );

			$content = str_replace( '"serviceSubTitle":"n"' , '"serviceSubTitle":""' , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content,
			);

			// Update the post into the database
			wp_update_post( $my_post );

			break;
		
		case 'gradient-slider-1':
		case 'gradient-slider-2':
		case 'gradient-slider-3':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"33"' , $category_new , $content );

			// Get Services Term ID
			$services_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'business-services' , $tax = 'services_cat' );
			$category_new = '"selectedServicesCategoryID":"' . $services_cat_id . '"';
			$content = str_replace( '"selectedServicesCategoryID":"31"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'team' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":42' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"34"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content,
			);

			// Update the post into the database
			wp_update_post( $my_post );

			break;

		case 'restaurant-homepage':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'restaurant' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"41"' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'our-chefs' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":39' , $category_new , $content );

			// Get Client Term ID
			$client_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'clients' , $tax = 'client_cat' );
			$category_new = '"selectedClientCatID":"' . $client_cat_id . '"';
			$content = str_replace( '"selectedClientCatID":"32"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'what-we-offer-restaurant' , $tax = 'category' );
			$category_new = '"selectedCategory":"' . $post_cat_id . '"';
			$content = str_replace( '"selectedCategory":"10"' , $category_new , $content );
			
			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );			

			break;

		case 'restaurant-2-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'restaurant' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"41"' , $category_new , $content );

			// Get post cat id
			$cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'what-we-offer-restaurant' , $tax = 'category' );
			$category_new = '"selectedCategory":"' . $cat_id . '"';
			$content = str_replace( '"selectedCategory":"10"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"34"' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'our-chefs' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":39' , $category_new , $content );

			// Get Client Term ID
			$client_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'clients' , $tax = 'client_cat' );
			$category_new = '"selectedClientCatID":"' . $client_cat_id . '"';
			$content = str_replace( '"selectedClientCatID":"32"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );	

			break;

		case 'education-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'education' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"36"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'team' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":42' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'education-progress-bar' , $tax = 'category' );
			$category_new = '"categories":"' . $post_cat_id . '"';
			$content = str_replace( '"categories":"5"' , $category_new , $content );
			
			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );			

			break;

		case 'medical-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'medical' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"37"' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'doctors' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":35' , $category_new , $content );

			// Get post cat id
			$cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'departments-medical' , $tax = 'category' );
			$category_new = '"selectedCategory":"' . $cat_id . '"';
			$content = str_replace( '"selectedCategory":"4"' , $category_new , $content );
			
			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );			

			break;

		case 'construction-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'construction' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"47"' , $category_new , $content );

			// Get Services Term ID
			$services_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'business-services' , $tax = 'services_cat' );
			$category_new = '"selectedServicesCategoryID":"' . $services_cat_id . '"';
			$content = str_replace( '"selectedServicesCategoryID":"48"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'construction-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"49"' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'construction-blog' , $tax = 'category' );
			$category_new = '"categories":"' . $post_cat_id . '"';
			$content = str_replace( '"categories":"50"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );		

			break;

		case 'charity-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'charity' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"51"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'charity-blog' , $tax = 'category' );
			$category_new = '"categories":"' . $post_cat_id . '"';
			$content = str_replace( '"categories":"52"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'charity-blog-2' , $tax = 'category' );
			$category_new = '"categories":"' . $post_cat_id . '"';
			$content = str_replace( '"categories":"54"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'charity-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"53"' , $category_new , $content );

			// Get Testimonial Term ID
			$testimonials_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'testimonial' , $tax = 'ct_testimonial_category' );
			$category_new = '"selectedTestimonialCategoryID":"' . $testimonials_cat_id . '"';
			$content = str_replace( '"selectedTestimonialCategoryID":"43"' , $category_new , $content );

			// Get Team Term ID
			$team_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'team' , $tax = 'ct_team_category' );
			$category_new = '"selectedCategoryID":' . $team_cat_id;
			$content = str_replace( '"selectedCategoryID":42' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );	

			break;

		case 'nature-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Slider Term ID
			$slider_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'nature' , $tax = 'ct_slider_category' );
			$category_new = '"selectedSliderCategoryID":"' . $slider_cat_id . '"';
			$content = str_replace( '"selectedSliderCategoryID":"55"' , $category_new , $content );

			// Get accordion
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'what-we-offer-restaurant' , $tax = 'category' );
			$category_new = '"selectedPostCategoryID":"' . $post_cat_id . '"';
			$content = str_replace( '"selectedPostCategoryID":"10"' , $category_new , $content );

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'charity-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"53"' , $category_new , $content );

			// Get post-masonry id
			$post_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'nature-blog' , $tax = 'category' );
			$category_new = '"categories":"' . $post_cat_id . '"';
			$content = str_replace( '"categories":"56"' , $category_new , $content );

			// Get Client Term ID
			$client_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'clients' , $tax = 'client_cat' );
			$category_new = '"selectedClientCatID":"' . $client_cat_id . '"';
			$content = str_replace( '"selectedClientCatID":"32"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );	

			break;

		case 'wedding-free':

			// Get $post object from slug
			$result = get_page_by_path( $slug );
			$content = $result->post_content;

			// Get Gallery Term ID
			$gallery_cat_id = bizberg_get_taxonomy_id_by_slug( $cat_name = 'corporate-gallery' , $tax = 'ct_gallery_category' );
			$category_new = '"selectedGalleryCategoryID":"' . $gallery_cat_id . '"';
			$content = str_replace( '"selectedGalleryCategoryID":"34"' , $category_new , $content );

			$content = str_replace( 'u00' , '\\\u00' , $content );
			$content = preg_replace( '/(\d)([n])/', wp_slash( '$1\\\$2' ), $content );

			$my_post = array(
			    'ID'           => $result->ID,
			    'post_content' => $content
			);

			// Update the post into the database
			wp_update_post( $my_post );	

			break;

		default:
			# code...
			break;
	}

	bizberg_set_font_icons_services();
	bizberg_set_exercpt_empty();
	bizberg_set_team_meta_data();
	bizberg_set_testimonials_meta_data();
	bizberg_set_font_icons_posts();

}