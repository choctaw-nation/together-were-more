<?php
/**
 * The global helper functions to use.
 *
 * This file should be used to define functions that are specifically meant to live in the global scope. Remember to prefix your functions with `cno_` to avoid conflicts.
 *
 * @package ChoctawNation
 */

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
 * Get the hover color based on the front-page category spotlight
 */
function cno_get_hover_color(): string {
	$front_page_id      = get_option( 'page_on_front' );
	$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
	return cno_get_category_color( $category_spotlight );
}
