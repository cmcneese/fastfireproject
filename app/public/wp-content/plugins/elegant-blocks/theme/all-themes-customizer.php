<?php

function bizberg_predesigned_sites( $data ){

	ob_start(); ?>

	<div class="customizer_documentation_wrapper">

		<div class="bizberg_install_plugin_notice" style="display: none;"></div>

		<div class="sample_homepage_demo_wrapper">
		
			<?php 

			if( !empty( $data ) ){ 

				foreach ( $data as $value ) { ?>

					<div class="sample_homepage_demo">			
						<div class="description">
							<?php echo esc_html( $value['title'] ); ?>
						</div>
						<div class="btn-wrapper">

							<?php 
							if( !empty( $value['pro'] ) ){ ?>
								<a 
								href="<?php echo esc_url( $value['pro'] ); ?>" 
								class="pro_feature_btn"
								target="blank">
									<span class="dashicons dashicons-star-filled"></span> Buy PRO
								</a>
								<?php
							} else { ?>
								<a href="javascript:void(0)" class="import_presets_bizberg">Import Preset</a>
								<?php 
							} ?>

							<a href="<?php echo esc_url( $value['preview_link'] ); ?>" target="blank">Preview</a>
						</div>
						<img src="<?php echo esc_url( $value['image'] ); ?>">
					</div>

					<?php
				}
			}
			?>	

		</div>

	</div>

	<?php
	return ob_get_clean();

}

function bizberg_blog_documentation(){

	ob_start(); ?>

	<div class="customizer_documentation_wrapper">

		<h2>Installation and Updates</h2>

		<h3><a href="javascript:void(0)" class="doc_title">How to Download PRO Themes From cyclonetheme.com</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/NuW999oJoCE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Upload Child Themes on to Your Server And Activate the Child Theme.</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/R8nN8HHRojs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Activate the License for Bizberg Premium Sites ?</a></h3>
		<div class="tb_customizer_container">

			<ol class="content">

			 	<li>The PRO Version allows you to import all premium pages, settings, and blocks. Once you have purchased the <strong>Bizberg PRO</strong> you can find the license key <a href="https://cyclonethemes.com/checkout/purchase-history/" target="_blank" rel="noopener">here</a><a href="https://cyclonethemes.com/wp-content/uploads/2018/06/purchases.jpg" target="_blank" rel="noopener"><img class="wp-image-3907 size-full alignnone" src="https://cyclonethemes.com/wp-content/uploads/2018/06/purchases.jpg" alt="" width="935" height="319"></a></li>

			 	<li>Click on <strong>View Licenses</strong> and click on the <strong>key icon</strong>, you can see the license key there.<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/license-key.jpg" target="_blank" rel="noopener"><img class="wp-image-3916 size-full alignnone" src="https://cyclonethemes.com/wp-content/uploads/2018/06/license-key.jpg" alt="" width="1108" height="149"></a></li>

			 	<li>Go to <strong>Dashboard</strong> &gt; <strong>Appearance</strong> &gt; <strong>Theme license </strong>and paste your license under
				<strong>License Key </strong>and click on <strong>Activate License
				<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/theme-license-page.jpg" target="_blank" rel="noopener"><img class="alignnone wp-image-3919 size-full" src="https://cyclonethemes.com/wp-content/uploads/2018/06/theme-license-page.jpg" alt="" width="627" height="267"></a>
				</strong>
				</li>

			 	<li>Congratulation!!! You have activated the PRO Version.</li>

			</ol>
		</div>

		<h2 class="mt-30">Bizberg Sites</h2>

		<h3><a href="javascript:void(0)" class="doc_title">How to Import FREE Bizberg Starter Sites?</a></h3>
		<div class="tb_customizer_container">
			<div class="content">
				<ul>
				 	<li>Before importing demo site make sure you have activated Bizberg theme and activate all recommended plugins.</li>
				</ul>
				<ol>
				 	<li>From the WordPress dashboard navigate to <strong>Appearance &gt; Import Demo</strong> <strong>Data</strong> and select a website you wish to import.
					<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/import-demo-data.png" target="_blank" rel="noopener"><img class="alignnone wp-image-3939 size-full" src="https://cyclonethemes.com/wp-content/uploads/2018/06/import-demo-data.png" alt="" width="954" height="469"></a></li>
				 	<li>It will open a confirmation message. Click on <strong>Yes, import</strong><strong><strong><strong>
					<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/yes-import.png" target="_blank" rel="noopener"><img class="alignnone wp-image-3942 size-full" src="https://cyclonethemes.com/wp-content/uploads/2018/06/yes-import.png" alt="" width="464" height="492"></a></strong></strong></strong></li>
				 	<li>Wait for sometime, the demo data will take some time to import.
					<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/processing-import.jpg" target="_blank" rel="noopener"><img class="alignnone wp-image-3943 size-full" src="https://cyclonethemes.com/wp-content/uploads/2018/06/processing-import.jpg" alt="" width="443" height="459"></a></li>
				 	<li>On successful import, it will show the success message.
					<a href="https://cyclonethemes.com/wp-content/uploads/2018/06/import-success.jpg" target="_blank" rel="noopener"><img class="alignnone wp-image-3944 size-full" src="https://cyclonethemes.com/wp-content/uploads/2018/06/import-success.jpg" alt="" width="557" height="466"></a></li>
				 	<li>Congratulation!!! You have successfully imported the demo sites.</li>
				</ol>						  
			</div>
		</div>

		<h2 class="mt-30">Free Version Options</h2>

		<h3><a href="javascript:void(0)" class="doc_title">How to Upload Site Logo ?</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/JxrFsFrzTzg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Change Theme Color</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/DnKASXfS6M4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Change Menu Hover Color</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/vQAhqVDAiA8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Enable/ Disable Header Button</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/IrJF7-XAM2s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Show / Hide Search Icon on Header</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/_E_rRJHBsRc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Add Widgets to Sidebar</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/PNh_W0S_RM0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How To Change The Breadcrumb Image</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/dfKiuLf5UTw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Change Breadcrumb Title & Subtitle</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/XgJA4VpllWM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Change Blog Homepage Layout</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/fVL9WLCF7wY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Limit Category Text Length and Read More Text</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/TWfAMr8K38w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Change 404 Image</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/_b-1FLBJVjA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">Add Social Icons in Footer</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/RYRRsubzADU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h2 class="mt-30"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled mr-10"></span>Pro Version Options<span class="ml-10 dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></h2>

		<h3><a href="javascript:void(0)" class="doc_title">How to add Top Header Bar</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/OxXCKXK7KnQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Enable Footer Mega Grid Columns</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/FtO44SmRzqA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Enable Preloader ?</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/0gL6k76tZCA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Change Copyright Text on Footer ?</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/weTER7AAOiQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Change Copyright Layout ?</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/5VdHDfQyqpg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<h3><a href="javascript:void(0)" class="doc_title">How to Change Footer Social Icons ?</a></h3>
		<div class="tb_customizer_container">
			<iframe width="560" height="200" src="https://www.youtube.com/embed/BiBeB6jDd0g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

	</div>

	<?php
	return ob_get_clean();

}

