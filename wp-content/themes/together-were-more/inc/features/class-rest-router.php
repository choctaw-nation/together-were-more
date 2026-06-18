<?php
/**
 * Rest Router
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

use WP_Error;
use WP_REST_Response;
use WP_HTML_Tag_Processor;


/**
 * Class Rest_Router
 *
 * This class handles the registration of REST API routes for the Choctaw Nation theme.
 */
class Rest_Router {
	/**
	 * The namespace for the REST API.
	 *
	 * @var string $namespace
	 */
	private string $namespace;

	/**
	 * The version for the REST API.
	 *
	 * @var int $version
	 */
	private int $version;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->namespace = 'cno';
		$this->version   = 1;
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register REST API routes.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace . '/v' . $this->version,
			'/current-feature',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_featured_person' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Get the featured person for the current feature.
	 *
	 * @return WP_REST_Response|WP_Error
	 */
	public function get_featured_person(): WP_REST_Response|WP_Error {
		$twm_homepage_id = 2;
		$featured_person = get_field( 'current_feature_featured_profile', $twm_homepage_id );
		if ( ! $featured_person ) {
			return new WP_Error( 'invalid_featured_person', 'Couldn\'t find the featured person!', array( 'status' => 400 ) );
		}
		$post_data = array(
			'featured_image' => $this->parse_featured_image( $featured_person->ID ),
			'name'           => $featured_person->post_title,
			'title'          => mp_get_field( 'meta_profile_title', $featured_person->ID, ),
			'bitly'          => mp_get_field( 'meta_bitly', $featured_person->ID, ),
		);

		return rest_ensure_response(
			array(
				'success' => true,
				'data'    => $post_data,
			)
		);
	}

	/**
	 * Parse the featured image for a post.
	 *
	 * @param int $post_id The ID of the post.
	 * @return array An array containing the image data.
	 */
	private function parse_featured_image( int $post_id ): array {
		$featured_image = get_the_post_thumbnail( $post_id, 'story-landscape' );
		if ( ! $featured_image ) {
			return array();
		}
		$image_data = array();
		$processor  = new WP_HTML_Tag_Processor( $featured_image );
		if ( $processor->next_tag( 'img' ) ) {
			$image_data['src']    = $processor->get_attribute( 'src' );
			$image_data['alt']    = $processor->get_attribute( 'alt' );
			$image_data['srcset'] = $processor->get_attribute( 'srcset' );
		}

		return $image_data;
	}
}
