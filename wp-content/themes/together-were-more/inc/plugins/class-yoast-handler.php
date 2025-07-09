<?php
/**
 * Yoast SEO Handler Class
 *
 * @package ChoctawNation
 * @subpackage Plugins
 */

namespace ChoctawNation\Plugins;

/**
 * Class Yoast_Handler
 */
class Yoast_Handler {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'wpseo_metadesc', array( $this, 'meta_description_handler' ) );
		add_filter( 'wpseo_metabox_prio', fn() => 'low' );
	}

	/**
	 * Use the excerpt as the meta description if none is set.
	 * Alternatively, use the ACF brief description if available.
	 *
	 * @param string $description The current meta description.
	 */
	public function meta_description_handler( $description ): string {
		if ( ! is_singular( 'post' ) ) {
			return $description;
		}
		$acf     = get_field( 'archive_content' );
		$excerpt = get_the_excerpt();
		if ( ! empty( $excerpt ) ) {
			return $excerpt;
		} elseif ( ! empty( $acf ) ) {
			return $acf;
		}
		return $description;
	}
}
