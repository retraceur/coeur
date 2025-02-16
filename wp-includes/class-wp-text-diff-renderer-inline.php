<?php
/**
 * Diff API: WP_Text_Diff_Renderer_inline class.
 *
 * @since WP 4.7.0
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Diff
 */

/**
 * Better word splitting than the PEAR package provides.
 *
 * @since WP 2.6.0
 * @uses Text_Diff_Renderer_inline Extends
 */
#[AllowDynamicProperties]
class WP_Text_Diff_Renderer_inline extends Text_Diff_Renderer_inline {

	/**
	 * @ignore
	 * @since WP 2.6.0
	 *
	 * @param string $string
	 * @param string $newlineEscape
	 * @return string
	 */
	public function _splitOnWords( $string, $newlineEscape = "\n" ) { // phpcs:ignore Universal.NamingConventions.NoReservedKeywordParameterNames.stringFound,WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
		$string = str_replace( "\0", '', $string );
		$words  = preg_split( '/([^\w])/u', $string, -1, PREG_SPLIT_DELIM_CAPTURE );
		$words  = str_replace( "\n", $newlineEscape, $words ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
		return $words;
	}
}
