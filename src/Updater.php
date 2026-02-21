<?php
/**
 * The Updater class file.
 *
 * @package Sjdworld\SjdwTheme
 */

declare(strict_types=1);

namespace Sjdworld\SjdwTheme;

/**
 * The Updater class.
 */
class Updater {

	/**
	 * The repo path.
	 *
	 * @var string
	 */
	const REPO_PATH = 'sjdworld/sjdw-theme';

	/**
	 * Register actions.
	 *
	 * @return self
	 */
	public function init(): self {

		// Get the transient data.
		add_filter( 'site_transient_update_themes', array( $this, 'get_update_info' ) );

		return $this;
	}

	/**
	 * Get plugin update information.
	 *
	 * @param mixed $transient The transient data for all plugins.
	 *
	 * @return mixed
	 */
	public function get_update_info( $transient ) {

		// Exit if not update lookup.
		if ( ! is_admin() || empty( $transient ) ) {
			return $transient;
		}

		$basename = 'sjdw-theme';
		$theme    = wp_get_theme( $basename );
		$local    = array(
			'theme'        => $basename,
			'version'      => (string) $theme->get( 'Version' ),
			'new_version'  => '',
			'requires'     => (string) $theme->get( 'Requires at least' ),
			'requires_php' => (string) $theme->get( 'Requires PHP' ),
			'url'          => '',
			'package'      => '',
		);

		$remote = $this->get_remote_data();

		if ( ! empty( $remote ) ) {

			$blog_version = get_bloginfo( 'version' );
			$php_version  = constant( 'PHP_VERSION' );

			if (
				! empty( $remote['version'] ) &&
				! empty( $remote['requires'] ) &&
				! empty( $remote['requires_php'] ) &&
				! empty( $remote['package'] ) &&
				version_compare( $remote['version'], $local['version'], '>' ) &&
				version_compare( $remote['requires'], $blog_version, '<' ) &&
				version_compare( $remote['requires_php'], $php_version, '<' )
			) {
				$local['new_version']  = $remote['version'];
				$local['requires']     = $remote['requires'];
				$local['requires_php'] = $remote['requires_php'];
				$local['package']      = $remote['package'];
			}
		}

		if ( ! empty( $local['new_version'] ) ) {
			$transient->response[ $basename ] = $local;
		} else {
			$transient->no_update[ $basename ] = $local;
		}

		return $transient;
	}

	/**
	 * Get the remote theme data.
	 *
	 * @return string[]
	 */
	public function get_remote_data(): array {

		$translug  = md5( 'sjdw-theme-remote' );
		$transient = get_transient( $translug );
		$transient = is_array( $transient ) ? $transient : array();

		if ( ! empty( $transient ) ) {
			return $transient;
		}

		// Get the repo relative path.
		$repo_path = $this->get_repo_path();

		// Get the response.
		$response = wp_remote_get(
			"https://api.github.com/repos/{$repo_path}/releases",
			array(
				'timeout'   => 10,
				'sslverify' => false,
				'headers'   => array(
					'Accept' => 'application/json',
				),
			)
		);

		if (
			is_wp_error( $response )
			|| 200 !== wp_remote_retrieve_response_code( $response )
			|| empty( wp_remote_retrieve_body( $response ) )
		) {
			return $transient;
		}

		// Dencode the response body.
		$result = json_decode( wp_remote_retrieve_body( $response ) );

		if ( empty( $result ) || ! is_array( $result ) ) {
			return $transient;
		}

		// Get the latest release.
		$release = array_shift( $result );

		if (
			empty( $release->tag_name ) ||
			empty( $release->assets[0]->name ) ||
			'sjdw-theme.zip' !== $release->assets[0]->name ||
			empty( $release->assets[0]->browser_download_url )
		) {
			return $transient;
		}

		// Get the style sheet data.
		$data = get_file_data(
			"https://raw.githubusercontent.com/{$repo_path}/{$release->tag_name}/style.css",
			array(
				'Version'     => 'Version',
				'RequiresWP'  => 'Requires at least',
				'RequiresPHP' => 'Requires PHP',
			)
		);

		if (
			empty( $data['Version'] ) ||
			empty( $data['RequiresWP'] ) ||
			empty( $data['RequiresPHP'] )
		) {
			return $transient;
		}

		$transient = array(
			'version'      => $data['Version'],
			'requires'     => $data['RequiresWP'],
			'requires_php' => $data['RequiresPHP'],
			'package'      => $release->assets[0]->browser_download_url,
		);

		set_transient( $translug, $transient, constant( 'WEEK_IN_SECONDS' ) );

		return $transient;
	}

	/**
	 * Get the repo path.
	 *
	 * @return string|null
	 */
	public function get_repo_path(): ?string {
		return self::REPO_PATH;
	}
}
