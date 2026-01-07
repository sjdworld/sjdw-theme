<?php
/**
 * The search form template file.
 *
 * @phpcs:disable Generic.Files.LineLength.TooLong
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<div class="icon-search">
	<a class="search-action" href="javascript:void();">
		<svg height="22" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="22" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M344.5,298c15-23.6,23.8-51.6,23.8-81.7c0-84.1-68.1-152.3-152.1-152.3C132.1,64,64,132.2,64,216.3  c0,84.1,68.1,152.3,152.1,152.3c30.5,0,58.9-9,82.7-24.4l6.9-4.8L414.3,448l33.7-34.3L339.5,305.1L344.5,298z M301.4,131.2  c22.7,22.7,35.2,52.9,35.2,85c0,32.1-12.5,62.3-35.2,85c-22.7,22.7-52.9,35.2-85,35.2c-32.1,0-62.3-12.5-85-35.2  c-22.7-22.7-35.2-52.9-35.2-85c0-32.1,12.5-62.3,35.2-85c22.7-22.7,52.9-35.2,85-35.2C248.5,96,278.7,108.5,301.4,131.2z"/></svg>
	</a>
	<div class="search-bg"></div>
	<div class="search-info">
		<div class="container">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<a class="search-close search-action" href="#">
					<svg class="icon-close" viewBox="0 0 32 32" width="20" height="20">
						<path class="path1" d="M0.407 2.375l29.217 29.217 1.968-1.968-29.217-29.217-1.968 1.968z"></path>
						<path class="path2" d="M29.625 0.407l-29.217 29.217 1.968 1.968 29.217-29.217-1.968-1.968z"></path>
					</svg>
				</a>
				<input type="search" class="search-field" placeholder="<?php esc_html_e( 'Search', 'sjdw-theme' ); ?>"
					value="<?php the_search_query(); ?>" name="s" autocomplete="off" />
				<input type="hidden" name="post_type" value="post"/>
			</form>
		</div>
	</div>
</div>
