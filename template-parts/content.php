<?php
/**
 * The default template for displaying content for both singular and index.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<article class="card content-item h-100">

	<?php sjdw_theme()->utility()->the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>

	<div class="card-body d-flex flex-column p-4">

		<p class="mb-0 post-date small"><?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?></p>

		<h3 class="card-title mb-3">
			<?php sjdw_theme()->utility()->the_post_link( get_the_ID(), get_the_title() ); ?>
		</h3>

		<?php the_excerpt(); ?>

	</div>
</article>
