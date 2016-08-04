<?php


/**
 * Move titles above menu templates.
 *
 * @since 1.0.0
 */
function lyrical_remove_titles(){

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

	if( ! is_front_page() ):
		add_action( 'primer_header', 'primer_add_page_builder_template_title' );
		add_action( 'primer_header', 'primer_add_blog_title' );
		add_action( 'primer_header', 'primer_add_archive_title' );
	endif;

}
add_action( 'init', 'lyrical_remove_titles' );

/**
 * Add a footer menu.
 *
 * @action primer_nav_menus
 * @since 1.0.0
 * @param $nav_menus
 * @return array
 */
function lyrical_update_nav_menus( $nav_menus ) {

	$new_nav_menus = array(
		'footer' => esc_html__( 'Footer Menu', 'scribbles' ),
	);

	return array_merge( $nav_menus, $new_nav_menus );

}
add_filter( 'primer_nav_menus', 'lyrical_update_nav_menus' );

/**
 * Add image size for hero image
 *
 * @link https://codex.wordpress.org/Function_Reference/add_image_size
 */
function lyrical_add_image_size() {

	add_image_size( 'hero', 2400, 1320, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'lyrical_add_image_size' );

/**
 * Move navigation from after_header to header
 *
 * @link https://codex.wordpress.org/Function_Reference/remove_action
 * @link https://codex.wordpress.org/Function_Reference/add_action
 */
function lyrical_move_navigation() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );
	add_action( 'primer_header', 'primer_add_primary_navigation', 9 );

}
add_action( 'after_setup_theme', 'lyrical_move_navigation', 10 );

/**
 * Update custom header arguments
 *
 * @param $args
 * @return mixed
 */
function lyrical_update_custom_header_args( $args ) {

	$args['width'] = 2400;
	$args['height'] = 1320;

	return $args;
}
add_filter( 'primer_custom_header_args', 'lyrical_update_custom_header_args' );

/**
 * Add additional sidebars
 *
 * @action primer_register_sidebars
 * @since 1.0.0
 * @param $sidebars
 * @return array
 */
