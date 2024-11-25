<?php
/**
 * Gets the email message from the user's mailbox to add as
 * a Retraceur post. Mailbox connection information must be
 * configured under Settings > Writing
 *
 * @package Retraceur
 *
 * @deprecated 1.0.0 Retraceur removed the "Post by email" feature.
 */

/** Make sure that the Retraceur bootstrap has run before continuing. */
require __DIR__ . '/wp-load.php';

_deprecated_file( basename( __FILE__ ), '1.0.0', '', '', true );

/** This filter is documented in wp-admin/options.php */
apply_filters_deprecated(
	'enable_post_by_email_configuration',
	array( true ),
	'1.0.0',
	'',
	__( 'Posting by email is not supported in Retraceur.' )
);

/**
 * Fires to allow a plugin to do a complete takeover of Post by Email.
 *
 * @since WP 2.9.0
 * @deprecated 1.0.0 Retraceur removed the "Post by email" feature.
 */
do_action_deprecated(
	'wp-mail.php', // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	array(),
	'1.0.0',
	'',
	__( 'Posting by email is not supported in Retraceur.' )
);

/**
 * Filters the original content of the email.
 *
 * Give Post-By-Email extending plugins full access to the content, either
 * the raw content, or the content of the last quoted-printable section.
 *
 * @since WP 2.8.0
 * @deprecated 1.0.0 Retraceur removed the "Post by email" feature.
 *
 * @param string $content The original email content.
 */
apply_filters_deprecated(
	'wp_mail_original_content',
	array( '' ),
	'1.0.0',
	'',
	__( 'Posting by email is not supported in Retraceur.' )
);

/**
 * Filters the content of the post submitted by email before saving.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur removed the "Post by email" feature.
 *
 * @param string $content The email content.
 */
apply_filters_deprecated(
	'phone_content',
	array( '' ),
	'1.0.0',
	'',
	__( 'Posting by email is not supported in Retraceur.' )
);

/**
 * Fires after a post submitted by email is published.
 *
 * @since WP 1.2.0
 * @deprecated 1.0.0 Retraceur removed the "Post by email" feature.
 *
 * @param int $post_ID The post ID.
 */
do_action_deprecated(
	'publish_phone',
	array( 0 ),
	'1.0.0',
	'',
	__( 'Posting by email is not supported in Retraceur.' )
);

wp_die(
	'<h1>' . __( 'Retraceur does not provide the "Post by email" feature.' ) . '</h1>' .
	'<p>' . __( 'Please use a plugin instead.' ) . '</p>',
	500
);
