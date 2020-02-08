<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Remove kirki notification
add_filter( 'kirki_telemetry', '__return_false' );

define( "ELEGANTBLOCKS_PLUGIN_URL", plugins_url( '/', dirname( __FILE__ ) ) );

/**
* Remove extra <br> and <p> tags if block
*/

remove_filter('the_content', 'wpautop');
add_filter('the_content', function ($content) {
    if ( has_blocks() ) {
        return $content;
    }
    return wpautop($content);
});

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * `wp-blocks`: includes block type registration and related functions.
 * `wp-element`: includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'elegant_blocks_cgb_editor_assets' );
function elegant_blocks_cgb_editor_assets() {

	wp_enqueue_script( 'wp-api' );
    
	// Scripts.
    wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script(
		'elegant-blocks-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element' , 'wp-components' , 'wp-editor' ) // Dependencies, defined above.
	);

    wp_enqueue_script( 
        'elegant_blocks_backend_editor_js', 
        plugins_url( '/dist/js/editor.js', dirname( __FILE__ ) ), 
        array( 'wp-blocks', 'wp-dom' ), 
        time(), 
        true 
    );

    // This js file will be included in both frontend and backend
    wp_enqueue_script( 
        'elegant_blocks_frontend_backend_js', 
        plugins_url( '/dist/js/frontend_backend.js', dirname( __FILE__ ) ), 
        array(), 
        time(), 
        true 
    );
    
    // Get google map api
    $google_map_api = get_option( 'elegant_blocks_google_map_api' );
    $google_map_script = get_option( 'elegant_blocks_google_map_script' ); 

    if( empty( $google_map_script ) ){
        wp_enqueue_script( 
            'elegant_blocks_google_map', 
            '//maps.googleapis.com/maps/api/js?libraries=places&key=' . esc_attr( $google_map_api ), 
            '0.1', 
            true 
        ); 
    }
    

    wp_enqueue_style( 'wp-jquery-ui-dialog' );
    wp_enqueue_style( 'gutenberg-editor-css', plugins_url( '/dist/css/gutenberg-base-editor-style.css', dirname( __FILE__ ) ) );
    wp_enqueue_style( 'gutenberg-blocks-css', plugins_url( '/dist/css/gutenberg-blocks.css', dirname( __FILE__ ) ) );
    wp_enqueue_style( 'font-awesome-5-backend', plugins_url( '/dist/font-awesome-5/css/all.css', dirname( __FILE__ ) ) );

}

add_action( 'wp_enqueue_scripts', 'elegant_blocks_main_style' , 999 );
function elegant_blocks_main_style(){
    wp_enqueue_style( 'elegant_blocks_custom_css', plugins_url( '/dist/css/elegantblock_style.css', dirname( __FILE__ ) ) );
    wp_enqueue_style( 'gutenberg-blocks-css', plugins_url( '/dist/css/gutenberg-blocks.css', dirname( __FILE__ ) ) );
}

add_action( 'wp_enqueue_scripts', 'elegant_blocks_plugin_styles' );
function elegant_blocks_plugin_styles() {

    $bootstrap_status = absint( get_option( 'elegant_blocks_bootstrap_status' ) ); 
    $google_font_status = absint( get_option( 'elegant_blocks_google_font_status' ) ); 
    $bootstrap_status = apply_filters( 'elegant_blocks_bootstrap', false );

    if( empty( $bootstrap_status ) ){
        wp_enqueue_style( 'bootstrap', plugins_url( '/dist/css/bootstrap.min.css', dirname( __FILE__ ) ) );
        wp_enqueue_script( 'bootstrap.js', plugins_url( '/dist/js/bootstrap.min.js', dirname( __FILE__ ) ) , array(), '0.1', true );
    }    

    $fontawesome_status = apply_filters( 'elegant_blocks_fontawesome', false );    
    if( empty( $fontawesome_status ) ){
        wp_enqueue_style( 'font-awesome-5', plugins_url( '/dist/font-awesome-5/css/all.css', dirname( __FILE__ ) ) );
    }
    
    wp_enqueue_style( 'animate', plugins_url( '/dist/css/animate.min.css', dirname( __FILE__ ) ) );
   
    wp_enqueue_style( 'elegant_blocks_plugins_css', plugins_url( '/dist/css/plugins.css', dirname( __FILE__ ) ) );


    // Add Google Font
    if( empty( $google_font_status ) ){
        wp_enqueue_style( 'open_sans_google_font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' );
        wp_enqueue_style( 'poppins_google_font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,800' );
        wp_enqueue_style( 'roboto_google_font', 'https://fonts.googleapis.com/css?family=Roboto:300,400,600,700,800' );
    }

    // JS
    wp_enqueue_script( 'jquery' );    
    wp_enqueue_script( 'jquery.touchSwipe.for.forms.min.js', plugins_url( '/dist/js/jquery.touchSwipe.for.forms.min.js', dirname( __FILE__ ) ) , array(), '0.1', true );
    wp_enqueue_script( 'elegant_blocks_responsive_bootstrap_carousel.min.js', plugins_url( '/dist/js/responsive_bootstrap_carousel.min.js', dirname( __FILE__ ) ) , array(), '0.1', true );
    wp_enqueue_script( 'slider_min.min.js', plugins_url( '/dist/js/slider_min.js', dirname( __FILE__ ) ) , array(), '0.1', true );
    wp_enqueue_script( 'elegantblock_custom', plugins_url( '/dist/js/elegantblock_custom.js', dirname( __FILE__ ) ) , array(), '0.1', false );
    wp_enqueue_script( 'elegant_blocks_plugins_js', plugins_url( '/dist/js/plugins.js', dirname( __FILE__ ) ) , array(), '0.1', true );
    wp_enqueue_script( 'instagram_js', plugins_url( '/dist/js/instagram.js', dirname( __FILE__ ) ) , array(), '0.1', false );
    wp_enqueue_script( 'slick', plugins_url( '/dist/js/slick.js', dirname( __FILE__ ) ) , array(), '0.1', true );

    // This js file will be included in both frontend and backend
    wp_register_script( 
        'elegant_blocks_frontend_backend_js', 
        plugins_url( '/dist/js/frontend_backend.js', dirname( __FILE__ ) ), 
        array(), 
        time(), 
        true 
    );

    $translation_array = array(
        'ELEGANTBLOCKS_PLUGIN_URL' => ELEGANTBLOCKS_PLUGIN_URL
    );

    wp_localize_script( 'elegant_blocks_frontend_backend_js', 'mb_backend_object', $translation_array );
    wp_enqueue_script( 'elegant_blocks_frontend_backend_js' );

    // Get google map api
    $google_map_api = get_option( 'elegant_blocks_google_map_api' );
    $google_map_script = get_option( 'elegant_blocks_google_map_script' ); 

    if( empty( $google_map_script ) ){
        wp_enqueue_script( 
            'elegant_blocks_google_map', 
            '//maps.googleapis.com/maps/api/js?libraries=places&key=' . esc_attr( $google_map_api ), 
            '0.1', 
            true 
        );    
    }    

}

// admin css and js
add_action( 'admin_enqueue_scripts', 'elegant_blocks_backend_css_js' , 999 );
function elegant_blocks_backend_css_js() {

    wp_enqueue_style( 
    	'elegant_blocks_backend_css', 
    	plugins_url( '/dist/css/admin.css', dirname( __FILE__ ) ), 
    	false, 
    	'0.1' 
    );

    // Localize the script with new data
    $disable_blocks = get_option( 'elegant_blocks_block_status' ); 
    $translation_array = array(
        'animate_style_options' => elegant_blocks_animate_css_options(),
        'progress_bar_limit' => apply_filters( 'elegant_blocks_progress_bar_limit', 10 ),
        'disable_blocks' => empty( $disable_blocks ) ? array() : $disable_blocks,
        'shape_images' => elegant_blocks_shapes(),
        'shape_svg' => elegant_blocks_shapes_svg(),
        'markers' => elegant_blocks_map_icons(),
        'google_map_api' => get_option( 'elegant_blocks_google_map_api' ),
        'elegant_blocks_settings_page' => admin_url( 'admin.php?page=elegant-blocks-settings' ),
        'ELEGANTBLOCKS_PLUGIN_URL' => ELEGANTBLOCKS_PLUGIN_URL,
        'fontawesome_icons' => bizberg_fontawesome_5_icons(),
        'google_fonts' => json_decode( GOOGLE_FONTS , true ),
        'pro_status' => get_option( 'pro_status' ),
        'demo_import_page' => admin_url( '/themes.php?page=cyclone-one-click-demo-import' )
    );

    wp_register_script( 
    	'elegant_blocks_backend_js', 
    	plugins_url( '/dist/js/admin.js', dirname( __FILE__ ) ) , 
    	array(), 
    	time(), 
    	true 
    );

    wp_localize_script( 'elegant_blocks_backend_js', 'mb_backend_object', $translation_array );
    wp_enqueue_script( 'elegant_blocks_backend_js' );
}

add_image_size( 'elegant_blocks_team_1', 500, 500, true );
add_image_size( 'elegant_blocks_blog_1', 693, 462, true );
add_image_size( 'elegant_blocks_slider_1', 1600, 1000, true );

/**
* Register new categories
*/

add_filter( 'block_categories', 'elegant_blocks_categories', 10, 2 );
function elegant_blocks_categories( $categories, $post ) {

    $cat =  array_merge(
        $categories,
        array(
            array(
                'slug' => 'elegant-blocks-newsletters-template',
                'title' => __( 'EB Newsletters Template', 'elegant-blocks' )
            ),            
            array(
                'slug' => 'elegant-blocks-video-template',
                'title' => __( 'EB Videos Template', 'elegant-blocks' )
            ),
            array(
                'slug' => 'elegant-blocks-description-template',
                'title' => __( 'EB Descriptions Template', 'elegant-blocks' )
            ),
            array(
                'slug' => 'elegant-blocks-banner-template',
                'title' => __( 'EB Banners Template', 'elegant-blocks' )
            ),
            array(
                'slug' => 'elegant-blocks',
                'title' => __( 'Elegant Blocks', 'elegant-blocks' )
            ),
        )
    );

    return array_reverse( $cat );
}

// Animate.css animations styles
function elegant_blocks_animate_css_options(){

    $styles = array(
        'bounce' => 'bounce',
        'flash' => 'flash',
        'pulse' => 'pulse',
        'rubberBand' => 'rubberBand',
        'shake' => 'shake',
        'swing' => 'swing',
        'tada' => 'tada',
        'wobble' => 'wobble',
        'jello' => 'jello',
        'bounceIn' => 'bounceIn',
        'bounceInDown' => 'bounceInDown',
        'bounceInUp' => 'bounceInUp',
        'fadeIn' => 'fadeIn',
        'fadeInDown' => 'fadeInDown',
        'fadeInDownBig' => 'fadeInDownBig',
        'fadeInLeft' => 'fadeInLeft',
        'fadeInLeftBig' => 'fadeInLeftBig',
        'fadeInRight' => 'fadeInRight',
        'fadeInRightBig' => 'fadeInRightBig',
        'fadeInUp' => 'fadeInUp',
        'fadeInUpBig' => 'fadeInUpBig',
        'flip' => 'flip',
        'flipInX' => 'flipInX',
        'flipInY' => 'flipInY',
        'lightSpeedIn' => 'lightSpeedIn',
        'rotateIn' => 'rotateIn',
        'rotateInDownLeft' => 'rotateInDownLeft',
        'rotateInDownRight' => 'rotateInDownRight',
        'rotateInUpLeft' => 'rotateInUpLeft',
        'rotateInUpRight' => 'rotateInUpRight',
        'slideInUp' => 'slideInUp',
        'slideInDown' => 'slideInDown',
        'slideInLeft' => 'slideInLeft',
        'slideInRight' => 'slideInRight',
        'zoomIn' => 'zoomIn',
        'zoomInDown' => 'zoomInDown',
        'zoomInLeft' => 'zoomInLeft',
        'zoomInRight' => 'zoomInRight',
        'zoomInUp' => 'zoomInUp',
        'hinge' => 'hinge',
        'rollIn' => 'rollIn',
    );

    $options = array();
    foreach ( $styles as $key => $value ) {
        
        $options[] = array(
            'label' => $key,
            'value' => $value
        );

    }

    return $options;

}

function elegant_blocks_color_luminance( $hex, $diff ) {
    $rgb = str_split(trim($hex, '# '), 2);
    foreach ($rgb as &$hex) {
        $dec = hexdec($hex);
        if ($diff >= 0) {
            $dec += $diff;
        }
        else {
            $dec -= abs($diff);         
        }
        $dec = max(0, min(255, $dec));
        $hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
    }
    return '#'.implode($rgb);
}

