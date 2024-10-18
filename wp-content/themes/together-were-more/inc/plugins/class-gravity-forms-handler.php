<?php
/**
 * Gravity Forms Handler
 * Edits the Gravity Forms output to match the design of the site.
 *
 * @package ChoctawNation
 * @subpackage Plugins
 */

namespace ChoctawNation\Plugins;

/**
 * Gravity Forms Handler
 */
class Gravity_Forms_Handler {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'gform_submit_button', array( $this, 'update_submit_button_classes' ), 10, 1 );
	}



	/**
	 * Update Submit Button Classes
	 *
	 * @param string $button The button HTML.
	 * @return string
	 */
	public function update_submit_button_classes( $button, ): string {
		$dom = new \DOMDocument();
		$dom->loadHTML( $button );
		$input              = $dom->getElementsByTagName( 'input' )->item( 0 );
		$classes            = $input->getAttribute( 'class' );
		$front_page_id      = get_option( 'page_on_front' );
		$category_spotlight = get_field( 'category_spotlight', $front_page_id )['category_to_spotlight']->name;
		$btn_color          = cno_get_category_color( $category_spotlight );
		$classes            = "btn btn-{$btn_color} text-uppercase";
		$input->setAttribute( 'class', $classes );
		return $dom->saveHtml( $input );
	}
}