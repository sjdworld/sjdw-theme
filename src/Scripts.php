<?php
/**
 * The Scripts class file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme;

use Sjdworld\SjdwTheme\Theme;

/**
 * The Scripts class.
 */
class Scripts {

	/**
	 * Register actions.
	 *
	 * @return void
	 */
	public function init(): void {

		// Add Front-End scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add Back-End scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Inject script loader strategy.
		add_filter( 'script_loader_tag', array( $this, 'inject_script_strategy' ), 10, 2 );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @return void
	 */
	public function enqueue_scripts(): void {

		$theme   = Theme::instance();
		$baseurl = trailingslashit( $theme->get_url() );
		$version = $theme->get_version();

		// Enqueue default scripts.
		wp_deregister_script( 'jquery' );
		wp_enqueue_script(
			'jquery',
			includes_url( '/js/jquery/jquery.min.js' ),
			array(),
			null, //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			true
		);

		// Enqueue bootstrap.
		wp_enqueue_script(
			'sjdw-theme-bootstrap',
			$baseurl . 'assets/dist/bootstrap/bootstrap.min.js',
			array(),
			$version,
			true
		);
		wp_enqueue_style(
			'sjdw-theme-bootstrap',
			$baseurl . 'assets/dist/bootstrap/bootstrap.min.css',
			array(),
			$version
		);

		// Enqueue theme.
		wp_enqueue_script(
			'sjdw-theme',
			$baseurl . 'assets/dist/main.min.js',
			array( 'jquery' ),
			$version,
			true
		);
		wp_enqueue_style(
			'sjdw-theme',
			$baseurl . 'assets/dist/base-style.min.css',
			array(),
			$version
		);
	}

	/**
	 * Enqueue admin scripts and styles
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts(): void {

		$theme   = Theme::instance();
		$baseurl = trailingslashit( $theme->get_url() );
		$version = $theme->get_version();

		// Enqueue admin styles.
		wp_enqueue_style(
			'sjdw-theme-admin',
			$baseurl . 'assets/dist/admin-style.min.css',
			array(),
			$version
		);
	}

	/**
	 * Inject script loader strategy.
	 *
	 * @param string $tag    The script tag for the enqueued script.
	 * @param string $handle The script’s registered handle.
	 *
	 * @return string
	 */
	public function inject_script_strategy( string $tag, string $handle ): string {

		$handlers = array(
			'sjdw-theme-bootstrap',
			'sjdw-theme',
		);

		/**
		 * Filter and return all the handlers for defer and async.
		 *
		 * @param string[] $handlers The handlers.
		 */
		$handlers = apply_filters( 'sjdw_theme_script_strategy', $handlers );

		if (
			is_admin() ||
			! in_array( $handle, $handlers, true ) ||
			str_contains( $tag, ' defer' ) ||
			str_contains( $tag, ' async' )
		) {
			return $tag;
		}

		$tag = str_replace( ' src', ' defer src', $tag );

		return $tag;
	}
}
