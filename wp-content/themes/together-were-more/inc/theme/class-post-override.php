<?php
/**
 * Override the default post settings
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

/**
 * Class Post_Override
 * Overrides the default post settings
 *
 * @package ChoctawNation
 */
class Post_Override {
	/**
	 * Constructor Function
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'alter_post_types' ) );
	}

	/**
	 * Alters the post type
	 */
	public function alter_post_types() {
		$this->update_labels();
	}

	/**
	 * Updates the labels for the post type
	 */
	private function update_labels() {
		$labels                     = get_post_type_labels( get_post_type_object( 'post' ) );
		$labels->name               = 'Profile';
		$labels->singular_name      = 'Profile';
		$labels->add_new            = 'Add New Profile';
		$labels->add_new_item       = 'Add New Profile';
		$labels->edit_item          = 'Edit Profile';
		$labels->new_item           = 'New Profile';
		$labels->view_item          = 'View Profile';
		$labels->view_items         = 'View Profiles';
		$labels->search_items       = 'Search Profiles';
		$labels->not_found          = 'No Profiles found';
		$labels->not_found_in_trash = 'No Profiles found in trash';
		$labels->all_items          = 'All Profiles';
		$labels->menu_name          = 'Profiles';
		$labels->name_admin_bar     = 'Profile';
		$args                       = get_post_type_object( 'post' );
		$args->labels               = $labels;
	}
}
