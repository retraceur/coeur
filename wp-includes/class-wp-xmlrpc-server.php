<?php
/**
 * XML-RPC protocol support for WP.
 *
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @package Retraceur
 * @subpackage Publishing
 */

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/**
 * WP XMLRPC server implementation.
 *
 * Implements compatibility for Blogger API, MetaWeblog API, MovableType, and
 * pingback. Additional WP API for managing comments, pages, posts,
 * options, etc.
 *
 * @since WP 1.5.0
 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
 *
 * @see IXR_Server
 */
#[AllowDynamicProperties]
class wp_xmlrpc_server extends IXR_Server {
	/**
	 * Methods.
	 *
	 * @var array
	 */
	public $methods;

	/**
	 * Blog options.
	 *
	 * @var array
	 */
	public $blog_options;

	/**
	 * IXR_Error instance.
	 *
	 * @var IXR_Error
	 */
	public $error;

	/**
	 * Flags that the user authentication has failed in this instance of wp_xmlrpc_server.
	 *
	 * @var bool
	 */
	protected $auth_failed = false;

	/**
	 * Flags that XML-RPC is enabled
	 *
	 * @var bool
	 */
	private $is_enabled;

	/**
	 * Registers all of the XMLRPC methods that XMLRPC server understands.
	 *
	 * Sets up server and method property. Passes XMLRPC methods through the
	 * {@see 'xmlrpc_methods'} filter to allow plugins to extend or replace
	 * XML-RPC methods.
	 *
	 * @since WP 1.5.0
	 * @deprecated 1.0.0 Retraceur removed the XML-RPC API.
	 */
	public function __construct() {
		_deprecated_class( 'wp_xmlrpc_server', '1.0.0', '', true );
		$this->is_enabled = false;
	}
}
