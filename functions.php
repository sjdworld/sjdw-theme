<?php
/**
 * The functions and definitions.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the custom autoloader.
require_once get_parent_theme_file_path( 'src/Theme.php' );
require_once get_parent_theme_file_path( 'src/Hooks.php' );
require_once get_parent_theme_file_path( 'src/Scripts.php' );
require_once get_parent_theme_file_path( 'src/Settings.php' );
require_once get_parent_theme_file_path( 'src/Updater.php' );
require_once get_parent_theme_file_path( 'src/Helper/Utility.php' );

/**
 * Get the theme main class instance.
 *
 * @return \Sjdworld\SjdwTheme\Theme
 */
function sjdw_theme(): \Sjdworld\SjdwTheme\Theme {
	return \Sjdworld\SjdwTheme\Theme::instance();
}

// Register and load the theme.
sjdw_theme()->load();
