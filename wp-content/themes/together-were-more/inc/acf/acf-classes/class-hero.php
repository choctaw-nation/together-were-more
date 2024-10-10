<?php
/**
 * Hero Fields
 * Initial ACF Class with the Hero fields API built out.
 *
 * @package ChoctawNation
 * @subpackage ACF
 * @since 1.9
 */

namespace ChoctawNation\ACF;

/** API for the Hero Group field that gets loaded on every page. */
class Hero extends Generator {

	/** The headline
	 *
	 * @var ?string $headline
	 */
	protected ?string $headline;

	/** The subheadline
	 *
	 * @var ?string $subheadline
	 */
	protected ?string $subheadline;

	// phpcs:ignore
	protected function init_props( array $acf ) {
		$this->headline    = empty( $acf['headline'] ) ? null : esc_textarea( $acf['headline'] );
		$this->subheadline = empty( $acf['subheadline'] ) ? null : esc_textarea( $acf['subheadline'] );
		$this->set_the_image( $acf['background_image'] );
	}

	/** Returns the headline */
	public function get_the_headline(): string {
		return $this->headline || '';
	}

	/** Echoes the headline */
	public function the_headline(): void {
		echo $this->get_the_headline();
	}

	/** Check if Subheadline is empty */
	public function has_subheadline(): bool {
		return ! empty( $this->subheadline );
	}

	/** Returns the subheadline */
	public function get_the_subheadline(): string {
		return $this->subheadline || '';
	}

	/** Echoes the subheadline */
	public function the_subheadline(): void {
		echo $this->get_the_subheadline();
	}

	/** Gets the Background Image source_url */
	public function get_the_image_src(): string {
		return $this->image->src;
	}

	/** Echoes the Image source url */
	public function the_image_src(): void {
		echo $this->get_the_image_src();
	}

	/**
	 * Wrapper for `ACF_Image->get_the_image()`.
	 * Generates the img element
	 *
	 * @param string $img_class the class to add
	 * @return string the HTML
	 */
	public function get_the_image( string $img_class = '' ): string {
		return $this->image->get_the_image( $img_class );
	}

	/**
	 * Echoes the img element
	 *
	 * @param string $img_class the class to add
	 */
	public function the_image( string $img_class = '' ): void {
		echo $this->get_the_image( $img_class );
	}
}
