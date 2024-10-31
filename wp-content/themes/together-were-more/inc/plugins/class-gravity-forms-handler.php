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
		add_action( 'admin_init', array( $this, 'allow_editors_to_manage_gf' ) );
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
		$input     = $dom->getElementsByTagName( 'input' )->item( 0 );
		$classes   = $input->getAttribute( 'class' );
		$btn_color = cno_get_primary_color();
		$classes   = "btn btn-{$btn_color} text-uppercase";
		$input->setAttribute( 'class', $classes );
		return $dom->saveHtml( $input );
	}

	/**
	 * Add Gravity Forms Capabilities to Editors
	 */
	public function allow_editors_to_manage_gf() {
		$role = get_role( 'editor' );
		$role->add_cap( 'gform_full_access' );
	}
}
