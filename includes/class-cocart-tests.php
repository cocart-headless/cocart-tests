<?php
/**
 * CoCart Tests core setup.
 *
 * @author  Sébastien Dumont
 * @package CoCart Tests
 * @since   1.0.0 Introduced
 * @license GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main CoCart Tests class.
 */
final class CoCart_Tests {

	/**
	 * CoCart_Tests - the single instance of the class.
	 *
	 * @access protected
	 *
	 * @static
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Plugin Version.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @var string
	 */
	public static $version = '1.0.0';

	/**
	 * Required WordPress Version.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @var string
	 */
	public static $required_wp = '5.6';

	/**
	 * Required WooCommerce Version.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @var string
	 */
	public static $required_woo = '4.3';

	/**
	 * Required PHP Version.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @var string
	 */
	public static $required_php = '7.4';

	/**
	 * Required CoCart Version.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @var string
	 */
	public static $required_cocart = '4.2';

	/**
	 * Main CoCart Tests Instance.
	 *
	 * Ensures only one instance of CoCart Tests is loaded or can be loaded.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @see CoCart_Tests()
	 *
	 * @return CoCart_Tests - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning this object is forbidden.', 'cocart-plus' ), esc_html( self::$version ) );
	} // END __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'cocart-plus' ), esc_html( self::$version ) );
	} // END __wakeup()

	/**
	 * Load the plugin.
	 *
	 * @access public
	 */
	public function __construct() {
		// Load REST API.
		add_action( 'rest_api_init', array( __CLASS__, 'load_rest_api' ), 0 );
	} // END __construct()

	/**
	 * Define constant if not already set.
	 *
	 * @access private
	 *
	 * @param string         $name  Constant name.
	 * @param string|boolean $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.VariableConstantNameFound
		}
	} // END define()

	/**
	 * Return the name of the package.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @return string
	 */
	public static function get_name() {
		return 'Tests';
	} // END get_name()

	/**
	 * Return the version of the package.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @return string
	 */
	public static function get_version() {
		return self::$version;
	} // END get_version()

	/**
	 * Return the path to the package.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @return string
	 */
	public static function get_path() {
		return dirname( __DIR__ );
	} // END get_path()

	/**
	 * Load REST API.
	 *
	 * @access public
	 *
	 * @static
	 */
	public static function load_rest_api() {
		// Load controllers.
		add_action( 'cocart_rest_api_controllers', array( __CLASS__, 'rest_api_includes' ) );

		// Adds CoCart namespaces to be registered.
		add_filter( 'cocart_rest_api_get_rest_namespaces', array( __CLASS__, 'add_namespaces' ) );
	} // END load_rest_api()

	/**
	 * Adds CoCart namespaces to be registered.
	 *
	 * @access public
	 *
	 * @static
	 *
	 * @param array $namespaces Namespaces already registered.
	 *
	 * @return array $namespaces All remaining namespaces and additional namespaces added.
	 */
	public static function add_namespaces( $namespaces ) {
		$namespaces['cocart/tests'] = self::get_test_controllers();

		return $namespaces;
	} // END add_namespaces()

	/**
	 * List of controllers that use a none versioned namespace.
	 *
	 * @access protected
	 *
	 * @static
	 *
	 * @return array
	 */
	protected static function get_test_controllers() {
		return array(
			'cocart-test-user-management' => 'CoCart_Tests_REST_User_Management_Controller',
		);
	} // END get_test_controllers()

	/**
	 * Include CoCart Test REST API controllers.
	 *
	 * @access public
	 *
	 * @static
	 */
	public static function rest_api_includes() {
		require_once __DIR__ . '/rest-api/controllers/tests/class-cocart-tests-rest-user-management-controller.php';
	} // END rest_api_includes()
} // END class
