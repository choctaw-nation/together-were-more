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
	 * Constructor
	 *
	 * @param array $acf The ACF field args
	 */
	public function __construct( array $acf ) {
		$this->is_quote       = 'quote' === $acf['is_quote'];
		$this->is_video       = 'video' === $acf['is_video'];
		$this->text           = $this->is_quote ? acf_esc_html( $acf['quote'] ) : acf_esc_html( $acf['text'] );
		$this->media_location = $acf['media_location'];
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
		$markup = $this->is_quote ? '<blockquote class="font-script fs-3 mb-0">%s</blockquote>' : '<p>%s</p>';
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
			// return lite-vimeo
		}
		// return figure with image
		$markup  = '<figure class="mb-0 %s" data-aos="fade-up"><Image class="w-100 object-fit-cover" src="%s" alt="" loading="lazy" /></figure>';
		$classes = 'ratio ratio-3x2';
		if ( 'portrait' === $this->media_location ) {
			$classes .= ' h-100';
		}
		return sprintf( $markup, $classes, $this->text );
	}

	/**
	 * Echo the media
	 */
	public function the_media(): void {
		echo $this->get_the_media();
	}
}