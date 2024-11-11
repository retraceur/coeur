<?php
/**
 * HTML API: WP_HTML_Span class.
 *
 * @since WP 6.2.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage HTML-API
 */

/**
 * Core class used by the HTML tag processor to represent a textual span
 * inside an HTML document.
 *
 * This is a two-tuple in disguise, used to avoid the memory overhead
 * involved in using an array for the same purpose.
 *
 * This class is for internal usage of the WP_HTML_Tag_Processor class.
 *
 * @access private
 * @since WP 6.2.0
 * @since WP 6.5.0 Replaced `end` with `length` to more closely align with `substr()`.
 *
 * @see WP_HTML_Tag_Processor
 */
class WP_HTML_Span {
	/**
	 * Byte offset into document where span begins.
	 *
	 * @since WP 6.2.0
	 *
	 * @var int
	 */
	public $start;

	/**
	 * Byte length of this span.
	 *
	 * @since WP 6.5.0
	 *
	 * @var int
	 */
	public $length;

	/**
	 * Constructor.
	 *
	 * @since WP 6.2.0
	 *
	 * @param int $start  Byte offset into document where replacement span begins.
	 * @param int $length Byte length of span.
	 */
	public function __construct( int $start, int $length ) {
		$this->start  = $start;
		$this->length = $length;
	}
}
