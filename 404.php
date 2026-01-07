<?php
/**
 * The template for displaying 404 page (not found).
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" role="main">
	<div class="container">

		<div class="row">
			<!-- content start -->
			<section id="content" class="col-12">
				<div class="text-center my-5">
					<h2 class="text-primary">
						<?php esc_html_e( 'That page can&rsquo;t be found!', 'sjdw-theme' ); ?>
					</h2>
					<p>
						<?php
						esc_html_e(
							'The page you were looking for could not be found.
							It might have been removed, renamed, or did not exist in the first place.',
							'sjdw-theme'
						);
						?>
					</p>
					<p>
						<?php
						echo wp_sprintf(
							/* translators: 1: Home link. */
							esc_html__( 'Please go back to %1$s', 'sjdw-theme' ),
							wp_sprintf(
								'<a href="%1$s">%2$s</a>',
								esc_url( home_url() ),
								esc_html__( 'Home', 'sjdw-theme' )
							)
						);
						?>
					</p>
				</div>
			</section>
			<!-- content end -->
		</div>

	</div>
</main>

<?php
get_footer();
