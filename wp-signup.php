<?php
/**
 * Displays and handles the signup form on multisite.
 *
 * @package Retraceur
 */

/** Sets up the Retraceur Environment. */
require __DIR__ . '/wp-load.php';

if ( ! has_action( 'retraceur_network_signup_template', 'retraceur_reseau_activate_template' ) ) {
	/**
	 * Fires before the Site Sign-up page is loaded.
	 *
	 * @since WP 4.4.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'before_signup_header',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	/**
	 * Fires before the site Sign-up form.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'before_signup_form',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	/**
	 * Filters the type of site sign-up.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 *
	 * @param string $active_signup String that returns registration type. The value can be
	 *                              'all', 'none', 'blog', or 'user'.
	 */
	apply_filters_deprecated(
		'wpmu_active_signup',
		array( '' ),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	/**
	 * Fires after the sign-up forms, before wp_footer.
	 *
	 * @since WP 3.0.0
	 * @deprecated 1.0.0 Retraceur fork.
	 */
	do_action_deprecated(
		'after_signup_form',
		array(),
		'1.0.0',
		'',
		__( 'WP Multisite feature is not supported in Retraceur.' )
	);

	wp_die(
		'<h1>' . __( 'Retraceur does not provide the Multisite feature by default.' ) . '</h1>' .
		'<p>' . __( 'Please download and install the « Retraceur Réseau » add-on.' ) . '</p>',
		500
	);
}

/**
 * Hook used by Retraceur Réseau to inject Signup code.
 *
 * @since 1.0.0 Retraceur fork.
 */
do_action( 'retraceur_network_signup_template' );
