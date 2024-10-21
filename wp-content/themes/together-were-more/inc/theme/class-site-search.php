<?php
/**
 * Class: Site Search
 * Handles Front-end Site Search
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

/**
 * Site Search Class
 */
class Site_Search {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register REST API Routes
	 */
	public function register_routes() {
		register_rest_route(
			'cno/v1',
			'/search',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'handle_search' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Handle Search Request
	 *
	 * @param \WP_REST_Request $request Request Object.
	 * @return \WP_REST_Response
	 */
	public function handle_search( \WP_REST_Request $request ): \WP_REST_Response {
		$search_query = sanitize_text_field( $request->get_param( 's' ) );

		if ( empty( $search_query ) ) {
			return new \WP_Error( 'no_query', 'No search query provided', array( 'status' => 400 ) );
		}

		$args = array(
			's'              => $search_query,
			'posts_per_page' => 5,
			'relevanssi'     => true,
		);

		$query   = new \WP_Query( $args );
		$results = array();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$meta_fields = get_field( 'meta' );
				$results[]   = array(
					'name'      => get_the_title(),
					'title'     => $meta_fields['title'],
					'id'        => get_the_ID(),
					'permalink' => get_permalink(),
					'excerpt'   => get_field( 'archive_content' ),
					'pronouns'  => $meta_fields['pronouns'],
					'category'  => $meta_fields['category']->slug,
				);
			}
			wp_reset_postdata();
		}

		return rest_ensure_response( $results );
	}
}