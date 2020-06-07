<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'general-settings',
	'label'       => esc_html__( 'Theme Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_theme_color', '#2fbeef' ),
	'output'    => array(
		array(
			'element'  => 'a:focus',
			'property'      => 'outline',
			'value_pattern' => '1px dashed $'
		),
		array(
			'element'  => 'a,.breadcrumb-wrapper .breadcrumb .active,#sidebar a,a:hover, a:focus,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, #blog .blog-post.blog-large .entry-date a,#blog .blog-post.blog-large .entry-title a:hover,#blog .blog-post .entry-meta > span > a:hover, nav.comment-navigation a:hover,.bizberg_post_date a,.bizberg_detail_user_wrapper a:hover,div#respond h3#reply-title small a, .sidebar-wrapper .section-title h3, #sidebar .widget h2.widget-title',
			'property' => 'color'
		),
		array(
			'element'  => '.search-form input#searchsubmit,#back-to-top a,.btn-primary, a.btn-primary, p.form-submit .submit, .reply a, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"],.result-paging-wrapper ul.paging li.active a, .result-paging-wrapper ul.paging li a:hover, .navigation.pagination a:hover, .navigation.pagination span:hover, .navigation.pagination span.current,#sidebar .widget h2.widget-title:before, .widget.widget_tag_cloud a:hover, .tagcloud.tags a:hover,.bizberg_detail_cat:after,.bizberg_post_date a:after,div#respond h3#reply-title:after',
			'property' => 'background'
		),
		array(
			'element'  => 'ul.sidebar-cat li a:hover, ul.archive li a:hover, .widget.widget_categories li a:hover, .widget.widget_archive li a:hover, .widget.widget_pages li a:hover, .widget.widget_meta li a:hover, .widget.widget_nav_menu li a:hover, .widget.widget_recent_entries li a:hover, .widget.widget_recent_comments li a:hover, .widget.widget_archive li:hover, .widget.widget_categories li:hover',
			'property' => 'color',
			'suffix' => ' !important'
		),
		array(
			'element'  => '.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, nav.comment-navigation a:hover,#blog .blog-post.blog-large .entry-date a:after,div#respond h3#reply-title small a, .bizberg_default_page .single_page h3:after',
			'property' => 'border-color'
		),
		array(
			'element'  => '.btn-primary, a.btn-primary, p.form-submit .submit, .reply a, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"]',
			'property' => 'border-color',
			'sanitize_callback' => 'bizberg_adjustBrightness',
			// 'suffix'   => ' !important'
		),
		array(
			'element'  => '.btn-primary:hover, a.btn-primary:hover, p.form-submit .submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover',
			'property' => 'background',
			'sanitize_callback' => 'bizberg_adjustBrightness',
		),
		array(
			'element'  => '.btn-primary:hover, a.btn-primary:hover, p.form-submit .submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover',
			'property' => 'border-color',
		)
	)
) );