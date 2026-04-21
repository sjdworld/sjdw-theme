<?php
/**
 * The template for displaying the footer.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
	</div>
	<!-- end wrapper -->

	<!-- start footer -->
	<footer id="footer">
		<div class="container">

			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<!-- start footer widgets -->
				<div id="footer-top">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
				<!-- end footer widgets -->
			<?php endif; ?>

			<div id="copyright">
				<span>
					<?php
					echo wp_sprintf(
						/* translators: 1: Current year, 2: Blog title. */
						esc_html__( 'Copyright &copy; %1$s %2$s', 'sjdw-theme' ),
						esc_html( date_i18n( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
					?>
				</span>
				<?php
				if ( has_nav_menu( 'policy' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'policy',
							'container'      => '',
							'items_wrap'     => '<ul id="policy-menu" class="menu">%3$s</ul>',
						)
					);
				}
				?>
			</div>

		</div>
	</footer>
	<!-- end footer -->

	<?php wp_footer(); ?>

</body>
</html>
