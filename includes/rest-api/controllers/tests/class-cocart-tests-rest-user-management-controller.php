<?php
/**
 * REST API: CoCart_Tests_REST_User_Management_Controller class
 *
 * @author  Sébastien Dumont
 * @package CoCart Tests\API
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Controller for testing user management.
 *
 * This REST API controller handles the request to return
 * session details via "cocart/test/user-management" endpoint.
 */
class CoCart_Tests_REST_User_Management_Controller {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'cocart/test';

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'user-management';

	/**
	 * Register routes.
	 *
	 * @access public
	 *
	 * @ignore Function ignored when parsed into Code Reference.
	 */
	public function register_routes() {
		// Get Store - cocart/test/user-management (GET).
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'session_details' ),
					'permission_callback' => '__return_true',
				),
			)
		);
	} // END register_routes()

	/**
	 * Retrieves session details requested.
	 *
	 * @access public
	 *
	 * @return WP_REST_Response The user management conditions.
	 */
	public function session_details() {
		// Current user ID.
		$current_user_id = 0;

		if ( is_user_logged_in() ) {
			$current_user_id = strval( get_current_user_id() );
		}

		$requested_cart = WC()->session->get_requested_cart();

		$test = array(
			'authenticated'  => $current_user_id > 0 ? true : false,
			'user_ID'        => $current_user_id,
			'requested_cart' => ! empty( $requested_cart ) ? $requested_cart : null,
			'is_customer'    => WC()->session->is_user_customer( $requested_cart ),
			'is_guest'       => ! empty( $requested_cart ) && ! is_numeric( $requested_cart ) ? true : false,
			'merge_cart'     => is_user_logged_in() && ! empty( $requested_cart ) && ! WC()->session->is_user_customer( $requested_cart ) && $current_user_id !== $requested_cart
		);

		return new WP_REST_Response( $test );
	} // END session_details()
} // END class
