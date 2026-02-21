<?php
/**
 * The Hooks class file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme;

use Sjdworld\SjdwTheme\Helper\Utility;

/**
 * The Hooks class.
 */
class Hooks {

	/**
	 * Register actions.
	 *
	 * @return void
	 */
	public function init(): void {

		// Initialise the theme.
		add_action( 'init', array( $this, 'init_theme' ) );

		// Fire up the theme.
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );

		// Filter the "read more" excerpt.
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		// Filter the except length.
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );

		// Change the image quality.
		add_filter( 'jpeg_quality', array( $this, 'jpeg_quality' ) );
		add_filter( 'wp_editor_set_quality', array( $this, 'jpeg_quality' ) );

		// Allow nested category filter.
		add_filter( 'wp_terms_checklist_args', array( $this, 'category_filter' ) );
	}

	/**
	 * Initialise the theme.
	 *
	 * @return void
	 */
	public function init_theme(): void {

		// Remove the head features.
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
	}

	/**
	 * Fire up the theme
	 *
	 * @return void
	 */
	public function setup_theme(): void {

		// Load the language file for translation.
		load_theme_textdomain( 'sjdw-theme', get_template_directory() . '/languages' );

		// Add custom logo support.
		add_theme_support( 'custom-logo' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add thumbnail support.
		add_theme_support( 'post-thumbnails' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Blocks.
		add_theme_support( 'widgets-block-editor' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'assets/dist/editor-style.min.css' );

		// Refister the navigation locations.
		register_nav_menus(
			array(
				'main' => esc_html__( 'Main Menu', 'sjdw-theme' ),
			)
		);

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Allow text widget to have shortcodes.
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more_string The string shown within the more link.
	 *
	 * @return string
	 */
	public function excerpt_more( string $more_string ): string {

		// Get the post link.
		$link = Utility::get_post_link( get_the_ID(), __( 'Read more', 'sjdw-theme' ), 'readmore' );

		$more_string = '... ' . $link;

		return $more_string;
	}

	/**
	 * Filter the except length to certain words.
	 *
	 * @param int $length Excerpt length.
	 *
	 * @return int
	 */
	public function excerpt_length( int $length ): int {

		if ( ! is_admin() ) {
			$length = 30;
		}

		return $length;
	}

	/**
	 * Change the image quality
	 *
	 * @param int $quality The quality for resize.
	 * @return int
	 */
	public function jpeg_quality( $quality ) {
		$quality = 100;
		return $quality;
	}

	/**
	 * Allow nested category filter
	 *
	 * @param array<mixed> $args The arguments.
	 *
	 * @return array<mixed>
	 */
	public function category_filter( array $args ): array {
		$args['checked_ontop'] = false;
		return $args;
	}
}
