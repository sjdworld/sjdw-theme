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

		<div class="row">
			<!-- content start -->
			<section id="content" class="col-12">
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 content-items">
					<?php while ( false !== have_posts() ) : ?>
						<?php the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						</div>
					<?php endwhile; ?>
				</div>
				<?php sjdw_theme()->utility()->the_pagination(); ?>
			</section>
			<!-- content end -->
		</div>

	</div>
</main>

<?php
get_footer();
