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
class Media_Press_Handler {
	/**
	 * Path to the Media Press configuration files.
	 *
	 * @var string $config_dir
	 */
	private $config_dir;
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->config_dir = get_template_directory() . '/inc/plugins/mediapress-configs';
		$this->load_media_press_configs();
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
				add_filter( "mediapress_{$filter}_config_path", fn() => $config_path );
			}
		}
	}
}