<?php
/**
 * The Full Width Media and Text Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

namespace ChoctawNation\ACF;

/**
 * Media and Text Layout
 */
class Full_Width_Media_And_Text extends Media_And_Text {
	/**
	 * Constructor
	 *
	 * @param array $acf The ACF field args
	 * @param int   $id  The post ID
	 */
	public function __construct( array $acf, int $id ) {
		parent::__construct( $acf, $id );
		$this->is_quote = $acf['is_quote'];
		$this->is_video = $acf['is_video'];
		$this->text     = $this->is_quote ? acf_esc_html( $acf['quote'] ) : acf_esc_html( $acf['content'] );
		$this->set_the_media_details( $acf );
	}

	/**
	 * Initialize the properties
	 *
	 * @param array $acf The ACF field args
	 */
	protected function init_props( array $acf ): void {
		$this->is_quote = $acf['is_quote'];
		$this->is_video = $acf['is_video'];
		$this->text     = $this->is_quote ? acf_esc_html( $acf['quote'] ) : acf_esc_html( $acf['content'] );
		$this->set_the_media_details( $acf );
	}

	/**
	 * Set the media details array
	 *
	 * @param array $acf The ACF field args
	 */
	protected function set_the_media_details( array $acf ): void {
		if ( $this->is_video ) {
			$video_details       = array(
				...$acf['video_details'],
				'use_primary_video' => $acf['use_primary_video'],
			);
			$video_handler       = new Video_Details( $video_details, $this->id );
			$this->media_details = $video_handler->get_the_video_details();
		} else {
			$this->media_details = $acf['photo_details'];
		}
	}

	/**
	 * Get the content col classes
	 *
	 * @return string
	 */
	public function get_the_text_col_classes(): string {
		$col_classes = array(
			'col',
		);
		if ( ! $this->is_quote ) {
			$col_classes[] = 'text-gray';
		}
		return join( ' ', $col_classes );
	}

	/**
	 * Get the media
	 *
	 * @return string
	 */
	public function get_the_media(): string {
		if ( $this->is_video ) {
			$markup  = '<figure class="mb-0 ratio ratio-16x9">';
			$markup .= $this->media_details['lite_vimeo'] ? $this->media_details['lite_vimeo'] : $this->media_details['fallback_iframe'];
			$markup .= '</figure>';
			return $markup;
		}
		// return figure with image
		$image_args = array(
			'loading' => 'lazy',
			'class'   => 'w-100 object-fit-cover',
		);
		$markup     = '<figure class="mb-0 ratio ratio-3x2">';
		$markup    .= wp_get_attachment_image(
			$this->media_details['photo'],
			'4k',
			false,
			$image_args
		);
		$markup    .= '</figure>';
		return $markup;
	}
}
