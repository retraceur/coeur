<?php
/**
 * Upgrade API: Block_Upgrader class.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @package Retraceur
 * @subpackage Upgrader
 */

/**
 * Core class used for upgrading/installing blocks.
 *
 * It is designed to upgrade/install blocks from a local zip, remote zip URL,
 * or uploaded zip file.
 *
 * @since 1.0.0 Retraceur fork.
 *
 * @see Plugin_Upgrader
 */
class Block_Upgrader extends Plugin_Upgrader {

	/**
	 * Initializes the upgrade strings.
	 *
	 * @since 1.0.0 Retraceur fork.
	 */
	public function upgrade_strings() {
		$this->strings['up_to_date'] = __( 'The block is at the latest version.' );
		$this->strings['no_package'] = __( 'Update package not available.' );
		/* translators: %s: Package URL. */
		$this->strings['downloading_package']  = sprintf( __( 'Downloading update from %s&#8230;' ), '<span class="code pre">%s</span>' );
		$this->strings['unpack_package']       = __( 'Unpacking the update&#8230;' );
		$this->strings['remove_old']           = __( 'Removing the old version of the block&#8230;' );
		$this->strings['remove_old_failed']    = __( 'Could not remove the old block.' );
		$this->strings['process_failed']       = __( 'Block update failed.' );
		$this->strings['process_success']      = __( 'Block updated successfully.' );
		$this->strings['process_bulk_success'] = __( 'Blocks updated successfully.' );
	}

	/**
	 * Initializes the installation strings.
	 *
	 * @since 1.0.0 Retraceur fork.
	 */
	public function install_strings() {
		$this->strings['no_package'] = __( 'Installation package not available.' );
		/* translators: %s: Package URL. */
		$this->strings['downloading_package'] = sprintf( __( 'Downloading installation package from %s&#8230;' ), '<span class="code pre">%s</span>' );
		$this->strings['unpack_package']      = __( 'Unpacking the block package&#8230;' );
		$this->strings['installing_package']  = __( 'Installing the block&#8230;' );
		$this->strings['remove_old']          = __( 'Removing the current block&#8230;' );
		$this->strings['remove_old_failed']   = __( 'Could not remove the current block.' );
		$this->strings['no_files']            = __( 'The block contains no files.' );
		$this->strings['process_failed']      = __( 'Block installation failed.' );
		$this->strings['process_success']     = __( 'Block installed successfully.' );
		/* translators: 1: Block name, 2: Block version. */
		$this->strings['process_success_specific'] = __( 'Successfully installed the block <strong>%1$s %2$s</strong>.' );

		if ( ! empty( $this->skin->overwrite ) ) {
			if ( 'update-plugin' === $this->skin->overwrite ) {
				$this->strings['installing_package'] = __( 'Updating the block&#8230;' );
				$this->strings['process_failed']     = __( 'Block update failed.' );
				$this->strings['process_success']    = __( 'Block updated successfully.' );
			}

			if ( 'downgrade-plugin' === $this->skin->overwrite ) {
				$this->strings['installing_package'] = __( 'Downgrading the block&#8230;' );
				$this->strings['process_failed']     = __( 'Block downgrade failed.' );
				$this->strings['process_success']    = __( 'Block downgraded successfully.' );
			}
		}
	}
}
