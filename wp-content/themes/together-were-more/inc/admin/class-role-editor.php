<?php
/**
 * Role Editor
 *
 * @package ChoctawNation
 */

namespace ChoctawNation\Admin;

/**
 * Role Editor
 */
class Role_Editor {
	/**
	 * Add Editor Capabilities
	 */
	public function add_editor_caps() {
		$capabilities = array(
			'editor' => array(
				'gform_full_access',
				'manage_options',
				'edit_theme_options',
			),
		);

		foreach ( $capabilities as $role => $capabilities ) {
			$role = get_role( $role );
			foreach ( $capabilities as $capability ) {
				$role->add_cap( $capability );
			}
		}
	}
}