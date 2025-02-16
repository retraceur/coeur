<?php
/**
 * HTTP API: WP_HTTP_Response class.
 *
 * @since WP 4.4.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage HTTP
 */

/**
 * Core class used to prepare HTTP responses.
 *
 * @since WP 4.4.0
 */
#[AllowDynamicProperties]
class WP_HTTP_Response {

	/**
	 * Response data.
	 *
	 * @since WP 4.4.0
	 * @var mixed
	 */
	public $data;

	/**
	 * Response headers.
	 *
	 * @since WP 4.4.0
	 * @var array
	 */
	public $headers;

	/**
	 * Response status.
	 *
	 * @since WP 4.4.0
	 * @var int
	 */
	public $status;

	/**
	 * Constructor.
	 *
	 * @since WP 4.4.0
	 *
	 * @param mixed $data    Response data. Default null.
	 * @param int   $status  Optional. HTTP status code. Default 200.
	 * @param array $headers Optional. HTTP header map. Default empty array.
	 */
	public function __construct( $data = null, $status = 200, $headers = array() ) {
		$this->set_data( $data );
		$this->set_status( $status );
		$this->set_headers( $headers );
	}

	/**
	 * Retrieves headers associated with the response.
	 *
	 * @since WP 4.4.0
	 *
	 * @return array Map of header name to header value.
	 */
	public function get_headers() {
		return $this->headers;
	}

	/**
	 * Sets all header values.
	 *
	 * @since WP 4.4.0
	 *
	 * @param array $headers Map of header name to header value.
	 */
	public function set_headers( $headers ) {
		$this->headers = $headers;
	}

	/**
	 * Sets a single HTTP header.
	 *
	 * @since WP 4.4.0
	 *
	 * @param string $key     Header name.
	 * @param string $value   Header value.
	 * @param bool   $replace Optional. Whether to replace an existing header of the same name.
	 *                        Default true.
	 */
	public function header( $key, $value, $replace = true ) {
		if ( $replace || ! isset( $this->headers[ $key ] ) ) {
			$this->headers[ $key ] = $value;
		} else {
			$this->headers[ $key ] .= ', ' . $value;
		}
	}

	/**
	 * Retrieves the HTTP return code for the response.
	 *
	 * @since WP 4.4.0
	 *
	 * @return int The 3-digit HTTP status code.
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Sets the 3-digit HTTP status code.
	 *
	 * @since WP 4.4.0
	 *
	 * @param int $code HTTP status.
	 */
	public function set_status( $code ) {
		$this->status = absint( $code );
	}

	/**
	 * Retrieves the response data.
	 *
	 * @since WP 4.4.0
	 *
	 * @return mixed Response data.
	 */
	public function get_data() {
		return $this->data;
	}

	/**
	 * Sets the response data.
	 *
	 * @since WP 4.4.0
	 *
	 * @param mixed $data Response data.
	 */
	public function set_data( $data ) {
		$this->data = $data;
	}

	/**
	 * Retrieves the response data for JSON serialization.
	 *
	 * It is expected that in most implementations, this will return the same as get_data(),
	 * however this may be different if you want to do custom JSON data handling.
	 *
	 * @since WP 4.4.0
	 *
	 * @return mixed Any JSON-serializable value.
	 */
	public function jsonSerialize() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
		return $this->get_data();
	}
}
