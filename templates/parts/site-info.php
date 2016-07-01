<?php
/**
 * Displays the footer site info.
 *
 * @package Primer
 */
?>

<div class="site-info-wrapper">

	<div class="site-info">

		<div class="site-info-inner">

			<div class="site-info-text">

				<?php get_template_part( 'templates/parts/site-title' ); ?>

			</div><!-- .site-info-text -->

			<?php if ( has_nav_menu( 'social' ) ) : ?>

				<div class="social-menu">

					<?php

					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);

					?>

				</div><!-- .social-menu -->

			<?php endif; ?>

			<?php if ( has_nav_menu( 'site-info' ) ) :  ?>

				<div class="site-info-menu-container">

					<nav class="site-info-menu" role="navigation">

						<?php

						wp_nav_menu(
							array(
								'theme_location' => 'site-info',
							)
						);

						?>

					</nav><!-- #site-navigation -->

				</div>

			<?php endif; ?>

		</div><!-- .site-info-inner -->

	</div><!-- .site-info -->

</div><!-- .site-info-wrapper -->
