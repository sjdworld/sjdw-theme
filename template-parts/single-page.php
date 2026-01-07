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
<article class="single-page">

	<?php if ( ! sjdw_theme_hide_page_title( get_the_ID() ) ) : ?>
	<header class="page-header">
		<h1><?php the_title(); ?></h1>
	</header>
	<?php endif; ?>

	<div class="page-content">
		<?php the_content(); ?>
	</div>

</article>
