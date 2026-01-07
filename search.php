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

		<h3 class="my-4">
			<?php esc_html_e( 'Search Results Found For', 'sjdw-theme' ); ?>: "<?php the_search_query(); ?>"
		</h3>

		<div class="row">

			<!-- content start -->
			<section id="content" class="col-12">
				<div class="row row-cols-1">
					<?php while ( false !== have_posts() ) : ?>
						<?php the_post(); ?>
						<div class="col mb-4">
							<?php get_template_part( 'template-parts/content-search', get_post_type() ); ?>
						</div>
					<?php endwhile; ?>
				</div>
				<?php sjdw_theme_the_numeric_pagination(); ?>
			</section>
			<!-- content end -->

		</div>

	</div>
</main>

<?php
get_footer();
