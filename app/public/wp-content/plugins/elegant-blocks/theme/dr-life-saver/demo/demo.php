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
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/medical-homepage-free.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage Transparent Header', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-transparent-header.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/transparent-header/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage Slider 1', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-slider-1.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/homepage-slider/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage Slider 2', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-slider-2.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/homepage-slider-2/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Homepage Slider 3', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-slider-3.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/homepage-slider-3/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'About Us', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/about-us-3.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/about-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Pricing', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/pricing-1.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/pricing/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'FAQ', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/faq-1.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/faq/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gallery 1', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages','Gallery' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/gallery-medical.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/gallery-1/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gallery 2', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages','Gallery' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/gallery-2.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/gallery-2/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Gallery 3', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages','Gallery' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-gallery-3.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/gallery-3/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Contact Us 1', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages','Contact Us' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/contact-us-1.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/contact-us/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Contact Us 2', 'bizberg' ),
	      	'categories'                   => array( 'PRO','Inner Pages','Contact Us' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/contact-us-2.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/contact-us-2/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Category Page', 'bizberg' ),
	      	'categories'                   => array( 'Free','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-category-free.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/author/cyclone/',
	    ),
	    array(
	      	'import_file_name'             => esc_html__( 'Detail Page', 'bizberg' ),
	      	'categories'                   => array( 'Free','Inner Pages' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-detail-free.jpg',
	      	'preview_url'                  => 'https://dr-life-saver-pro.cyclonethemes.com/2019/07/12/outpatient-rehabilitation/',
	    ),
  	);
}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="homepage transparent header"] button,
	    	.js-ocdi-gl-item[data-name="homepage slider 1"] button,
	    	.js-ocdi-gl-item[data-name="homepage slider 2"] button,
	    	.js-ocdi-gl-item[data-name="homepage slider 3"] button,
	    	.js-ocdi-gl-item[data-name="about us"] button,
	    	.js-ocdi-gl-item[data-name="pricing"] button,	    	
	    	.js-ocdi-gl-item[data-name="faq"] button,
	    	.js-ocdi-gl-item[data-name="gallery 1"] button,
	    	.js-ocdi-gl-item[data-name="gallery 2"] button,
	    	.js-ocdi-gl-item[data-name="gallery 3"] button,
	    	.js-ocdi-gl-item[data-name="contact us 2"] button,
	    	.js-ocdi-gl-item[data-name="contact us 1"] button,
	    	.js-ocdi-gl-item[data-name="category page"] button,
	    	.js-ocdi-gl-item[data-name="detail page"] button
	    	{
			    display: none;
			}
	  	</style>

		<?php
	}
	
}