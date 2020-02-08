<?php

// Disable generation of smaller images (thumbnails) during the content import
if( get_option( 'elegant_blocks_disable_smaller_images_on_import' ) == 1 ){
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );	
}

add_filter( 'pt-ocdi/import_files', 'bizberg_import_files' );
function bizberg_import_files() {
  	return array(
  		array(
      		'import_file_name'             => esc_html__( 'Simple Homepage Free', 'bizberg' ),
      		'categories'                   => array( 'Free','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/professional-education-consultancy.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Transparent Header', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/education-transparent-header.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/homepage-transparent/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage Slider 1', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/slider-1.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/homepage-slider-1/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage Slider 2', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/slider-2.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/homepage-slider-2/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage Slider 3', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/slider-3.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/homepage-slider-3/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Services', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage','Pages' ),
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/services-2.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/services/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Contact US 1', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage','Pages' ),
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/contact-us-1-1.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/contact-form-1/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Contact US 2', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage','Pages' ),
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/contact-us-2-1.jpg',
	      	'preview_url'                  => 'https://professional-education-consultancy-pro.cyclonethemes.com/contact-form-2/',
	    )
  	);
}

add_filter( 'bizberg_recommended_plugins', 'professional_education_consultancy_pro_recommended_plugins' );
function professional_education_consultancy_pro_recommended_plugins( $data ){

	$data[] = array(
		'name'      => esc_html__( 'Advanced Custom Fields', 'professional-education-consultancy' ),
		'slug'      => 'advanced-custom-fields',
		'required'  => true,
	);

	$data[] = array(
		'name'      => esc_html__( 'Data Types for Professional Education Consultancy PRO', 'professional-education-consultancy' ),
		'slug'      => 'data-types-bizberg',
		'required'  => true,
		'source'    => get_template_directory() . '/inc/plugins/data-types-bizberg.zip'
	);

	$data[] = array(
		'name'      => esc_html__( 'Block Gallery – Photo Gallery Gutenberg Blocks', 'professional-education-consultancy' ),
		'slug'      => 'block-gallery',
		'required'  => true
	);

	return $data;

}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="services"] button,
	    	.js-ocdi-gl-item[data-name="contact us 2"] button,
	    	.js-ocdi-gl-item[data-name="contact us 1"] button
	    	{
			    display: none;
			}
	  	</style>

		<?php
	}
	
}