<?php
/**
 * General settings administration panel.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

/** Retraceur Translation Installation API */
require_once ABSPATH . 'wp-admin/includes/translation-install.php';

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'Sorry, you are not allowed to manage options for this site.' ) );
}

// Used in the HTML title tag.
$title       = __( 'General Settings' );
$parent_file = 'options-general.php';
/* translators: Date and time format for exact current time, mainly about timezones, see https://www.php.net/manual/datetime.format.php */
$timezone_format = _x( 'Y-m-d H:i:s', 'timezone date format' );

add_action( 'admin_head', 'options_general_add_js' );

$options_help = '<p>' . __( 'The fields on this screen determine some of the basics of your site setup.' ) . '</p>' .
	'<p>' . __( 'Most themes show the site title at the top of every page, in the title bar of the browser, and as the identifying name for syndicated feeds. Many themes also show the tagline.' ) . '</p>';

if ( ! is_multisite() ) {
	$options_help .= '<p>' . __( 'Two terms you will want to know are the Retraceur URL and the site URL. The Retraceur URL is where the core Retraceur installation files are, and the site URL is the address a visitor uses in the browser to go to your site.' ) . '</p>' .
		'<p>' . esc_html__( 'Though the terms refer to two different concepts, in practice, they can be the same address or different. For example, you can have the core Retraceur installation files in the root directory (`https://example.com`), in which case the two URLs would be the same. Or the Retraceur files can be in a subdirectory (`https://example.com/subsite`). In that case, the Retraceur URL and the site URL would be different.' ) . '</p>' .
		'<p>' . sprintf(
			/* translators: 1: http://, 2: https:// */
			esc_html__( 'Both Retraceur URL and site URL can start with either %1$s or %2$s. A URL starting with %2$s requires an SSL certificate, so be sure that you have one before changing to %2$s. With %2$s, a padlock will appear next to the address in the browser address bar. Both %2$s and the padlock signal that your site meets some basic security requirements, which can build trust with your visitors and with search engines.' ),
			'<code>http://</code>',
			'<code>https://</code>'
		) . '</p>' .
		'<p>' . __( 'If you want site visitors to be able to register themselves, check the membership box. If you want the site administrator to register every new contributor, leave the box unchecked. In either case, you can set a default contributor role for all new contributors.' ) . '</p>';
}

$options_help .= '<p>' . __( 'You can set the language, and Retraceur will automatically download and install the translation files (available if your filesystem is writable).' ) . '</p>' .
	'<p>' . __( 'UTC means Coordinated Universal Time.' ) . '</p>' .
	'<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.' ) . '</p>';

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => $options_help,
	)
);

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<form method="post" action="options.php" novalidate="novalidate">
<?php settings_fields( 'general' ); ?>

<table class="form-table" role="presentation">

<tr>
<th scope="row"><label for="blogname"><?php _e( 'Site Title' ); ?></label></th>
<td><input name="blogname" type="text" id="blogname" value="<?php form_option( 'blogname' ); ?>" class="regular-text" /></td>
</tr>

<?php
if ( ! is_multisite() ) {
	/* translators: Site tagline. */
	$sample_tagline = __( 'Just another Retraceur site' );
} else {
	/* translators: %s: Network title. */
	$sample_tagline = sprintf( __( 'Just another %s site' ), get_network()->site_name );
}
$tagline_description = sprintf(
	/* translators: %s: Site tagline example. */
	__( 'In a few words, explain what this site is about. Example: &#8220;%s.&#8221;' ),
	$sample_tagline
);
?>
<tr>
<th scope="row"><label for="blogdescription"><?php _e( 'Tagline' ); ?></label></th>
<td><input name="blogdescription" type="text" id="blogdescription" aria-describedby="tagline-description" value="<?php form_option( 'blogdescription' ); ?>" class="regular-text" />
<p class="description" id="tagline-description"><?php echo $tagline_description; ?></p></td>
</tr>

