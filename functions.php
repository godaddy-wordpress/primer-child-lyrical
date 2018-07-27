<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.3' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function lyrical_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 11 );
	remove_action( 'primer_after_header', 'primer_add_page_title',         12 );
	remove_action( 'primer_header', 'primer_add_site_title',               5 );

	add_action( 'primer_header', 'primer_add_site_title',         5 );
	add_action( 'primer_header', 'primer_add_primary_navigation', 5 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

	}

}
add_action( 'template_redirect', 'lyrical_move_elements' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function lyrical_custom_logo_args( $args ) {

	$args['width']  = 325;
	$args['height'] = 100;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'lyrical_custom_logo_args' );

/**
 * Display author avatar over the post thumbnail.
 *
 * @action primer_after_post_thumbnail
 * @since  1.0.0
 */
function lyrical_add_author_avatar() {

	?>
	<div class="avatar-container">

		<?php echo get_avatar( get_the_author_meta( 'user_email' ), '128' ); ?>

	</div>
	<?php

}
add_action( 'primer_after_post_thumbnail', 'lyrical_add_author_avatar' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function lyrical_fonts( $fonts ) {

	$fonts[] = 'Playfair Display';
	$fonts[] = 'Raleway';

	return $fonts;

}
add_filter( 'primer_fonts', 'lyrical_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function lyrical_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Playfair Display',
		),
		'navigation_font' => array(
			'default' => 'Raleway',
		),
		'heading_font' => array(
			'default' => 'Raleway',
		),
		'primary_font' => array(
			'default' => 'Raleway',
		),
		'secondary_font' => array(
			'default' => 'Raleway',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'lyrical_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function lyrical_colors( $colors ) {

	unset(
		$colors['menu_background_color'],
		$colors['footer_widget_content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default' => '#ffffff',
		),
		'tagline_text_color' => array(
			'default' => '#ffffff',
		),
		'hero_text_color' => array(
			'default' => '#ffffff',
		),
		'menu_text_color' => array(
			'default' => '#ffffff',
		),
		'menu_dropdown_background_color' => array(
			'label'   => esc_html__( 'Dropdown Background', 'primer' ),
			'default' => '#1985a1',
			'section' => 'colors-menu',
			'css'     => array(
				'.main-navigation li li a,
				.menu-toggle:not( [style*="display: none"] ) + .main-navigation,
				.menu-toggle:not( [style*="display: none"] ) + .main-navigation .expand' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation li li a:hover,
				.main-navigation li li a:visited:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'heading_text_color' => array(
			'default' => '#353535',
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_widget_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_menu_text_color' => array(
			'default' => '#686868',
		),
		'footer_text_color' => array(
			'default' => '#686868',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#4c99ba',
		),
		'button_color' => array(
			'default'  => '#4c99ba',
			'css'     => array(
				'.woocommerce-cart-menu-item .woocommerce.widget_shopping_cart p.buttons a' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'button_text_color' => array(
			'default'  => '#ffffff',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#f5f5f5',
		),
		'content_background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#141414',
		),
		'footer_widget_background_color' => array(
			'default' => '#141414',
		),
		'footer_background_color' => array(
			'default' => '#2d2d2d',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'lyrical_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function lyrical_color_schemes( $color_schemes ) {

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['blush']['base'],
				'button_color'                   => $color_schemes['blush']['base'],
				'menu_dropdown_background_color' => $color_schemes['blush']['base'],
			),
		),
		'bronze' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['bronze']['base'],
				'button_color'                   => $color_schemes['bronze']['base'],
				'menu_dropdown_background_color' => $color_schemes['bronze']['base'],
			),
		),
		'canary' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['canary']['base'],
				'button_color'                   => $color_schemes['canary']['base'],
				'menu_dropdown_background_color' => $color_schemes['canary']['base'],
			),
		),
		'cool' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['cool']['base'],
				'button_color'                   => $color_schemes['cool']['base'],
				'menu_dropdown_background_color' => $color_schemes['cool']['base'],
			),
		),
		'dark' => array(
			'colors' => array(
				// Text
				'tagline_text_color'               => '#999999',
				'heading_text_color'               => '#ffffff',
				'primary_text_color'               => '#e5e5e5',
				'secondary_text_color'             => '#c1c1c1',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				// Backgrounds
				'background_color'               => '#222222',
				'content_background_color'       => '#2d2d2d',
				'hero_background_color'          => '#141414',
				'footer_widget_background_color' => '#141414',
				'footer_background_color'        => '#2d2d2d',
				'menu_dropdown_background_color' => $color_schemes['dark']['base'],
			),
		),
		'iguana' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['iguana']['base'],
				'button_color'                   => $color_schemes['iguana']['base'],
				'menu_dropdown_background_color' => $color_schemes['iguana']['base'],
			),
		),
		'muted' => array(
			'colors' => array(
				// Text
				'heading_text_color'     => '#4f5875',
				'primary_text_color'     => '#4f5875',
				'secondary_text_color'   => '#888c99',
				'footer_menu_text_color' => $color_schemes['muted']['base'],
				'footer_text_color'      => '#4f5875',
				// Links & Buttons
				'link_color'   => $color_schemes['muted']['base'],
				'button_color' => $color_schemes['muted']['base'],
				// Backgrounds
				'background_color'               => '#d5d6e0',
				'hero_background_color'          => '#5a6175',
				'menu_background_color'          => '#5a6175',
				'menu_dropdown_background_color' => $color_schemes['muted']['base'],
				'footer_widget_background_color' => '#b6b9c5',
				'footer_background_color'        => '#d5d6e0',

			),
		),
		'plum' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['plum']['base'],
				'button_color'                   => $color_schemes['plum']['base'],
				'menu_dropdown_background_color' => $color_schemes['plum']['base'],
			),
		),
		'rose' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['rose']['base'],
				'button_color'                   => $color_schemes['rose']['base'],
				'menu_dropdown_background_color' => $color_schemes['rose']['base'],
			),
		),
		'tangerine' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['tangerine']['base'],
				'button_color'                   => $color_schemes['tangerine']['base'],
				'menu_dropdown_background_color' => $color_schemes['tangerine']['base'],
			),
		),
		'turquoise' => array(
			'colors' => array(
				'link_color'                     => $color_schemes['turquoise']['base'],
				'button_color'                   => $color_schemes['turquoise']['base'],
				'menu_dropdown_background_color' => $color_schemes['turquoise']['base'],
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'lyrical_color_schemes' );
