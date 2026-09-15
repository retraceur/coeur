#!/usr/bin/env node

import fs from 'node:fs';
import path from 'node:path';

const builtDir = path.resolve( './built' );
const imagesDir = path.join( builtDir, 'images' );
const images = fs.existsSync( imagesDir ) ? fs.readdirSync( imagesDir ) : [];
const files = fs.readdirSync( builtDir );

const fileType = process.argv[2] || 'css';
const destinationDir = process.argv[3] || path.resolve( './wp-admin/css' );

const findAndReplaceInfile = ( fileName, image ) => {
	const filePath = path.join( builtDir, fileName );
	const newImage = image.replace( /\.([A-Za-z0-9^\.(?!(png|jpg|jpeg|gif))]+\.)/, '.' );
	const content = fs.readFileSync( filePath, 'utf8' );

	if ( content.includes( image ) && fileName.endsWith( `.${ fileType }` ) ) {
		console.log( `Found reference to ${ image } in ${ fileName }` );

		const newContent = content.replaceAll( image, newImage );
		fs.writeFile( filePath, newContent, 'utf8', ( err ) => {
			err ? console.log( err ) : console.log( `Replaced ${ image } with ${ newImage } in ${ fileName }` );
		} );
	}
};

images.forEach( ( image ) => {
	const imagePath = path.join( imagesDir, image );

	if ( ! fs.lstatSync( imagePath ).isDirectory() ) {
		files.forEach( ( file ) => {
			if ( file !== 'images' ) {
				findAndReplaceInfile( file, image );
			}
		} );
	}
} );

files.forEach( ( file ) => {
	const sourcePath = path.join( builtDir, file );
	const destinationPath = path.join( destinationDir, file );

	if ( file.endsWith( `.${ fileType }` ) ) {
		fs.renameSync( sourcePath, destinationPath );
		console.log( `Moved: ${ sourcePath } -> ${ destinationPath }` );
	}
} );