<?php if ( ! is_multisite() ) {
	$wp_site_url_class = '';
	$wp_home_class     = '';
	if ( defined( 'WP_SITEURL' ) ) {
		$wp_site_url_class = ' disabled';
	}
	if ( defined( 'WP_HOME' ) ) {
		$wp_home_class = ' disabled';
	}
	?>

<tr>
<th scope="row"><label for="siteurl"><?php _e( 'Retraceur Address (URL)' ); ?></label></th>
<td><input name="siteurl" type="url" id="siteurl" value="<?php form_option( 'siteurl' ); ?>"<?php disabled( defined( 'WP_SITEURL' ) ); ?> class="regular-text code<?php echo $wp_site_url_class; ?>" /></td>
</tr>

<tr>
<th scope="row"><label for="home"><?php _e( 'Site Address (URL)' ); ?></label></th>
<td><input name="home" type="url" id="home" aria-describedby="home-description" value="<?php form_option( 'home' ); ?>"<?php disabled( defined( 'WP_HOME' ) ); ?> class="regular-text code<?php echo $wp_home_class; ?>" />
	<?php if ( ! defined( 'WP_HOME' ) ) : ?>
<p class="description" id="home-description">
	<?php esc_html__( 'Enter the same address here unless you want your site home page to be different from your Retraceur installation directory.' ); ?>
</p>
<?php endif; ?>
</td>
</tr>

<?php } ?>

<tr>
<th scope="row"><label for="new_admin_email"><?php _e( 'Administration Email Address' ); ?></label></th>
<td><input name="new_admin_email" type="email" id="new_admin_email" aria-describedby="new-admin-email-description" value="<?php form_option( 'admin_email' ); ?>" class="regular-text ltr" />
<p class="description" id="new-admin-email-description"><?php _e( 'This address is used for admin purposes. If you change this, an email will be sent to your new address to confirm it. <strong>The new address will not become active until confirmed.</strong>' ); ?></p>
<?php
$new_admin_email = get_option( 'new_admin_email' );
if ( $new_admin_email && get_option( 'admin_email' ) !== $new_admin_email ) {
	$pending_admin_email_message = sprintf(
		/* translators: %s: New admin email. */
		__( 'There is a pending change of the admin email to %s.' ),
		'<code>' . esc_html( $new_admin_email ) . '</code>'
	);
	$pending_admin_email_message .= sprintf(
		' <a href="%1$s">%2$s</a>',
		esc_url( wp_nonce_url( admin_url( 'options.php?dismiss=new_admin_email' ), 'dismiss-' . get_current_blog_id() . '-new_admin_email' ) ),
		__( 'Cancel' )
	);
	wp_admin_notice(
		$pending_admin_email_message,
		array(
			'additional_classes' => array( 'updated', 'inline' ),
		)
	);
}
?>
</td>
</tr>

<?php
$languages    = get_available_languages();
$translations = wp_get_available_translations();
if ( ! is_multisite() && defined( 'WPLANG' ) && '' !== WPLANG && 'en_US' !== WPLANG && ! in_array( WPLANG, $languages, true ) ) {
	$languages[] = WPLANG;
}
if ( ! empty( $languages ) || ! empty( $translations ) ) {
	?>
	<tr>
		<th scope="row"><label for="WPLANG"><?php _e( 'Site Language' ); ?><span class="dashicons dashicons-translation" aria-hidden="true"></span></label></th>
		<td>
			<?php
			$locale = get_locale();
			if ( ! in_array( $locale, $languages, true ) ) {
				$locale = '';
			}

			wp_dropdown_languages(
				array(
					'name'                        => 'WPLANG',
					'id'                          => 'WPLANG',
					'selected'                    => $locale,
					'languages'                   => $languages,
					'translations'                => $translations,
					'show_available_translations' => current_user_can( 'install_languages' ) && wp_can_install_language_pack(),
				)
			);

			// Add note about deprecated WPLANG constant.
			if ( defined( 'WPLANG' ) && ( '' !== WPLANG ) && WPLANG !== $locale ) {
				_deprecated_argument(
					'define()',
					'4.0.0',
					/* translators: 1: WPLANG, 2: wp-config.php */
					sprintf( __( 'The %1$s constant in your %2$s file is no longer needed.' ), 'WPLANG', 'wp-config.php' )
				);
			}
			?>
		</td>
	</tr>
	<?php
}
?>
<tr>
<?php
$current_offset = get_option( 'gmt_offset' );
$tzstring       = get_option( 'timezone_string' );

