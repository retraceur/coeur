<?php
/**
 * Media form for inclusion in the administration panels.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @global string       $post_type        Global post type.
 * @global WP_Post_Type $post_type_object Global post type object.
 * @global WP_Post      $post             Global post object.
 */
global $post_type, $post_type_object, $post;

// Flag that we're not loading the block editor.
$current_screen = get_current_screen();
$current_screen->is_block_editor( false );

if ( 'attachment' !== $post_type ) {
	wp_die( __( 'Retraceur only use this form to edit media.' ), __( 'Error: wrong object' ), array( 'back_link' => 1 ) );
}

if ( is_multisite() ) {
	add_action( 'admin_footer', '_admin_notice_post_locked' );
} else {
	$check_users = get_users(
		array(
			'fields' => 'ID',
			'number' => 2,
		)
	);

	if ( count( $check_users ) > 1 ) {
		add_action( 'admin_footer', '_admin_notice_post_locked' );
	}

	unset( $check_users );
}

wp_enqueue_script( 'post' );

if ( wp_is_mobile() ) {
	wp_enqueue_script( 'jquery-touch-punch' );
}

/**
 * Post ID global
 *
 * @name $post_ID
 * @var int
 */
$post_ID = isset( $post_ID ) ? (int) $post_ID : 0;
$user_ID = isset( $user_ID ) ? (int) $user_ID : 0;
$action  = isset( $action ) ? $action : '';

$message = false;
if ( isset( $_GET['message'] ) ) {
	$message = __( 'Media file updated.' );
}

$form_action      = 'editpost';
$nonce_action     = 'update-post_' . $post->ID;
$post_type_object = get_post_type_object( $post_type );

// All meta boxes should be defined and added before the first do_meta_boxes() call (or potentially during the do_meta_boxes action).
require_once ABSPATH . 'wp-admin/includes/meta-boxes.php';

register_and_do_post_meta_boxes( $post );

add_screen_option(
	'layout_columns',
	array(
		'max'     => 2,
		'default' => 2,
	)
);

get_current_screen()->add_help_tab(
	array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' =>
			'<p>' . __( 'This screen allows you to edit fields for metadata in a file within the media library.' ) . '</p>' .
			'<p>' . __( 'For images only, you can click on Edit Image under the thumbnail to expand out an inline image editor with icons for cropping, rotating, or flipping the image as well as for undoing and redoing. The boxes on the right give you more options for scaling the image, for cropping it, and for cropping the thumbnail in a different way than you crop the original image. You can click on Help in those boxes to get more information.' ) . '</p>' .
			'<p>' . __( 'Note that you crop the image by clicking on it (the Crop icon is already selected) and dragging the cropping frame to select the desired part. Then click Save to retain the cropping.' ) . '</p>' .
			'<p>' . __( 'Remember to click Update to save metadata entered or changed.' ) . '</p>',
	)
);

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">
<h1 class="wp-heading-inline">
<?php
echo esc_html( $title );
?>
</h1>

<?php
if ( isset( $post_new_file ) && current_user_can( $post_type_object->cap->create_posts ) ) {
	echo ' <a href="' . esc_url( admin_url( $post_new_file ) ) . '" class="page-title-action">' . esc_html__( 'Add New Media File' ) . '</a>';
}
?>

<hr class="wp-header-end">

<?php
if ( $message ) :
	wp_admin_notice(
		$message,
		array(
			'type'               => 'success',
			'dismissible'        => true,
			'id'                 => 'message',
			'additional_classes' => array( 'updated' ),
		)
	);
endif;
?>
<form name="post" action="post.php" method="post" id="post"
<?php
/**
 * Fires inside the post editor form tag.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action( 'edit_media_form_tag', $post );

$referer = wp_get_referer();
?>
>
<?php wp_nonce_field( $nonce_action ); ?>
<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID; ?>" />
<input type="hidden" id="hiddenaction" name="action" value="<?php echo esc_attr( $form_action ); ?>" />
<input type="hidden" id="originalaction" name="originalaction" value="<?php echo esc_attr( $form_action ); ?>" />
<input type="hidden" id="post_id" name="post_ID" value="<?php echo absint( $post->ID ); ?>" />
<input type="hidden" id="post_author" name="post_author" value="<?php echo esc_attr( $post->post_author ); ?>" />
<input type="hidden" id="post_type" name="post_type" value="<?php echo esc_attr( $post_type ); ?>" />
<input type="hidden" id="original_post_status" name="original_post_status" value="<?php echo esc_attr( $post->post_status ); ?>" />
<input type="hidden" id="referredby" name="referredby" value="<?php echo $referer ? esc_url( $referer ) : ''; ?>" />
<?php
wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );

/**
 * Fires at the beginning of the edit form.
 *
 * At this point, the required hidden fields and nonces have already been output.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action( 'edit_media_form_top', $post );
?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-<?php echo ( 1 === get_current_screen()->get_columns() ) ? '1' : '2'; ?>">
<div id="post-body-content">

<?php if ( post_type_supports( $post_type, 'title' ) ) { ?>
<div id="titlediv">
<div id="titlewrap">
	<?php
	/**
	 * Filters the title field placeholder text.
	 *
	 * @since 1.0.0 Retraceur fork.
	 *
	 * @param string  $text Placeholder text. Default 'Add title'.
	 * @param WP_Post $post Post object.
	 */
	$title_placeholder = apply_filters( 'enter_media_title_here', __( 'Add title' ), $post );
	?>
	<label class="screen-reader-text" id="title-prompt-text" for="title"><?php echo $title_placeholder; ?></label>
	<input type="text" name="post_title" size="30" value="<?php echo esc_attr( $post->post_title ); ?>" id="title" spellcheck="true" autocomplete="off" />
</div>
</div><!-- /titlediv -->
	<?php
}
/**
 * Fires after the title field.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @param WP_Post $post Post object.
 */
do_action( 'edit_media_form_after_title', $post );
?>
</div><!-- /post-body-content -->

<div id="postbox-container-1" class="postbox-container">
<?php do_meta_boxes( $post_type, 'side', $post ); ?>
</div>
<div id="postbox-container-2" class="postbox-container">
<?php
do_meta_boxes( null, 'normal', $post );
do_meta_boxes( null, 'advanced', $post );
?>
</div>
</div><!-- /post-body -->
<br class="clear" />
</div><!-- /poststuff -->
</form>
</div>

<?php if ( ! wp_is_mobile() && post_type_supports( $post_type, 'title' ) && '' === $post->post_title ) : ?>
<script type="text/javascript">
try{document.post.title.focus();}catch(e){}
</script>
<?php endif; ?>
