<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
$body_class = ''; 
if( function_exists( 'bizberg_get_homepage_style_class' ) ){
	$body_class = bizberg_get_homepage_style_class();
}
?>

<body <?php body_class( 'sidebar ' . $body_class ); ?>>

<?php 

/**
* https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook/
*/

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else { 
	do_action( 'wp_body_open' ); 
}

do_action( 'bizberg_after_body' ); ?>

<header id="masthead">

	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'bizberg' ); ?>		
	</a>

	<?php 
	do_action( 'bizberg_top_header' );
	?>

    <nav class="navbar navbar-default with-slicknav">
        <div id="navbar" class="collapse navbar-collapse navbar-arrow">
            <div class="container">

            	<div class="bizberg_header_wrapper">

	                <a 
	                class="logo pull-left <?php echo ( has_custom_logo() || !empty( get_bloginfo( 'description' ) ) ? '' : 'bizberg_no_tagline' ); ?>" 
	                href="<?php echo esc_url( home_url('/') ); ?>">

	                	<?php 
	                	if ( has_custom_logo() ) { ?>
	                    	<img 
	                    	src="<?php echo esc_url( bizberg_get_custom_logo_link() ); ?>" 
	                    	alt="<?php esc_attr_e( 'Logo', 'bizberg' ) ?>" 
	                    	class="site_logo">
	                    	<?php 
	                    	do_action( 'bizberg_top_logo' );
	                    } else {
	                    	echo '<h3>' . esc_html( get_bloginfo( 'name' ) ) . '</h3>';

	                    	if( !empty( get_bloginfo( 'description' ) ) ){
	                    		echo '<p>' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
	                    	}

	                    } ?>

	                </a>

	                <?php 
	                
	                if( has_nav_menu( 'menu-1' ) ){

	                	$walker = new Bizberg_Menu_With_Description;
	                	wp_nav_menu( array(
						    'theme_location' => 'menu-1',
						    'menu_class'=>'nav navbar-nav pull-right',
						    'container' => 'ul',
						    'menu_id' => 'responsive-menu',
						    'walker' => $walker,
						    'link_before' => '<span class="eb_menu_title">',
						    'link_after' => '</span>'
						) );

	                } else {

	                	wp_nav_menu( array(
						    'theme_location' => 'menu-1',
						    'menu_class'=>'nav navbar-nav pull-right',
						    'container' => 'ul',
						    'menu_id' => 'responsive-menu',
						    'link_before' => '<span class="eb_menu_title">',
						    'link_after' => '</span>'
						) );
						
	                }
	                
	                ?>

	            </div>

            </div>

        </div><!--/.nav-collapse -->

        <div id="slicknav-mobile" class="<?php echo ( !has_custom_logo() ? 'text-logo' : '' ); ?>"></div>

    </nav> 
</header><!-- header section end -->

<?php 
if( is_page_template( 'page-templates/full-width.php' ) 
	|| is_404() 
	|| is_page_template( 'contact-us.php' )
	|| is_page_template( 'page-templates/page-fullwidth-transparent-header.php' ) ){
	// no breadcrum
	echo '';
} elseif( !is_front_page() ){
	bizberg_get_breadcrums();
} else { 
	// Slider or Banner
	if( get_theme_mod( 'slider_banner' , 'banner' ) == 'slider' ){
		bizberg_get_slider_1();
	} else {
		bizberg_get_banner();
	}
} 