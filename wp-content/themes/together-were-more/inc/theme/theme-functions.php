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
