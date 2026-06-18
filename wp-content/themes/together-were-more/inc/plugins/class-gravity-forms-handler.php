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
	 * Update Submit Button Classes
	 *
	 * @param string $button The button HTML.
	 * @return string
	 */
	public function update_submit_button_classes( $button ): string {
		$dom = new \DOMDocument();
		$dom->loadHTML( $button );
		$input     = $dom->getElementsByTagName( 'input' )->item( 0 );
		$classes   = $input->getAttribute( 'class' );
		$btn_color = cno_get_primary_color();
		$classes   = "btn btn-{$btn_color} text-uppercase";
		$input->setAttribute( 'class', $classes );
		return $dom->saveHtml( $input );
	}

	/**
	 * Dequeue Gravity Forms Recaptcha Scripts where possible.
	 * The blocks should enqueue it when needed.
	 */
	public function dequeue_recaptcha_scripts() {
		if ( is_admin() ) {
			return;
		}
		if ( is_home() || is_front_page() || is_archive() ) {
			wp_dequeue_script( 'gforms_recaptcha_recaptcha' );
			wp_dequeue_script( 'gforms_recaptcha_frontend' );
		}
	}
}