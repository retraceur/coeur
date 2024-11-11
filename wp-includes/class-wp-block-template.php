<?php
/**
 * Blocks API: WP_Block_Template class.
 *
 * @since WP 5.8.0
 * @since 1.0.0 motsVertueux fork.
 *
 * @package motsVertueux
 */

/**
 * Class representing a block template.
 *
 * @since WP 5.8.0
 */
#[AllowDynamicProperties]
class WP_Block_Template {

	/**
	 * Type: wp_template.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $type;

	/**
	 * Theme.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $theme;

	/**
	 * Template slug.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $slug;

	/**
	 * ID.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $id;

	/**
	 * Title.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $title = '';

	/**
	 * Content.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $content = '';

	/**
	 * Description.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $description = '';

	/**
	 * Source of the content. `theme` and `custom` is used for now.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $source = 'theme';

	/**
	 * Origin of the content when the content has been customized.
	 * When customized, origin takes on the value of source and source becomes
	 * 'custom'.
	 *
	 * @since WP 5.9.0
	 * @var string|null
	 */
	public $origin;

	/**
	 * Post ID.
	 *
	 * @since WP 5.8.0
	 * @var int|null
	 */
	public $wp_id;

	/**
	 * Template Status.
	 *
	 * @since WP 5.8.0
	 * @var string
	 */
	public $status;

	/**
	 * Whether a template is, or is based upon, an existing template file.
	 *
	 * @since WP 5.8.0
	 * @var bool
	 */
	public $has_theme_file;

	/**
	 * Whether a template is a custom template.
	 *
	 * @since WP 5.9.0
	 *
	 * @var bool
	 */
	public $is_custom = true;

	/**
	 * Author.
	 *
	 * A value of 0 means no author.
	 *
	 * @since WP 5.9.0
	 * @var int|null
	 */
	public $author;

	/**
	 * Plugin.
	 *
	 * @since WP 6.7.0
	 * @var string|null
	 */
	public $plugin;

	/**
	 * Post types.
	 *
	 * @since WP 5.9.0
	 * @var string[]|null
	 */
	public $post_types;

	/**
	 * Area.
	 *
	 * @since WP 5.9.0
	 * @var string|null
	 */
	public $area;

	/**
	 * Modified.
	 *
	 * @since WP 6.3.0
	 * @var string|null
	 */
	public $modified;
}
