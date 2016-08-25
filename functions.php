<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function lyrical_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_header', 'primer_add_primary_navigation', 5 );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

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
		'footer_widget_heading_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_widget_text_color' => array(
			'default' => '#ffffff',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#4c99ba',
		),
		'button_color' => array(
			'default'  => '#4c99ba',
		),
		/**
		 * Background colors
		 */
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
				'footer_widget_background_color' => '#141414',
			),
		),
		'bronze' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'canary' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'cool' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'dark' => array(
			'colors' => array(
				'link_color'                     => '#4c99ba',
				'button_color'                   => '#4c99ba',
				'content_background_color'       => '#2d2d2d',
				'hero_background_color'          => '#141414',
				'footer_widget_background_color' => '#141414',
				'footer_background_color'        => '#2d2d2d',
			),
		),
		'iguana' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'muted' => array(
			'colors' => array(
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				'footer_widget_background_color'   => '#767f99',
			),
		),
		'plum' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'rose' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'footer_widget_background_color' => '#141414',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'lyrical_color_schemes' );