function lyrical_add_sidebars( $sidebars ) {

	$new_sidebars = array(
		array(
			'name'          => __( 'Hero', 'ascension' ),
			'id'            => 'hero',
			'description'   => __( 'The hero appears in the hero widget area on the front page', 'lyrical' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);

	return array_merge( $sidebars, $new_sidebars );

}
add_filter( 'primer_register_sidebars', 'lyrical_add_sidebars' );

function remove_hero_if_not_home() {

	if ( ! is_front_page() ) {

		remove_action( 'primer_header', 'primer_add_hero', 10 );

	}

}
add_action( 'primer_before_header', 'remove_hero_if_not_home' );

/**
 * Get header image with image size
 *
 * @since 1.0.0
 * @return false|string
 */
function lyrical_get_header_image() {

	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	$custom_header = get_custom_header();

	if ( ! empty( $custom_header->attachment_id ) ) {

		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );

		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
	return get_header_image();
}

/**
 * Change font types.
 *
 * @action primer_font_types
 * @since 1.0.0
 * @return array
 */
function lyrical_font_types() {

	return array(
		array(
			'name'    => 'primary_font',
			'label'   => __( 'Primary Font', 'primer' ),
			'default' => 'Open Sans',
			'css'     => array(
				'body,
				h2, h3, h4, h5, h6,
				blockquote,
				button, a.button, input, select, textarea,
				label,
				legend,
				.main-navigation,
				.widget, .widget p, .widget ul, .widget ol,
				.widget-title,
				.entry-footer,
				.entry-meta,
				.event-meta, .sermon-meta, .location-meta, .person-meta,
				.post-format,
				.more-link,
				.comment-list li .comment-author, .comment-list li .comment-metadata,
				#respond,
				.site-description,
				.featured-content .entry-header .entry-title,
				.featured-content .entry-header .read-more,
				.hero blockquote.large cite,
				.featured-content .entry-title,
				.featured-content .read-more' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'secondary_font',
			'label'   => __( 'Secondary Font', 'primer' ),
			'default' => 'Playfair Display',
			'css'     => array(
				'h1,
				.site-title,
				.hero blockquote.large p
				' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

}
add_action( 'primer_font_types', 'lyrical_font_types' );

/**
 * Change colors
 *
 * @action primer_colors
 * @since 1.0.0
 * @return array
 */
function lyrical_colors() {

	return array(
		array(
			'name'    => 'header_textcolor',
			'default' => '#ffffff',
			'css'     => array(
				'.site-title a, .site-title a:visited,
				.menu-toggle div,
				.main-navigation li a, .main-navigation li a:hover, .main-navigation .sub-menu a, .main-navigation .sub-menu .sub-menu a' => array(
					'color' => '%1$s',
				),
				'.main-navigation li.current-menu-item a, .main-navigation li a:hover' => array(
					'border-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#eaeaea',
		),
		array(
			'name'    => 'content_background_color',
			'label'   => esc_html__( 'Content Background Color', 'primer' ),
			'default' => '#ffffff',
			'css'     => array(
				'.hentry,
				.widget,
				.comments-area,
				body.search-results .page-header, body.archive .archive-header,
				.no-results, .not-found,
				article.format-link,
				.widget_search .search-field,
				.widget_search .search-field:focus' => array(
					'background-color' => '%1$s',
				),
				'.social-media a,
				.featured-content .read-more,
				.featured-content article,
				.featured-content, .featured-content .entry-title a,
				.site-info-wrapper .site-info .social-menu a,
				.site-info-wrapper a,
				.site-info-wrapper,
				button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"],
				button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,
				.footer-widget-area .footer-widget .widget,
				.footer-widget-area .footer-widget .widget-title,
				.site-footer a:hover,
				.site-footer,
				.hero h1, .hero h2, .hero h3, .hero h4, .hero h5, .hero h6, .hero p, .hero cite, .hero table, .hero ul, .hero li, .hero dd, .hero dt, .hero address, .hero code, .hero pre
				.featured-content .entry-header .read-more,
				.featured-content .entry-header .entry-meta,
				.featured-content .entry-header .entry-header-column,
				.featured-content .entry-header, .featured-content .entry-header .entry-title, .featured-content .entry-header .entry-title a,
				.gallery-caption,				' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-info-wrapper .site-info .social-menu a:hover,
				.site-info-wrapper a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#eaeaea',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-description' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_background_color',
			'label'   => esc_html__( 'Footer Background Color', 'primer' ),
			'default' => '#141414',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'site_info_background_color',
			'label'   => esc_html__( 'Site Info Background Color', 'primer' ),
			'default' => '#2d2d2d',
			'css'     => array(
				'.site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#4c99ba',
			'css'     => array(
				'a, a:visited,
				.social-menu a,
				.post-format,
				.more-link,
				.entry-footer a,
				.widget_calendar #calendar_wrap #wp-calendar tfoot td a:hover,
				.site-footer a,
				.featured-content .entry-header .post-format,
				abbr,
				.site-info-menu ul li a' => array(
					'color' => '%1$s',
				),
				'.featured-content .read-more,
				button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"],
				.featured-content .entry-header .read-more' => array(
					'background-color' => '%1$s',
				),
				'.site-info-menu ul li a' => array(
					'border-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover, a:visited:hover, a:focus, a:visited:focus, a:active, a:visited:active,
				.social-menu a:hover,
				.featured-content .read-more:hover,
				.site-footer a:hover,
				.site-info-menu ul li a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,
				.featured-content .entry-header .read-more:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
				'.site-info-menu ul li a:hover' => array(
					'border-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#111111',
			'css'     => array(
				'body,
				h1, h2, h3, h4, h5, h6,
				legend,.entry-title a
				  .hentry .entry-header' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => esc_html__( 'Secondary Text Color', 'primer' ),
			'default' => '#111111',
			'css'     => array(
				'h1 small, h2 small, h3 small, h4 small, h5 small, h6 small,
				h2, h4,
				.suheader,
				hr,
				pre,
				code,
				table th, table td,
				acronym,
				blockquote cite,
				blockquote cite a, blockquote cite a:visited,
				blockquote, blockquote p,
				.footer-widget-area .footer-widget .widget_recent_entries .post-date,
				#respond .form-allowed-tags,
				#respond .comment-notes,
				#respond .logged-in-as,
				.comment-list .comment-awaiting-moderation,
				 .comment-list li.pingback, .comment-list li.trackback,
				 .entry-footer' => array(
					'color' => '%1$s',
				),
				'button:disabled, a.button:disabled, a.button:visited:disabled, input[type="button"]:disabled, input[type="reset"]:disabled, input[type="submit"]:disabled' => array(
					'background-color' => '%1$s',
				),
			),
		),

	);
}
add_action( 'primer_colors', 'lyrical_colors' );

/**
 * Change color schemes
 *
 * @action primer_color_schemes
 * @since 1.0.0
 * @return array
 */
function lyrical_color_schemes() {

	return array(
		'lyrical-2' => array(
			'label'  => esc_html__( 'Lyrical 2', 'ascension' ),
			'colors' => array(
				'header_textcolor'              => '#efece4',
				'background_color'              => '#efece4',
				'content_background_color'      => '#FFFFFF',
				'header_background_color'       => '#eaeaea',
				'tagline_text_color'            => '#ffffff',
				'footer_background_color'       => '#141414',
				'site_info_background_color'    => '#2d2d2d',
				'link_color'                    => '#62d7db',
				'main_text_color'               => '#111111',
				'secondary_text_color'          => '#111111',
			),
		),
		'lyrical-3' => array(
			'label'  => esc_html__( 'Lyrical 3', 'ascension' ),
			'colors' => array(
				'header_textcolor'              => '#ffffff',
				'background_color'              => '#333333',
				'content_background_color'      => '#333333',
				'header_background_color'       => '#ffffff',
				'tagline_text_color'            => '#ffffff',
				'footer_background_color'       => '#333333',
				'site_info_background_color'    => '#333333',
				'link_color'                    => '#18a370',
				'main_text_color'               => '#a0a0a0',
				'secondary_text_color'          => '#a0a0a0',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'lyrical_color_schemes' );