add_action( 'plugins_loaded', 'elegant_blocks_register_dynamic_block', 10 );
function elegant_blocks_register_dynamic_block() {

    // Only load if Gutenberg is available.
    if ( !function_exists( 'register_block_type' ) ) {
        return;
    }
    
    // Hook server side rendering into render callback
    register_block_type(
        'elegant-blocks-plugin/team',
        array(
            'render_callback' => 'elegant_blocks_render_dynamic_block_team_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/blog-1',
        array(
            'render_callback' => 'elegant_blocks_render_blog_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/slider',
        array(
            'render_callback' => 'elegant_blocks_render_slider_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/testimonials',
        array(
            'render_callback' => 'elegant_blocks_render_testimonial_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/gallery',
        array(
            'render_callback' => 'elegant_blocks_render_gallery_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/calltoaction',
        array(
            'render_callback' => 'elegant_blocks_render_calltoaction_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/instagram',
        array(
            'render_callback' => 'elegant_blocks_render_instagram_1',
        )
    );

    register_block_type(
        'ct-plugin/instagram-1',
        array(
            'render_callback' => 'elegant_blocks_render_instagram_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/services',
        array(
            'render_callback' => 'elegant_blocks_render_services_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/tabs',
        array(
            'render_callback' => 'elegant_blocks_render_tabs',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/accordion',
        array(
            'render_callback' => 'elegant_blocks_render_accordion',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/social-icons',
        array(
            'render_callback' => 'elegant_blocks_render_social_icons',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/pricing-table',
        array(
            'render_callback' => 'elegant_blocks_render_pricing_table',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/progress-bar',
        array(
            'render_callback' => 'elegant_blocks_render_progress_bar',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/heading',
        array(
            'render_callback' => 'elegant_blocks_render_heading',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/countup',
        array(
            'render_callback' => 'elegant_blocks_render_countup',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/shape-divider',
        array(
            'render_callback' => 'elegant_blocks_render_shape_divider',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/map',
        array(
            'render_callback' => 'elegant_blocks_render_map',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/clients',
        array(
            'render_callback' => 'elegant_blocks_render_clients',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/description-1',
        array(
            'render_callback' => 'elegant_blocks_render_description_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/banner-1',
        array(
            'render_callback' => 'elegant_blocks_render_banner_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/eb-container',
        array(
            'render_callback' => 'elegant_blocks_render_container',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/video-1',
        array(
            'render_callback' => 'elegant_blocks_render_video_1',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/text',
        array(
            'render_callback' => 'elegant_blocks_render_text',
        )
    );

    register_block_type(
        'elegant-blocks-plugin/newsletter-1',
        array(
            'render_callback' => 'elegant_blocks_render_newsletter_1',
        )
    );

}

/**
* Check if gutenberg is install or not
*/

add_action( 'admin_notices', 'elegant_blocks_check_gutenberg' );
function elegant_blocks_check_gutenberg(){

    if( !function_exists( 'register_block_type' ) ){ ?>

        <div class="notice notice-error">
            <p><?php esc_html_e( 'Gutenberg is not activate in this site. Please install WordPress 5.0 or greater or install gutenberg plugin.', 'elegant-blocks' ); ?></p>
        </div>

        <?php
    }

}

function elegant_blocks_join_numbers($arr){
    $number = 0;
    if( !empty( $arr[0] ) && is_array( $arr[0] ) ){
        $number = implode('.', $arr[0] );
    }
    return $number;
}

/**
* Get shape divider images
*/

function elegant_blocks_map_icons(){

    $files = array_values( 
        array_diff( 
            scandir( 
                plugin_dir_path( __DIR__ ) . 'src/images/map_icons' 
            ), 
            array('.', '..') 
        )
    );

    $markers = array();
    $markerDir = plugins_url( '/src/images/map_icons/' , dirname(__FILE__) );
    $allowedExt = array('jpg','jpeg','gif','png','svg');

    if( !empty( $files ) ){

        foreach( $files as $image ){

            $ext = pathinfo( $image, PATHINFO_EXTENSION );

            if( in_array( $ext, $allowedExt ) ){
                $markers[] = esc_url( $markerDir . $image );
            }            

        }

    }

    return apply_filters( 'elegant_blocks_map_images', $markers );

}

/**
* Get shape divider images
*/

function elegant_blocks_shapes(){

    $files = array_values( 
        array_diff( 
            scandir( 
                plugin_dir_path( __DIR__ ) . 'src/images/shape_divider' 
            ), 
            array('.', '..') 
        )
    );

    $shapeImage = array();
    $shapeImageDir = plugins_url( '/src/images/shape_divider/' , dirname(__FILE__) );
    $allowedExt = array('jpg','jpeg','gif','png','svg');

    if( !empty( $files ) ){

        foreach( $files as $image ){

            $ext = pathinfo( $image, PATHINFO_EXTENSION );

            if( in_array( $ext, $allowedExt ) ){
                $shapeImage[] = esc_url( $shapeImageDir . $image );
            }            

        }

    }

    return apply_filters( 'elegant_blocks_shape_images', $shapeImage );

}

function elegant_blocks_shapes_svg(){

    $svg_1 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1893.000000pt" height="256.000000pt" viewBox="0 0 1893.000000 256.000000">
        <path d="M0 2126 l0 -436 68 69 c56 58 78 72 135 92 60 21 81 23 175 18 62 -3
        126 -12 152 -21 37 -14 53 -15 98 -5 30 6 75 8 100 4 60 -9 153 -56 205 -104
        41 -38 44 -39 128 -42 73 -3 91 -8 128 -32 l42 -28 17 32 c31 57 50 75 109
        106 144 77 316 84 467 18 93 -40 214 -144 289 -247 15 -21 39 -54 53 -73 l25
        -35 32 24 c39 30 133 62 207 71 70 8 187 -15 245 -49 40 -24 43 -24 58 -8 8 9
        18 28 22 42 14 47 74 135 127 186 139 134 342 223 628 276 159 30 541 32 670
        5 251 -54 448 -148 591 -284 67 -63 70 -62 98 49 64 249 218 387 466 417 176
        21 383 -32 528 -135 54 -39 60 -40 78 -18 28 35 109 65 189 71 l79 6 49 58
        c139 164 326 271 536 308 175 31 399 -7 603 -104 238 -112 368 -240 441 -433
        22 -57 26 -87 29 -195 1 -71 5 -132 8 -137 3 -4 26 -2 52 6 57 17 189 20 256
        4 105 -23 257 -116 323 -195 l35 -44 50 25 c212 107 474 109 696 5 66 -31 74
        -30 88 19 22 74 98 133 207 160 65 17 69 24 57 101 -34 207 63 420 228 502 89
        44 215 60 335 42 42 -6 45 -5 77 35 44 55 104 81 184 81 98 0 196 -40 259
        -107 55 -59 107 -216 108 -324 0 -48 13 -70 39 -70 31 0 121 -49 164 -89 51
        -47 55 -45 82 39 70 216 200 310 430 310 189 -1 419 -79 544 -187 57 -48 114
        -136 143 -221 19 -57 23 -86 22 -192 0 -70 -6 -144 -13 -169 -17 -58 -7 -67
        74 -63 84 5 160 -20 201 -65 l32 -35 46 35 c79 61 169 67 322 22 16 -5 26 0
        40 20 78 112 141 146 267 146 92 1 185 -27 294 -87 185 -103 277 -277 245
        -466 -7 -39 -9 -75 -4 -80 4 -4 34 6 65 23 157 85 387 64 632 -56 173 -84 293
        -198 371 -352 45 -90 53 -90 93 7 106 254 303 459 540 561 346 148 874 95
        1272 -128 44 -24 90 -43 107 -43 43 0 80 -16 128 -56 l43 -34 74 39 c154 81
        355 94 510 33 105 -41 200 -104 242 -162 61 -83 125 -249 125 -322 0 -13 6
        -33 14 -43 12 -17 15 -15 41 29 15 26 39 53 54 60 42 22 121 27 188 13 43 -9
        66 -10 73 -3 5 5 10 38 10 73 0 97 13 115 123 157 25 10 37 21 37 35 0 10 -22
        63 -49 118 -56 112 -94 219 -116 323 -18 84 -20 247 -4 322 15 70 60 168 105
        229 73 100 272 221 421 257 l73 17 0 358 0 357 -9465 0 -9465 0 0 -436z" transform="translate(0.000000,256.000000) scale(0.100000,-0.100000)" fill="#000" stroke="none" fill-opacity="1"/>
    </svg>';

    $svg_2 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1800.000000pt" height="268.000000pt" viewBox="0 0 1800.000000 268.000000"
     preserveAspectRatio="xMidYMid meet">
    <path d="M0 2490 c0 -181 1 -190 19 -190 11 0 36 -10 56 -22 33 -19 49 -21
    153 -19 147 3 165 3 230 -5 40 -4 57 -2 70 9 19 16 80 35 127 39 25 3 31 9 39
    38 l8 36 82 1 c72 1 229 20 326 39 19 4 49 17 65 30 17 12 62 32 100 45 39 12
    78 26 88 31 10 5 54 10 97 10 56 1 81 5 84 15 3 7 15 13 26 13 27 0 77 26 87
    45 7 12 12 12 34 1 14 -7 39 -16 55 -19 60 -10 151 -39 201 -62 28 -14 66 -25
    84 -25 26 0 31 -3 26 -20 -3 -14 0 -20 10 -20 12 0 14 -7 9 -32 -4 -18 -10
    -54 -13 -79 -5 -44 -3 -48 32 -80 20 -19 43 -48 50 -65 15 -36 11 -158 -7
    -192 -10 -18 -9 -28 4 -50 9 -17 13 -42 11 -68 -4 -36 -1 -45 29 -75 30 -31
    92 -78 158 -121 14 -10 55 -22 90 -27 54 -7 68 -13 90 -40 15 -17 33 -31 42
    -31 9 0 18 -9 21 -20 3 -11 17 -24 31 -30 14 -5 26 -13 26 -18 0 -5 16 -29 35
    -53 39 -50 41 -60 20 -93 -15 -22 -14 -27 15 -75 16 -29 30 -57 30 -64 0 -24
    67 -58 121 -62 30 -3 80 -10 113 -15 52 -9 63 -8 98 10 50 26 112 26 140 0 12
    -11 33 -21 47 -21 72 -4 116 0 119 10 2 6 22 11 45 11 28 0 48 7 64 22 18 17
    36 22 86 23 87 2 121 22 136 80 10 39 9 48 -4 62 -9 8 -13 18 -10 21 3 3 11 0
    17 -6 7 -7 21 -12 33 -12 11 0 28 -9 37 -20 16 -17 27 -19 137 -15 93 4 120 2
    124 -9 6 -15 96 -29 207 -32 100 -2 172 -13 245 -35 33 -10 92 -20 130 -23 39
    -3 90 -11 115 -19 40 -12 54 -11 119 6 61 16 78 17 97 7 19 -11 36 -9 96 5 40
    11 80 26 88 35 29 32 76 54 127 61 61 8 113 43 113 76 0 20 5 23 43 23 47 -1
    150 -33 155 -49 2 -6 9 -11 16 -11 6 0 29 -17 49 -38 29 -29 34 -41 25 -50
    -13 -13 -15 -12 35 -35 24 -11 37 -23 37 -36 0 -19 36 -32 100 -37 14 -1 41
    -5 61 -9 27 -5 40 -3 53 10 10 10 23 14 34 10 9 -4 40 -13 67 -19 28 -7 69
    -24 93 -39 33 -22 42 -33 42 -56 0 -24 5 -29 32 -35 39 -8 58 -23 51 -41 -8
    -24 38 -39 81 -26 30 8 53 6 111 -9 89 -23 125 -44 125 -75 0 -23 28 -55 48
    -55 15 0 16 -17 2 -22 -17 -5 18 -66 43 -74 12 -4 36 -17 53 -30 17 -13 35
    -24 41 -24 15 0 43 -34 43 -53 0 -9 6 -17 13 -17 7 0 26 -13 42 -30 15 -16 51
    -37 78 -46 83 -28 258 -21 297 11 8 7 40 15 70 18 48 4 60 1 95 -23 49 -34
    119 -44 195 -29 78 16 131 14 168 -5 29 -15 32 -21 32 -60 l0 -44 73 -6 c177
    -14 370 17 391 63 5 13 22 25 39 28 17 3 32 14 34 24 6 23 41 35 56 20 6 -6
    22 -11 36 -11 15 0 53 -11 86 -25 33 -13 74 -25 92 -25 17 0 39 -8 49 -17 9
    -10 22 -18 28 -18 28 -1 56 -18 56 -34 0 -10 7 -24 15 -31 8 -7 15 -27 15 -44
    0 -54 79 -106 161 -106 23 0 57 -5 74 -11 62 -23 286 19 308 57 4 8 13 14 19
    14 6 0 20 7 30 16 13 13 21 14 31 5 25 -20 210 9 242 38 16 16 37 19 115 19
    52 0 100 0 107 1 7 1 20 17 29 36 13 29 22 35 46 35 31 0 32 -6 14 -50 -9 -21
    14 -48 44 -54 34 -5 108 -55 200 -135 41 -36 77 -67 80 -71 12 -13 60 -40 74
    -40 8 0 31 -10 52 -22 33 -19 40 -20 73 -8 20 7 48 21 63 31 33 24 35 24 34
    -3 -1 -20 3 -23 34 -20 98 9 242 0 291 -19 20 -8 41 -5 90 12 79 27 227 30
    303 6 27 -9 54 -13 60 -10 5 4 29 6 52 4 23 -1 45 3 49 9 3 5 17 10 31 10 13
    0 24 5 24 10 0 6 9 10 20 10 15 0 20 7 20 24 0 35 14 40 66 20 42 -16 47 -16
    80 -1 22 11 60 17 104 17 38 0 72 5 75 10 3 6 19 10 35 10 17 0 53 9 82 20 42
    16 66 19 118 14 72 -6 120 6 120 32 0 13 8 15 41 11 33 -4 46 0 70 21 29 24
    32 24 87 12 47 -9 68 -9 119 3 34 8 65 12 68 9 3 -3 5 -16 5 -29 0 -18 9 -28
    38 -40 54 -22 245 -11 284 17 15 11 32 20 38 20 6 0 21 6 33 14 12 8 41 17 64
    21 49 8 93 38 93 65 0 15 7 17 48 14 161 -15 232 -36 232 -70 0 -21 30 -64 45
    -64 6 0 32 -10 56 -23 24 -13 84 -34 133 -46 78 -21 91 -22 100 -9 7 9 34 17
    71 20 75 7 124 33 132 71 4 18 19 37 44 52 20 14 45 38 55 54 11 19 22 27 28
    22 18 -14 141 -61 161 -61 10 0 33 -12 52 -26 53 -40 206 -83 329 -91 67 -4
    73 -3 91 20 12 16 34 27 62 32 38 6 43 5 48 -15 5 -19 10 -21 47 -15 22 4 48
    13 56 21 9 7 25 11 35 9 35 -8 69 31 70 78 0 32 3 41 15 38 48 -13 74 -13 84
    0 6 8 25 19 41 24 20 7 31 18 33 33 3 18 8 22 25 16 12 -4 52 -6 90 -5 97 2
    136 -7 149 -35 6 -13 19 -24 29 -24 9 0 39 -17 66 -38 82 -65 112 -75 143 -47
    13 12 23 12 52 3 31 -9 41 -8 65 7 17 11 43 18 65 16 20 -1 39 3 43 9 3 5 21
    10 39 10 18 0 54 11 82 24 27 13 66 29 87 36 21 6 43 20 49 30 9 13 20 17 43
    13 21 -3 45 2 71 16 21 12 49 21 62 21 23 0 36 8 75 46 12 11 38 28 58 37 20
    9 39 24 43 32 4 13 9 12 35 -3 29 -16 31 -16 51 5 11 13 33 25 48 29 74 16
    115 45 94 66 -19 19 -14 28 13 28 28 0 48 34 35 60 -18 36 -19 82 -4 105 19
    30 12 55 -16 55 -11 0 -20 4 -20 10 0 15 50 37 104 45 27 4 59 13 70 20 12 8
    38 15 59 17 25 1 42 9 48 20 5 9 15 15 22 12 7 -2 52 -10 101 -17 67 -10 91
    -11 104 -1 16 11 47 17 152 30 25 3 54 14 65 24 31 27 77 33 120 16 49 -21 68
    -20 107 4 18 11 41 20 50 20 10 0 25 11 34 25 14 21 24 25 70 25 29 0 56 -5
    59 -10 3 -6 10 -10 16 -10 5 0 9 290 9 755 l0 755 -9000 0 -9000 0 0 -190z" transform="translate(0.000000,268.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none"/>
    </svg>';

    $svg_3 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1742.000000pt" height="198.000000pt" viewBox="0 0 1742.000000 198.000000"
     preserveAspectRatio="xMidYMid meet">
        <path d="M0 1000 l0 -991 28 6 c15 3 117 15 227 26 110 11 211 22 225 25 23 5
    259 31 790 89 124 14 259 30 300 36 41 6 201 24 355 41 154 16 287 32 295 34
    8 2 69 9 135 15 66 6 208 22 315 35 107 13 224 26 260 30 36 4 157 17 270 31
    113 13 286 33 385 43 99 11 317 36 485 55 168 19 368 42 445 51 77 8 214 24
    305 35 91 11 251 29 355 40 105 11 224 25 265 30 41 6 176 22 300 35 124 14
    342 38 485 54 662 76 981 113 1105 126 74 8 232 26 350 40 423 49 830 95 1270
    144 102 12 280 32 395 46 116 13 273 32 350 40 129 15 283 32 1015 115 146 17
    382 44 525 60 143 16 382 43 530 60 149 17 407 47 575 66 168 19 422 48 565
    64 540 62 876 100 1055 120 102 11 259 29 350 40 91 11 248 29 350 40 220 25
    596 68 960 109 146 17 366 42 490 56 124 13 299 34 390 45 91 11 302 33 470
    50 168 17 339 34 380 39 42 5 -3788 9 -8637 10 l-8713 1 0 -991z" transform="translate(0.000000,198.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none"/>
        </svg>';

    $svg_4 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="2262.000000pt" height="258.000000pt" viewBox="0 0 2262.000000 258.000000"
     preserveAspectRatio="xMidYMid meet">
    <path d="M45 2577 c28 -2 127 -12 220 -23 94 -11 251 -29 350 -40 99 -11 317
    -36 485 -55 168 -20 404 -46 525 -60 121 -14 360 -41 530 -60 171 -20 411 -47
    535 -60 124 -14 257 -29 295 -35 39 -5 135 -16 215 -25 80 -8 222 -24 315 -35
    94 -11 271 -32 395 -45 124 -14 344 -39 490 -56 364 -41 740 -84 960 -109 102
    -11 259 -29 350 -40 91 -11 248 -29 350 -40 179 -20 515 -58 1055 -120 143
    -16 397 -45 565 -64 168 -19 427 -49 575 -66 149 -17 387 -44 530 -60 143 -16
    400 -45 570 -65 312 -35 710 -81 970 -110 77 -8 235 -27 350 -40 116 -14 293
    -34 395 -46 440 -49 847 -95 1270 -144 118 -14 276 -32 350 -40 124 -13 443
    -50 1105 -126 143 -16 361 -40 485 -54 124 -13 259 -29 300 -35 41 -5 161 -19
    265 -30 105 -11 264 -29 355 -40 91 -11 228 -27 305 -35 77 -9 277 -32 445
    -51 168 -19 386 -44 485 -55 99 -10 272 -30 385 -43 113 -14 234 -27 270 -31
    36 -4 153 -17 260 -30 107 -13 249 -29 315 -35 66 -6 127 -13 135 -15 8 -2
    141 -18 295 -34 154 -17 312 -35 350 -41 39 -6 174 -22 300 -35 408 -44 586
    -64 800 -90 116 -13 293 -34 395 -45 102 -12 322 -37 490 -56 168 -19 364 -41
    436 -49 72 -8 189 -21 260 -30 71 -8 212 -24 314 -35 102 -11 219 -25 260 -30
    41 -6 197 -24 345 -40 149 -17 326 -37 395 -45 69 -8 137 -15 153 -15 l27 0 0
    1285 0 1285 -11312 -2 c-6222 -1 -11290 -3 -11263 -5z" transform="translate(0.000000,258.000000) scale(0.100000,-0.100000)"fill="#000000" stroke="none"/>
    </svg>';

    $svg_5 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1920.000000pt" height="227.000000pt" viewBox="0 0 1920.000000 227.000000"
     preserveAspectRatio="xMidYMid meet">
    <path d="M0 1853 l0 -418 158 -22 c86 -12 477 -69 867 -127 1006 -149 2490
    -368 2885 -426 184 -27 580 -86 880 -130 300 -44 772 -114 1050 -155 278 -41
    888 -131 1355 -200 1198 -177 1828 -270 2138 -315 l267 -39 338 49 c185 27
    537 79 782 115 245 36 873 129 1395 206 523 77 1634 241 2470 364 1721 254
    3480 513 4157 613 l458 67 0 418 0 417 -9600 0 -9600 0 0 -417z" transform="translate(0.000000,227.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none"/>
    </svg>';

    $svg_6 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1920.000000pt" height="135.000000pt" viewBox="0 0 1920.000000 135.000000"
     preserveAspectRatio="xMidYMid meet">
    <path d="M0 675 l0 -675 23 0 c14 0 31 13 46 36 42 61 173 189 256 250 298
    219 688 296 1045 205 l74 -18 70 33 c74 35 192 58 244 48 24 -5 36 1 68 31
    401 379 1008 446 1495 166 l84 -48 40 20 c122 61 317 63 432 4 31 -16 32 -16
    126 34 354 186 784 191 1140 13 86 -44 88 -44 119 -28 74 38 141 54 231 54
    l89 0 77 72 c229 215 521 328 846 328 298 0 580 -100 797 -282 47 -40 48 -40
    92 -29 119 30 268 2 368 -68 l57 -39 48 16 c35 11 87 16 198 16 136 0 157 -2
    230 -27 101 -33 192 -87 267 -156 l58 -53 41 16 c23 9 75 21 117 26 75 10 75
    10 146 78 89 85 143 122 260 178 145 68 242 89 421 88 188 0 282 -21 442 -99
    62 -30 115 -55 118 -55 3 0 23 11 43 25 98 68 258 84 389 40 l76 -26 66 45
    c91 63 222 122 327 148 72 18 117 22 239 22 180 0 278 -20 421 -88 120 -57
    200 -115 298 -216 l79 -81 61 28 c56 26 70 28 182 28 118 0 121 -1 194 -37
    l74 -36 65 37 c252 141 569 244 883 287 166 23 480 23 646 0 288 -39 545 -118
    793 -241 l92 -46 38 27 c68 47 160 74 253 74 134 0 242 -46 331 -141 44 -47
    50 -51 69 -39 52 33 198 100 271 124 239 80 541 80 780 0 148 -49 321 -145
    417 -232 l38 -35 50 47 c28 26 81 62 118 79 58 27 80 32 167 35 80 3 112 0
    158 -15 l57 -20 39 28 c62 46 193 107 283 131 119 33 327 33 446 0 241 -65
    435 -220 548 -435 l43 -82 1 553 0 552 -9600 0 -9600 0 0 -675z" transform="translate(0.000000,135.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"/>
    </svg>';

    $svg_7 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1920.000000pt" height="135.000000pt" viewBox="0 0 1920.000000 135.000000"
     preserveAspectRatio="xMidYMid meet">
    <g transform="translate(0.000000,135.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none">
    <path d="M0 794 c0 -441 3 -554 12 -548 7 4 27 18 44 31 22 17 44 23 80 23 49
    0 95 16 101 35 1 6 -9 15 -23 22 -23 11 -33 9 -75 -12 -57 -29 -63 -30 -55 -9
    8 21 -4 40 -15 23 -13 -22 -20 -4 -10 24 11 27 58 47 116 47 55 0 105 12 105
    25 0 8 -8 11 -19 8 -10 -2 -26 3 -35 12 -12 12 -20 14 -29 6 -16 -13 -91 5
    -82 20 4 5 12 9 19 9 8 0 19 6 25 14 10 12 7 18 -19 31 -38 20 -34 39 9 43 29
    3 32 6 28 28 -4 25 15 50 32 40 5 -3 26 -31 46 -62 25 -37 41 -52 47 -46 7 7
    18 2 34 -15 19 -20 24 -22 24 -9 0 9 5 16 10 16 6 0 10 8 10 19 0 10 7 24 15
    31 8 7 15 19 15 26 0 8 4 14 8 14 14 0 32 -23 32 -41 0 -14 8 -17 35 -16 33 2
    35 4 30 27 -10 38 -23 46 -33 20 l-9 -24 -13 24 c-7 14 -19 29 -27 33 -8 5
    -11 17 -7 33 5 18 2 24 -11 24 -14 0 -16 -7 -13 -34 l4 -33 -28 20 c-15 11
    -28 24 -28 28 0 5 -21 22 -46 39 -25 18 -50 44 -55 58 -10 25 -7 30 31 64 35
    31 45 36 62 27 11 -6 26 -26 34 -45 8 -19 23 -43 34 -54 19 -19 19 -19 25 1 4
    10 13 19 20 19 8 0 18 7 23 16 5 9 32 20 63 26 50 9 55 8 74 -15 11 -13 28
    -27 39 -31 21 -7 22 -5 -44 -80 l-25 -28 35 18 c32 16 46 19 103 26 9 1 17 6
    17 11 0 4 4 6 9 3 11 -7 6 -82 -7 -116 -10 -26 -41 -56 -79 -78 -19 -10 -23
    -10 -23 3 0 25 -14 17 -29 -17 l-14 -31 -19 26 c-26 36 -39 34 -25 -3 10 -27
    9 -32 -11 -46 -23 -16 -29 -48 -11 -60 12 -7 69 43 69 62 0 6 7 14 15 18 21 8
    19 3 -15 -47 -16 -25 -30 -48 -30 -51 0 -4 12 -18 26 -31 l26 -24 21 23 c26
    27 90 50 116 41 33 -10 51 20 44 71 -5 38 -2 48 17 69 33 35 74 49 108 37 33
    -11 47 -6 56 24 4 12 17 33 30 47 25 27 55 27 77 1 6 -8 25 -14 41 -14 39 0
    69 -17 62 -35 -4 -8 -12 -15 -20 -15 -31 0 -6 -35 30 -41 20 -4 54 -53 55 -79
    1 -8 -8 -21 -18 -27 -21 -13 -59 -5 -123 28 -33 17 -38 17 -52 3 -17 -17 -13
    -34 8 -34 21 0 64 -49 71 -79 4 -20 18 -34 51 -50 57 -29 74 -23 74 27 0 21 4
    42 8 47 5 6 14 29 21 53 12 42 48 72 62 50 3 -5 10 -8 15 -7 21 6 54 -14 60
    -36 3 -14 4 -51 1 -82 l-4 -58 56 -1 c31 0 67 -6 80 -13 21 -12 23 -17 16 -67
    -6 -53 -6 -54 19 -54 14 0 26 1 26 3 0 1 -4 16 -9 34 -7 22 -5 39 5 58 8 15
    14 42 14 60 0 21 11 46 30 70 17 21 30 43 30 49 0 24 -39 73 -67 85 -17 7 -36
    26 -44 43 -9 21 -32 41 -69 60 -56 29 -89 72 -90 114 0 20 49 71 102 106 40
    26 72 6 104 -66 15 -33 38 -69 52 -81 23 -20 25 -26 15 -48 -6 -14 -9 -28 -6
    -31 7 -7 43 69 43 89 0 7 14 15 30 19 19 3 34 14 40 28 5 13 9 19 10 13 0 -5
    4 -4 8 3 5 7 24 14 43 16 19 2 53 7 75 11 35 6 45 4 63 -14 12 -12 21 -27 21
    -34 0 -7 16 -19 35 -26 19 -7 35 -16 35 -20 0 -10 -41 -60 -87 -107 -18 -18
    -33 -35 -33 -38 0 -13 26 -5 59 18 20 13 57 26 84 29 41 4 47 2 47 -14 0 -11
    3 -19 6 -19 11 0 44 42 44 57 0 21 98 17 123 -4 20 -17 20 -17 13 2 -5 11 -10
    38 -13 60 -3 22 -15 50 -27 63 -17 19 -21 37 -22 98 l-2 74 41 35 c22 19 49
    35 59 35 35 0 78 -42 90 -88 6 -24 17 -46 25 -49 11 -4 9 -9 -6 -20 -19 -13
    -20 -15 -4 -48 9 -18 24 -35 33 -38 15 -4 16 5 13 79 -3 73 -1 84 16 93 12 7
    30 7 52 1 19 -6 35 -10 36 -10 2 0 -6 16 -17 37 -10 20 -17 40 -14 45 8 13 74
    38 100 38 36 0 66 -35 58 -66 -6 -24 -5 -25 15 -12 12 7 31 27 42 44 10 18 28
    34 38 37 30 8 66 -15 69 -45 2 -18 10 -28 24 -30 28 -4 35 -26 11 -35 -34 -13
    -83 -55 -83 -73 0 -20 -43 -41 -90 -45 -17 -1 -36 -7 -43 -14 -16 -16 -30 -13
    -23 5 7 17 -13 74 -26 74 -9 0 -29 -71 -22 -81 2 -5 -20 -34 -51 -65 -50 -52
    -70 -94 -45 -94 6 0 10 6 10 13 0 8 11 20 25 27 15 8 25 22 25 35 0 15 10 25
    36 34 31 11 38 11 56 -6 19 -17 20 -17 43 10 13 15 26 27 28 27 8 0 -9 -75
    -23 -100 -7 -14 -20 -33 -29 -43 -14 -17 -14 -19 4 -29 18 -10 17 -12 -9 -33
    -28 -22 -28 -52 -1 -41 8 3 17 -3 20 -13 3 -11 15 -21 25 -24 15 -4 20 -14 20
    -39 0 -29 4 -34 21 -34 12 1 30 -11 41 -26 l21 -26 -55 -56 c-34 -35 -66 -58
    -85 -62 -17 -3 -33 -14 -36 -23 -3 -14 5 -16 70 -13 73 4 73 3 73 -22 0 -14 5
    -26 10 -26 6 0 10 -8 11 -17 0 -11 3 -13 6 -5 6 16 33 16 33 0 -1 -7 -7 -24
    -15 -38 -8 -14 -14 -35 -15 -48 l0 -23 29 20 c16 12 34 21 40 21 16 0 13 26
    -4 40 -8 7 -15 17 -15 23 0 5 8 3 18 -6 25 -23 29 -22 46 11 13 26 12 34 -10
    98 -14 38 -27 77 -31 87 -3 9 -8 17 -12 17 -12 0 -41 59 -32 64 15 10 56 -48
    81 -113 12 -33 26 -61 30 -61 13 0 20 69 21 200 l1 125 14 -50 c8 -27 19 -83
    24 -123 13 -95 35 -122 101 -122 34 0 49 4 53 16 5 14 10 14 42 -5 19 -12 39
    -21 44 -21 5 0 16 21 24 48 8 26 15 41 15 35 1 -7 8 -13 16 -13 14 0 13 -3 -1
    -25 -20 -31 -13 -41 15 -23 26 16 37 48 21 58 -9 6 -9 13 -1 28 20 37 11 102
    -14 102 -7 0 -15 18 -18 41 -3 23 -11 46 -19 50 -22 14 -56 10 -67 -8 -6 -10
    -11 -13 -11 -7 0 16 22 34 42 34 10 0 18 5 18 10 0 6 -11 10 -24 10 -18 0 -25
    7 -29 28 -3 15 -10 47 -16 70 -7 24 -9 60 -5 79 6 33 8 34 38 29 25 -5 37 -1
    62 22 25 23 41 28 89 30 32 1 64 7 71 13 8 7 13 6 16 -1 2 -8 11 -8 31 -1 42
    16 64 13 89 -12 13 -12 36 -34 52 -47 l29 -25 -5 33 c-3 18 -1 35 3 38 5 2 4
    17 -2 31 -14 36 3 45 72 37 36 -4 59 -2 63 5 11 17 49 13 97 -9 24 -11 53 -20
    65 -20 29 0 87 -46 89 -70 3 -32 11 -33 53 -5 40 26 81 32 170 22 48 -6 66
    -17 86 -58 12 -25 12 -29 0 -29 -8 0 -14 -4 -14 -10 0 -5 6 -10 13 -10 20 0
    38 -40 35 -76 -3 -40 -100 -170 -156 -207 -28 -19 -42 -36 -42 -51 0 -13 -16
    -37 -37 -57 -21 -18 -30 -25 -20 -13 17 21 23 55 10 53 -5 0 -17 -4 -28 -8
    -11 -5 -25 -4 -31 1 -8 6 -22 -10 -44 -49 -18 -32 -64 -88 -101 -126 -38 -37
    -69 -73 -69 -79 0 -7 7 -5 18 4 9 8 30 18 46 22 17 4 42 16 57 27 20 14 44 19
    93 19 64 0 66 -1 66 -25 0 -14 5 -25 10 -25 6 0 10 -8 11 -17 0 -11 3 -13 6
    -5 2 6 12 12 20 12 11 0 14 -6 10 -23 -6 -22 -6 -22 9 -2 9 11 36 57 62 102
    25 46 49 83 53 83 4 0 9 -7 13 -15 8 -21 102 -21 110 0 5 13 13 12 53 -10 56
    -29 66 -30 88 -9 15 15 17 15 21 -2 3 -13 26 -27 63 -41 l59 -21 25 22 c14 11
    28 31 32 44 3 12 13 22 21 22 11 0 13 6 8 23 -15 52 -34 87 -45 87 -6 0 -33
    -23 -60 -50 -34 -35 -56 -50 -74 -50 -23 0 -25 3 -20 23 10 31 43 64 88 90 32
    18 35 22 20 28 -12 5 -3 8 25 8 l42 1 -16 25 c-10 15 -12 25 -5 25 6 0 11 7
    11 15 0 25 -20 17 -33 -13 -9 -19 -18 -26 -34 -24 -12 2 -45 -7 -74 -20 -49
    -21 -51 -23 -29 -30 15 -5 4 -6 -28 -2 -102 10 -104 20 -13 81 l62 42 -48 3
    c-44 3 -48 5 -45 26 1 13 -1 22 -5 20 -5 -3 -22 -11 -40 -18 -23 -10 -34 -23
    -39 -45 -4 -16 -9 -24 -11 -17 -3 7 0 27 6 45 l11 32 -20 -24 c-11 -13 -20
    -29 -20 -36 0 -20 -37 -48 -45 -35 -12 19 35 110 56 110 30 0 31 18 2 22 -22
    2 -29 9 -31 31 -3 23 0 27 22 27 23 0 25 2 16 26 -13 34 -13 91 1 100 17 10
    29 -16 30 -71 1 -28 4 -38 6 -23 5 33 33 45 50 22 10 -14 15 -15 28 -4 17 14
    17 14 33 -15 11 -19 11 -19 12 3 0 13 5 32 10 43 13 23 45 27 36 4 -3 -9 0
    -15 8 -15 24 0 26 12 6 38 -13 15 -20 40 -20 65 0 23 -7 48 -16 58 -24 26 -30
    101 -11 118 18 14 37 7 37 -14 0 -14 12 -14 43 0 12 5 24 1 37 -10 11 -10 20
    -14 20 -10 0 5 5 4 10 -1 19 -19 -6 -61 -49 -85 -52 -29 -70 -78 -43 -116 16
    -22 100 -69 109 -60 2 2 -1 16 -7 31 -13 34 -8 43 30 51 39 9 44 19 24 50 -9
    14 -12 25 -7 25 5 0 15 -11 21 -24 13 -29 47 -37 85 -19 23 12 26 18 21 41
    -14 57 -43 91 -92 105 -30 9 -48 20 -50 32 -4 18 17 18 63 -1 17 -7 16 -3 -7
    28 -34 45 -34 48 -3 48 15 0 36 -11 49 -25 l23 -25 12 24 c8 15 21 22 34 21
    12 -1 28 -3 35 -4 6 0 12 -10 12 -20 0 -16 6 -19 38 -18 51 3 53 -14 3 -38
    -22 -11 -41 -25 -41 -32 0 -7 -14 -20 -31 -29 -33 -17 -33 -13 -13 -125 3 -21
    1 -46 -5 -57 -10 -18 -8 -21 17 -25 25 -4 24 -4 -6 -6 -44 -2 -50 -23 -18 -69
    32 -47 68 -68 129 -77 27 -4 51 -14 54 -21 3 -8 9 -14 13 -14 11 0 46 84 69
    168 18 67 19 74 4 112 -12 31 -14 43 -5 52 9 9 15 9 25 -1 20 -21 13 -119 -16
    -200 -37 -102 -37 -101 24 -94 46 5 51 4 47 -13 -2 -14 -14 -20 -41 -24 -32
    -4 -43 -12 -62 -44 -19 -31 -22 -44 -14 -65 5 -14 12 -32 15 -40 3 -11 8 -10
    19 5 8 10 15 14 15 7 0 -6 -5 -15 -10 -18 -6 -3 -10 -15 -10 -26 0 -14 7 -19
    29 -19 16 0 37 -3 47 -7 16 -6 16 -7 -2 -14 -16 -6 -15 -8 7 -8 25 -1 26 1 31
    67 3 37 12 82 22 99 15 30 15 36 1 65 -25 55 -71 129 -84 138 -20 12 -3 50 22
    50 38 0 87 -37 94 -70 6 -34 23 -41 23 -10 0 12 -11 31 -24 43 -43 39 -42 61
    5 101 49 41 71 37 95 -20 8 -19 21 -34 28 -34 8 0 16 -6 19 -12 2 -7 8 -10 12
    -6 10 10 -13 38 -32 38 -8 0 -11 5 -8 11 5 7 15 5 31 -5 27 -18 51 -21 56 -5
    2 5 24 15 48 20 25 5 53 12 63 15 12 4 17 0 18 -13 0 -10 3 -13 6 -5 7 17 23
    15 23 -3 0 -8 5 -15 11 -15 5 0 8 -4 4 -9 -3 -5 -1 -12 5 -16 10 -6 -29 -67
    -60 -93 -12 -10 -10 -10 13 -1 15 7 27 15 27 19 0 4 12 8 28 8 52 2 72 6 72
    15 0 4 4 6 9 3 11 -7 6 -82 -7 -117 -6 -14 -24 -38 -42 -52 l-31 -27 27 -10
    c27 -11 36 -6 47 24 2 5 10 7 18 4 8 -3 18 -7 24 -9 5 -2 10 5 10 16 0 11 7
    21 15 21 8 1 17 3 20 4 16 6 50 6 50 -1 0 -4 -12 -17 -27 -27 -16 -11 -37 -37
    -48 -58 -26 -50 -50 -74 -75 -74 -27 0 -25 -26 3 -34 14 -4 18 -9 10 -14 -6
    -4 -13 -20 -15 -36 -2 -23 1 -29 18 -32 16 -3 24 4 32 29 10 31 10 30 7 -16
    -2 -26 1 -47 5 -47 5 0 15 -3 24 -6 11 -4 16 -1 16 10 0 9 5 16 11 16 5 0 7
    -6 3 -12 -6 -10 -5 -10 8 -1 8 7 18 10 21 6 4 -3 7 2 7 12 0 14 -3 15 -14 6
    -10 -8 -16 -8 -23 1 -23 28 -41 75 -44 113 -4 36 -1 40 20 43 20 3 23 0 18
    -20 -3 -12 1 -36 8 -53 l14 -30 -6 33 c-5 28 -3 32 16 32 11 0 21 4 21 9 0 6
    12 6 30 0 27 -10 30 -15 30 -52 -1 -44 -12 -66 -43 -84 -17 -9 -15 -12 18 -41
    34 -31 75 -43 75 -22 0 6 -7 10 -15 10 -16 0 -30 42 -21 65 10 26 32 16 46
    -20 11 -28 18 -34 33 -29 16 5 19 3 14 -11 -4 -9 -7 -18 -7 -21 0 -2 -6 -1
    -14 2 -12 4 -32 -23 -23 -32 9 -9 76 10 71 20 -3 6 1 3 9 -7 18 -21 31 -22 47
    -2 11 13 10 18 -6 30 -14 11 -15 14 -5 15 10 0 2 13 -19 35 -43 44 -33 56 13
    16 l34 -31 8 43 c12 60 7 105 -17 155 -18 38 -22 41 -37 29 -9 -8 -24 -17 -33
    -20 -10 -4 -18 -11 -18 -17 0 -5 -7 -10 -15 -10 -9 0 -12 6 -8 16 4 11 0 15
    -13 14 -48 -5 -62 14 -21 30 l22 9 -23 0 c-13 1 -31 8 -40 17 -15 15 -15 17 1
    29 9 7 17 20 17 30 0 10 8 24 18 31 15 12 9 13 -45 14 -64 0 -91 19 -30 21 41
    1 66 9 96 31 l24 17 -44 40 c-35 32 -49 39 -69 35 -37 -9 -113 -13 -106 -7 3
    4 -4 18 -16 31 -13 14 -18 22 -11 19 17 -11 42 3 36 19 -3 8 -13 14 -22 12 -9
    -1 -22 1 -28 5 -9 6 -13 1 -13 -17 0 -19 -5 -26 -20 -26 -14 0 -18 -5 -13 -17
    6 -16 4 -16 -15 1 -25 22 -24 24 48 96 25 25 37 36 27 24 -24 -29 -21 -34 13
    -22 17 5 37 8 45 4 26 -10 38 30 18 61 -17 25 -17 27 -1 20 19 -7 34 8 18 18
    -5 3 -10 12 -10 20 0 11 6 12 30 3 26 -8 34 -7 50 7 21 19 28 7 8 -13 -8 -8
    -5 -14 15 -23 37 -17 22 -32 -24 -24 -43 7 -53 -7 -19 -25 15 -8 27 -7 49 4
    26 14 30 14 35 0 12 -31 6 -72 -15 -98 -14 -18 -19 -35 -15 -50 6 -24 90 -106
    108 -106 10 0 -10 42 -26 52 -8 6 -8 8 0 8 7 0 14 9 17 21 3 13 10 18 17 14 7
    -4 -2 12 -19 35 -34 48 -38 65 -17 86 8 7 16 19 18 26 8 23 29 -5 27 -36 -2
    -17 0 -37 5 -44 4 -6 4 -12 0 -12 -3 0 2 -12 11 -27 13 -19 15 -28 6 -31 -9
    -3 -7 -10 5 -23 16 -18 16 -20 1 -37 -23 -25 -22 -29 14 -37 17 -4 33 -13 36
    -21 3 -8 9 -14 13 -14 11 0 46 84 69 168 18 67 19 74 4 112 -12 31 -14 43 -5
    52 22 22 37 -9 36 -77 -1 -60 -8 -87 -40 -162 -25 -56 -20 -63 36 -56 42 5 50
    3 50 -11 0 -9 8 -16 20 -16 13 0 18 -5 14 -15 -4 -8 -11 -15 -18 -15 -6 0 -22
    -7 -35 -16 l-22 -16 20 -22 c19 -20 19 -24 6 -42 -14 -18 -14 -18 -15 5 0 19
    -4 23 -24 19 -27 -5 -44 18 -26 36 5 5 10 18 10 27 0 10 8 20 18 22 13 4 12 5
    -5 6 -15 1 -29 -11 -44 -36 -25 -40 -26 -53 -9 -97 10 -28 11 -28 25 -10 8 10
    15 14 15 7 0 -6 -4 -15 -10 -18 -5 -3 -10 -15 -10 -26 0 -14 7 -19 29 -19 16
    0 37 -3 47 -7 16 -6 16 -7 -2 -14 -16 -6 -15 -8 7 -8 25 -1 26 1 31 67 3 37
    12 82 22 99 15 30 15 36 1 65 -35 74 -69 118 -92 118 -16 0 -16 -1 -2 39 9 26
    16 31 43 31 18 0 37 -5 44 -12 9 -9 15 -9 24 0 19 19 26 14 30 -20 l4 -33 11
    26 c38 87 150 53 124 -38 l-9 -29 60 1 c40 1 64 7 76 18 15 16 15 17 -1 17
    -23 0 -22 37 1 49 27 14 46 -2 38 -33 -4 -15 -2 -26 4 -26 5 0 17 -14 25 -30
    14 -27 18 -29 30 -16 8 8 15 21 15 28 0 26 20 37 46 25 18 -8 28 -7 36 1 9 9
    7 12 -10 12 -13 0 -22 6 -22 15 0 8 -4 15 -10 15 -5 0 -10 4 -10 9 0 6 17 8
    38 6 20 -1 43 -3 50 -4 13 -1 17 -31 4 -31 -9 0 -42 -54 -42 -69 0 -6 9 -11
    21 -11 12 0 23 -8 26 -18 3 -14 12 -17 34 -14 16 2 32 8 35 13 12 20 26 8 20
    -16 -6 -23 -4 -25 18 -19 19 4 26 1 31 -15 3 -12 11 -19 16 -15 5 3 7 14 4 25
    -4 11 -2 19 4 19 6 0 11 -1 11 -2 12 -80 12 -82 -3 -70 -13 11 -17 10 -26 -5
    -10 -17 -12 -16 -30 7 -15 19 -22 22 -33 12 -8 -6 -17 -9 -20 -7 -8 9 -58 -17
    -52 -26 2 -4 11 -6 19 -3 7 3 18 -4 24 -15 10 -17 16 -19 37 -10 18 6 30 6 38
    -1 9 -6 17 -6 26 3 10 10 11 7 6 -14 -7 -33 1 -41 27 -28 15 9 18 8 12 -1 -6
    -10 -1 -11 18 -6 14 3 29 2 32 -4 3 -5 -3 -10 -15 -10 -20 0 -20 -1 -3 -28 9
    -15 18 -28 19 -30 4 -8 34 12 34 23 0 7 9 11 24 8 16 -3 29 3 44 21 15 19 30
    26 58 27 l39 1 -39 9 c-22 5 -46 15 -54 22 -12 9 -16 9 -19 0 -9 -26 -24 -12
    -22 20 2 38 -9 77 -23 77 -5 0 -6 -5 -3 -10 3 -6 -1 -17 -9 -26 -14 -13 -16
    -13 -16 -1 0 24 62 108 105 143 40 32 41 32 53 13 11 -18 10 -19 -12 -13 -19
    4 -28 -1 -45 -25 -13 -17 -19 -31 -14 -31 4 0 1 -5 -7 -10 -12 -8 -11 -10 8
    -10 15 0 22 6 22 20 0 24 35 28 44 5 4 -11 19 -14 58 -13 l52 3 31 -62 c18
    -39 36 -63 46 -63 10 0 19 -11 21 -25 3 -14 5 -25 4 -25 -1 0 -16 4 -34 9 -38
    11 -41 3 -9 -27 17 -16 33 -21 60 -19 23 2 42 -2 49 -10 9 -11 13 -12 19 -1
    15 22 10 33 -21 46 -20 9 -30 21 -30 35 1 22 1 22 21 -2 11 -13 22 -21 26 -18
    10 11 32 -13 26 -29 -3 -8 4 -17 19 -23 14 -5 31 -23 38 -40 14 -35 17 -37 40
    -16 25 23 51 9 43 -23 -4 -17 -2 -23 6 -18 14 9 15 53 1 61 -5 3 -10 13 -10
    21 0 11 6 14 23 9 20 -7 21 -6 6 9 -20 21 -47 11 -55 -20 -4 -16 -13 -24 -27
    -24 -19 0 -20 1 -2 20 17 19 17 20 1 20 -10 0 -17 7 -15 18 1 9 0 19 -1 22 -8
    21 -5 47 6 43 8 -3 11 2 7 16 -3 12 -9 21 -14 21 -5 0 -9 6 -9 13 0 15 39 17
    42 2 3 -22 5 -31 13 -48 4 -11 3 -23 -4 -30 -6 -6 -11 -16 -11 -23 0 -18 48
    -10 68 12 19 21 91 71 135 93 15 7 27 19 27 26 0 8 9 10 25 7 l25 -4 -23 -18
    c-12 -9 -35 -20 -50 -24 -25 -6 -28 -11 -23 -31 7 -26 -3 -32 -20 -15 -18 18
    -83 -24 -84 -52 0 -5 5 -8 10 -8 6 0 10 6 10 14 0 8 7 16 15 20 17 6 21 -9 5
    -19 -6 -4 -8 -16 -5 -26 8 -24 -14 -56 -25 -38 -13 19 -28 1 -22 -27 2 -14 7
    -22 11 -17 16 24 73 54 89 48 12 -5 13 -9 5 -12 -17 -6 -16 -23 1 -23 22 0 27
    -27 5 -33 -14 -4 -19 -14 -19 -36 0 -31 6 -36 33 -25 9 3 13 13 10 25 -3 10 0
    19 6 19 6 0 11 -5 11 -11 0 -6 7 -8 16 -5 8 3 13 2 10 -2 -7 -12 11 -35 22
    -28 8 4 8 16 0 39 -14 42 -17 44 -29 27 -8 -13 -10 -13 -19 0 -13 21 -12 33 2
    27 20 -7 50 13 44 28 -3 8 0 17 6 21 7 5 3 11 -12 16 -27 10 -41 1 -20 -12 17
    -11 16 -11 -22 -14 -35 -2 -35 4 2 39 26 25 33 27 54 17 23 -10 36 -7 36 9 0
    4 -6 9 -12 12 -7 2 1 2 17 -1 41 -6 48 -11 42 -31 -3 -14 1 -17 19 -13 19 3
    24 0 24 -17 0 -11 -4 -21 -8 -21 -5 0 -4 -25 1 -55 9 -48 13 -55 34 -55 13 0
    23 5 23 11 0 6 9 8 21 4 12 -4 19 -3 16 1 -3 5 17 7 43 6 41 -3 51 0 62 17 9
    14 24 21 48 22 l35 1 -30 9 c-68 21 -85 21 -85 -1 0 -11 -4 -20 -9 -20 -6 0
    -7 16 -4 36 l6 36 -26 -17 c-15 -9 -27 -22 -27 -27 0 -6 -7 -8 -15 -5 -8 4
    -17 2 -20 -3 -4 -6 -12 -10 -18 -10 -7 0 -4 7 6 15 18 13 18 15 -6 57 -36 62
    -41 98 -18 126 11 12 30 22 43 22 17 0 20 3 9 9 -8 5 -19 7 -26 5 -6 -3 -17 2
    -24 10 -7 8 -19 12 -26 10 -8 -4 -20 7 -30 27 -9 17 -29 42 -43 56 -18 17 -22
    27 -15 34 17 17 5 38 -18 32 -20 -5 -69 21 -69 36 0 5 18 29 40 52 22 24 40
    46 40 50 0 16 -18 18 -30 3 -7 -8 -20 -12 -28 -9 -11 4 -13 0 -8 -18 4 -16 -3
    -31 -23 -52 -15 -17 -26 -35 -24 -41 2 -5 -3 -19 -12 -29 -13 -17 -16 -18 -25
    -5 -6 8 -8 23 -6 33 2 9 0 17 -5 17 -5 0 -9 5 -9 11 0 6 6 9 14 6 9 -4 16 3
    19 16 2 12 8 31 12 42 5 16 3 15 -13 -5 -20 -25 -41 -23 -26 2 13 21 12 46 -3
    41 -7 -3 -13 -1 -13 5 0 6 15 16 33 23 l32 13 -32 3 c-35 5 -44 19 -15 25 9 2
    32 2 49 0 l33 -4 -20 -25 c-11 -14 -20 -30 -20 -36 0 -5 9 2 21 17 18 23 22
    24 35 11 9 -8 12 -19 9 -25 -12 -20 10 -9 40 18 17 15 38 31 49 35 14 6 16 10
    7 21 -10 11 -8 16 8 21 11 3 20 11 18 17 -1 6 4 13 12 16 8 3 11 0 7 -6 -4 -7
    -2 -21 4 -32 9 -17 19 -20 60 -17 56 5 57 4 89 -72 13 -30 33 -63 45 -73 20
    -17 20 -18 2 -32 -17 -14 -17 -17 15 -55 19 -23 42 -43 52 -47 9 -3 17 -10 17
    -15 0 -5 4 -9 9 -9 5 0 8 14 5 32 -4 33 23 89 35 71 3 -5 13 -12 22 -15 23 -9
    55 -97 42 -117 -13 -20 -50 -26 -69 -11 -8 8 -14 8 -14 2 0 -5 7 -13 16 -16
    25 -10 64 -7 64 4 0 6 13 -4 29 -22 16 -18 27 -35 25 -37 -2 -3 -10 4 -18 14
    -8 11 -18 15 -26 10 -9 -5 -11 -4 -6 3 5 8 -3 12 -24 12 -18 0 -29 -4 -25 -10
    3 -6 12 -10 20 -10 7 0 15 -7 19 -15 3 -8 12 -15 21 -15 9 0 27 -12 41 -27 23
    -25 24 -26 14 -5 -20 40 -5 34 28 -12 30 -41 81 -72 152 -90 l25 -7 -23 17
    c-21 16 -21 17 -5 30 21 16 47 18 38 4 -3 -5 -2 -10 4 -10 5 0 12 4 16 9 5 9
    -54 31 -85 31 -12 0 -11 3 2 17 14 14 22 15 43 5 15 -7 24 -8 20 -3 -3 6 4 15
    15 21 18 10 27 7 56 -15 l34 -26 0 23 c0 29 -8 39 -45 58 -22 12 -31 24 -33
    48 -2 18 -8 32 -14 32 -17 0 -2 75 23 116 l22 37 33 -36 c54 -58 67 -153 28
    -198 -8 -9 -12 -23 -8 -32 8 -23 20 -13 27 22 8 40 48 67 77 51 33 -18 76 8
    72 43 -2 19 1 27 12 27 19 0 30 -17 16 -25 -18 -11 -10 -23 12 -17 14 3 19 2
    14 -6 -4 -7 -14 -12 -21 -12 -14 0 -41 -38 -37 -53 1 -4 -2 -17 -8 -27 -9 -17
    -5 -25 20 -50 33 -32 38 -42 16 -34 -21 8 -76 -27 -76 -47 0 -10 3 -25 6 -33
    5 -13 9 -14 21 -5 11 10 23 8 56 -9 33 -16 58 -21 109 -19 52 2 64 5 56 14 -8
    10 -6 13 6 13 25 0 19 17 -14 41 -29 22 -50 64 -50 101 0 16 4 18 22 12 13 -4
    33 -8 45 -10 13 -1 44 -14 69 -28 25 -14 50 -23 55 -21 5 3 11 -5 15 -19 6
    -25 29 -40 45 -30 6 3 16 0 24 -6 18 -15 44 7 37 32 -2 10 -2 25 2 34 5 13 10
    13 36 -6 29 -20 50 -20 50 1 0 15 -20 32 -61 51 -34 15 -37 15 -54 0 -16 -16
    -17 -16 -6 5 8 16 8 22 -4 27 -8 3 -15 1 -15 -5 0 -7 -10 -9 -25 -5 -14 4 -25
    2 -25 -4 0 -5 5 -10 11 -10 5 0 8 -4 5 -9 -3 -4 -17 -6 -31 -3 -24 4 -25 6
    -10 22 8 9 15 19 15 22 0 4 -28 4 -62 1 -70 -5 -63 10 9 22 23 3 47 13 54 21
    6 8 21 14 33 14 16 0 18 2 7 9 -8 5 -29 7 -47 5 -31 -4 -33 -2 -30 23 3 33
    -22 67 -38 54 -6 -5 -24 -11 -41 -15 -51 -10 -115 38 -67 51 l21 5 -21 28
    c-24 33 -16 54 19 47 34 -6 49 24 27 58 -9 14 -12 25 -7 25 5 0 15 -11 21 -24
    14 -31 48 -37 94 -14 32 15 37 16 42 2 12 -30 6 -72 -14 -97 -11 -14 -20 -32
    -20 -40 0 -21 19 -32 33 -18 15 15 27 14 27 -3 0 -8 -7 -17 -16 -20 -15 -6
    -14 -10 6 -31 27 -29 50 -32 51 -7 0 10 3 12 6 5 9 -24 25 -13 19 12 -4 14 -2
    25 3 25 5 0 12 -18 16 -40 5 -31 12 -41 30 -46 14 -3 30 -13 36 -21 11 -12 14
    -11 25 9 15 27 18 50 4 28 -11 -17 -13 -1 -4 24 3 9 11 13 17 9 6 -3 7 -1 3 5
    -3 6 3 26 14 44 24 40 25 54 4 62 -13 5 -15 2 -11 -15 3 -13 -2 -28 -14 -40
    -10 -10 -19 -23 -19 -29 0 -5 -4 -10 -10 -10 -5 0 -7 -6 -4 -13 2 -7 -2 -21
    -11 -32 -13 -17 -16 -18 -25 -5 -6 8 -8 23 -6 33 2 9 0 17 -5 17 -5 0 -9 5 -9
    11 0 6 6 9 13 6 9 -3 17 9 24 36 l11 41 -18 -24 c-23 -31 -32 -23 -21 18 8 25
    7 30 -5 25 -23 -9 -16 15 9 28 12 7 23 10 24 8 1 -2 5 -1 9 4 4 4 -7 7 -24 7
    -30 0 -47 19 -19 21 90 5 98 2 67 -26 -11 -10 -20 -25 -20 -33 0 -9 8 -5 21
    12 18 23 22 24 35 11 9 -8 12 -19 9 -25 -10 -16 11 -11 26 6 11 14 11 18 -2
    28 -18 13 -19 78 -2 83 20 7 35 -47 28 -100 -4 -33 -2 -47 4 -42 21 13 97 -31
    113 -66 l17 -34 11 30 c7 17 12 40 12 52 1 25 31 36 77 27 23 -5 34 -15 43
    -40 11 -32 28 -46 28 -23 0 5 5 7 10 4 7 -4 1 -16 -15 -31 l-26 -24 24 0 c13
    0 32 9 43 21 32 35 49 40 63 17 12 -19 11 -20 -12 -14 -17 4 -29 0 -42 -14
    -17 -19 -17 -20 1 -20 11 0 24 -10 29 -22 6 -13 16 -22 23 -20 17 3 15 -25 -3
    -32 -8 -3 -15 -12 -15 -20 0 -8 -8 -15 -17 -15 -22 0 -93 -19 -76 -20 17 -1
    44 -31 38 -42 -8 -12 -62 -12 -70 1 -13 21 -25 9 -19 -17 4 -16 7 -32 8 -38 2
    -19 39 -27 48 -10 7 12 14 13 29 5 11 -6 19 -7 19 -1 0 5 9 7 21 4 16 -5 19
    -11 14 -32 -4 -14 -13 -33 -21 -42 -19 -21 -18 -28 6 -22 13 3 20 14 20 29 0
    13 6 27 14 31 7 4 16 25 20 45 7 36 5 38 -19 38 -26 0 -35 -15 -13 -22 9 -3 9
    -6 0 -12 -7 -4 -12 -2 -12 4 0 6 -11 8 -27 4 l-28 -5 24 20 c19 18 21 24 11
    36 -7 9 -10 18 -7 21 9 9 54 -4 69 -20 7 -7 22 -11 33 -8 17 5 18 3 8 -9 -7
    -8 -10 -25 -6 -37 6 -25 23 -30 23 -6 0 9 6 14 12 12 12 -4 42 61 33 70 -2 2
    -6 -6 -10 -17 -3 -12 -13 -21 -20 -21 -9 0 -12 6 -9 15 4 8 3 23 -2 32 -17 39
    -12 49 19 45 21 -3 28 -1 23 7 -4 6 -21 11 -37 11 -19 0 -28 4 -24 11 4 6 24
    9 46 8 46 -4 57 4 38 28 -12 15 -12 16 1 8 13 -8 12 -5 -1 15 -20 31 -55 37
    -80 14 -10 -9 -19 -13 -19 -8 0 16 23 34 43 34 11 0 17 5 14 13 -2 6 -13 11
    -24 9 -13 -2 -20 2 -19 10 0 7 -7 42 -17 78 -14 49 -16 74 -10 100 9 32 12 35
    44 32 26 -2 42 5 65 26 27 24 41 29 95 31 73 3 108 6 162 17 32 6 42 3 60 -15
    12 -12 35 -31 50 -42 23 -18 28 -28 25 -58 -3 -31 0 -36 17 -33 11 2 27 10 36
    18 9 8 18 12 21 9 3 -3 11 1 18 10 44 53 60 -39 31 -177 -23 -110 -104 -193
    -193 -200 -31 -3 -47 -13 -48 -30 0 -5 9 -8 19 -8 41 0 153 -42 193 -74 24
    -18 49 -31 55 -29 18 6 2 -40 -19 -55 -10 -7 -18 -25 -18 -39 0 -20 4 -24 19
    -20 12 3 22 -1 25 -10 4 -11 10 -11 26 -3 11 6 36 8 56 4 25 -5 40 -2 53 10
    17 15 19 15 25 1 3 -10 11 -13 18 -8 16 9 33 14 79 20 32 4 40 1 60 -26 28
    -38 48 -46 64 -24 11 14 9 23 -13 55 -13 21 -31 38 -38 38 -7 0 -15 9 -19 19
    -9 29 -46 34 -72 9 -17 -16 -23 -18 -23 -7 0 8 5 20 12 27 8 8 5 16 -13 31
    -13 11 -29 20 -35 21 -6 0 -19 9 -29 20 -14 15 -15 23 -6 33 8 11 6 18 -9 32
    -11 10 -20 23 -20 30 0 20 38 47 65 47 14 0 25 4 25 8 0 19 41 17 56 -3 16
    -22 16 -22 11 6 -2 15 -1 27 3 27 14 0 48 -47 68 -92 12 -27 26 -48 33 -48 6
    0 8 7 5 16 -20 51 -18 61 13 73 25 11 35 10 59 -2 26 -12 34 -12 63 0 22 9 46
    12 69 7 19 -4 39 -7 43 -6 4 1 16 -2 26 -8 16 -8 20 -5 25 13 7 30 73 100 86
    92 5 -3 15 -3 21 1 8 5 8 9 -1 14 -7 5 -41 -5 -77 -21 -36 -16 -71 -29 -78
    -29 -7 0 -24 -9 -39 -21 l-26 -20 0 38 c0 33 7 45 45 81 25 23 49 42 55 42 5
    0 10 6 10 13 0 21 33 47 59 47 21 0 21 1 7 22 -9 12 -16 28 -16 34 0 12 63 54
    80 54 6 0 22 -19 37 -41 l28 -42 10 44 11 44 50 0 50 0 -13 -25 c-12 -23 -11
    -26 12 -33 14 -5 25 -16 25 -26 0 -13 7 -16 33 -13 21 2 38 -2 46 -12 7 -8 19
    -12 28 -9 17 6 33 -12 33 -39 0 -15 -4 -15 -31 -6 -25 8 -38 7 -65 -5 -32 -16
    -50 -42 -20 -31 8 3 19 -3 25 -14 6 -11 25 -24 43 -27 18 -4 50 -16 70 -26 47
    -24 51 -24 45 4 -9 32 8 96 30 113 17 14 15 15 -15 10 l-34 -6 29 30 c17 19
    38 30 55 30 35 0 44 16 18 32 -43 27 -13 37 49 16 20 -7 40 -18 44 -25 5 -9
    15 -10 34 -2 31 11 46 -3 40 -38 -3 -19 -1 -20 19 -11 18 8 29 7 49 -6 20 -13
    25 -25 25 -58 0 -36 6 -48 55 -99 36 -37 55 -66 54 -81 0 -23 0 -23 -9 -2 -11
    28 -30 40 -30 19 0 -8 -7 -18 -15 -21 -8 -4 -15 -14 -15 -24 0 -9 -8 -25 -19
    -34 -18 -16 -18 -16 -13 9 4 22 1 25 -19 23 -13 -2 -32 -15 -41 -31 -10 -15
    -23 -27 -30 -27 -9 0 -9 3 0 12 7 7 12 16 12 20 0 4 -9 -1 -20 -12 -11 -11
    -27 -20 -36 -20 -17 0 -16 23 2 104 7 28 6 29 -22 22 -36 -9 -58 -36 -85 -106
    -20 -52 -24 -89 -16 -135 7 -46 28 -105 42 -118 23 -24 29 -81 10 -116 -9 -18
    -15 -44 -13 -59 3 -24 11 -16 72 71 l69 97 28 -26 c15 -14 30 -37 33 -50 4
    -13 11 -24 16 -24 20 0 4 130 -18 152 -5 5 -34 15 -63 22 -37 8 -55 17 -57 29
    -2 12 1 15 12 11 14 -6 21 5 17 28 0 5 12 8 29 8 16 0 30 4 30 9 0 16 39 19
    51 5 9 -11 9 -23 -1 -53 -12 -38 -6 -86 10 -76 4 3 17 -11 29 -30 25 -43 45
    -47 36 -6 -4 21 -2 30 10 35 9 3 13 2 10 -4 -12 -20 6 -50 31 -50 13 0 24 -6
    24 -12 0 -9 4 -8 10 2 7 10 8 2 4 -29 l-7 -43 31 16 c17 9 37 25 46 37 8 12
    19 18 25 14 6 -3 11 -2 11 4 0 5 13 18 29 27 36 21 34 34 -8 70 -19 15 -39 42
    -46 58 l-13 31 -15 -35 c-9 -19 -16 -28 -16 -19 -2 26 -44 60 -61 49 -27 -17
    -40 -11 -40 21 0 17 -4 28 -10 24 -6 -3 -10 1 -10 9 0 20 -19 31 -33 17 -6 -6
    -16 -11 -21 -11 -22 1 37 40 60 40 13 0 24 5 24 10 0 6 -5 10 -11 10 -5 0 -7
    4 -4 10 7 12 67 2 80 -14 6 -7 29 -12 53 -12 32 0 42 4 42 17 0 8 -3 19 -7 23
    -5 4 -9 12 -9 17 -1 5 -2 10 -4 12 -5 6 -11 47 -13 95 -3 51 -2 53 20 49 16
    -3 24 1 28 14 4 11 15 19 25 19 13 0 17 5 14 15 -3 8 -10 13 -16 12 -6 -1 -12
    6 -13 16 -3 17 -2 17 13 4 33 -29 117 -65 132 -57 8 4 34 11 57 15 23 3 47 13
    54 21 6 8 21 14 32 14 16 0 12 6 -19 29 -21 15 -48 38 -58 50 -12 13 -23 18
    -30 12 -6 -5 -24 -11 -41 -15 -51 -10 -115 38 -67 51 l21 5 -21 28 c-24 33
    -16 54 19 47 34 -6 49 24 27 58 -9 14 -12 25 -7 25 5 0 15 -11 21 -24 14 -31
    48 -37 94 -14 32 15 37 16 42 2 12 -30 6 -72 -14 -97 -26 -33 -25 -46 5 -87
    34 -46 70 -67 127 -75 26 -4 50 -11 54 -16 18 -30 43 12 78 134 24 82 24 87 9
    127 -12 31 -14 43 -5 52 9 9 15 9 25 -1 20 -21 13 -119 -16 -200 -36 -99 -35
    -103 8 -95 44 8 85 -2 85 -21 0 -8 7 -15 16 -15 15 0 15 2 1 22 -9 13 -26 41
    -37 63 -12 22 -28 45 -37 52 -20 16 -8 53 18 53 43 0 98 -46 99 -82 0 -34 17
    -18 24 21 8 51 45 82 84 72 35 -9 54 -48 43 -87 -8 -29 -8 -29 30 -29 47 0 79
    -28 79 -67 0 -23 -6 -32 -31 -42 l-31 -13 31 -13 c17 -7 44 -10 61 -8 27 4 30
    2 24 -16 -4 -12 -10 -25 -14 -31 -5 -5 -6 -21 -3 -35 4 -22 9 -25 37 -22 20 2
    37 -2 45 -12 7 -8 19 -12 28 -9 17 6 33 -12 33 -39 0 -15 -4 -15 -31 -6 -25 8
    -38 7 -65 -5 -32 -16 -50 -42 -20 -31 8 3 19 -3 25 -14 6 -11 25 -24 43 -27
    38 -9 105 -41 130 -62 9 -8 22 -36 29 -63 12 -47 13 -48 43 -39 17 5 32 9 33
    9 1 0 9 -7 18 -16 14 -15 13 -19 -19 -50 -21 -20 -29 -34 -21 -34 8 0 15 5 15
    11 0 5 5 7 12 3 7 -4 8 -3 4 4 -12 20 6 13 32 -11 23 -20 24 -20 15 -2 -8 18
    -10 41 -3 48 1 1 7 34 14 72 l11 70 37 3 36 3 -16 29 c-13 22 -20 26 -30 18
    -9 -8 -16 -8 -24 0 -18 18 7 86 43 116 17 14 26 26 20 26 -10 0 -66 -23 -103
    -41 -24 -12 -28 -11 -28 6 0 15 95 115 110 115 4 0 5 11 3 25 -4 20 0 25 22
    31 21 5 30 2 43 -17 l16 -23 6 24 c4 19 13 25 33 26 19 1 27 -4 27 -16 0 -16
    17 -28 65 -46 11 -4 24 -8 29 -8 5 -1 11 -6 13 -13 3 -7 -7 -11 -25 -11 -32 1
    -52 -8 -52 -23 0 -6 4 -8 9 -4 5 3 12 1 16 -5 3 -5 29 -20 56 -31 48 -21 69
    -43 69 -71 0 -8 -4 -6 -11 5 -5 9 -17 17 -25 17 -13 0 -13 -3 0 -22 16 -22 22
    -58 10 -58 -4 0 -26 21 -50 47 -24 26 -47 44 -50 40 -4 -4 0 -15 9 -24 8 -10
    20 -31 26 -46 10 -25 8 -32 -19 -59 -17 -17 -32 -29 -34 -27 -2 2 -9 14 -15
    26 -6 13 -16 23 -20 23 -14 0 -21 -44 -9 -51 7 -4 6 -8 -3 -12 -12 -4 -11 -7
    1 -16 13 -9 13 -11 0 -11 -10 0 -11 -3 -3 -11 9 -9 16 -8 27 3 11 11 12 18 3
    27 -8 8 -7 11 7 11 46 0 78 -41 91 -118 l7 -43 34 33 c19 18 34 41 34 51 0 9
    27 37 63 63 34 25 68 53 75 62 7 9 31 23 54 32 36 13 41 19 44 50 4 58 15 99
    30 111 8 6 14 18 14 25 0 8 4 14 9 14 14 0 28 -23 35 -57 9 -38 30 -58 52 -49
    13 5 16 16 11 52 -6 57 -23 77 -35 44 l-9 -24 -13 24 c-7 14 -18 28 -25 32 -7
    4 -10 19 -7 33 3 19 0 25 -13 25 -14 0 -16 -7 -13 -34 4 -33 3 -33 -18 -19
    -13 8 -29 24 -37 36 -8 13 -31 31 -51 42 -21 12 -40 31 -46 50 -10 28 -9 32
    30 67 35 31 45 36 62 27 11 -6 26 -26 34 -45 8 -19 23 -43 34 -54 19 -19 19
    -19 25 1 4 10 13 19 20 19 8 0 18 7 23 16 5 9 32 20 62 26 51 9 54 9 81 -21
    15 -17 33 -31 39 -31 11 0 -33 -64 -60 -88 -8 -7 1 -5 20 4 32 16 46 19 103
    26 9 1 17 6 17 11 0 4 4 6 9 3 11 -7 6 -83 -8 -116 -15 -37 -32 -54 -68 -72
    -28 -14 -33 -14 -33 -2 0 24 -14 15 -29 -18 l-14 -31 -19 26 c-27 37 -38 34
    -39 -10 0 -28 -2 -33 -8 -19 -7 18 -8 18 -14 2 -6 -15 -10 -16 -22 -6 -13 10
    -15 9 -15 -9 0 -18 4 -21 20 -16 11 4 33 0 49 -8 30 -15 51 -7 51 19 0 6 7 14
    15 18 17 6 21 -9 5 -19 -20 -12 -56 -100 -58 -140 -1 -22 2 -53 7 -70 l8 -30
    8 28 c7 26 25 38 25 16 0 -21 45 -64 63 -61 9 2 17 8 17 13 0 5 20 9 44 9 36
    0 50 6 75 31 35 35 37 41 17 72 -7 12 -16 37 -20 55 -8 44 12 38 40 -11 l20
    -37 13 49 c10 40 16 48 31 44 29 -8 82 19 77 38 -3 9 0 24 5 33 7 12 5 16 -7
    16 -8 0 -15 -4 -15 -10 0 -5 -4 -10 -9 -10 -18 0 -4 57 28 108 33 52 39 56 75
    52 33 -3 106 22 120 42 7 10 19 18 26 16 7 -2 15 3 17 10 3 7 -13 20 -41 32
    -37 17 -49 18 -65 8 -25 -15 -35 -6 -26 22 5 16 13 20 27 17 12 -3 27 1 36 9
    10 10 28 14 48 12 27 -3 34 0 36 17 2 12 12 21 27 23 19 3 22 8 18 30 -5 26
    -4 27 41 27 47 0 47 0 52 -38 6 -49 19 -50 48 -7 31 46 49 56 70 37 9 -7 25
    -17 35 -20 24 -9 21 -41 -8 -75 l-25 -30 29 11 c24 9 34 7 55 -6 14 -10 26
    -24 26 -32 0 -8 7 -15 16 -15 9 0 18 -8 21 -17 2 -10 22 -30 44 -45 35 -25 39
    -32 39 -69 0 -41 0 -42 -20 -24 -11 10 -41 26 -67 35 -27 10 -67 25 -90 35
    -41 17 -80 15 -68 -5 3 -5 17 -10 30 -10 44 0 115 -120 115 -195 0 -13 -7 -29
    -16 -36 -14 -11 -19 -10 -34 9 -25 30 -37 28 -45 -8 -4 -16 -12 -33 -19 -37
    -7 -5 -18 -23 -25 -41 -13 -31 -37 -52 -59 -52 -6 0 -18 27 -28 60 -24 79 -38
    77 -32 -5 3 -36 2 -63 -2 -60 -22 14 -27 -86 -6 -104 16 -14 36 -4 119 61 31
    24 60 38 77 38 16 0 32 4 35 10 3 5 16 15 28 21 32 17 12 -1 -73 -63 -103 -75
    -115 -90 -98 -118 18 -29 72 -19 105 20 13 16 32 32 42 35 11 3 21 15 24 25 3
    11 12 20 21 20 9 0 16 6 16 13 0 22 34 47 64 47 26 0 27 1 12 22 -27 38 -20
    61 25 82 30 14 44 15 52 7 6 -6 17 -11 25 -11 11 0 11 3 -2 15 -8 8 -20 15
    -26 15 -14 0 -49 40 -50 57 0 7 -15 15 -34 19 -24 4 -33 10 -29 20 3 8 12 14
    20 14 8 0 11 4 8 10 -3 5 -1 10 4 10 6 0 20 9 31 20 15 15 25 18 38 12 9 -5
    22 -7 28 -5 7 2 15 -8 18 -22 5 -21 11 -24 31 -19 16 4 25 2 25 -5 0 -8 10 -7
    29 4 19 9 41 12 61 9 40 -8 47 -22 16 -30 -33 -8 -29 -24 13 -45 24 -13 39
    -15 52 -9 24 13 26 13 33 -6 4 -9 1 -23 -5 -30 -9 -11 -7 -14 11 -14 19 0 20
    -3 10 -15 -6 -8 -9 -19 -5 -26 4 -6 1 -15 -6 -20 -9 -6 -10 -9 -2 -9 16 0 24
    14 46 79 23 68 73 131 103 131 28 0 40 16 18 24 -8 3 -32 -2 -52 -13 -20 -10
    -59 -26 -87 -36 -27 -10 -60 -27 -72 -38 l-23 -20 0 37 c0 48 13 72 50 91 16
    8 31 24 35 35 3 11 13 20 21 20 8 0 14 7 14 15 0 21 46 48 70 42 24 -6 25 1 5
    27 -20 27 -19 55 3 63 9 3 24 12 33 20 23 19 43 8 75 -40 l28 -42 11 50 c9 41
    14 49 30 47 11 -2 32 -4 47 -4 24 -1 26 -4 21 -30 -5 -24 -2 -28 17 -28 13 0
    24 -8 27 -20 4 -15 14 -20 38 -20 18 0 38 -7 45 -15 7 -9 21 -13 35 -9 18 4
    24 0 29 -21 9 -35 6 -37 -30 -24 -23 9 -37 8 -66 -4 -21 -9 -38 -23 -38 -31 0
    -9 6 -13 14 -10 8 3 17 1 20 -5 5 -7 13 -7 26 1 16 10 22 8 41 -15 12 -16 24
    -26 27 -23 3 3 11 -2 18 -12 7 -9 14 -12 14 -6 0 6 -7 17 -15 24 -8 7 -15 20
    -15 30 0 13 10 17 44 18 24 1 66 6 93 11 46 9 127 3 178 -14 15 -4 30 3 57 29
    21 20 42 36 48 36 5 0 10 6 10 13 0 20 33 47 59 47 21 0 21 1 5 25 -21 32 -15
    45 30 69 34 18 37 18 54 3 20 -18 34 -13 25 8 -2 8 -11 11 -19 8 -17 -6 -18 9
    -2 25 9 9 8 16 -5 30 -23 25 -21 32 8 32 32 0 65 -28 65 -56 0 -26 41 -39 85
    -28 26 7 27 5 23 -25 -3 -18 -1 -34 4 -37 4 -3 8 -13 8 -23 0 -13 7 -16 33
    -13 21 2 38 -2 46 -12 7 -8 19 -12 28 -9 17 6 33 -12 33 -39 0 -15 -4 -15 -31
    -6 -25 8 -38 7 -65 -5 -32 -16 -50 -42 -20 -31 8 3 19 -3 25 -14 6 -11 29 -24
    53 -31 51 -13 118 -50 130 -71 4 -8 12 -27 18 -43 9 -24 14 -27 57 -27 50 0
    110 24 158 65 l30 25 -93 89 c-51 49 -106 96 -122 103 -17 7 -30 16 -30 20 0
    11 -186 148 -199 148 -6 0 -11 5 -11 10 0 6 12 10 27 10 31 0 253 -163 361
    -265 38 -36 74 -65 79 -65 17 0 50 43 77 99 31 64 32 74 9 92 -15 13 -15 12
    -5 -8 10 -17 9 -25 -4 -37 -8 -9 -19 -16 -23 -16 -15 0 -39 26 -46 48 -6 22 4
    28 43 23 6 -1 12 5 12 14 0 8 5 15 10 15 21 0 8 19 -20 29 -16 5 -30 15 -30
    20 0 6 -7 11 -17 11 -14 0 -14 2 2 20 17 19 28 20 149 17 90 -2 131 -6 134
    -15 2 -7 11 -12 19 -12 13 0 13 -3 3 -15 -11 -13 -11 -20 0 -40 16 -30 30 -32
    30 -4 0 14 5 19 18 17 9 -2 26 4 36 14 23 21 21 21 30 -14 5 -24 3 -28 -14
    -28 -23 0 -26 -10 -7 -29 6 -7 8 -12 2 -11 -5 2 -19 2 -30 0 l-20 -1 20 -9
    c13 -5 26 -3 36 6 18 16 79 19 79 5 0 -6 -15 -11 -32 -13 -45 -4 -53 -38 -10
    -38 17 0 32 6 35 14 6 14 47 19 47 5 0 -3 11 -11 24 -17 19 -9 27 -8 36 4 13
    14 8 17 -20 15 -10 -1 -16 7 -16 19 0 16 7 20 33 20 l33 0 3 -307 c1 -207 3
    -138 5 210 l2 517 -9600 0 -9600 0 0 -556z m7455 54 c3 -3 -4 -13 -15 -23 -11
    -10 -20 -25 -20 -33 0 -9 8 -5 21 12 18 23 22 24 35 11 9 -8 12 -19 9 -25 -9
    -14 8 -13 23 2 8 8 12 8 12 1 0 -17 -28 -35 -41 -27 -9 5 -10 1 -6 -15 4 -15
    -1 -29 -14 -42 -10 -10 -19 -23 -19 -29 0 -5 -4 -10 -10 -10 -5 0 -7 -6 -4
    -13 2 -7 -2 -21 -11 -32 -13 -17 -16 -18 -25 -5 -6 8 -8 23 -6 33 2 9 0 17 -5
    17 -5 0 -9 5 -9 11 0 6 6 9 13 6 9 -3 17 9 24 36 l11 41 -18 -24 c-23 -31 -32
    -23 -21 18 8 25 7 30 -5 25 -23 -9 -16 15 9 28 12 7 24 11 25 10 2 -2 6 0 10
    3 3 3 -9 6 -26 6 -33 0 -44 16 -15 22 23 4 72 2 78 -4z"/>
    <path d="M18756 934 c-8 -21 -9 -17 20 -49 14 -15 23 -34 20 -42 -3 -8 -2 -12
    2 -9 5 3 27 0 49 -6 46 -11 65 -37 34 -45 -13 -3 -17 -11 -15 -26 4 -21 4 -21
    -5 1 -10 21 -31 31 -31 14 0 -17 36 -39 80 -50 24 -6 45 -10 45 -9 0 1 9 12
    20 25 16 20 17 25 5 33 -10 6 -11 12 -5 17 16 12 17 35 1 29 -8 -3 -27 8 -45
    29 -24 26 -28 34 -15 34 22 0 8 15 -14 16 -10 1 -29 2 -45 3 -19 1 -30 8 -37
    26 -11 29 -54 35 -64 9z"/>
    <path d="M18710 928 c0 -10 -6 -21 -13 -25 -7 -4 -26 -38 -42 -75 -15 -37 -36
    -75 -46 -84 -31 -28 -24 -44 22 -44 39 0 171 17 196 25 17 6 -38 100 -58 101
    -8 0 -19 2 -25 2 -16 3 -24 54 -11 70 7 10 6 17 -6 30 -16 15 -17 15 -17 0z"/>
    <path d="M19040 741 c0 -5 5 -11 12 -13 13 -5 2 -28 -13 -28 -6 0 -7 5 -4 10
    13 21 -6 30 -36 17 -28 -11 -31 -16 -34 -74 -4 -57 -2 -63 15 -63 10 0 23 -8
    28 -17 8 -14 14 -15 41 -3 17 7 31 19 31 26 0 9 11 14 28 14 18 0 23 3 14 9
    -9 5 -11 17 -6 35 5 23 1 33 -31 62 -40 36 -45 39 -45 25z"/>
    <path d="M17755 709 c-33 -15 -67 -28 -76 -28 -9 -1 -28 -10 -42 -21 -15 -12
    -30 -21 -34 -21 -4 1 -16 -2 -26 -5 -11 -3 -27 2 -38 12 -21 19 -38 12 -21 -9
    7 -8 10 -16 7 -19 -3 -3 4 -13 15 -23 21 -19 27 -69 9 -81 -8 -4 -7 -9 2 -14
    13 -9 47 6 65 29 6 8 16 11 22 7 6 -3 14 -1 17 4 4 6 17 15 29 20 14 5 27 23
    34 47 14 48 74 115 95 107 8 -3 18 -1 21 4 13 22 -22 18 -79 -9z"/>
    <path d="M10060 681 c0 -5 7 -14 15 -21 8 -7 15 -16 15 -20 0 -13 -38 -18 -49
    -7 -8 8 -11 8 -11 -1 0 -7 -7 -12 -16 -12 -14 0 -14 3 -4 15 25 30 -12 16 -42
    -16 -33 -34 -32 -52 2 -57 l24 -4 -25 -19 c-21 -16 -22 -21 -11 -38 6 -12 12
    -27 12 -35 0 -10 10 -13 34 -11 23 2 41 -3 55 -16 l21 -20 0 43 c0 41 -1 43
    -31 45 -44 3 -46 9 -14 37 17 14 26 30 22 39 -8 21 3 29 20 15 17 -14 21 -9
    29 29 4 21 1 35 -11 46 -18 18 -35 22 -35 8z"/>
    <path d="M12955 649 c24 -73 30 -123 15 -114 -6 4 -8 10 -5 15 3 5 1 11 -5 15
    -11 7 -25 -39 -15 -54 9 -16 38 -14 30 2 -4 6 -1 5 7 -4 7 -9 25 -19 41 -23
    15 -3 27 -13 27 -21 0 -18 -31 -20 -48 -3 -7 7 -12 8 -12 4 0 -12 70 -96 80
    -96 4 0 11 20 14 45 12 74 28 66 24 -11 l-3 -68 38 -9 c43 -10 56 -4 37 18 -9
    11 -10 18 -1 29 8 10 9 22 1 42 -20 56 -33 73 -64 85 -17 7 -38 20 -47 28 -9
    9 -25 23 -35 32 -32 27 -64 69 -64 83 0 8 -5 18 -11 22 -8 4 -9 -1 -4 -17z"/>
    <path d="M1681 617 c-7 -9 -13 -28 -13 -44 -1 -33 38 -103 58 -103 7 0 18 -19
    24 -42 15 -58 41 -109 63 -122 22 -14 51 3 55 33 4 24 20 28 28 6 4 -8 -6 -27
    -24 -44 -27 -27 -31 -29 -50 -15 -27 19 -30 11 -19 -64 l9 -63 36 3 c34 3 37
    1 42 -27 l6 -30 26 40 c14 22 37 51 52 64 14 14 26 29 26 35 0 6 9 17 21 24
    24 15 26 19 -29 -66 -33 -52 -33 -54 -10 -50 15 2 33 20 55 57 18 30 31 57 28
    59 -4 4 9 25 50 77 15 19 17 19 26 3 13 -24 104 -26 113 -3 5 14 9 14 33 1 19
    -9 45 -12 75 -9 45 5 47 7 57 49 6 24 15 44 19 44 20 0 52 -49 58 -88 13 -82
    32 -59 41 49 l6 67 -32 -4 c-18 -2 -37 -6 -42 -10 -14 -8 -39 15 -39 37 0 12
    -7 19 -20 19 -10 0 -34 6 -52 14 -49 22 -122 33 -124 19 -1 -11 -22 -63 -36
    -90 -17 -35 -50 -60 -89 -71 -34 -9 -38 -8 -48 14 -15 35 -28 30 -35 -14 -5
    -34 -46 -91 -46 -65 0 6 -16 27 -36 48 -26 28 -38 35 -47 26 -17 -17 -27 -13
    -27 10 0 11 -5 40 -11 65 -8 32 -16 44 -30 44 -21 0 -39 -28 -31 -50 4 -12 3
    -13 -10 -2 -9 7 -18 25 -21 41 -4 17 -15 32 -26 36 -18 5 -20 12 -14 52 5 40
    4 45 -10 40 -9 -3 -17 -1 -19 5 -2 6 -9 4 -17 -5z"/>
    <path d="M6673 610 c-33 -14 -51 -49 -58 -115 -8 -76 2 -92 41 -72 48 24 87
    29 109 13 20 -14 20 -15 -3 -39 -13 -14 -20 -27 -15 -30 14 -9 92 56 100 83 3
    14 12 31 20 38 7 7 13 19 13 26 0 6 15 13 32 14 39 3 59 19 35 28 -9 3 -41 -7
    -73 -25 -32 -17 -67 -31 -78 -31 -11 0 -30 -10 -43 -22 l-23 -21 0 35 c0 25 9
    47 26 67 21 26 24 34 14 46 -14 16 -62 19 -97 5z"/>
    <path d="M13132 540 c12 -22 28 -40 35 -40 7 0 13 -4 13 -10 0 -19 80 -90 101
    -90 16 0 20 -5 16 -19 -4 -16 5 -22 52 -36 31 -10 59 -20 64 -22 4 -2 7 0 7 6
    0 20 -86 101 -108 101 -12 0 -22 6 -22 14 0 8 -23 34 -52 58 -29 23 -49 38
    -45 31 4 -6 3 -14 -3 -18 -5 -3 -10 -1 -10 5 0 11 -50 59 -62 60 -4 0 3 -18
    14 -40z"/>
    <path d="M3840 560 c0 -14 -69 -89 -94 -102 -12 -7 -39 -14 -60 -17 -58 -9
    -55 -27 6 -41 69 -16 136 -51 170 -87 26 -27 27 -33 23 -96 -4 -62 -3 -67 16
    -67 11 0 23 -9 28 -22 7 -19 9 -17 14 16 4 26 1 49 -10 70 -10 18 -17 62 -19
    106 l-3 75 9 -60 c9 -67 25 -115 38 -115 12 0 102 133 131 194 16 33 20 51 12
    54 -6 2 -11 17 -11 33 0 16 -4 29 -10 29 -5 0 -9 -8 -8 -17 3 -41 -3 -63 -17
    -63 -8 0 -18 12 -21 27 -4 15 -20 41 -35 57 l-28 30 -12 -29 c-7 -17 -18 -55
    -25 -85 l-12 -55 -1 45 -1 44 -40 -39 c-22 -21 -43 -35 -47 -31 -7 6 14 98 32
    139 5 12 3 17 -9 17 -9 0 -16 -4 -16 -10z"/>
    <path d="M5513 530 c-12 -5 -28 -19 -36 -32 -18 -28 -31 -119 -22 -147 8 -25
    23 -28 21 -5 0 9 5 19 13 22 10 3 12 0 8 -11 -4 -11 -2 -14 9 -10 7 3 14 14
    14 24 0 18 14 23 56 22 8 0 11 24 11 73 -1 72 -2 74 -27 73 -14 0 -35 -4 -47
    -9z"/>
    <path d="M12075 515 c-4 -11 -12 -33 -18 -49 -11 -29 -11 -93 -1 -129 5 -15 8
    -16 22 -5 14 11 14 9 -1 -8 -12 -15 -15 -30 -11 -53 7 -31 9 -33 41 -28 19 4
    77 12 129 19 63 8 94 16 94 25 0 7 4 13 9 13 6 0 22 11 36 24 31 28 28 54 -10
    96 -12 14 -28 35 -34 48 -15 29 -32 28 -61 -3 -13 -14 -20 -25 -16 -25 4 0
    -22 -16 -58 -35 -78 -41 -98 -44 -66 -10 27 29 24 35 -19 38 -34 2 -40 14 -15
    32 15 10 15 14 1 41 -14 27 -16 27 -22 9z"/>
    <path d="M7476 455 c-3 -8 -15 -15 -26 -15 -12 0 -20 -7 -20 -16 0 -10 6 -14
    15 -10 12 4 13 2 3 -13 -6 -10 -18 -18 -27 -17 -10 1 -17 -10 -21 -29 -4 -20
    -11 -30 -23 -29 -9 1 -17 -4 -17 -11 0 -19 -37 -49 -42 -34 -3 8 -9 9 -19 4
    -8 -5 -23 -8 -34 -7 -16 2 -17 1 -5 -7 8 -6 23 -8 32 -5 14 4 16 1 11 -12 -7
    -19 -5 -18 56 23 18 12 38 20 43 17 5 -4 25 8 43 26 25 24 38 30 55 25 30 -10
    19 -31 -15 -27 -26 3 -27 2 -15 -13 12 -15 12 -17 -5 -14 -22 3 -75 -20 -75
    -31 0 -4 9 -10 20 -13 11 -3 20 -10 20 -15 0 -5 -9 -12 -20 -15 -21 -5 -29
    -50 -11 -61 17 -11 39 5 34 25 -3 10 0 19 6 19 6 0 11 -5 11 -11 0 -6 7 -8 16
    -5 8 3 13 2 10 -2 -2 -4 -1 -14 3 -20 5 -9 16 0 34 27 15 22 27 42 27 44 0 2
    -16 4 -35 5 -25 1 -35 -3 -35 -13 0 -20 -16 -19 -24 1 -10 25 -8 26 37 22 37
    -2 42 0 45 20 2 15 -2 22 -13 22 -9 0 -13 5 -10 10 4 7 11 8 18 2 8 -6 21 -6
    37 1 25 10 25 10 3 14 -22 4 -34 43 -14 43 5 0 1 17 -9 38 -11 20 -21 45 -24
    55 -7 21 -32 23 -40 2z"/>
    </g>
    </svg>';

    $svg_8 = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
     width="1920.000000pt" height="44.000000pt" viewBox="0 0 1920.000000 44.000000"
     preserveAspectRatio="xMidYMid meet">
    <g transform="translate(0.000000,44.000000) scale(0.100000,-0.100000)"
    fill="#000000" stroke="none">
    <path d="M0 316 l0 -123 68 -31 c68 -31 74 -31 195 -18 21 2 41 6 43 9 3 3 26
    -2 52 -9 26 -8 65 -14 87 -13 22 2 50 -3 62 -9 29 -16 43 -15 43 3 0 8 8 15
    17 15 24 0 136 -31 149 -42 7 -5 23 -4 37 1 27 11 120 4 148 -10 19 -10 61 0
    53 12 -9 16 31 10 71 -11 22 -11 45 -20 52 -20 7 0 13 -5 13 -10 0 -7 7 -7 21
    0 15 8 29 9 47 1 15 -6 51 -11 79 -13 42 -1 59 3 84 21 31 23 60 26 139 15 19
    -3 50 -7 68 -9 69 -10 108 -11 136 -3 21 5 34 4 46 -7 10 -9 28 -13 50 -10 19
    3 56 8 83 11 26 3 47 10 47 15 0 9 13 10 115 7 77 -2 95 1 95 18 0 12 6 15 27
    10 15 -4 29 -3 33 4 5 8 23 1 56 -20 27 -17 56 -29 64 -27 14 4 174 -16 230
    -29 56 -12 140 -12 140 0 0 12 18 13 233 15 57 0 77 4 71 12 -5 9 1 10 20 5
    14 -3 26 -2 26 3 0 5 11 11 25 13 14 3 25 2 25 -2 0 -12 80 -11 133 1 28 7 47
    16 47 25 0 8 3 14 8 14 4 1 27 5 52 10 31 6 49 5 59 -3 11 -9 15 -9 18 1 6 15
    49 16 58 2 10 -16 165 -8 174 8 6 10 14 10 36 2 19 -7 31 -8 39 0 5 5 37 10
    69 10 50 0 60 3 64 20 6 21 53 29 53 9 0 -7 12 -9 30 -7 17 3 33 1 36 -4 3 -5
    11 -5 17 0 16 13 97 20 97 9 0 -5 10 -6 23 -3 12 4 27 8 32 9 6 2 16 6 23 11
    7 4 19 2 28 -5 8 -6 17 -9 21 -6 3 3 18 0 34 -9 35 -18 44 -18 44 -1 1 6 7 10
    15 8 8 -2 65 -5 125 -6 61 -1 134 -5 164 -9 45 -6 53 -5 48 8 -8 21 51 25 125
    9 34 -8 92 -10 145 -7 48 2 111 6 138 8 28 1 60 6 71 10 12 4 53 1 90 -5 38
    -6 107 -12 154 -14 47 -1 111 -6 143 -10 42 -6 61 -5 66 4 6 8 26 6 77 -10 56
    -17 74 -19 98 -10 17 6 32 7 35 3 12 -17 40 -20 51 -7 6 8 18 11 25 8 8 -2 38
    0 67 6 36 8 54 9 56 1 5 -15 30 -12 40 6 7 13 15 14 49 5 41 -11 73 -7 73 10
    0 5 16 2 36 -6 49 -20 73 -19 92 5 l17 21 135 -27 c74 -15 159 -37 188 -50 44
    -19 57 -21 85 -12 17 6 36 17 40 25 4 7 25 13 45 13 21 0 42 4 48 9 10 10 150
    -10 197 -28 15 -6 61 -9 102 -7 41 3 77 1 80 -4 9 -15 264 -14 343 1 36 7 73
    7 122 0 76 -12 241 -13 280 -2 14 4 36 4 50 0 75 -21 248 -59 268 -59 13 0 20
    4 17 10 -3 5 -15 10 -26 10 -13 0 -18 4 -13 11 5 8 34 10 95 6 61 -4 89 -2 92
    6 2 7 17 3 40 -12 27 -17 45 -21 67 -16 17 4 36 2 43 -3 18 -15 50 -17 72 -5
    15 8 41 7 107 -8 78 -16 93 -17 134 -4 26 8 50 18 53 24 4 5 22 4 46 -5 41
    -15 145 -16 156 -1 3 4 35 3 70 -2 83 -14 95 -14 111 3 8 7 42 18 77 24 61 11
    65 10 122 -19 53 -26 68 -29 145 -28 66 1 89 -2 103 -15 10 -9 23 -16 29 -16
    7 0 12 -4 12 -9 0 -10 96 -7 122 4 9 4 48 4 85 1 37 -3 97 -7 133 -9 36 -1 71
    -6 77 -10 7 -4 22 -3 33 3 11 6 25 8 31 5 5 -4 20 0 33 8 17 12 33 13 61 7 28
    -6 46 -5 66 6 31 16 67 18 87 5 8 -5 31 -2 55 6 31 11 63 13 127 8 103 -9 269
    -9 277 -1 4 3 34 6 67 6 37 0 70 6 82 14 13 10 25 11 35 5 8 -5 55 -9 106 -9
    50 0 103 -4 116 -9 17 -7 55 -3 123 10 71 15 121 19 176 15 44 -3 80 -1 83 4
    3 5 31 7 64 4 38 -4 76 -1 112 9 30 8 86 21 124 27 39 7 86 19 106 26 25 8 40
    9 47 2 5 -5 41 -16 78 -24 55 -12 74 -12 97 -3 35 15 84 16 272 6 172 -10 193
    -12 225 -25 34 -13 91 -22 181 -27 61 -3 81 0 104 15 21 14 34 16 52 9 33 -12
    36 -12 29 7 -4 11 -1 14 12 10 79 -23 105 -26 136 -17 19 5 37 7 40 4 3 -3 12
    0 21 7 11 9 35 11 85 6 45 -5 70 -4 70 3 0 12 62 -6 135 -39 27 -13 50 -19 52
    -14 2 5 42 8 89 6 85 -3 87 -3 81 18 -4 16 -2 20 8 16 8 -3 15 -1 17 4 5 17
    150 30 258 25 139 -8 158 -8 203 1 22 3 49 2 60 -4 64 -29 83 -33 135 -26 31
    4 74 15 97 25 60 27 107 20 149 -20 43 -42 83 -44 131 -7 40 31 49 33 35 7 -5
    -11 -10 -22 -10 -24 0 -9 150 -18 194 -12 35 6 50 13 59 32 l13 24 13 -27 c7
    -17 15 -24 19 -17 4 6 30 14 57 18 28 4 64 11 80 17 24 8 50 5 126 -16 78 -21
    116 -25 210 -25 63 0 153 -2 201 -6 l88 -6 12 28 c20 45 52 58 61 26 4 -15 5
    -14 6 3 l1 21 81 -24 c90 -25 109 -28 109 -13 0 6 -5 10 -12 10 -6 0 -9 3 -6
    6 3 3 14 1 25 -5 45 -24 99 -38 118 -31 11 5 35 22 53 39 39 37 42 37 42 11 0
    -28 14 -25 28 5 10 23 42 36 42 18 0 -5 15 -9 33 -10 17 -2 37 -10 44 -19 6
    -9 15 -14 20 -11 5 3 38 -1 73 -8 80 -17 140 -16 140 2 0 7 11 13 24 13 14 0
    28 4 31 10 3 5 20 10 36 10 17 0 64 12 105 26 49 17 79 22 87 16 7 -5 19 -10
    27 -11 44 -4 80 -10 99 -16 11 -3 21 -2 21 3 0 5 17 4 38 -4 20 -7 67 -13 103
    -14 47 0 70 -5 79 -15 10 -12 16 -13 27 -4 8 8 10 15 4 18 -6 4 -6 12 -2 20 7
    10 10 8 16 -9 l7 -22 29 28 28 27 45 -17 c24 -9 50 -24 56 -32 8 -9 31 -14 61
    -14 44 0 49 2 49 23 0 15 3 18 8 9 5 -7 16 -10 25 -6 10 3 24 1 32 -6 8 -6 19
    -9 25 -5 5 3 10 1 10 -5 0 -6 6 -10 13 -8 6 1 29 -1 49 -5 41 -9 78 5 78 28 0
    8 6 12 13 10 6 -2 35 -7 62 -10 72 -9 79 -10 92 -18 7 -5 21 -3 31 2 11 6 22
    7 26 4 3 -4 32 -8 64 -9 58 -2 226 -64 282 -104 21 -15 55 -18 233 -22 l207
    -5 0 214 0 213 -9600 0 -9600 0 0 -124z"/>
    </g>
    </svg>';

    $svg = array(
        $svg_1,
        $svg_2,
        $svg_3,
        $svg_4,
        $svg_5,
        $svg_6,
        $svg_7,
        $svg_8
    );

    return apply_filters( 'elegant_blocks_shape_svg', $svg );

}

/*
* Check gutenberg is active or not
*/

function elegant_blocks_is_gutenberg_page() {

    if ( function_exists( 'is_gutenberg_page' ) &&
            is_gutenberg_page()
    ) {
        // The Gutenberg plugin is on.
        return true;
    }
    $current_screen = get_current_screen();
    if ( method_exists( $current_screen, 'is_block_editor' ) &&
            $current_screen->is_block_editor()
    ) {
        // Gutenberg page on 5+.
        return true;
    }
    return false;

}

function elegant_blocks_limit_content_chr( $content, $limit=100 ) {
    return mb_strimwidth( strip_tags($content), 0, $limit, ' [ ... ]' );
}

/**
* Remove intro text of the "One click demo import"
*/ 

add_filter( 'pt-ocdi/plugin_intro_text', 'elegant_blocks_import_intro_text' );
function elegant_blocks_import_intro_text( $default_text ) {
    return false;
}

/**
* Change 'One click demo import' page texts
*/ 

add_filter( 'pt-ocdi/plugin_page_setup', 'elegant_blocks_import_page_setup' , 1 );
function elegant_blocks_import_page_setup( $default_settings ) {

    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Bizberg Demo Import' , 'elegant-blocks' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'elegant-blocks' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'cyclone-one-click-demo-import';
    return $default_settings;

}

/**
* Remove 'One click demo import' branding
*/ 
 
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


add_filter( 'admin_body_class', 'elegant_blocks_admin_body_class' );

/**
 * Adds one or more classes to the body tag in the dashboard.
 *
 * @link https://wordpress.stackexchange.com/a/154951/17187
 * @param  String $classes Current body classes.
 * @return String          Altered body classes.
 */
function elegant_blocks_admin_body_class( $classes ) {

    if( !empty( $_GET['page'] ) && $_GET['page'] == 'elegant-blocks-bizberg-theme-options' ){
        return "$classes elegant_block_theme_option";
    } else {
        return "$classes";
    }
    
}

add_action( 'admin_notices', 'elegant_blocks_notice' );
function elegant_blocks_notice() {

    // Hide bizberg admin message
    if( !empty( $_GET['status'] ) && $_GET['status'] == 'hide_error_message_eb' ){
        update_option( 'hide_error_message_eb', true );
    }

    $status = get_option( 'hide_error_message_eb' );
    if( $status == true ){
        return;
    } ?>

    <div class="notice notice-error">
        <p>Elegant Blocks is a plugin made for <a href="https://cyclonethemes.com/">CycloneTheme's</a> themes. <a href="<?php echo esc_url( admin_url() . '?status=hide_error_message_eb' ); ?>" class="button">Hide this Message</a></p>
        
    </div>
    
    <?php
}

add_action( 'wp_ajax_bizberg_install_required_plugin_for_import_demo_data', 'bizberg_install_required_plugin_for_import_demo_data' );
function bizberg_install_required_plugin_for_import_demo_data(){

    $plugins = !empty( $_POST['plugins'] ) ? json_decode( stripslashes( $_POST['plugins'] ) ) : '';
    $slug = array(
        'ultimate_blocks' => array(
            'slug' => 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php',
            'zip' => 'https://downloads.wordpress.org/plugin/ultimate-addons-for-gutenberg.latest-stable.zip'
        ),
        'ocdi' => array(
            'slug' => 'one-click-demo-import/one-click-demo-import.php',
            'zip' => 'https://downloads.wordpress.org/plugin/one-click-demo-import.latest-stable.zip'
        )
    );

    if( !empty( $plugins ) && is_array( $plugins ) ){

        foreach ( $plugins as $value) {
            
            if( in_array( $value, array( 'ocdi' , 'ultimate_blocks' ) ) ){

                $installed = false;
                if ( !bizberg_is_plugin_installed( $slug[$value]['slug'] ) ) {
                    $installed = bizberg_install_plugin( $slug[$value]['zip'] );
                }

                activate_plugin( $slug[$value]['slug'] );

            }

        }

    }

    echo json_encode( 
        array(
            'status' => 'success'
        ) 
    );

    die;

}

add_action( "wp_ajax_bizberg_check_required_plugin_for_import_demo_data", "bizberg_check_required_plugin_for_import_demo_data" );
function bizberg_check_required_plugin_for_import_demo_data(){

    $recommended_plugins = array(
        'ocdi' => array( 'installed' => false , 'activate' => false ),
        'ultimate_blocks' => array( 'installed' => false , 'activate' => false )
    );

    if( class_exists( 'OCDI_Plugin' ) ){
        $recommended_plugins['ocdi']['installed'] = true;
        $recommended_plugins['ocdi']['activate'] = true;
    } elseif( bizberg_is_plugin_installed( 'one-click-demo-import/one-click-demo-import.php' ) ){
        $recommended_plugins['ocdi']['installed'] = true;
    }

    if( class_exists( 'UAGB_Loader' ) ){
        $recommended_plugins['ultimate_blocks']['installed'] = true;
        $recommended_plugins['ultimate_blocks']['activate'] = true; 
    } elseif( bizberg_is_plugin_installed( 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php' ) ){
        $recommended_plugins['ultimate_blocks']['installed'] = true;
    }

    echo json_encode( 
        array( 
            'status' => $recommended_plugins,
            'message' => bizberg_plugin_check_notice_customizer( $recommended_plugins )
        ) 
    );

    die;

}

function bizberg_plugin_check_notice_customizer( $recommended_plugins ){ 

    if( 
        !( 
            $recommended_plugins['ocdi']['installed'] == false || 
            $recommended_plugins['ocdi']['activate'] == false ||
            $recommended_plugins['ultimate_blocks']['installed'] == false || 
            $recommended_plugins['ultimate_blocks']['activate'] == false 
        )
    ){
        return;
        ob_start(); 
    }

    $to_install_activate = array();;
    ?>

    <div class="notice notice-error is-dismissible">
        <h4>Required Plugins</h4>
        <p>To import demo data, you will need the following plugin(s) first.</p>
        <ul>

            <?php 
            if( $recommended_plugins['ocdi']['installed'] == false || $recommended_plugins['ocdi']['activate'] == false ){ 
                $to_install_activate[] = 'ocdi'; ?>
                <li>
                    <a 
                    href="https://wordpress.org/plugins/one-click-demo-import/" 
                    target="blank">One Click Demo Import</a>
                </li>
                <?php
            } 

            if( $recommended_plugins['ultimate_blocks']['installed'] == false || $recommended_plugins['ultimate_blocks']['activate'] == false ){ 
                $to_install_activate[] = 'ultimate_blocks'; ?>         
                <li>
                    <a 
                    href="https://wordpress.org/plugins/ultimate-addons-for-gutenberg/" 
                    target="blank">Gutenberg Blocks – Ultimate Addons for Gutenberg</a></li>
                <?php 
            } ?>

        </ul>
        <a href="javascript:void(0)" class="button customizer_install_activate_required_plugins" data-install='<?php echo json_encode( $to_install_activate ); ?>'>Install & Activate</a>
    </div>

    <?php

    return ob_get_clean();

}

// Disable Gutenberg Blocks – Ultimate Addons for Gutenberg redirect on activation
add_action( 'init', 'bizberg_disable_uagb',999 );
function bizberg_disable_uagb(){
    update_option( '__uagb_do_redirect', false );
}