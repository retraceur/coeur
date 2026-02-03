<?php
/**
 * Media settings administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'Sorry, you are not allowed to manage options for this site.' ) );
}

// Used in the HTML title tag.
$title       = __( 'Media Settings' );
$parent_file = 'options-general.php';

$media_options_help = '<p>' . __( 'You can set maximum sizes for images inserted into your written content; you can also insert an image as Full Size.' ) . '</p>';

if ( ! is_multisite()
	&& ( get_option( 'upload_url_path' )
		|| get_option( 'upload_path' ) && 'wp-content/uploads' !== get_option( 'upload_path' ) )
) {
	$media_options_help .= '<p>' . __( 'Uploading Files allows you to choose the folder and path for storing your uploaded files.' ) . '</p>';
}

$media_options_help .= '<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.' ) . '</p>';

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => $media_options_help,
	)
);

require_once ABSPATH . 'wp-admin/admin-header.php';

?>

<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<form action="options.php" method="post">
<?php settings_fields( 'media' ); ?>

<?php if ( current_user_can( 'upload_files' ) ) : ?>
	<h2 class="title"><?php esc_html_e( 'Global Media' ); ?></h2>
	<p><?php esc_html_e( 'These Media are used to define the site’s identity.' ); ?></p>
	<table class="form-table" role="presentation">
		<tr class="hide-if-no-js site-icon-section">
			<th scope="row"><?php _e( 'Site Icon' ); ?></th>
			<td>
				<?php
				wp_enqueue_media();
				wp_enqueue_script( 'site-icon' );

				$classes_for_upload_button = 'upload-button button-hero button';
				$classes_for_update_button = 'button';
				$classes_for_wrapper       = '';

				if ( has_site_icon() ) {
					$classes_for_wrapper         .= ' has-site-icon';
					$classes_for_button           = $classes_for_update_button;
					$classes_for_button_on_change = $classes_for_upload_button;
				} else {
					$classes_for_wrapper         .= ' hidden';
					$classes_for_button           = $classes_for_upload_button;
					$classes_for_button_on_change = $classes_for_update_button;
				}

				// Handle alt text for site icon on page load.
				$site_icon_id           = (int) get_option( 'site_icon' );
				$app_icon_alt_value     = '';
				$browser_icon_alt_value = '';

				$site_icon_url = get_site_icon_url();

				if ( $site_icon_id ) {
					$img_alt            = get_post_meta( $site_icon_id, '_wp_attachment_image_alt', true );
					$filename           = wp_basename( $site_icon_url );
					$app_icon_alt_value = sprintf(
						/* translators: %s: The selected image filename. */
						__( 'App icon preview: The current image has no alternative text. The file name is: %s' ),
						$filename
					);

					$browser_icon_alt_value = sprintf(
						/* translators: %s: The selected image filename. */
						__( 'Browser icon preview: The current image has no alternative text. The file name is: %s' ),
						$filename
					);

					if ( $img_alt ) {
						$app_icon_alt_value = sprintf(
							/* translators: %s: The selected image alt text. */
							__( 'App icon preview: Current image: %s' ),
							$img_alt
						);

						$browser_icon_alt_value = sprintf(
							/* translators: %s: The selected image alt text. */
							__( 'Browser icon preview: Current image: %s' ),
							$img_alt
						);
					}
				}
				?>

				<style>
				:root {
					--site-icon-url: url( '<?php echo esc_url( $site_icon_url ); ?>' );
				}
				</style>

				<div id="site-icon-preview" class="site-icon-preview settings <?php echo esc_attr( $classes_for_wrapper ); ?>">
					<div class="direction-wrap">
						<img id="app-icon-preview" src="<?php echo esc_url( $site_icon_url ); ?>" class="app-icon-preview" alt="<?php echo esc_attr( $app_icon_alt_value ); ?>" />
						<div class="site-icon-preview-browser">
							<svg role="img" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" class="browser-buttons"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 20a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm18 0a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm24-6a6 6 0 1 0 0 12 6 6 0 0 0 0-12Z" /></svg>
							<div class="site-icon-preview-tab">
								<img id="browser-icon-preview" src="<?php echo esc_url( $site_icon_url ); ?>" class="browser-icon-preview" alt="<?php echo esc_attr( $browser_icon_alt_value ); ?>" />
								<div class="site-icon-preview-site-title" id="site-icon-preview-site-title" aria-hidden="true"><?php bloginfo( 'name' ); ?></div>
									<svg role="img" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" class="close-button">
										<path d="M12 13.0607L15.7123 16.773L16.773 15.7123L13.0607 12L16.773 8.28772L15.7123 7.22706L12 10.9394L8.28771 7.22705L7.22705 8.28771L10.9394 12L7.22706 15.7123L8.28772 16.773L12 13.0607Z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>

				<input type="hidden" name="site_icon" id="site_icon_hidden_field" value="<?php form_option( 'site_icon' ); ?>" />
				<div class="site-icon-action-buttons">
					<button type="button"
						id="choose-from-library-button"
						class="<?php echo esc_attr( $classes_for_button ); ?>"
						data-alt-classes="<?php echo esc_attr( $classes_for_button_on_change ); ?>"
						data-size="512"
						data-choose-text="<?php esc_attr_e( 'Choose a Site Icon' ); ?>"
						data-update-text="<?php esc_attr_e( 'Change Site Icon' ); ?>"
						data-update="<?php esc_attr_e( 'Set as Site Icon' ); ?>"
						data-state="<?php echo esc_attr( has_site_icon() ); ?>"

					>
						<?php if ( has_site_icon() ) : ?>
							<?php _e( 'Change Site Icon' ); ?>
						<?php else : ?>
							<?php _e( 'Choose a Site Icon' ); ?>
						<?php endif; ?>
					</button>
					<button
						id="js-remove-site-icon"
						type="button"
						<?php echo has_site_icon() ? 'class="button button-secondary reset remove-site-icon"' : 'class="button button-secondary reset hidden"'; ?>
					>
						<?php _e( 'Remove Site Icon' ); ?>
					</button>
				</div>

				<p class="description">
					<?php
						printf(
							/* translators: 1: pixel value for icon size. 2: pixel value for icon size. */
							__( 'The Site Icon is what you see in browser tabs, and within tbe bookmark bars. It should be square and at least <code>%1$s by %2$s</code> pixels.' ),
							512,
							512
						);
					?>
				</p>

			</td>
		</tr>
		<tr>
			<th scope="row"><?php esc_html_e( 'Site’s default Open Graph image' ); ?></th>
			<td>
				<?php wp_enqueue_script( 'retraceur-global-media' ); ?>
				<div id="opengraph-image"></div>
			</td>
		</tr>

		<?php do_settings_fields( 'media', 'global' ); ?>
	</table>
