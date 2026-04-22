<?php
/**
 * Membership settings administration panel.
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
$title       = __( 'Membership Settings' );
$parent_file = 'options-general.php';

add_action( 'admin_print_footer_scripts', 'options_discussion_add_js' );

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => '<p>' . __( 'This screen provides many options for controlling the membership management.' ) . '</p>' .
			'<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.' ) . '</p>',
	)
);

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<form method="post" action="options.php">
<?php settings_fields( 'membership' ); ?>

<?php
if ( ! is_multisite() ) {
	$membership_title = __( 'Registration' );
	?>
	<table class="form-table indent-children" role="presentation">
	<tr>
	<th scope="row"><?php echo esc_html( $membership_title ); ?></th>
	<td><fieldset><legend class="screen-reader-text"><span><?php echo esc_html( $membership_title ); ?></span></legend><label for="users_can_register">
	<input name="users_can_register" type="checkbox" id="users_can_register" value="1" <?php checked( '1', get_option( 'users_can_register' ) ); ?> />
		<?php esc_html_e( 'Anyone can register' ); ?></label>
	</fieldset></td>
	</tr>

	<tr>
	<th scope="row"><label for="default_role"><?php esc_html_e( 'New Contributor Default Role' ); ?></label></th>
	<td>
		<?php
		/**
		 * Filters the roles to be excluded from the default_role option.
		 *
		 * @since WP 7.0.0
		 *
		 * @param string[] $roles_to_exclude Array of roles to exclude from the dropdown.
		 *                                   Defaults to administrator and editor.
		 */
		$excluded_roles = (array) apply_filters( 'default_role_dropdown_excluded_roles', array( 'administrator', 'editor' ) );

		$editable_roles = array_reverse( get_editable_roles() );

		$selected = retraceur_get_default_role();

		foreach ( $editable_roles as $role => $details ) {
			if ( in_array( $role, $excluded_roles, true ) && $role !== $selected ) {
				unset( $editable_roles[ $role ] );
			}
		}
		?>
		<select name="default_role" id="default_role"><?php wp_dropdown_roles( $selected, $editable_roles ); ?></select>
	</td>
	</tr>
	<?php do_settings_fields( 'membership', 'default' ); ?>
	</table>
<?php
}
?>

<h2 class="title"><?php esc_html_e( 'Avatars' ); ?></h2>

<p><?php esc_html_e( 'An avatar is an image that can be associated with a contributor across multiple websites. In this area, you can choose to display avatars of contributors who interact with the site.' ); ?></p>

<?php
// The above would be a good place to link to the documentation on the Gravatar functions, for putting it in themes. Anything like that?

$show_avatars       = get_option( 'show_avatars' );
$show_avatars_class = '';
if ( ! $show_avatars ) {
	$show_avatars_class = ' hide-if-js';
}
?>

<table class="form-table" role="presentation">
<tr>
<th scope="row"><?php _e( 'Avatar Display' ); ?></th>
<td>
	<label for="show_avatars">
		<input type="checkbox" id="show_avatars" name="show_avatars" value="1" <?php checked( $show_avatars, 1 ); ?> />
		<?php esc_html_e( 'Show Avatars' ); ?>
	</label>
</td>
</tr>
<tr class="avatar-settings<?php echo $show_avatars_class; ?>">
<th scope="row"><?php esc_html_e( 'Maximum Rating' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	<?php
	/* translators: Hidden accessibility text. */
	esc_html_e( 'Maximum Rating' );
	?>
</span></legend>

<?php
$ratings = array(
	/* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */
	'G'  => __( 'G &#8212; Suitable for all audiences' ),
	/* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */
	'PG' => __( 'PG &#8212; Possibly offensive, usually for audiences 13 and above' ),
	/* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */
	'R'  => __( 'R &#8212; Intended for adult audiences above 17' ),
	/* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */
	'X'  => __( 'X &#8212; Even more mature than above' ),
);
foreach ( $ratings as $key => $rating ) :
	$selected = ( get_option( 'avatar_rating' ) === $key ) ? 'checked="checked"' : '';
	echo "\n\t<label><input type='radio' name='avatar_rating' value='" . esc_attr( $key ) . "' $selected/> $rating</label><br />";
endforeach;
?>

</fieldset></td>
</tr>
<tr class="avatar-settings<?php echo $show_avatars_class; ?>">
<th scope="row"><?php esc_html_e( 'Default Avatar' ); ?></th>
<td class="defaultavatarpicker"><fieldset><legend class="screen-reader-text"><span>
	<?php
	/* translators: Hidden accessibility text. */
	_e( 'Default Avatar' );
	?>
</span></legend>

<p>
<?php esc_html_e( 'For contributors without a custom avatar of their own, you can either display a generic logo or a generated one based on their email address.' ); ?><br />
</p>

<?php
$avatar_defaults = array(
	'mystery'          => __( 'Mystery Person' ),
	'pagan'            => __( 'Pagan (Generated)' ),
	'identicon'        => __( 'Identicon (Generated)' ),
	'wavatar'          => __( 'Wavatar (Generated)' ),
	'monsterid'        => __( 'MonsterID (Generated)' ),
	'retro'            => __( 'Retro (Generated)' ),
	'robohash'         => __( 'RoboHash (Generated)' ),
);
/**
 * Filters the default avatars.
 *
 * Avatars are stored in key/value pairs, where the key is option value,
 * and the name is the displayed avatar name.
 *
 * @since WP 2.6.0
 *
 * @param string[] $avatar_defaults Associative array of default avatars.
 */
$avatar_defaults = apply_filters( 'avatar_defaults', $avatar_defaults );
$default         = get_option( 'avatar_default', 'mystery' );
$avatar_list     = '';

// Force avatars on to display these choices.
add_filter( 'pre_option_show_avatars', '__return_true', 100 );

foreach ( $avatar_defaults as $default_key => $default_name ) {
	$selected     = ( $default === $default_key ) ? 'checked="checked" ' : '';
	$avatar_list .= "\n\t<label><input type='radio' name='avatar_default' id='avatar_{$default_key}' value='" . esc_attr( $default_key ) . "' {$selected}/> ";
	$avatar_list .= get_avatar( $user_email, 32, $default_key, '', array( 'force_default' => true ) );
	$avatar_list .= ' ' . $default_name . '</label>';
	$avatar_list .= '<br />';
}

remove_filter( 'pre_option_show_avatars', '__return_true', 100 );

/**
 * Filters the HTML output of the default avatar list.
 *
 * @since WP 2.6.0
 *
 * @param string $avatar_list HTML markup of the avatar list.
 */
echo apply_filters( 'default_avatar_select', $avatar_list );
?>

</fieldset></td>
</tr>
<?php do_settings_fields( 'membership', 'avatars' ); ?>
</table>

<?php do_settings_sections( 'membership' ); ?>

<?php submit_button(); ?>
</form>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>