$check_zone_info = true;

// Remove old Etc mappings. Fallback to gmt_offset.
if ( str_contains( $tzstring, 'Etc/GMT' ) ) {
	$tzstring = '';
}

if ( empty( $tzstring ) ) { // Create a UTC+- zone if no timezone string exists.
	$check_zone_info = false;
	if ( 0 === (int) $current_offset ) {
		$tzstring = 'UTC+0';
	} elseif ( $current_offset < 0 ) {
		$tzstring = 'UTC' . $current_offset;
	} else {
		$tzstring = 'UTC+' . $current_offset;
	}
}

?>
<th scope="row"><label for="timezone_string"><?php _e( 'Timezone' ); ?></label></th>
<td>

<select id="timezone_string" name="timezone_string" aria-describedby="timezone-description">
	<?php echo wp_timezone_choice( $tzstring, get_user_locale() ); ?>
</select>

<p class="description" id="timezone-description">
<?php
	printf(
		/* translators: %s: UTC abbreviation */
		__( 'Choose either a city in the same timezone as you or a %s (Coordinated Universal Time) time offset.' ),
		'<abbr>UTC</abbr>'
	);
	?>
</p>

<p class="timezone-info">
	<span id="utc-time">
	<?php
		printf(
			/* translators: %s: UTC time. */
			__( 'Universal time is %s.' ),
			'<code>' . date_i18n( $timezone_format, false, true ) . '</code>'
		);
		?>
	</span>
<?php if ( get_option( 'timezone_string' ) || ! empty( $current_offset ) ) : ?>
	<span id="local-time">
	<?php
		printf(
			/* translators: %s: Local time. */
			__( 'Local time is %s.' ),
			'<code>' . date_i18n( $timezone_format ) . '</code>'
		);
	?>
	</span>
<?php endif; ?>
</p>

<?php if ( $check_zone_info && $tzstring ) : ?>
<p class="timezone-info">
<span>
	<?php
	$now = new DateTime( 'now', new DateTimeZone( $tzstring ) );
	$dst = (bool) $now->format( 'I' );

	if ( $dst ) {
		_e( 'This timezone is currently in daylight saving time.' );
	} else {
		_e( 'This timezone is currently in standard time.' );
	}
	?>
	<br />
	<?php
	if ( in_array( $tzstring, timezone_identifiers_list( DateTimeZone::ALL_WITH_BC ), true ) ) {
		$transitions = timezone_transitions_get( timezone_open( $tzstring ), time() );

		// 0 index is the state at current time, 1 index is the next transition, if any.
		if ( ! empty( $transitions[1] ) ) {
			echo ' ';
			$message = $transitions[1]['isdst'] ?
				/* translators: %s: Date and time. */
				__( 'Daylight saving time begins on: %s.' ) :
				/* translators: %s: Date and time. */
				__( 'Standard time begins on: %s.' );
			printf(
				$message,
				/* translators: date and time format, see https://www.php.net/manual/datetime.format.php */
				'<code>' . wp_date( __( 'F j, Y g:i a' ), $transitions[1]['ts'] ) . '</code>'
			);
		} else {
			_e( 'This timezone does not observe daylight saving time.' );
		}
	}
	?>
	</span>
</p>
<?php endif; ?>
</td>
</tr>

<?php $date_format_title = __( 'Date Format' ); ?>
<tr>
<th scope="row"><?php echo $date_format_title; ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php echo $date_format_title; ?></span></legend>
<?php
	/**
	 * Filters the default date formats.
	 *
	 * @since WP 2.7.0
	 * @since WP 4.0.0 Replaced the `Y/m/d` format with `Y-m-d` (ISO date standard YYYY-MM-DD).
	 * @since WP 6.8.0 Added the `d.m.Y` format.
	 *
	 * @param string[] $default_date_formats Array of default date formats.
	 */
	$date_formats = array_unique( apply_filters( 'date_formats', array( __( 'F j, Y' ), 'Y-m-d', 'm/d/Y', 'd/m/Y', 'd.m.Y' ) ) );

	$custom = true;

