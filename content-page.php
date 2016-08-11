<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Lyrical
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! primer_has_hero_image() && ! has_action( 'primer_after_header', 'primer_add_page_title' ) ) : ?>

		<?php get_template_part( 'templates/parts/page-title' ); ?>

	<?php endif; ?>

	<?php if ( ! primer_use_featured_hero_image() ) : ?>

		<?php get_template_part( 'templates/parts/loop/post', 'thumbnail' ); ?>

	<?php endif; ?>

	<?php get_template_part( 'templates/parts/loop/page', 'content' ); ?>

	<?php get_template_part( 'templates/parts/loop/page', 'footer' ); ?>

</article><!-- #post-## -->
