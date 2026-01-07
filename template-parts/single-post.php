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
<article class="single-post">

	<header class="page-header">
		<h1 class="mb-0"><?php the_title(); ?></h1>
		<?php get_template_part( 'template-parts/meta', get_post_type() ); ?>
	</header>

	<div class="row">
		<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
			<!-- start sidebar widgets -->
			<div id="sidebar" class="col-lg order-lg-2">
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</div>
			<!-- end sidebar widgets -->
		<?php endif; ?>
		<div class="col">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php get_template_part( 'template-parts/tag', get_post_type() ); ?>
		</div>
	</div>

</article>
