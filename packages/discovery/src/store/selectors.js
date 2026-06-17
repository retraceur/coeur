/**
 * WP dependencies.
 */
import { __, sprintf } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import { isVersionSatisfied } from './utils/version';

/**
 * Returns the discovery settings.
 *
 * @param {Object} state Global application state.
 * @return {Object} The discovery settings.
 */
export const getSettings = ( state ) => {
	return state.settings || {};
};

/**
 * Returns whether a repository is compatible with the current
 * Retraceur and PHP versions.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {{ compatible: boolean, reasons: string[] }} Compatibility result.
 */
export function getRepositoryCompatibility( state, repository ) {
	const details  = state?.details?.[ repository ] ?? {};
	const versions = state?.settings?.versions ?? {};
	const reasons  = [];

	if ( details.requires_retraceur && versions.retraceur ) {
		if ( ! isVersionSatisfied( versions.retraceur, details.requires_retraceur ) ) {
			reasons.push(
				sprintf(
					/* Translators: 1: required version, 2: installed version. */
					__( 'Requires Retraceur %1$s or higher. You are running %2$s.' ),
					details.requires_retraceur,
					versions.retraceur
				)
			);
		}
	}

	if ( details.requires_php && versions.php ) {
		if ( ! isVersionSatisfied( versions.php, details.requires_php ) ) {
			reasons.push(
				sprintf(
					/* Translators: 1: required version, 2: installed version. */
					__( 'Requires PHP %1$s or higher. You are running %2$s.' ),
					details.requires_php,
					versions.php
				)
			);
		}
	}

	return {
		compatible: reasons.length === 0,
		reasons,
	};
}

/**
 * Returns whether the repositories are being requested.
 *
 * @param {Object} state Global application state.
 *
 * @return {boolean} Whether the repositories are being requested.
 */
export function isRequestingRepositories( state ) {
	return state?.isRequestingRepositories ?? false;
}

/**
 * Returns the repositories.
 *
 * @param {Object} state Global application state.
 *
 * @return {Array} Repositories.
 */
export function getRepositories( state ) {
	return state?.results ?? [];
}

/**
 * Returns whether the releases for a given repository are being requested.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {boolean} Whether the releases are being requested.
 */
export function isRequestingReleases( state, repository ) {
	return state?.loadingReleases?.[ repository ] ?? false;
}

/**
 * Returns a repository releases.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {Array} Releases.
 */
export function getReleases( state, repository ) {
	const currentRepository = state?.results.find(
		( result ) => result.full_name === repository
	);
	return currentRepository?.releases ?? [];
}

/**
 * Returns whether the details for a given repository are being requested.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {boolean} Whether the details are being requested.
 */
export function isRequestingRepository( state, repository ) {
	return state?.loadingDetails?.[ repository ] ?? false;
}

/**
 * Returns a repository with its complementary details merged in.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {Object} Repository with details.
 */
export function getRepository( state, repository ) {
	const base    = state?.results?.find( ( r ) => r.full_name === repository ) ?? {};
	const details = state?.details?.[ repository ] ?? {};
	return { ...base, ...details };
}

/**
 * Returns whether the changelog for a given repository is being requested.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {boolean} Whether the changelog is being requested.
 */
export function isRequestingChangelog( state, repository ) {
	return state?.loadingChangelogs?.[ repository ] ?? false;
}

/**
 * Returns the changelog for a given repository.
 *
 * @param {Object} state      Global application state.
 * @param {string} repository The repository full name.
 *
 * @return {string|null} The changelog HTML content, or null if not yet fetched.
 */
export function getChangelog( state, repository ) {
	return state?.changelogs?.[ repository ] ?? null;
}
