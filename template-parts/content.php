<?php
/**
 * The default template for displaying content for both singular and index.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sjdw_theme_permalink = get_post_meta( get_the_ID(), '_external_link', true );
$sjdw_theme_target    = get_post_meta( get_the_ID(), '_link_target', true );

$sjdw_theme_redmore_txt = wp_sprintf(
	/* translators: 1: The title. */
	esc_html__( 'about %1$s', 'sjdw-theme' ),
	esc_html( get_the_title() )
);

if ( empty( $sjdw_theme_permalink ) ) {
	$sjdw_theme_permalink = get_permalink( get_the_ID() );
	$sjdw_theme_target    = '';
}
?>
<article class="card content-item h-100">
	<?php
	sjdw_theme_the_post_thumbnail(
		get_the_ID(),
		'thumbnail',
		array( 'class' => 'img-fluid' )
	);
	?>
	<div class="card-body d-flex flex-column p-4">

		<p class="mb-0 post-date small"><?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?></p>

		<h3 class="card-title mb-3">
			<a target="<?php echo esc_attr( $sjdw_theme_target ); ?>"
				href="<?php echo esc_url( $sjdw_theme_permalink ); ?>">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php the_excerpt(); ?>

		<p class="link-arrow mt-auto mb-2 has-primary-color has-text-color has-link-color">
			<a title="<?php echo esc_html( get_the_title() ); ?>"
				target="<?php echo esc_attr( $sjdw_theme_target ); ?>"
				href="<?php echo esc_url( $sjdw_theme_permalink ); ?>">
				<?php esc_html_e( 'Read more', 'sjdw-theme' ); ?>
				<span class="visually-hidden visually-hidden-focusable">
					<?php echo esc_html( $sjdw_theme_redmore_txt ); ?>
				</span>
			</a>
		</p>

	</div>
</article>
