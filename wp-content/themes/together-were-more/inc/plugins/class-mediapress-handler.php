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
		$this->load_media_press_configs();
		require_once get_template_directory() . '/inc/plugins/class-mediapress-fields.php';
	}

	/**
	 * Load Media Press Configurations
	 */
	private function load_media_press_configs() {
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
