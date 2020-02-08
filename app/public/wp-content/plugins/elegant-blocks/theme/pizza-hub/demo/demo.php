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
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-free.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-free/',
	    ),
    	array(
      		'import_file_name'             => esc_html__( 'Homepage 1', 'bizberg' ),
      		'categories'                   => array( 'Homepage','PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-1-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage ( Video Banner )', 'bizberg' ),
	      	'categories'                   => array( 'Homepage','PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-2-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-2/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage 3', 'bizberg' ),
	      	'categories'                   => array( 'Homepage','PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-3-pro.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/homepage-3/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'About Us', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages','PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/about-us-1.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/about-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Service', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/services-1.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/team/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Contact US', 'bizberg' ),
	      	'categories'                   => array( 'Inner Pages' , 'PRO' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/contact-us.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/contact-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Image Grid', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'PRO' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/image-grid.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/image-grid/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Masonry Gallery', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'PRO' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/masonry-gallery.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/masonry-gallery/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Carousel Gallery', 'bizberg' ),
	      	'categories'                   => array( 'Gallery' , 'PRO' , 'Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/carousel-slider.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/carousel-slider/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Category Page', 'bizberg' ),
	      	'categories'                   => array( 'Free','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/category.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/category/blog/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Detail Page', 'bizberg' ),
	      	'categories'                   => array( 'Free','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/pizza-hub-detail-page.jpg',
	      	'preview_url'                  => 'https://pizza-hub-pro.cyclonethemes.com/vestibulum-auctor-massa-arcu/',
	    ),
  	);
}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="homepage 1"] button,
	    	.js-ocdi-gl-item[data-name="homepage ( video banner )"] button,
	    	.js-ocdi-gl-item[data-name="homepage 3"] button,
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