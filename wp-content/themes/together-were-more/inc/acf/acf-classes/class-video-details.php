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
	 * The video URL
	 *
	 * @var string $video_url
	 */
	private string $video_url;

	/**
	 * The video ID
	 *
	 * @var string $video_id
	 */
	public string $video_id;

	/**
	 * Whether the video is public
	 *
	 * @var bool $is_public
	 */
	public bool $is_public;

	/**
	 * The video thumbnail URL
	 *
	 * @var string $thumbnail_url
	 */
	public string $custom_thumbnail_url;

	/**
	 * Constructor
	 *
	 * @param array $acf The ACF field args
	 */
	public function __construct( array $acf ) {
		$this->video_url            = $acf['video_url'];
		$this->is_public            = $acf['is_public'];
		$this->custom_thumbnail_url = $acf['custom_thumbnail_url'];
	}
}