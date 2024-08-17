<?php
/**
 * Plugin Name: CoCart Tests
 * Plugin URI:  https://cocartapi.com
 * Description: Run tests for CoCart.
 * Author:      CoCart Headless, LLC
 * Author URI:  https://cocartapi.com
 * Version:     1.0.0
 * Text Domain: cocart-tests
 * Domain Path: /languages/
 * Requires at least: 5.6
 * Tested up to: 6.6
 * Requires PHP: 7.4
 * CoCart requires at least: 4.2
 * CoCart tested up to: 4.3
 *
 * Copyright:   CoCart Headless, LLC
 * License:     GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package CoCart Tests
 */

if ( ! defined( 'COCART_TESTS_FILE' ) ) {
	define( 'COCART_TESTS_FILE', __FILE__ ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
}

if ( ! class_exists( 'CoCart_Tests' ) ) {
	include_once untrailingslashit( plugin_dir_path( COCART_TESTS_FILE ) ) . '/includes/class-cocart-tests.php';
} // END if class exists

/**
 * Returns the main instance of CoCart Tests.
 *
 * @return CoCart_Tests
 */
if ( ! function_exists( 'CoCart_Tests' ) ) {
	/**
	 * Initialize CoCart Tests.
	 */
	function CoCart_Tests() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
		return CoCart_Tests::instance();
	}

	// Run CoCart Tests.
	CoCart_Tests();
}
