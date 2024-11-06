<?php
/**
 * Video Details Class
 * Gets the video details out of the ACF oEmbed field
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

namespace ChoctawNation\ACF;

/**
 * Video Details Class
 */
class Video_Details {
	/**
	 * The post ID
	 *
	 * @var int $post_id
	 */
	private int $post_id;

	/**
	 * The ACF field args
	 *
	 * @var array $acf
	 */
	private array $acf;

	/**
	 * Constructor
	 *
	 * @param array $acf The ACF field args
	 * @param int   $id  The post ID
	 */
	public function __construct( array $acf, int $id ) {
		$this->post_id = $id;
		$this->acf     = $acf;
	}

	/**
	 * Gets the video details from either the passed video_details array or the primary video (set in a profile's Meta details)
	 *
	 * @return array
	 */
	public function get_the_video_details(): array {
		return $this->acf['use_primary_video'] ? $this->get_primary_video_details() : $this->get_video_details();
	}

	/**
	 * Gets the video details for the "primary" video (set in a profile's Meta details)
	 *
	 * @return array
	 */
	private function get_primary_video_details(): array {
		$video_id         = cno_extract_vimeo_id( get_field( 'meta_video_details_video_url', $this->post_id, false ) );
		$is_public        = get_field( 'meta_video_details_is_public', $this->post_id, );
		$custom_thumbnail = get_field( 'meta_video_details_custom_thumbnail', $this->post_id ) ?? '';
		$fallback_iframe  = get_field( 'meta_video_details_video_url', $this->post_id );
		$lite_vimeo       = cno_generate_lite_vimeo( $video_id, true, $custom_thumbnail );
		return array(
			'video_id'         => $video_id,
			'is_public'        => $is_public,
			'custom_thumbnail' => $custom_thumbnail,
			'fallback_iframe'  => $fallback_iframe,
			'lite_vimeo'       => $lite_vimeo,
		);
	}

	/**
	 * Gets the video details for the video in the ACF field
	 *
	 * @return array
	 */
	private function get_video_details(): array {
		$video_id         = $this->extract_video_id();
		$is_public        = $this->acf['is_public'];
		$custom_thumbnail = $this->acf['custom_thumbnail'] ?: '';
		$fallback_iframe  = $this->acf['video_url'];
		$lite_vimeo       = cno_generate_lite_vimeo( $video_id, true, $custom_thumbnail );
		return array(
			'video_id'         => $video_id,
			'is_public'        => $is_public,
			'custom_thumbnail' => $custom_thumbnail,
			'fallback_iframe'  => $fallback_iframe,
			'lite_vimeo'       => $lite_vimeo,
		);
	}

	/**
	 * Extracts the video ID from the iFrame's src param
	 *
	 * @return string
	 */
	private function extract_video_id(): string {
		$pattern = '/src="https:\/\/player\.vimeo\.com\/video\/(\d+)[^"]*"/';
		preg_match( $pattern, $this->acf['video_details']['video_url'], $matches );
		return $matches[1];
	}
}