<?php endif; ?>

<h2 class="title"><?php _e( 'Image sizes' ); ?></h2>
<p><?php _e( 'The sizes listed below determine the maximum dimensions in pixels to use when adding an image to the Media Library.' ); ?></p>

<table class="form-table" role="presentation">
<?php $thumbnail_size_title = __( 'Thumbnail size' ); ?>
<tr>
<th scope="row"><?php echo $thumbnail_size_title; ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php echo $thumbnail_size_title; ?></span></legend>
<label for="thumbnail_size_w"><?php _e( 'Width' ); ?></label>
<input name="thumbnail_size_w" type="number" step="1" min="0" id="thumbnail_size_w" value="<?php form_option( 'thumbnail_size_w' ); ?>" class="small-text" />
<br />
<label for="thumbnail_size_h"><?php _e( 'Height' ); ?></label>
<input name="thumbnail_size_h" type="number" step="1" min="0" id="thumbnail_size_h" value="<?php form_option( 'thumbnail_size_h' ); ?>" class="small-text" />
</fieldset>
<input name="thumbnail_crop" type="checkbox" id="thumbnail_crop" value="1"<?php checked( '1', get_option( 'thumbnail_crop' ) ); ?> />
<label for="thumbnail_crop"><?php _e( 'Crop thumbnail to exact dimensions (normally thumbnails are proportional)' ); ?></label>
</td>
</tr>

