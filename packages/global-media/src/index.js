/**
 * WP dependencies
 */
import { Button } from '@wordpress/components';
import domReady from '@wordpress/dom-ready';
import { createRoot, useState } from '@wordpress/element';
import { MediaUpload } from '@wordpress/media-utils';
import { __ } from '@wordpress/i18n';

const GlobalMedia = () => {
	const [ image, setImage ] = useState( {} );

	if ( ! image.id ) {
		return (
			<MediaUpload
				mode="browse"
				onSelect={ ( media ) =>
					setImage( media )
				}
				multiple={ false }
				allowedTypes={ ['image'] }
				render={ ( { open } ) => (
					<Button variant="secondary" onClick={ open }>{ __( 'Choose an Image' ) }</Button>
				) }
			/>
		);
	}

	return (
		<input
			type="text"
			name="default_ogengraph_image" id="default_ogengraph_image_hidden_field"
			value={ image.id }
			readOnly
		/>
	)
}

domReady( function() {
	const target = document.querySelector( '#opengraph-image' );
	const root = createRoot( target );

	root.render( <GlobalMedia /> );
} );
