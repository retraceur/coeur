<?php
/**
 * New User Administration Screen.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

/** Retraceur Administration Bootstrap */
require_once __DIR__ . '/admin.php';

if ( ! current_user_can( 'create_users' ) ) {
	wp_die(
		'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
		'<p>' . __( 'Sorry, you are not allowed to create users.' ) . '</p>',
		403
	);
}

if ( isset( $_REQUEST['action'] ) && 'createuser' === $_REQUEST['action'] ) {
	check_admin_referer( 'create-user', '_wpnonce_create-user' );

	// Adding a new user to this site.
	$new_user_email = wp_unslash( $_REQUEST['email'] );
	$user_details   = retraceur_validate_signup( $_REQUEST['user_login'], $new_user_email );

	if ( is_wp_error( $user_details['errors'] ) && $user_details['errors']->has_errors() ) {
		$add_user_errors = $user_details['errors'];
	} else {
		/** This filter is documented in wp-includes/user.php */
		$new_user_login = apply_filters( 'pre_user_login', sanitize_user( wp_unslash( $_REQUEST['user_login'] ), true ) );
		$meta           = wp_parse_args(
			array_intersect_key(
				$_REQUEST,
				array(
					'first_name' => '',
					'last_name'  => '',
					'url'        => '',
					'locale'     => '',
					'pass1'      => '',
				)
			),
			array(
				'add_to_blog' => get_current_blog_id(),
				'new_role'    => $_REQUEST['role'],
			)
		);

		if ( isset( $_POST['noconfirmation'] ) ) {
			add_filter( 'retraceur_send_activation_notification', '__return_false' );  // Disable confirmation email.
		}

		// Signup the user.
		$key = retraceur_signup_user( $new_user_login, $new_user_email, $meta );

		// Activate the signup if no confirmation is needed.
		if ( isset( $_POST['noconfirmation'] ) ) {
			$new_user = retraceur_activate_signup( $key );
			if ( is_wp_error( $new_user ) ) {
				$redirect = add_query_arg( array( 'update' => 'could_not_add' ), 'user-new.php' );
			} elseif ( current_user_can( 'list_users' ) ) {
				$redirect = 'users.php?update=add&id=' . $new_user['user_id'];
			} else {
				$redirect = add_query_arg(
					array(
						'update'  => 'add',
						'user_id' => $new_user['user_id'],
					),
					'user-new.php'
				);
			}
		} else {
			$redirect = add_query_arg( array( 'update' => 'newuserconfirmation' ), 'user-new.php' );
		}

		wp_redirect( $redirect );
		die();
	}
}

// Used in the HTML title tag.
$title       = __( 'Add New User' );
$parent_file = 'users.php';

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => '<p>' . __( 'To add a new user to your site, fill in the form on this screen and click the Add New User button at the bottom.' ) . '</p>' .
		             '<p>' . __( 'New users are automatically assigned a password, which they can change after logging in. You can view or edit the assigned password by clicking the Show Password button. The username cannot be changed once the user has been added.' ) . '</p>' .
					 '<p>' . __( 'By default, new users will receive an email letting them know they&#8217;ve been added as a user for your site. This email will also contain a password reset link. Uncheck the box if you do not want to send the new user a welcome email.' ) . '</p>' .
					 '<p>' . __( 'Remember to click the Add New User button at the bottom of this screen when you are finished.' ) . '</p>',
	)
);

get_current_screen()->add_help_tab(
	array(
		'id'      => 'user-roles',
		'title'   => __( 'User Roles' ),
		'content' => '<p>' . __( 'Here is a basic overview of the different user roles and the permissions associated with each one:' ) . '</p>' .
							'<ul>' .
							'<li>' . __( 'Subscribers can read regular site content but cannot create it.' ) . '</li>' .
							'<li>' . __( 'Contributors can write and manage their posts but not publish posts or upload media files.' ) . '</li>' .
							'<li>' . __( 'Authors can publish and manage their own posts, and are able to upload files.' ) . '</li>' .
							'<li>' . __( 'Editors can publish posts, manage posts as well as manage other people&#8217;s posts, etc.' ) . '</li>' .
							'<li>' . __( 'Administrators have access to all the administration features.' ) . '</li>' .
							'</ul>',
	)
);

