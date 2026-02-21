<?php
/**
 * The PhpUnit Theme class file.
 *
 * @package Sjdworld\SjdwTheme\Tests
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme\Tests;

use Sjdworld\SjdwTheme\Helper\Utility;
use WP_Mock;
use WP_Mock\Tools\TestCase;
use Sjdworld\SjdwTheme\Theme;

/**
 * Test class for ThemeTest class.
 */
class ThemeTest extends TestCase {

	/**
	 * Fire up the initial setup.
	 *
	 * @return void
	 */
	public function setUp(): void {

		parent::setUp();

		$theme = new class() {
			/**
			 * Get the theme header params.
			 *
			 * @param  string $header The header.
			 * @return string
			 */
			public function get( string $header ) {
				return 'Version' === $header ? '1.0.0' : '';
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
	 * Test instance method.
	 *
	 * @return void
	 */
	public function test_instance(): void {

		$theme = Theme::instance();
		$this->assertInstanceOf( Theme::class, $theme );
	}

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$theme = Theme::instance();

		$this->assertEquals( 'Sjdw - Theme', $theme->get_name() );
		$this->assertEquals( 'sjdw-theme', $theme->get_slug() );
		$this->assertEquals( '1.0.0', $theme->get_version() );

		$url = 'http://example.com';
		$this->assertInstanceOf( Theme::class, $theme->set_url( $url ) );
		$this->assertEquals( $url, $theme->get_url() );

		$path = 'path/to/theme';
		$this->assertInstanceOf( Theme::class, $theme->set_path( $path ) );
		$this->assertEquals( $path, $theme->get_path() );
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load(): void {

		$theme = Theme::instance();
		$this->assertFalse( $theme->is_loaded() );
		$theme->load();
		$this->assertTrue( $theme->is_loaded() );
	}

	/**
	 * Test utility method.
	 *
	 * @return void
	 */
	public function test_utility(): void {

		$theme = Theme::instance();
		$this->assertInstanceOf( Utility::class, $theme->utility() );
	}
}
