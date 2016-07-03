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
 * Remove primer navigation and add lyrical navigation
 */
function lyrical_navigation() {
	wp_dequeue_script( 'primer-navigation' );
	wp_enqueue_script( 'lyrical-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120206', true );
}
add_action( 'wp_print_scripts', 'lyrical_navigation', 100 );

/**
 * Add mobile menu to header
 *
 * @link https://codex.wordpress.org/Function_Reference/get_template_part
 */
function lyrical_add_mobile_menu() {
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'primer_header', 'lyrical_add_mobile_menu', 0 );

/**
 * Move navigation from after_header to header
 *
 * @link https://codex.wordpress.org/Function_Reference/remove_action
 * @link https://codex.wordpress.org/Function_Reference/add_action
 */
function lyrical_move_navigation() {
	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );
	get_template_part( 'templates/parts/primary-navigation' );
}
add_action( 'primer_header', 'lyrical_move_navigation', 19 );

/**
 * Add Playfair Display font as a secondary font
 *
 * @param $args
 *
 * @return mixed
 */
function lyrical_update_google_font_query_args( $args ) {
	$args['family'] .= '|Playfair+Display:900';
	return $args;
}
add_filter( 'google_font_query_args', 'lyrical_update_google_font_query_args' );

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
 * Display hero in the header
 *
 * @action primer_header
 */
function lyrical_add_hero(){
	if ( is_front_page() && is_active_sidebar( 'hero' ) ) {
		get_template_part( 'templates/parts/hero' );
	}
}
add_action( 'primer_header', 'lyrical_add_hero', 25 );

/**
 * Register hero sidebar
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lyrical_register_hero_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Hero', 'ascension' ),
		'id'            => 'hero',
		'description'   => __( 'The hero appears in the hero widget area on the front page', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lyrical_register_hero_sidebar' );

/**
 * Get header image with image size
 *
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
	$header_image = get_header_image();
	return $header_image;
}
