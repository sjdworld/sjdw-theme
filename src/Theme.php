<?php
/**
 * The Theme class file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme;

use Sjdworld\SjdwTheme\Helper\Utility;
use Sjdworld\SjdwTheme\Posts\Page;
use Sjdworld\SjdwTheme\Posts\Post;
use Sjdworld\SjdwTheme\Widgets\ContactWidget;
use Sjdworld\SjdwTheme\Widgets\PostFilterWidget;
use Sjdworld\SjdwTheme\Widgets\WoocartWidget;

/**
 * The Theme class.
 */
final class Theme {

	/**
	 * The name.
	 *
	 * @var string
	 */
	const NAME = 'Sjdw - Theme';

	/**
	 * The slug.
	 *
	 * @var string
	 */
	const SLUG = 'sjdw-theme';

	/**
	 * The version.
	 *
	 * @var string|null
	 */
	private $version;

	/**
	 * The description.
	 *
	 * @var string|null
	 */
	private $description;

	/**
	 * The base url.
	 *
	 * @var string|null
	 */
	private $url;

	/**
	 * The base path.
	 *
	 * @var string|null
	 */
	private $path;

	/**
	 * Loaded init function.
	 *
	 * @var bool
	 */
	private static $loaded = false;

	/**
	 * Instance for this class.
	 *
	 * @var self|null
	 */
	private static $instance;

	/**
	 * Instance for Utility class.
	 *
	 * @var Utility|null
	 */
	private static $utility;

	/**
	 * If an instance exists, returns it. If not, creates one and retuns it.
	 *
	 * @return self
	 */
	public static function instance(): self {

		if ( empty( self::$instance ) ) {
			// Create a new instance.
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Load the theme.
	 *
	 * @return void
	 */
	public static function load(): void {

		// Prevent duplicate call.
		if ( self::is_loaded() ) {
			return;
		}

		// Initialise all classes.
		( new Hooks() )->init();
		( new Scripts() )->init();
		( new Settings() )->init();

		$page = new Page();
		$page->init();

		// Load widgets.
		( new ContactWidget() )->init();
		( new PostFilterWidget() )->init();
		( new WoocartWidget() )->init();

		if ( is_admin() ) {

			// Initialize the Updater.
			( new Updater() )->init();

			// Initialise all classes.
			$page->admin_init();
			( new Post() )->admin_init();
		}

		// Flag loaded.
		self::$loaded = true;
	}

	/**
	 * Get the Utility class instance
	 *
	 * @return Utility
	 */
	public function utility(): Utility {

		if ( is_null( self::$utility ) ) {
			self::$utility = new Utility();
		}

		return self::$utility;
	}

	/**
	 * Get the loaded flag.
	 *
	 * @return bool
	 */
	public static function is_loaded(): bool {
		return self::$loaded;
	}

	/**
	 * Get the version.
	 *
	 * @return string|null
	 */
	public function get_version(): ?string {
		return $this->version;
	}

	/**
	 * Set the version.
	 *
	 * @param string $version The version.
	 *
	 * @return self
	 */
	public function set_version( string $version ): self {
		$this->version = $version;
		return $this;
	}

	/**
	 * Get the description.
	 *
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * Set the description.
	 *
	 * @param string $description The description.
	 *
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the base url.
	 *
	 * @return string|null
	 */
	public function get_url(): ?string {
		return $this->url;
	}

	/**
	 * Set the base url.
	 *
	 * @param string $url The base url.
	 *
	 * @return self
	 */
	public function set_url( string $url ): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get the base path.
	 *
	 * @return string|null
	 */
	public function get_path(): ?string {
		return $this->path;
	}

	/**
	 * Set the base path.
	 *
	 * @param string $path The base path.
	 *
	 * @return self
	 */
	public function set_path( string $path ): self {
		$this->path = $path;
		return $this;
	}

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return self::NAME;
	}

	/**
	 * Get the package slug.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return self::SLUG;
	}

	/**
	 * Prevent Initialising.
	 */
	private function __construct() {

		$theme = wp_get_theme( 'sjdw-theme' );

		// Set the default variables.
		$this->set_version( (string) $theme->get( 'Version' ) );
		$this->set_description( (string) $theme->get( 'Description' ) );
		$this->set_path( get_template_directory() );
		$this->set_url( get_template_directory_uri() );
	}

	/**
	 * Prevent cloning.
	 */
	private function __clone() {}
}
