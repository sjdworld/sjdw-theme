<?php
/**
 * The template index file.
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

		<header class="page-header">
			<h1><?php single_cat_title(); ?></h1>
		</header>

		<div class="row">

			<!-- content start -->
			<section id="content" class="col">
				<div class="row row-cols-1 row-cols-md-2">
					<?php while ( false !== have_posts() ) : ?>
						<?php the_post(); ?>
						<div class="col mb-5">
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
