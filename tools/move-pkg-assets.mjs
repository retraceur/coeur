#!/usr/bin/env node

import fs from 'node:fs';
import fsp from 'node:fs/promises';
import path from 'node:path';

const builtDir = path.resolve( './../../built' );
const files = fs.readdirSync( builtDir );

let moveErrors = [];
let moveSuccess = 0;

const moveFile = async ( filePath, destinationPath ) => {
	try {
		await fsp.rename( filePath, destinationPath );
		moveSuccess++;
	} catch ( err ) {
		moveErrors.push( path.basename( filePath ) );
		throw err;
	}
};

const loop = async () => {
	console.log( '\n🗜️ Moving package assets...' );

	for ( const file of files ) {
		const filePath = path.join( builtDir, file );
		const isDirectory = fs.lstatSync( filePath ).isDirectory();
		let destinationPath = '';

		// Move package files to the destination directory.
		if ( ! isDirectory ) {
			if ( file.endsWith( `.css` ) ) {
				destinationPath = path.join( './../../wp-admin/css', file );
			} else if ( file.endsWith( `.js` ) ) {
				destinationPath = path.join( './../../wp-admin/js', file );
			} else if ( file.endsWith( `.php` ) ) {
				destinationPath = path.join( './../../wp-includes/assets', file );
			} else {
				fs.unlinkSync( filePath );
			}

			try {
				await moveFile( filePath, destinationPath );
			} catch ( err ) {
				console.error( `\n⚠️ Error moving ${ file }:`, err.message );
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

	console.log( '' );
};

loop();
