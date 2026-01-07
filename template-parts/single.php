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
<article>

	<header class="page-header">
		<h1><?php the_title(); ?></h1>
	</header>

	<div class="page-content">
		<?php the_content(); ?>
	</div>

</article>
