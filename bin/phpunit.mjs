#!/usr/bin/env node
/**
 * Sets up and runs the Retraceur PHPUnit tests. Node.js built-ins only.
 *
 *   setup       Clone phpunit-testcases if missing, fetch the PHPUnit phar (never fails npm install).
 *   update      git pull --ff-only in phpunit-testcases, then refresh the phar.
 *   pin         Download the phar and write its sha256 in phpunit-testcases/phpunit-phar.json.
 *   install-db  Install Retraceur in the (disposable) tests database.
 *   test        Run PHPUnit (default). Extra arguments are passed to PHPUnit.
 *
 * Environment: PHP_BIN (PHP 8.3+ binary), PHPUNIT_TESTCASES_REPO (clone URL),
 * PHPUNIT_PHAR_BASE (phar download base URL).
 */
import { createHash } from 'node:crypto';
import { spawnSync } from 'node:child_process';
import { existsSync, mkdirSync, readFileSync, renameSync, writeFileSync } from 'node:fs';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve( dirname( fileURLToPath( import.meta.url ) ), '..' );
const casesDir = join( root, 'phpunit-testcases' );
const pharDir = join( root, '.phpunit' );
const pharConfigPath = join( casesDir, 'phpunit-phar.json' );

const REPO_URL = process.env.PHPUNIT_TESTCASES_REPO ?? 'https://github.com/retraceur/phpunit-testcases.git';
const PHAR_BASE = process.env.PHPUNIT_PHAR_BASE ?? 'https://phar.phpunit.de';
const phpBin = process.env.PHP_BIN ?? 'php';

const sha256 = ( buffer ) => createHash( 'sha256' ).update( buffer ).digest( 'hex' );
const run = ( command, args ) => spawnSync( command, args, { stdio: 'inherit' } );

function checkGitignore() {
	const file = join( root, '.gitignore' );
	const entries = existsSync( file )
		? readFileSync( file, 'utf8' ).split( /\r?\n/ ).map( ( l ) => l.trim().replace( /^\//, '' ).replace( /\/$/, '' ) )
		: [];

	for ( const entry of [ 'phpunit-testcases', '.phpunit' ] ) {
		if ( ! entries.includes( entry ) ) {
			console.warn( `Warning: add "/${ entry }/" to .gitignore.` );
		}
	}
}

function ensureClone() {
	if ( existsSync( join( casesDir, '.git' ) ) ) {
		return;
	}
	if ( existsSync( casesDir ) ) {
		throw new Error( `${ casesDir } exists but is not a git clone.` );
	}

	console.log( `Cloning ${ REPO_URL }` );
	const result = run( 'git', [ 'clone', REPO_URL, casesDir ] );
	if ( result.error || result.status !== 0 ) {
		throw new Error( 'git clone failed. Is git installed and the repository reachable?' );
	}
}

function readPharConfig() {
	return JSON.parse( readFileSync( pharConfigPath, 'utf8' ) );
}

async function download( version ) {
	const url = `${ PHAR_BASE }/phpunit-${ version }.phar`;
	console.log( `Downloading ${ url }` );

	const response = await fetch( url );
	if ( ! response.ok ) {
		throw new Error( `Download failed (HTTP ${ response.status }).` );
	}
	return Buffer.from( await response.arrayBuffer() );
}

async function ensurePhar() {
	const { version, sha256: pinned } = readPharConfig();

	if ( ! pinned ) {
		throw new Error( 'No sha256 is pinned in phpunit-testcases/phpunit-phar.json. Run "npm run phpunit:pin", then commit the file in phpunit-testcases.' );
	}

	const pharPath = join( pharDir, 'phpunit.phar' );

	// The pinned checksum identifies the version: reuse the file when it matches.
	if ( existsSync( pharPath ) && sha256( readFileSync( pharPath ) ) === pinned ) {
		return pharPath;
	}

	// Missing, or left over from another version: download it and verify it.
	const buffer = await download( version );
	if ( sha256( buffer ) !== pinned ) {
		throw new Error( 'Checksum mismatch for the downloaded PHPUnit phar. Nothing was saved.' );
	}

	mkdirSync( pharDir, { recursive: true } );
	writeFileSync( `${ pharPath }.tmp`, buffer );
	renameSync( `${ pharPath }.tmp`, pharPath );

	return pharPath;
}

async function pin() {
	const config = readPharConfig();
	const hash = sha256( await download( config.version ) );

	writeFileSync( pharConfigPath, JSON.stringify( { ...config, sha256: hash }, null, 2 ) + '\n' );
	console.log( `phpunit ${ config.version } sha256: ${ hash }` );
	console.log( 'Written to phpunit-testcases/phpunit-phar.json: commit it in that repository.' );
}

function checkPhp() {
	const result = spawnSync( phpBin, [ '-r', 'echo PHP_VERSION_ID;' ], { encoding: 'utf8' } );

	if ( result.error ) {
		throw new Error( `Cannot run "${ phpBin }". Set PHP_BIN to a PHP 8.3+ binary (MAMP: /Applications/MAMP/bin/php/php8.x.x/bin/php).` );
	}
	if ( Number( result.stdout ) < 80300 ) {
		throw new Error( `PHP 8.3+ is required, "${ phpBin }" is ${ result.stdout }. Set PHP_BIN to a newer binary.` );
	}
}

async function main() {
	const [ command = 'test', ...args ] = process.argv.slice( 2 );

	if ( command === 'setup' ) {
		// Never break `npm install`: warn and move on.
		try {
			checkGitignore();
			ensureClone();
			await ensurePhar();
		} catch ( error ) {
			console.warn( `phpunit setup skipped: ${ error.message }` );
		}
		return 0;
	}

	if ( command === 'update' ) {
		ensureClone();
		const result = run( 'git', [ '-C', casesDir, 'pull', '--ff-only' ] );
		if ( result.status !== 0 ) {
			return 1;
		}
		await ensurePhar();
		return 0;
	}

	if ( command === 'pin' ) {
		ensureClone();
		await pin();
		return 0;
	}

	if ( command === 'install-db' ) {
		ensureClone();
		checkPhp();
		return run( phpBin, [ join( casesDir, 'install.php' ) ] ).status ?? 1;
	}

	if ( command === 'test' ) {
		ensureClone();
		const pharPath = await ensurePhar();
		checkPhp();

		const hasConfig = args.some( ( a ) => a === '-c' || a.startsWith( '--configuration' ) );
		const phpunitArgs = hasConfig ? args : [ '--configuration', join( casesDir, 'phpunit.xml.dist' ), ...args ];

		return run( phpBin, [ pharPath, ...phpunitArgs ] ).status ?? 1;
	}

	throw new Error( `Unknown command "${ command }". Use setup, update, pin, install-db or test.` );
}

main().then(
	( code ) => process.exit( code ),
	( error ) => {
		console.error( `phpunit: ${ error.message }` );
		process.exit( 1 );
	}
);
