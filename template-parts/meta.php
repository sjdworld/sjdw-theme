<?php
/**
 * The template for displaying all post meta.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<ul class="list-inline post-meta">
	<li class="list-inline-item post-date">
		<?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
	</li>
	<?php if ( has_category() ) : ?>
		<li class="list-inline-item post-categories">
			<?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
		</li>
	<?php endif; ?>
</ul>
