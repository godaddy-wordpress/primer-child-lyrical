<?php
/**
 * Displays the site header.
 *
 * @package Lyrical
 */
?>

<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

	<div class="hero">

		<?php
		/**
		 * Fires inside the `.hero` element.
		 *
		 * @since 1.0.0
		 */
		do_action( 'primer_hero' );
		?>

	</div>

<?php endif; ?>
