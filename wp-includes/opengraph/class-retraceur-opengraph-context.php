<?php
/**
 * Opengraph: Retraceur_Opengraph_Context class.
 *
 * Responsible of the Opengraph context structure definition.
 *
 * @since 3.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Opengraph
 */

/**
 * Class Retraceur_Opengraph_Context.
 *
 * @since 3.0.0 Retraceur fork.
 */
class Retraceur_Opengraph_Context {

	/**
	 * Text to use in the `og:title` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $title;

	/**
	 * Text to use in the `og:description` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $description;

	/**
	 * Text to use in the `og:type` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $type;

	/**
	 * URL to use in the `og:url` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $url;

	/**
	 * URL to use in the `og:image` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $image;

	/**
	 * Text to use in the `og:site_name` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public string $site_name;

	/**
	 * DateTime (ISO 8601) to use in the `og:published_time` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public ?string $published_time = null;

	/**
	 * DateTime (ISO 8601) to use in the `og:modified_time` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public ?string $modified_time = null;

	/**
	 * URL to use in the `og:author_url` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public ?string $author_url = null;

	/**
	 * Main category name to use in the `og:section` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public ?string $section = null;

	/**
	 * The list of tag names to use in the `og:tags` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public array $tags = array();

	/**
	 * The size in pixels to use in the `og:image_height` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var integer
	 */
	public ?int $image_width  = null;

	/**
	 * The size in pixels to use in the `og:image_height` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var integer
	 */
	public ?int $image_height = null;

	/**
	 * Text to use for the `og:locale` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var string
	 */
	public ?string $locale = null;

	/**
	 * The list of locale names to use for the `og:alternate_locales` property.
	 *
	 * @since 3.0.0 Retraceur fork.
	 *
	 * @var array
	 */
	public array $alternate_locales = array();
}
