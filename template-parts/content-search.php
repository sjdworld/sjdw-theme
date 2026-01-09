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

if ( empty( $sjdw_theme_permalink ) ) {
	$sjdw_theme_permalink = get_permalink( get_the_ID() );
	$sjdw_theme_target    = '';
}

?>
<article class="content-item">

	<h2 class="h4 mb-3">
		<a target="<?php echo esc_attr( $sjdw_theme_target ); ?>"
			href="<?php echo esc_url( $sjdw_theme_permalink ); ?>">
			<?php the_title(); ?>
		</a>
	</h2>

	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>

</article>
