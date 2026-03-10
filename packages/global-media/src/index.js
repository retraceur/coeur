/**
 * WP dependencies
 */
import { Button } from '@wordpress/components';
import domReady from '@wordpress/dom-ready';
import { createRoot, useState } from '@wordpress/element';
import { MediaUpload } from '@wordpress/media-utils';
import { __ } from '@wordpress/i18n';

/**
 * Style dependency
 */
import './opengraph.scss';

const GlobalMedia = ( { settings } ) => {
	const { id, url, siteName, siteDescription } = settings;
	const [ image, setImage ] = useState( { id: id, url: url } );

	const reset = () => {
		setImage( { id: 0, url: '' } );
	}

	return (
		<>
			{ image.url &&
				<div className="__opengraph_preview">
					<img src={ image.url } alt="Site title" />
					<div className="__opengraph_description">
						<div>{ siteName }</div>
						<p>{ siteDescription }</p>
					</div>
				</div>
			}
			<div className="__opengraph-action-buttons">
				<MediaUpload
					mode="browse"
					onSelect={ ( media ) =>
						setImage( media )
					}
					multiple={ false }
					allowedTypes={ ['image'] }
					render={ ( { open } ) => (
						<Button className={ image.id ? "button-secondary" : "button button-hero" } onClick={ open }>{ image.id ? __( 'Change Image' ) : __( 'Choose an Image' ) }</Button>
					) }
				/>

				{ image.url &&
					<Button variant="tertiary" className="__opengraph-remove-image" onClick={ reset }>{ __( 'Remove the Image' ) }</Button>
				}
			</div>
			<input
				type="hidden"
				name="default_ogengraph_image" id="default_ogengraph_image_hidden_field"
				value={ image.id }
				readOnly
			/>
		</>
	);
}

domReady( function() {
	const target = document.querySelector( '#opengraph-image' );
	const root = createRoot( target );
	const settings = window.retraceurOpengraphSettings || {};

	root.render( <GlobalMedia settings={ settings }/> );
} );
