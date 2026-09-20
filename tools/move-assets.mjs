#!/usr/bin/env node

import fs from 'node:fs';
import fsp from 'node:fs/promises';
import path from 'node:path';

const builtDir = path.resolve( './built' );
const imagesDir = path.join( builtDir, 'images' );
const images = fs.existsSync( imagesDir ) ? fs.readdirSync( imagesDir ) : [];
const imageReplacements = images.map( ( image ) => {
	return {
		image: image,
		replacement: image.replace( /\.[A-Za-z0-9_-]+\.(png|jpe?g|gif)$/i, '.$1' ),
	};
} );
const files = fs.readdirSync( builtDir );

const fileType = process.argv[2] || 'css';
const destinationDir = path.resolve( process.argv[3] ) || path.resolve( './wp-admin/css' );

let replaceErrors = [];
let replaceSuccess = 0;
let moveErrors = [];
let moveSuccess = 0;

const replaceAllLiteral = ( content, search, replacement ) => {
	return content.split( search ).join( replacement );
};

const findAndReplaceInfile = async ( fileName, image ) => {
	const filePath = path.join( builtDir, fileName );
	const match = imageReplacements.find( ( r ) => r.image === image );
	const newImage = match ? match.replacement : image;
	const content = await fsp.readFile( filePath, 'utf8' );

	if ( ! content.includes( image ) ) {
		return;
	}

	const newContent = replaceAllLiteral( content, image, newImage );

	try {
		await fsp.writeFile( filePath, newContent, 'utf8' );
		replaceSuccess++;
	} catch ( err ) {
		replaceErrors.push( image );
		throw err;
	}
};

const moveFile = async ( file, filePath ) => {
	const destinationPath = path.join( destinationDir, file );

	try {
		await fsp.rename( filePath, destinationPath );
		moveSuccess++;
	} catch ( err ) {
		moveErrors.push( file );
		throw err;
	}
};

const loop = async () => {
	console.log( '\n🗜️ Moving minified assets...' );

	for ( const file of files ) {
		const filePath = path.join( builtDir, file );
		const isDirectory = fs.lstatSync( filePath ).isDirectory();

		// Replace image references in CSS files if there are any images to replace.
		if ( file.endsWith( '.min.css' ) && images.length ) {
			for ( const image of images ) {
				const imagePath = path.join( imagesDir, image );

				if ( ! fs.lstatSync( imagePath ).isDirectory() ) {
					try {
						await findAndReplaceInfile( file, image );
					} catch ( err ) {
						console.error( `\n⚠️ Error replacing "${ image }" in ${ file }:`, err.message );
					}
				}
			}
		}

		// Move minified files to the destination directory.
		if ( ! isDirectory ) {
			if ( file.endsWith( `.min.${ fileType }` ) ) {
				try {
					await moveFile( file, filePath );
				} catch ( err ) {
					console.error( `\n⚠️ Error moving ${ file }:`, err.message );
				}
			} else {
				// Remove the file from the built directory if it is not a minified file or a directory.
				fs.unlinkSync( filePath );
			}
		}
	}

	console.log( `\n✅ ${ moveSuccess } file(s) successfully moved.` );

	if ( moveErrors.length ) {
		console.log( `\n❌ ${ moveErrors.length } file(s) were not moved due to an error. Here are the files:` );
		moveErrors.forEach( ( fileName ) => {
			console.log( `- ${ fileName }` );
		} );
	}

	if ( replaceSuccess ) {
		console.log( `🏞️  ${ replaceSuccess } image reference(s) successfully replaced.` );
	}

	if ( replaceErrors.length ) {
		console.log( `\n❌ ${ replaceErrors.length } image reference(s) were not replaced due to an error. Here are the images:` );
		replaceErrors.forEach( ( image ) => {
			console.log( `- ${ image }` );
		} );
	}

	if ( images.length ) {
		fs.rm( imagesDir, { recursive: true, force: true }, ( err ) => {
			if ( err ) {
				console.error( `Error while deleting ${imagesDir}.`, err );
				return;
			}

			console.log(`${imagesDir} is deleted!`);
		} );
	}

	console.log( '' );
};

loop();