wp_enqueue_script( 'wp-ajax-response' );
wp_enqueue_script( 'user-profile' );

require_once ABSPATH . 'wp-admin/admin-header.php';

if ( isset( $_GET['update'] ) ) {
	$messages = array();

	if ( 'add' === $_GET['update'] ) {
		$messages[] = __( 'User added.' );
	} elseif ( 'newuserconfirmation' === $_GET['update'] ) {
		$messages[] = __( 'Invitation email sent to new user. A confirmation link must be clicked before their account is created.' );
	} elseif ( 'could_not_add' === $_GET['update'] ) {
		$add_user_errors = new WP_Error( 'could_not_add', __( 'That user could not be added to this site.' ) );
	}
}
?>
<div class="wrap">
<h1 id="add-new-user">
<?php
if ( current_user_can( 'create_users' ) ) {
	_e( 'Add New User' );
} elseif ( current_user_can( 'promote_users' ) ) {
	_e( 'Add Existing User' );
}
?>
</h1>

<?php
if ( isset( $errors ) && is_wp_error( $errors ) ) :
	$error_message = '';
	foreach ( $errors->get_error_messages() as $err ) {
		$error_message .= "<li>$err</li>\n";
	}
	wp_admin_notice(
		'<ul>' . $error_message . '</ul>',
		array(
			'additional_classes' => array( 'error' ),
			'paragraph_wrap'     => false,
		)
	);
endif;

if ( ! empty( $messages ) ) {
	foreach ( $messages as $msg ) {
		wp_admin_notice(
			$msg,
			array(
				'id'                 => 'message',
				'additional_classes' => array( 'updated' ),
				'dismissible'        => true,
			)
		);
	}
}
?>

<?php
if ( isset( $add_user_errors ) && is_wp_error( $add_user_errors ) ) :
	$error_message = '';
	foreach ( $add_user_errors->get_error_messages() as $message ) {
		$error_message .= "<p>$message</p>\n";
	}
	wp_admin_notice(
		$error_message,
		array(
			'additional_classes' => array( 'error' ),
			'paragraph_wrap'     => false,
		)
	);
endif;
?>
<div id="ajax-response"></div>

