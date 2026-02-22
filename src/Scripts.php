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
}
