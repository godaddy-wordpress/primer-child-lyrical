<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function lyrical_move_elements() {

	// Primary navigation
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	add_action( 'primer_header', 'primer_add_primary_navigation', 5 );

	// Page titles
	remove_action( 'primer_after_header', 'primer_add_page_title' );

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

	$defaults['default']['description'] = esc_html__( 'Surfing', 'lyrical' );

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
 * @since 1.0.0
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
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param array $font_types
 *
 * @return array
 */
function lyrical_font_types( $font_types ) {

	unset( $font_types['header_font'] );

	$overrides = array(

		'primary_font' => array(
			'default' => 'Raleway',
			'css'     => array(
				'body,
				p,
				ol li,
				ul li,
				dl dd,
				.button' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'secondary_font' => array(
			'default' => 'Playfair Display',
			'css'     => array(
				'h1,
		.site-title,
		.hero blockquote p' => array(
					'font-family' => '"%1$s", serif',
				),
			),
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

	return array();

}
add_filter( 'primer_colors', 'lyrical_colors' );
