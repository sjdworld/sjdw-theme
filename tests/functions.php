<?php
/**
 * The PhpUnit bootstrap file.
 *
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
 *
 * @package Sjdworld\SjdwTheme\Tests
 */

declare(strict_types=1);

/**
 * Appends a trailing slash.
 *
 * @param string $value The value.
 *
 * @return string
 */
function trailingslashit( string $value ): string {
	return untrailingslashit( $value ) . '/';
}

/**
 * Removes trailing forward slashes and backslashes if they exist.
 *
 * @param string $value The value.
 *
 * @return string
 */
function untrailingslashit( string $value ): string {
	return rtrim( $value, '/\\' );
}
