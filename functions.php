<?php

/**
 * Register custom Custom Navigation Menus.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 */
function lyrical_register_site_info_menu() {

	register_nav_menus(
		array(
			'site-info' => esc_html__( 'Site Info', 'lyrical' ),
		)
	);

}
add_action( 'after_setup_theme', 'lyrical_register_site_info_menu' );

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

function remove_site_header_if_not_home() {

	if ( ! is_front_page() ) {

		remove_action( 'primer_header', 'primer_add_site_header', 10 );

	}

}
add_action( 'primer_before_header', 'remove_site_header_if_not_home' );

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
			'default' => 'Raleway',
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
			'default' => '#202223',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#f7f7f7',
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#202223',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'menu_background_color',
			'label'   => esc_html__( 'Menu Background Color', 'primer' ),
			'default' => 'red',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#62d7db',
			'css'     => array(
				'a, a:visited, a:focus' => array(
					'color' => '%1$s',
				),
				'' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
				'' => array(
					'background-color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#202223',
			'css'     => array(
				'body' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => esc_html__( 'Secondary Text Color', 'primer' ),
			'default' => '#202223',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'other_accent_color',
			'label'   => esc_html__( 'Other Accent Color', 'lyrical' ),
			'default' => '#db4353',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
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
		'dark' => array(
			'label'  => esc_html__( 'Schrapel', 'ascension' ),
			'colors' => array(
				'header_textcolor'        => '#ffffff',
				'background_color'        => '#333333',
				'header_background_color' => '#333333',
				'tagline_text_color'      => '#999999',
				'menu_background_color'   => '#444444',
				'link_color'              => '#589ef2',
				'main_text_color'         => '#e5e5e5',
				'secondary_text_color'    => '#c1c1c1',
			),
		),
		'muted' => array(
			'label'  => esc_html__( 'Wallace', 'ascension' ),
			'colors' => array(
				'header_textcolor'        => '#5a6175',
				'background_color'        => '#d5d6e0',
				'header_background_color' => '#d5d6e0',
				'tagline_text_color'      => '#888c99',
				'menu_background_color'   => '#5a6175',
				'link_color'              => '#3e4c75',
				'main_text_color'         => '#4f5875',
				'secondary_text_color'    => '#888c99',
			),
		),
		'red' => array(
			'label'  => esc_html__( 'Marley', 'ascension' ),
			'colors' => array(
				'header_textcolor'        => '#402b30',
				'background_color'        => '#f9f9f9',
				'header_background_color' => '#f9f9f9',
				'tagline_text_color'      => '#999999',
				'menu_background_color'   => '#640c1f',
				'link_color'              => '#640c1f',
				'main_text_color'         => '#402b30',
				'secondary_text_color'    => '#222222',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'lyrical_color_schemes' );
