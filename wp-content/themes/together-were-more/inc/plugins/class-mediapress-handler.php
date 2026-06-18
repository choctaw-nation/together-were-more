<?php
/**
 * Media Press Handler
 * Adjusts Media Press
 *
 * @package ChoctawNation
 * @subpackage Plugins
 */

namespace ChoctawNation\Plugins;

/**
 * Media Press Handler
 */
class MediaPress_Handler {
	/**
	 * Path to the Media Press configuration files.
	 *
	 * @var string $config_dir
	 */
	private $config_dir;

	/**
	 * Flag to check if Media Press configurations are available.
	 *
	 * @var bool $has_config
	 */
	public bool $has_config = false;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->config_dir = get_template_directory() . '/inc/plugins/mediapress-configs';
		if ( ! file_exists( $this->config_dir ) ) {
			return;
		}
	}

	/**
	 * Check if MediaPress is active
	 */
	public function plugin_is_active(): bool {
		$plugin_dir         = WP_PLUGIN_DIR;
		$mediapress_plugins = glob( $plugin_dir . '/mediapress*/plugin.php' );
		$mediapress_dir     = ! empty( $mediapress_plugins ) ? basename( dirname( $mediapress_plugins[0] ) ) . '/plugin.php' : '';
		return is_plugin_active( $mediapress_dir );
	}

	/**
	 * Load Media Press Configurations
	 */
	public function load_media_press_configs() {
		$files = array(
			'checklist' => 'checklist.json',
			'fields'    => 'fields.json',
		);
		foreach ( $files as $filter => $file ) {
			$config_path = $this->config_dir . '/' . $file;
			if ( file_exists( $config_path ) ) {
				$this->has_config = true;
				add_filter( "mediapress_{$filter}_config_path", fn() => $config_path );
			}
		}
	}
}