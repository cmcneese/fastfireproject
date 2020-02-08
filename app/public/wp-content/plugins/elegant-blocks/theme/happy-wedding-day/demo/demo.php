<?php

// Disable generation of smaller images (thumbnails) during the content import
if( get_option( 'elegant_blocks_disable_smaller_images_on_import' ) == 1 ){
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );	
}

add_filter( 'pt-ocdi/import_files', 'bizberg_import_files' );
function bizberg_import_files() {
  	return array(
  		array(
      		'import_file_name'             => esc_html__( 'Wedding Homepage Free', 'bizberg' ),
      		'categories'                   => array( 'Free','Homepage' ),
      		'local_import_file'            => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'demo-content.xml',
		    'local_import_customizer_file' => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customizer.dat',
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/happy-wedding-day-homepage.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/wedding-free/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Wedding Planner PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/wedding-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/wedding-planner-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Restaurant PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/restaurant-2-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/restaurant-pro-version-2/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Nature PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/nature-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/nature-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Charity PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/charity-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/charity-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Construction PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/construction-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/construction-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Education PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'https://cyclonethemes.com/wp-content/uploads/2018/06/education-pro.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/education-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Medical PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/medical-pro-1.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/medical-pro/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Business 1 PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-1.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Business 2 PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-2.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/homepage-2/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Business 3 PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/homepage-3.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/homepage-3/',
	    ),
	    array(
      		'import_file_name'             => esc_html__( 'Business Transparent Header PRO', 'bizberg' ),
      		'categories'                   => array( 'PRO','Homepage' ),
	      	'import_preview_image_url'     => 'http://cyclonethemes.com/wp-content/uploads/2018/06/transparent-header.jpg',
	      	'preview_url'                  => 'https://bizberg.cyclonethemes.com/transparent-header/',
	    )
  	);
}

add_action('admin_head', 'bizberg_custom_admin_css');
function bizberg_custom_admin_css() { 

	if( !empty( $_GET['page'] ) && $_GET['page'] == 'cyclone-one-click-demo-import' ){ ?>

		<style>
	    	.js-ocdi-gl-item[data-name="restaurant pro"] button,
	    	.js-ocdi-gl-item[data-name="nature pro"] button,
	    	.js-ocdi-gl-item[data-name="charity pro"] button,
	    	.js-ocdi-gl-item[data-name="construction pro"] button,
	    	.js-ocdi-gl-item[data-name="wedding planner pro"] button,
	    	.js-ocdi-gl-item[data-name="construction pro"] button,
	    	.js-ocdi-gl-item[data-name="education pro"] button,
	    	.js-ocdi-gl-item[data-name="medical pro"] button,
	    	.js-ocdi-gl-item[data-name="business 1 pro"] button,
	    	.js-ocdi-gl-item[data-name="business 2 pro"] button,
	    	.js-ocdi-gl-item[data-name="business 3 pro"] button,
	    	.js-ocdi-gl-item[data-name="business transparent header pro"] button
	    	{
			    display: none;
			}
	  	</style>

		<?php
	}
	
}