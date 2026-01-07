<?php
/**
 * The template for displaying all single pages.
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
				<?php
				while ( false !== have_posts() ) {
					the_post();
					get_template_part( 'template-parts/single', get_post_type() );
				}
				?>
			</section>
			<!-- content end -->

		</div>

	</div>
</main>

<?php
get_footer();
