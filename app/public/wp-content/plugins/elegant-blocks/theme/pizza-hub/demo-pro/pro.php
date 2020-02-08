<?php

// Disable generation of smaller images (thumbnails) during the content import
if( get_option( 'elegant_blocks_disable_smaller_images_on_import' ) == 1 ){
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );	
}

add_filter( 'pt-ocdi/import_files', 'pizza_hub_pro_import_files' );
function pizza_hub_pro_import_files() {

	return array(
		array(
      		'import_file_name'             => esc_html__( 'Simple Homepage', 'pizza-hub-pro' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-1-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/', 
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage FREE', 'pizza-hub-pro' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-free.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-free/', 
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage ( Video Banner )', 'pizza-hub-pro' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/homepage-2-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-2/', 
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Homepage 3', 'pizza-hub-pro' ),
      		'categories'                   => array( 'Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
		    'local_import_widget_file'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'widgets.wie',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-3-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-3/', 
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'About Us', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/about-us-1.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/about-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Service', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/services-1.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/team/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Contact US', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/contact-us.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/contact-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Image Grid', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/image-grid.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/image-grid/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Masonry Gallery', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/masonry-gallery.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/masonry-gallery/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Carousel Gallery', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/carousel-slider.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/carousel-slider/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Category Page', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/category.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/category/blog/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Detail Page', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/pizza-hub-detail-page.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/vestibulum-auctor-massa-arcu/',
	    ),
	);

}

add_filter( 'bizberg_recommended_plugins', 'pizza_hub_pro_recommended_plugins' );
function pizza_hub_pro_recommended_plugins( $data ){

	$data[] = array(
		'name'      => esc_html__( 'Advanced Custom Fields', 'pizza-hub-pro' ),
		'slug'      => 'advanced-custom-fields',
		'required'  => true,
	);

	$data[] = array(
		'name'      => esc_html__( 'Mailpoet', 'pizza-hub-pro' ),
		'slug'      => 'mailpoet',
		'required'  => true,
	);

	$data[] = array(
		'name'      => esc_html__( 'Data Types for Pizza Hub PRO', 'pizza-hub-pro' ),
		'slug'      => 'data-types-bizberg',
		'required'  => true,
		'source'    => get_template_directory() . '/inc/plugins/data-types-bizberg.zip'
	);

	$data[] = array(
		'name'      => esc_html__( 'Block Gallery – Photo Gallery Gutenberg Blocks', 'pizza-hub-pro' ),
		'slug'      => 'block-gallery',
		'required'  => true
	);

	return $data;

}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="about us"] button,
	    	.js-ocdi-gl-item[data-name="service"] button,
	    	.js-ocdi-gl-item[data-name="contact us"] button,	    	
	    	.js-ocdi-gl-item[data-name="image grid"] button,
	    	.js-ocdi-gl-item[data-name="masonry gallery"] button,
	    	.js-ocdi-gl-item[data-name="carousel gallery"] button,
	    	.js-ocdi-gl-item[data-name="category page"] button,
	    	.js-ocdi-gl-item[data-name="detail page"] button
	    	{
			    display: none;
			}
	  	</style>

		<?php
	}
	
}