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
<article class="content-item">

	<h2 class="h4 mb-3">
		<?php sjdw_theme()->utility()->the_post_link( get_the_ID(), get_the_title() ); ?>
	</h2>

	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>

</article>