add_action( 'init' , 'bizberg_customizer_extras' );
function bizberg_customizer_extras(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_section( 'documentation', array(
	    'title'          => esc_html__( 'Documentation', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'priority' => 1000
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'documentation-features',
		'section'     => 'documentation',
		'default'     => bizberg_blog_documentation()
	] );

	Kirki::add_section( 'top-bar', array(
	    'title'          => esc_html__( 'Top Bar PRO', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'theme_options',
	    'priority' => 1
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'top-bar-features',
		'section'     => 'top-bar',
		'default'     => '<div class="pro_feature_wrapper"><img src="' . plugin_dir_url( __DIR__ ) . '/src/images/pro-features/top-bar-feature.jpg"></div>'
	] );

	Kirki::add_section( 'footer-mega-grids-columns', array(
	    'title'          => esc_html__( 'Footer Mega Grid Columns PRO', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'theme_options',
	    'priority' => 1
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'footer-mega-grids-columns-features',
		'section'     => 'footer-mega-grids-columns',
		'default'     => '<div class="pro_feature_wrapper"><img src="' . plugin_dir_url( __DIR__ ) . '/src/images/pro-features/footer-grid.jpg"></div>'
	] );

	Kirki::add_section( 'preloader', array(
	    'title'          => esc_html__( 'Preloader PRO', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'theme_options',
	    'priority' => 1
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'preloader-features',
		'section'     => 'preloader',
		'default'     => '<div class="pro_feature_wrapper"><img src="' . plugin_dir_url( __DIR__ ) . '/src/images/pro-features/preloader.jpg"></div>'
	] );

	Kirki::add_section( 'footer1', array(
	    'title'          => esc_html__( 'Footer PRO', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'theme_options',
	    'priority' => 1
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'footer1-features',
		'section'     => 'footer1',
		'default'     => '<div class="pro_feature_wrapper"><img src="' . plugin_dir_url( __DIR__ ) . '/src/images/pro-features/footer-pro.jpg"></div>'
	] );

	Kirki::add_section( 'fonts', array(
	    'title'          => esc_html__( 'Fonts PRO', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'theme_options',
	    'priority' => 1
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'fonts-features',
		'section'     => 'fonts',
		'default'     => '<div class="pro_feature_wrapper"><img src="' . plugin_dir_url( __DIR__ ) . '/src/images/pro-features/fonts.jpg"></div>'
	] );

	$predesigned_sites = apply_filters( 'bizberg_predesigned_sites' , false );

	if( !empty( $predesigned_sites ) ){

		Kirki::add_section( 'pre-designed-sites', array(
		    'title'          => esc_html__( 'Predesigned Sites', 'bizberg' ),
		    'capability'     => 'edit_theme_options',
		    'priority' => 1
		) );

		Kirki::add_field( 'theme_config_id', [
			'type'        => 'custom',
			'settings'    => 'pre-designed-sites',
			'section'     => 'pre-designed-sites',
			'default'     => bizberg_predesigned_sites( $predesigned_sites )
		] );

	}	

}