<?php
/**
 * The template part for displaying general content.
 *
 * @package Lyrical
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'templates/parts/loop/post', 'title' ); ?>

	<?php get_template_part( 'templates/parts/loop/post', 'meta' ); ?>

	<?php if ( ! is_single() || ! primer_use_featured_hero_image() ) : ?>

		<?php get_template_part( 'templates/parts/loop/post', 'thumbnail' ); ?>

	<?php endif; ?>

	<?php if ( is_single() ) : ?>

		<?php get_template_part( 'templates/parts/loop/post', 'content' ); ?>

	<?php else : ?>

		<?php get_template_part( 'templates/parts/loop/post', 'excerpt' ); ?>

	<?php endif; ?>

	<?php get_template_part( 'templates/parts/loop/post', 'footer' ); ?>

</article><!-- #post-## -->
