<?php

/**
 * IXR_Base64 class.
 *
 * @since WP 1.5.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage IXR
 */
class IXR_Base64
{
    var $data;

	/**
	 * PHP5 constructor.
	 */
    function __construct( $data )
    {
        $this->data = $data;
    }

	/**
	 * PHP4 constructor.
	 */
	public function IXR_Base64( $data ) {
		self::__construct( $data );
	}

    function getXml()
    {
        return '<base64>'.base64_encode($this->data).'</base64>';
    }
}
