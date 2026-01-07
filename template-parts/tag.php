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
<?php if ( has_tag() ) : ?>
	<div class="tagcloud my-3">
		<span class="d-inline-block mr-2"><strong><?php esc_html_e( 'Tags:', 'sjdw-theme' ); ?></strong></span>
		<?php echo wp_kses_post( get_the_tag_list() ); ?>
	</div>
<?php endif; ?>
