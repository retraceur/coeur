/**
 * Compares two semantic version strings.
 *
 * Pre-release versions (e.g. '1.0.0-beta1') are considered lower
 * than their stable counterpart (e.g. '1.0.0'), in compliance with
 * the Semantic Versioning specification.
 *
 * @param {string} installed The installed version (e.g. '8.1.0').
 * @param {string} required  The required version (e.g. '8.2').
 *
 * @return {boolean} Whether the installed version satisfies the requirement.
 */
export function isVersionSatisfied( installed, required ) {
	if ( ! installed || ! required ) {
		return true;
	}

	const splitPreRelease = ( v ) => {
		const [ version, preRelease = null ] = v.split( '-' );
		return { version, preRelease };
	};

	const a = splitPreRelease( installed );
	const b = splitPreRelease( required );

	const normalize = ( v ) =>
		v.split( '.' ).map( ( n ) => parseInt( n, 10 ) );

	const aNums = normalize( a.version );
	const bNums = normalize( b.version );

	// Do versions comparison.
	for ( let i = 0; i < Math.max( aNums.length, bNums.length ); i++ ) {
		const diff = ( aNums[ i ] ?? 0 ) - ( bNums[ i ] ?? 0 );
		if ( diff !== 0 ) {
			return diff > 0;
		}
	}

	if ( a.preRelease !== null && b.preRelease === null ) {
		return false;
	}

	return true;
}
