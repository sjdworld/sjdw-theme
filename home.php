<?php
/**
 * The template index file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sjdw_theme_blogid = (int) get_option( 'page_for_posts' );

get_header();
?>

<main id="main" role="main">
	<div class="container">

		<?php if ( $sjdw_theme_blogid && ! sjdw_theme_hide_page_title( $sjdw_theme_blogid ) ) : ?>
		<header class="page-header">
			<h1><?php echo esc_html( get_the_title( $sjdw_theme_blogid ) ); ?></h1>
		</header>
		<?php endif; ?>

		<div class="row">

			<!-- content start -->
			<section id="content" class="col <?php echo ! absint( $sjdw_theme_blogid ) ? 'pt-4 pt-md-5' : ''; ?>">
				<div class="row row-cols-1 row-cols-md-2 content-items">
					<?php while ( false !== have_posts() ) : ?>
						<?php the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						</div>
					<?php endwhile; ?>
				</div>
				<?php sjdw_theme_the_numeric_pagination(); ?>
			</section>
			<!-- content end -->

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
				<!-- start sidebar widgets -->
				<div id="sidebar" class="col-lg">
					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				</div>
				<!-- end sidebar widgets -->
			<?php endif; ?>

		</div>

	</div>
</main>

<?php
get_footer();
