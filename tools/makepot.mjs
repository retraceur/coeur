#!/usr/bin/env node

import spawn from 'cross-spawn';
import files from './data/translatable-scripts.json' with { type: "json" };
import potHeaders from './data/pot-headers.json' with { type: "json" };

let potErrors = [];
let successAmount = 0;

const generatePot = ( file ) => {
	return new Promise( ( resolve, reject ) => {
		const t = spawn(
			'wp',
			['i18n', 'make-pot', '.', `i18n/js/${ file.potName }`, `--include="${ file.jsName }"`, '--ignore-domain', `--headers='${ JSON.stringify( potHeaders ) }'`],
			{
				shell: true,
			}
		);

		if ( t.stdout ) {
			t.stdout.on( 'data', () => {
				successAmount += 1;
			} );
		}

		if ( t.stderr ) {
			t.stderr.on( 'data', () => {
				potErrors = [...potErrors, file.potName];
			} );
		}

		t.on( 'exit', ( code ) => {
			if ( code === 0 ) {
				resolve();
			} else {
				reject(
					new Error(
						`Pot generation failed for: ${ file.potName }`
					)
				);
			}
		} );

		t.on( 'error', reject );
	} );
}

async function loop() {
	console.log( '\n🌍 Pot files generation started, please wait...' );

	for( const file of files ) {
		await generatePot( file );
	};

	if ( successAmount ) {
		console.log( `\n✅ ${ successAmount } file(s) successfully generated.` );
	}

	if ( potErrors.length ) {
		console.log( `\n❌ ${ potErrors.length } file(s) were not generated due to an error. Here are the files:` );
		potErrors.forEach( ( potName ) => {
			console.log( `- ${ potName }` );
		} );
	}

	console.log( '' );
};

loop();