<?php $medium_size_title = __( 'Medium size' ); ?>
<tr>
<th scope="row"><?php echo $medium_size_title; ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php echo $medium_size_title; ?></span></legend>
<label for="medium_size_w"><?php _e( 'Max Width' ); ?></label>
<input name="medium_size_w" type="number" step="1" min="0" id="medium_size_w" value="<?php form_option( 'medium_size_w' ); ?>" class="small-text" />
<br />
<label for="medium_size_h"><?php _e( 'Max Height' ); ?></label>
<input name="medium_size_h" type="number" step="1" min="0" id="medium_size_h" value="<?php form_option( 'medium_size_h' ); ?>" class="small-text" />
</fieldset></td>
</tr>

<?php $large_size_title = __( 'Large size' ); ?>
<tr>
<th scope="row"><?php echo $large_size_title; ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php echo $large_size_title; ?></span></legend>
<label for="large_size_w"><?php _e( 'Max Width' ); ?></label>
<input name="large_size_w" type="number" step="1" min="0" id="large_size_w" value="<?php form_option( 'large_size_w' ); ?>" class="small-text" />
<br />
<label for="large_size_h"><?php _e( 'Max Height' ); ?></label>
<input name="large_size_h" type="number" step="1" min="0" id="large_size_h" value="<?php form_option( 'large_size_h' ); ?>" class="small-text" />
</fieldset></td>
</tr>

<?php do_settings_fields( 'media', 'default' ); ?>
</table>

<?php
/**
 * @global array $wp_settings
 */
if ( isset( $GLOBALS['wp_settings']['media']['embeds'] ) ) :
	?>
<h2 class="title"><?php _e( 'Embeds' ); ?></h2>
<table class="form-table" role="presentation">
	<?php do_settings_fields( 'media', 'embeds' ); ?>
</table>
<?php endif; ?>

<?php if ( ! is_multisite() ) : ?>
<h2 class="title"><?php _e( 'Uploading Files' ); ?></h2>
<table class="form-table" role="presentation">
	<?php
	/*
	 * If upload_url_path is not the default (empty),
	 * or upload_path is not the default ('wp-content/uploads' or empty),
	 * they can be edited, otherwise they're locked.
	 */
	if ( get_option( 'upload_url_path' )
		|| get_option( 'upload_path' ) && 'wp-content/uploads' !== get_option( 'upload_path' ) ) :
		?>
<tr>
<th scope="row"><label for="upload_path"><?php _e( 'Store uploads in this folder' ); ?></label></th>
<td><input name="upload_path" type="text" id="upload_path" value="<?php echo esc_attr( get_option( 'upload_path' ) ); ?>" class="regular-text code" />
<p class="description">
		<?php
		/* translators: %s: wp-content/uploads */
		printf( __( 'Default is %s' ), '<code>wp-content/uploads</code>' );
		?>
</p>
</td>
</tr>

<tr>
<th scope="row"><label for="upload_url_path"><?php _e( 'Full URL path to files' ); ?></label></th>
<td><input name="upload_url_path" type="text" id="upload_url_path" value="<?php echo esc_attr( get_option( 'upload_url_path' ) ); ?>" class="regular-text code" />
<p class="description"><?php _e( 'Configuring this is optional. By default, it should be blank.' ); ?></p>
</td>
</tr>
<tr>
<td colspan="2" class="td-full">
<?php else : ?>
<tr>
<td class="td-full">
<?php endif; ?>
<label for="uploads_use_yearmonth_folders">
<input name="uploads_use_yearmonth_folders" type="checkbox" id="uploads_use_yearmonth_folders" value="1"<?php checked( '1', get_option( 'uploads_use_yearmonth_folders' ) ); ?> />
	<?php _e( 'Organize my uploads into month- and year-based folders' ); ?>
</label>
</td>
</tr>

	<?php do_settings_fields( 'media', 'uploads' ); ?>
</table>
<?php endif; ?>

<?php do_settings_sections( 'media' ); ?>

<?php submit_button(); ?>

</form>

</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