<?php if ( current_user_can( 'create_users' ) ) {
	?>
<p><?php _e( 'Create a brand new user and add them to this site.' ); ?></p>
<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate"
	<?php
	/** This action is documented in wp-admin/user-new.php */
	do_action( 'user_new_form_tag' );
	?>
>
<input name="action" type="hidden" value="createuser" />
	<?php wp_nonce_field( 'create-user', '_wpnonce_create-user' ); ?>
	<?php
	// Load up the passed data, else set to a default.
	$creating = isset( $_POST['createuser'] );

	$new_user_login       = $creating && isset( $_POST['user_login'] ) ? wp_unslash( $_POST['user_login'] ) : '';
	$new_user_firstname   = $creating && isset( $_POST['first_name'] ) ? wp_unslash( $_POST['first_name'] ) : '';
	$new_user_lastname    = $creating && isset( $_POST['last_name'] ) ? wp_unslash( $_POST['last_name'] ) : '';
	$new_user_email       = $creating && isset( $_POST['email'] ) ? wp_unslash( $_POST['email'] ) : '';
	$new_user_uri         = $creating && isset( $_POST['url'] ) ? wp_unslash( $_POST['url'] ) : '';
	$new_user_role        = $creating && isset( $_POST['role'] ) ? wp_unslash( $_POST['role'] ) : '';
	$new_user_ignore_pass = $creating && isset( $_POST['noconfirmation'] ) ? wp_unslash( $_POST['noconfirmation'] ) : '';

	?>
<table class="form-table" role="presentation">
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Username' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="user_login" type="text" id="user_login" value="<?php echo esc_attr( $new_user_login ); ?>" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60" /></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="email"><?php _e( 'Email' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="email" type="email" id="email" value="<?php echo esc_attr( $new_user_email ); ?>" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="first_name"><?php _e( 'First Name' ); ?> </label></th>
		<td><input name="first_name" type="text" id="first_name" value="<?php echo esc_attr( $new_user_firstname ); ?>" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="last_name"><?php _e( 'Last Name' ); ?> </label></th>
		<td><input name="last_name" type="text" id="last_name" value="<?php echo esc_attr( $new_user_lastname ); ?>" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="url"><?php _e( 'Website' ); ?></label></th>
		<td><input name="url" type="url" id="url" class="code" value="<?php echo esc_attr( $new_user_uri ); ?>" /></td>
	</tr>
		<?php
		$languages = get_available_languages();
		if ( $languages ) :
			?>
		<tr class="form-field user-language-wrap">
			<th scope="row">
				<label for="locale">
					<?php /* translators: The user language selection field label. */ ?>
					<?php _e( 'Language' ); ?><span class="dashicons dashicons-translation" aria-hidden="true"></span>
				</label>
			</th>
			<td>
				<?php
				wp_dropdown_languages(
					array(
						'name'                        => 'locale',
						'id'                          => 'locale',
						'selected'                    => 'site-default',
						'languages'                   => $languages,
						'show_available_translations' => false,
						'show_option_site_default'    => true,
					)
				);
				?>
			</td>
		</tr>
		<?php endif; ?>
	<tr class="form-field form-required user-pass1-wrap">
		<th scope="row">
			<label for="pass1">
				<?php _e( 'Password' ); ?>
				<span class="description hide-if-js"><?php _e( '(required)' ); ?></span>
			</label>
		</th>
		<td>
			<input type="hidden" value=" " /><!-- #24364 workaround -->
			<button type="button" class="button wp-generate-pw hide-if-no-js"><?php _e( 'Generate password' ); ?></button>
			<div class="wp-pwd">
				<?php $initial_password = wp_generate_password( 24 ); ?>
				<div class="password-input-wrapper">
					<input type="password" name="pass1" id="pass1" class="regular-text" autocomplete="new-password" spellcheck="false" data-reveal="1" data-pw="<?php echo esc_attr( $initial_password ); ?>" aria-describedby="pass-strength-result" />
					<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
				</div>
				<button type="button" class="button wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>">
					<span class="dashicons dashicons-hidden" aria-hidden="true"></span>
					<span class="text"><?php _e( 'Hide' ); ?></span>
				</button>
			</div>
		</td>
	</tr>
	<tr class="form-field form-required user-pass2-wrap hide-if-js">
		<th scope="row"><label for="pass2"><?php _e( 'Repeat Password' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td>
		<input type="password" name="pass2" id="pass2" autocomplete="new-password" spellcheck="false" aria-describedby="pass2-desc" />
		<p class="description" id="pass2-desc"><?php _e( 'Type the password again.' ); ?></p>
		</td>
	</tr>
	<tr class="pw-weak">
		<th><?php _e( 'Confirm Password' ); ?></th>
		<td>
			<label>
				<input type="checkbox" name="pw_weak" class="pw-checkbox" />
				<?php _e( 'Confirm use of weak password' ); ?>
			</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e( 'Skip Confirmation Email' ); ?></th>
		<td>
			<input type="checkbox" name="noconfirmation" id="adduser-noconfirmation" value="1" />
			<label for="adduser-noconfirmation"><?php _e( 'Add the user without sending an email that requires their confirmation' ); ?></label>
		</td>
	</tr>
	<?php if ( current_user_can( 'promote_users' ) ) { ?>
	<tr class="form-field">
		<th scope="row"><label for="role"><?php _e( 'Role' ); ?></label></th>
		<td><select name="role" id="role">
			<?php
			if ( ! $new_user_role ) {
				$new_user_role = get_option( 'default_role' );
			}
			wp_dropdown_roles( $new_user_role );
			?>
			</select>
		</td>
	</tr>
	<?php } ?>
</table>

	<?php
	/** This action is documented in wp-admin/user-new.php */
	do_action( 'user_new_form', 'add-new-user' );
	?>

	<?php submit_button( __( 'Add New User' ), 'primary', 'createuser', true, array( 'id' => 'createusersub' ) ); ?>

</form>
<?php } // End if current_user_can( 'create_users' ). ?>
</div>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
