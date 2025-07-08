<?php
/**
 * The global helper functions to use.
 *
 * This file should be used to define functions that are specifically meant to live in the global scope. Remember to prefix your functions with `cno_` to avoid conflicts.
 *
 * @package ChoctawNation
 */

use ChoctawNation\Plugins\MediaPress_Fields;

/**
 * Takes raw ACF field (vimeo only) URL and returns the video id.
 * (Pass `false` as 3rd parameter in `get_field` to return raw url string.)
 * Returns the video id or `false` if something goes wrong.
 *
 * @param string $url the Vimeo URL
 * @return string|false the video ID or false
 */
function cno_extract_vimeo_id( string $url ): string|false {
	$vimeo_id = str_replace( 'https://vimeo.com/', '', $url );

	// Check if vimeo_id has a slash
	if ( strpos( $vimeo_id, '/' ) !== false ) {
		$parts = explode( '/', $vimeo_id );
		if ( ! empty( $parts[1] ) ) {
			return $parts[0] . '/' . $parts[1];
		}
		return $parts[0];
	}
	return $vimeo_id;
}

/**
 * Takes raw ACF field (vimeo only) URL and converts it to `<lite-vimeo>` web component.
 * (Pass `false` as 3rd parameter in `get_field` to return raw url string.)
 * Returns web component or `false` if video is unlisted.
 *
 * @param string $video_id the video id
 * @param bool   $enable_tracking whether to enable tracking or not
 * @param string $custom_placeholder_url the custom placeholder URL
 * @return string the web component or false
 */
function cno_generate_lite_vimeo( string $video_id, bool $enable_tracking = true, string $custom_placeholder_url = '' ): string {
	$markup = "<lite-vimeo videoid='{$video_id}'";
	if ( ! empty( $custom_placeholder_url ) ) {
		$markup .= "unlisted customPlaceholder='{$custom_placeholder_url}'";
	}
	if ( $enable_tracking ) {
		$markup .= ' enableTracking';
	}
	$markup .= '></lite-vimeo>';
	return $markup;
}


/**
 * Generate HTML attributes from an array
 *
 * @param array $attributes An associative array of attributes.
 *
 * @return string
 */
function cno_generate_html_attributes( array $attributes ): string {
	$html = '';
	foreach ( $attributes as $key => $value ) {
		$html .= "{$key}='{$value}' ";
	}
	return $html;
}

/**
 * Get the Bootstrap color for a category
 *
 * @param ?string $category_name The name of the category.
 *
 * @return string
 */
function cno_get_category_color( ?string $category_name ): string {
	$color_map = array(
		'Artists'       => 'gold',
		'Culture'       => 'plum',
		'Inspirational' => 'violet',
		'Competitors'   => 'garnet',
	);
	if ( empty( $category_name ) ) {
		return 'gray';
	}
	if ( ! isset( $color_map[ $category_name ] ) ) {
		wp_die( "Category '{$category_name}' not found in color map.", 'Category Error', );
	}
	return $color_map[ $category_name ];
}

/**
 * Get an array of categories sorted by a custom order
 * (Artists, Culture, Inspire, Competitors)
 *
 * @return WP_Term[]
 */
function cno_get_categories_array(): array {
	$categories = get_categories(
		array(
			'hide_empty' => false,
			'exclude'    => get_cat_ID( 'Uncategorized' ),
		)
	);
	usort(
		$categories,
		function ( $a, $b ) {
			$order = array( 'Artists', 'Culture', 'Inspire', 'Competitors' );
			$pos_a = array_search( $a->name, $order, true );
			$pos_b = array_search( $b->name, $order, true );
			return $pos_a - $pos_b;
		}
	);
	return $categories;
}

/**
 * Gets the primary color based on the front-page category spotlight or the current category if loaded on a category archive or single post.
 */
function cno_get_primary_color(): string {
	// Get Fallback color
	$front_page_id   = get_option( 'page_on_front' );
	$active_category = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;

	// Override the active category on single post or category archive pages
	if ( is_single() ) {
		if ( ! empty( get_the_category() ) ) {
			$active_category = get_the_category()[0]->name;
		}
	} elseif ( is_category() ) {
		$active_category = single_cat_title( '', false );
	}

	// Return the color
	return cno_get_category_color( $active_category );
}

/**
 * Get a field value from MediaPress_Fields class.
 *
 * @param string   $field_name The name of the field to retrieve.
 * @param int|null $post_id    The ID of the post to retrieve the field from. Defaults to 0 (current post).
 * @param bool     $should_escape Whether to escape the field value. Defaults to true.
 *
 * @return mixed The value of the field, or null if not found.
 */
function mp_get_field( string $field_name, int|null $post_id = null, bool $should_escape = true ): mixed {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$mediapress_fields = new MediaPress_Fields( $post_id );
	return $mediapress_fields->get_field( $field_name, $should_escape );
}

/**
 * Echoes a field value from MediaPress_Fields class.
 *
 * @param string   $field_name The name of the field to retrieve.
 * @param int|null $post_id    The ID of the post to retrieve the field from. Defaults to 0 (current post).
 * @param bool     $should_escape Whether to escape the field value. Defaults to true.
 */
function mp_the_field( string $field_name, int|null $post_id = null, bool $should_escape = true ): void {
	echo mp_get_field( $field_name, $post_id, $should_escape );
}
