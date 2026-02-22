<?php
/**
 * The default template for displaying content for both singular and index.
 *
 * @phpcs:disable Generic.Files.LineLength.TooLong
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<article class="single-post">

	<div class="row">

		<?php $sjdw_theme_content_class = is_active_sidebar( 'blog-sidebar' ) ? 'col-md-8 col-lg-9' : 'col-12'; ?>
		<div class="<?php echo esc_attr( $sjdw_theme_content_class ); ?>">

			<header class="page-header mb-3">
				<h1 class="mb-0"><?php the_title(); ?></h1>
				<?php get_template_part( 'template-parts/meta', get_post_type() ); ?>
			</header>

			<?php $sjdw_theme_featured_video = get_post_meta( get_the_ID(), '_featured_video', true ); ?>
			<?php if ( ! empty( $sjdw_theme_featured_video ) ) : ?>
				<div class="ratio ratio-16x9 my-4">
					<iframe rel="0" allowfullscreen
						src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $sjdw_theme_featured_video ); ?>?rel=0">
					</iframe>
				</div>
			<?php endif; ?>

			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php get_template_part( 'template-parts/tag', get_post_type() ); ?>

		</div>

		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
			<!-- start sidebar widgets -->
			<div id="sidebar" class="col-md-4 col-lg-3 mb-4">
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</div>
			<!-- end sidebar widgets -->
		<?php endif; ?>

	</div>

</article>
