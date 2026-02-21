<?php
/**
 * The PhpUnit bootstrap class file.
 *
 * @package Sjdworld\SjdwTheme\Tests
 */

declare(strict_types=1);

// Load the composer autoloader.
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Include WordPress functios.
require_once dirname( __DIR__ ) . '/tests/functions.php';

// Invoke WP_Mock.
\WP_Mock::bootstrap();
