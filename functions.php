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

	return array(
		'header_textcolor' => array(
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
		'background_color' => array(
			'default' => '#eaeaea',
		),
		'content_background_color' => array(
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
				.gallery-caption' => array(
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
		'header_background_color' => array(
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#eaeaea',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'tagline_text_color' => array(
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-description' => array(
					'color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => esc_html__( 'Footer Background Color', 'primer' ),
			'default' => '#141414',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'site_info_background_color' => array(
			'label'   => esc_html__( 'Site Info Background Color', 'primer' ),
			'default' => '#2d2d2d',
			'css'     => array(
				'.site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#4c99ba',
			'css'     => array(
				'#content a:not(.button), #content a:not(.button):visited,
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
				'#content a:not(.button):hover, #content a:not(.button):visited:hover, #content a:not(.button):focus, #content a:not(.button):visited:focus, #content a:not(.button):active, #content a:not(.button):visited:active,
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
		'main_text_color' => array(
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
		'secondary_text_color' => array(
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

	return array(
		'wallace' => array(
			'label'  => esc_html__( 'Wallace', 'lyrical' ),
			'colors' => array(
				'header_textcolor'           => '#efece4',
				'background_color'           => '#efece4',
				'content_background_color'   => '#ffffff',
				'header_background_color'    => '#eaeaea',
				'tagline_text_color'         => '#ffffff',
				'footer_background_color'    => '#141414',
				'site_info_background_color' => '#2d2d2d',
				'link_color'                 => '#00d3db',
				'main_text_color'            => '#111111',
				'secondary_text_color'       => '#111111',
			),
		),
		'miller' => array(
			'label'  => esc_html__( 'Miller', 'lyrical' ),
			'colors' => array(
				'header_textcolor'           => '#ffffff',
				'background_color'           => '#333333',
				'content_background_color'   => '#333333',
				'header_background_color'    => '#ffffff',
				'tagline_text_color'         => '#ffffff',
				'footer_background_color'    => '#333333',
				'site_info_background_color' => '#333333',
				'link_color'                 => '#18a370',
				'main_text_color'            => '#a0a0a0',
				'secondary_text_color'       => '#a0a0a0',
			),
		),
		'garand' => array(
			'label'  => esc_html__( 'Garand', 'lyrical' ),
			'colors' => array(
				'header_textcolor'           => '#ffffff',
				'background_color'           => '#c9e8d1',
				'content_background_color'   => '#ffffff',
				'header_background_color'    => '#344939',
				'tagline_text_color'         => '#d4f4dc',
				'footer_background_color'    => '#344939',
				'site_info_background_color' => '#446053',
				'link_color'                 => '#18a370',
				'main_text_color'            => '#243a2a',
				'secondary_text_color'       => '#243a2a',
			),
		),
	);

}
add_filter( 'primer_color_schemes', 'lyrical_color_schemes' );