foreach ( $date_formats as $format ) {
	echo "\t<label><input type='radio' name='date_format' value='" . esc_attr( $format ) . "'";
	if ( get_option( 'date_format' ) === $format ) { // checked() uses "==" rather than "===".
		echo " checked='checked'";
		$custom = false;
	}
	echo ' /> <span class="date-time-text format-i18n">' . date_i18n( $format ) . '</span><code>' . esc_html( $format ) . "</code></label><br />\n";
}

	echo '<label><input type="radio" name="date_format" id="date_format_custom_radio" value="\c\u\s\t\o\m"';
	checked( $custom );
	echo '/> <span class="date-time-text date-time-custom-text">' . __( 'Custom:' ) . '<span class="screen-reader-text"> ' .
			/* translators: Hidden accessibility text. */
			__( 'enter a custom date format in the following field' ) .
		'</span></span></label>' .
		'<label for="date_format_custom" class="screen-reader-text">' .
			/* translators: Hidden accessibility text. */
			__( 'Custom date format:' ) .
		'</label>' .
		'<input type="text" name="date_format_custom" id="date_format_custom" value="' . esc_attr( get_option( 'date_format' ) ) . '" class="small-text" />' .
		'<br />' .
		'<p><strong>' . __( 'Preview:' ) . '</strong> <span class="example">' . date_i18n( get_option( 'date_format' ) ) . '</span>' .
		"<span class='spinner'></span>\n" . '</p>';
?>
	</fieldset>
</td>
</tr>

<?php $time_format_title = __( 'Time Format' ); ?>
<tr>
<th scope="row"><?php echo $time_format_title; ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php echo $time_format_title; ?></span></legend>
<?php
	/**
	 * Filters the default time formats.
	 *
	 * @since WP 2.7.0
	 *
	 * @param string[] $default_time_formats Array of default time formats.
	 */
	$time_formats = array_unique(
		apply_filters(
			'time_formats',
			array(
				/* translators: time format, see https://www.php.net/manual/datetime.format.php */
				__( 'g:i a' ),
				'g:i A',
				'H:i'
			)
		)
	);

	$custom = true;

foreach ( $time_formats as $format ) {
	echo "\t<label><input type='radio' name='time_format' value='" . esc_attr( $format ) . "'";
	if ( get_option( 'time_format' ) === $format ) { // checked() uses "==" rather than "===".
		echo " checked='checked'";
		$custom = false;
	}
	echo ' /> <span class="date-time-text format-i18n">' . date_i18n( $format ) . '</span><code>' . esc_html( $format ) . "</code></label><br />\n";
}

	echo '<label><input type="radio" name="time_format" id="time_format_custom_radio" value="\c\u\s\t\o\m"';
	checked( $custom );
	echo '/> <span class="date-time-text date-time-custom-text">' . __( 'Custom:' ) . '<span class="screen-reader-text"> ' .
			/* translators: Hidden accessibility text. */
			__( 'enter a custom time format in the following field' ) .
		'</span></span></label>' .
		'<label for="time_format_custom" class="screen-reader-text">' .
			/* translators: Hidden accessibility text. */
			__( 'Custom time format:' ) .
		'</label>' .
		'<input type="text" name="time_format_custom" id="time_format_custom" value="' . esc_attr( get_option( 'time_format' ) ) . '" class="small-text" />' .
		'<br />' .
		'<p><strong>' . __( 'Preview:' ) . '</strong> <span class="example">' . date_i18n( get_option( 'time_format' ) ) . '</span>' .
		"<span class='spinner'></span>\n" . '</p>';
?>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="start_of_week"><?php _e( 'Week Starts On' ); ?></label></th>
<td><select name="start_of_week" id="start_of_week">
<?php
/**
 * @global WP_Locale $wp_locale Retraceur date and time locale object.
 */
global $wp_locale;

for ( $day_index = 0; $day_index <= 6; $day_index++ ) :
	$selected = ( (int) get_option( 'start_of_week' ) === $day_index ) ? 'selected="selected"' : '';
	echo "\n\t<option value='" . esc_attr( $day_index ) . "' $selected>" . $wp_locale->get_weekday( $day_index ) . '</option>';
endfor;
?>
</select></td>
</tr>
<?php do_settings_fields( 'general', 'default' ); ?>
</table>

<?php do_settings_sections( 'general' ); ?>

<?php submit_button(); ?>
</form>

</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
