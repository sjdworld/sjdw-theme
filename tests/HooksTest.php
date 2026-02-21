<?php
/**
 * The HooksTest class file.
 *
 * @package Sjdworld\SjdwTheme\Tests
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme\Tests;

use WP_Mock;
use WP_Mock\Tools\TestCase;
use Sjdworld\SjdwTheme\Hooks;

/**
 * The HooksTest class.
 *
 * @group Hook
 */
class HooksTest extends TestCase {

	/**
	 * Fire up the initial setup.
	 *
	 * @return void
	 */
	public function setUp(): void {

		parent::setUp();

		$theme = new class() {
			/**
			 * Get the header.
			 *
			 * @param  string $header The header.
			 * @return string
			 */
			public function get( string $header ) {
				return '1.0.0';
			}
		};

		WP_Mock::userFunction( 'wp_get_theme' )
			->andReturn( $theme );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( dirname( __DIR__ ) );

		WP_Mock::userFunction( 'get_template_directory_uri' )
			->andReturn( 'http://localhost.com/wp-content/themes/sjdw-themes' );
	}

	/**
	 * Test init function.
	 *
	 * @return void
	 */
	public function test_init(): void {

		$hooks = new Hooks();

		WP_Mock::expectActionAdded( 'init', array( $hooks, 'init_theme' ) );
		WP_Mock::expectActionAdded( 'after_setup_theme', array( $hooks, 'setup_theme' ) );

		$hooks->init();

		WP_Mock::assertActionsCalled();
	}
}
