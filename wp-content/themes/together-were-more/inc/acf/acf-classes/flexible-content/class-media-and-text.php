<?php
/**
 * The Media and Text Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

namespace ChoctawNation\ACF;

/**
 * Media and Text Layout
 */
class Media_And_Text {
	/**
	 * The post ID
	 *
	 * @var int $id
	 */
	protected int $id;

	/**
	 * The text type
	 *
	 * @var bool $is_quote
	 */
	protected bool $is_quote;

	/**
	 * The media type
	 *
	 * @var bool $is_video
	 */
	protected bool $is_video;

	/**
	 * The text
	 *
	 * @var string $text
	 */
	protected string $text;

	/**
	 * The media location
	 *
	 * @var string $media_location
	 */
	protected string $media_location;

	/**
	 * The array containing relevant photo or video details
	 *
	 * @var array $media_details
	 */
	protected array $media_details;

	/**
	 * Constructor
	 *
	 * @param array $acf The ACF field args
	 * @param int   $id  The post ID
	 */
	public function __construct( array $acf, int $id ) {
		$this->id = $id;
		$this->init_props( $acf );
	}

	/**
	 * Initialize the properties
	 *
	 * @param array $acf The ACF field args
	 */
	protected function init_props( array $acf ): void {
		$this->is_quote       = $acf['is_quote'];
		$this->is_video       = $acf['is_video'];
		$this->text           = $this->is_quote ? acf_esc_html( $acf['quote'] ) : acf_esc_html( $acf['content'] );
		$this->media_location = $acf['media_location'];
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
	 * Get the row classes
	 *
	 * @return string
	 */
	public function get_the_row_classes(): string {
		$row_classes = array(
			'row',
			'row-cols-1',
			'row-cols-lg-2',
			'row-gap-4',
			'justify-content-between',
			'align-items-stretch',
		);
		if ( 'left' === $this->media_location ) {
			$row_classes[] = 'flex-row-reverse';
		}
		if ( $this->is_quote ) {
			$row_classes[] = 'align-items-center';
		}
		return join( ' ', $row_classes );
	}

	/**
	 * Echo the row classes
	 */
	public function the_row_classes(): void {
		echo $this->get_the_row_classes();
	}

	/**
	 * Get the content col classes
	 *
	 * @return string
	 */
	public function get_the_text_col_classes(): string {
		$col_classes = array(
			'col-lg-6',
		);
		if ( ! $this->is_quote ) {
			$col_classes[] = 'text-gray';
		}
		if ( $this->is_quote ) {
			$col_classes[] = 'd-flex flex-column justify-content-center';
		}
		return join( ' ', $col_classes );
	}

	/**
	 * Echo the content col classes
	 */
	public function the_text_col_classes(): void {
		echo $this->get_the_text_col_classes();
	}

	/**
	 * Get the content
	 *
	 * @return string
	 */
	public function get_the_text(): string {
		$markup = $this->is_quote ? '<blockquote class="font-script fs-3 mb-0" data-aos="fade-in">%s</blockquote>' : '<p>%s</p>';
		return sprintf( $markup, $this->text );
	}

	/**
	 * Echo the content
	 */
	public function the_text(): void {
		echo $this->get_the_text();
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
			'class'   => 'w-100 h-100 object-fit-' . ( $this->media_details['is_portrait'] ? 'cover' : 'contain' ),
		);

		$markup  = '<figure class="mb-0 ' . ( $this->media_details['is_portrait'] ? ' portrait-container' : ' ratio ratio-3x2' ) . ( $this->is_quote ? '"' : '" data-aos="fade-up")' ) . '>';
		$markup .= wp_get_attachment_image(
			$this->media_details['photo'],
			$this->media_details['is_portrait'] ? 'story-portrait' : 'story-landscape',
			false,
			$image_args
		);
		$markup .= '</figure>';
		return $markup;
	}

	/**
	 * Echo the media
	 */
	public function the_media(): void {
		echo $this->get_the_media();
	}
}
