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
 * Set the default hero image description.
 *
 * @filter primer_default_hero_images
 * @since  1.0.0
 *
 * @param  array $defaults
 *
 * @return array
 */
function lyrical_default_hero_images( $defaults ) {

	$defaults['default']['description'] = esc_html__( 'Surfer on a wave', 'lyrical' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'lyrical_default_hero_images' );

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
		'heading_font' => array(
			'default' => 'Playfair Display',
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

	unset( $colors['menu_background_color'] );

	$overrides = array(
		/**
		 * Text colors
		 */
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
		'dark' => array(
			'colors' => array(
				'hero_background_color' => '#333333',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'lyrical_color_schemes' );
