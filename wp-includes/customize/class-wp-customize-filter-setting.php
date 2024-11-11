<?php
/**
 * Customize API: WP_Customize_Filter_Setting class.
 *
 * @since WP 4.4.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 * @subpackage Customize
 */

/**
 * A setting that is used to filter a value, but will not save the results.
 *
 * Results should be properly handled using another setting or callback.
 *
 * @since WP 3.4.0
 *
 * @see WP_Customize_Setting
 */
class WP_Customize_Filter_Setting extends WP_Customize_Setting {

	/**
	 * Saves the value of the setting, using the related API.
	 *
	 * @since WP 3.4.0
	 *
	 * @param mixed $value The value to update.
	 */
	public function update( $value ) {}
}
