<?php
/**
 * The utility class file.
 *
 * @package Sjdworld\SjdwTheme\Helper
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme\Helper;

use WP_Query;
use WP_Post;

/**
 * Utility class.
 */
class Utility {

	/**
	 * Get Numeric pagination.
	 *
	 * @param WP_Query|null $query The query object.
	 *
	 * @return string
	 */
	public static function get_pagination( ?WP_Query $query = null ): string {

		global $wp_query;

		// Set the instance if null.
		if ( is_null( $query ) ) {
			$query = $wp_query;
		}

		// Check whether the instance is set.
		if ( ! $query instanceof WP_Query ) {
			return '';
		}

		// Do not show if there is only one page.
		if ( $query->max_num_pages <= 1 ) {
			return '';
		}

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $query->max_num_pages );
		$links = array();

		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$html = '<ul class="pagination justify-content-center my-4">';

		if ( ! in_array( 1, $links, true ) ) {
			$class = 1 === $paged ? 'active' : '';

			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( 1 ) ),
				'1'
			);

			if ( ! in_array( 2, $links, true ) ) {
				$html .= '<li class="page-item">…</li>';
			}
		}

		sort( $links );

		foreach ( (array) $links as $link ) {
			$class = $paged === $link ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $link ) ),
				$link
			);
		}

		if ( ! in_array( $max, $links, true ) ) {
			if ( ! in_array( $max - 1, $links, true ) ) {
				$html .= '<li class="page-item d-flex align-items-center"><span class="mr-1">…</span></li>';
			}

			$class = $paged === $max ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $max ) ),
				$max
			);
		}

		$html .= '</ul>';

		return $html;
	}

	/**
	 * Print Numeric pagination.
	 *
	 * @param WP_Query|null $query The query object.
	 *
	 * @return void
	 */
	public static function the_pagination( ?WP_Query $query = null ): void {
		// Get the pgination html.
		$html = self::get_pagination( $query );
		echo wp_kses_post( $html );
	}

	/**
	 * Check for the hide page title flag
	 *
	 * @param int $post_id The post ID.
	 *
	 * @return bool
	 */
	public static function hide_page_title( int $post_id ): bool {
		// Get the post meta.
		$hide = (int) get_post_meta( $post_id, '_hide_title', true );
		return $hide ? true : false;
	}

	/**
	 * Print the custom logo image
	 *
	 * @param string|null $default The default image if not found.
	 *
	 * @return void
	 */
	public static function the_custom_logo( ?string $default = null ): void {

		$logo_id  = get_theme_mod( 'custom_logo' );
		$bloginfo = get_bloginfo( 'name' );

		if ( ! empty( $logo_id ) ) {
			$html = wp_get_attachment_image(
				$logo_id,
				'full',
				false,
				array(
					'class' => 'img-fluid',
					'alt'   => $bloginfo,
				)
			);
		} else {
			$default = ! empty( $default ) ? $default : get_stylesheet_directory_uri() . '/assets/images/logo.svg';
			$html    = wp_sprintf(
				'<img src="%1$s" class="img-fluid" alt="%2$s">',
				esc_url( $default ),
				esc_attr( $bloginfo )
			);
		}

		echo wp_kses_post( $html );
	}

	/**
	 * Print the post thumbnail
	 *
	 * @param int|WP_Post  $post The post.
	 * @param string       $size The thumbnail size.
	 * @param array<mixed> $attr The attributes.
	 *
	 * @return void
	 */
	public static function the_post_thumbnail(
		$post,
		string $size,
		array $attr = array( 'class' => 'img-fluid' )
	): void {

		if ( has_post_thumbnail( $post ) ) {
			// Get the image.
			$html = get_the_post_thumbnail( $post, $size, $attr );
		} else {

			// Get the default image from theme settings.
			$default_image = get_theme_mod( 'default_image' );

			if ( ! empty( $default_image ) ) {
				// Get the attachment ID.
				$attachment_id = attachment_url_to_postid( $default_image );

				if ( ! empty( $attachment_id ) ) {
					// Get the image.
					$html = wp_get_attachment_image( $attachment_id, $size, false, $attr );
				}
			}

			if ( empty( $html ) ) {

				$default = get_template_directory_uri() . '/assets/images/no-image.png';
				$title   = get_the_title( $post );

				// Get the default image.
				$html = wp_sprintf(
					'<img src="%1$s" alt="%2$s" class="%2$s"/>',
					esc_url( $default ),
					esc_html( $title ),
					! empty( $attr['class'] ) ? esc_attr( $attr['class'] ) : ''
				);
			}
		}

		echo wp_kses_post( $html );
	}

	/**
	 * Get the post link
	 *
	 * @param int|WP_Post $post     The post.
	 * @param string      $content  The link content.
	 * @param string      $cssclass The link css class.
	 *
	 * @return string
	 */
	public static function get_post_link( $post, string $content, string $cssclass = '' ): string {

		$post_id   = is_int( $post ) ? $post : $post->ID;
		$permalink = get_post_meta( $post_id, '_external_link', true );
		$target    = get_post_meta( $post_id, '_link_target', true );

		if ( empty( $permalink ) ) {
			$permalink = get_permalink( $post_id );
			$target    = '';
		}

		$link = wp_sprintf(
			'<a href="%1$s" target="%2$s" class="%3$s">%4$s</a>',
			esc_url( $permalink ),
			esc_attr( $target ),
			esc_attr( $cssclass ),
			wp_kses_post( $content )
		);

		return $link;
	}

	/**
	 * Print the post link
	 *
	 * @param int|WP_Post $post     The post.
	 * @param string      $content  The link content.
	 * @param string      $cssclass The link css class.
	 *
	 * @return void
	 */
	public static function the_post_link( $post, string $content, string $cssclass = '' ): void {
		// Get the post link.
		$link = self::get_post_link( $post, $content, $cssclass );
		echo wp_kses_post( $link );
	}
}
