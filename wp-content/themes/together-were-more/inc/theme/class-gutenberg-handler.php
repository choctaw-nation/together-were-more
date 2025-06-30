<?php
/**
 * Gutenberg Handler
 * Handles the Controls and Settings for the Block Editor
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

/**
 * Gutenberg Handler
 */
class Gutenberg_Handler {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_assets' ), 30 );
		add_action( 'after_setup_theme', array( $this, 'cno_block_theme_support' ), 50 );
		add_action( 'init', array( $this, 'register_block_assets' ) );
		add_filter( 'block_editor_settings_all', array( $this, 'restrict_gutenberg_ui' ), 10, 1 );
		add_filter( 'allowed_block_types_all', array( $this, 'restrict_block_types' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'handle_page_templates' ) );
		add_filter( 'image_size_names_choose', array( $this, 'custom_image_sizes' ), );
	}

	/**
	 * Check if the current user is an administrator.
	 *
	 * @return bool
	 */
	private function is_admin(): bool {
		return current_user_can( 'activate_plugins' );
	}

	/**
	 * Enqueue the block editor assets that control the layout of the Block Editor.
	 */
	public function enqueue_block_assets() {
		wp_enqueue_style(
			'typekit',
			'https://use.typekit.net/mud5elq.css',
			array(),
			null // phpcs:ignore
		);
		new Asset_Loader( 'editDefaultBlocks', Enqueue_Type::script, 'admin', array() );
	}

	/**
	 * Init theme supports specific to the block editor.
	 */
	public function cno_block_theme_support() {
		$opt_in_features = array(
			'responsive-embeds',
			'editor-styles',
		);
		foreach ( $opt_in_features as $feature ) {
			add_theme_support( $feature );
		}
		$opt_out_features = array(
			'core-block-patterns',
		);
		foreach ( $opt_out_features as $feature ) {
			remove_theme_support( $feature );
		}
	}

	/**
	 * Register the block assets.
	 */
	public function register_block_assets() {
		$blocks_path = get_template_directory() . '/dist';
		$manifest    = $blocks_path . '/blocks-manifest.php';
		if ( file_exists( $manifest ) ) {
			wp_register_block_types_from_metadata_collection( $blocks_path . '/js/blocks', $blocks_path . '/blocks-manifest.php' );
		}
	}

	/**
	 * Restrict access to the locking UI to Administrators.
	 *
	 * @param array $settings Default editor settings.
	 */
	public function restrict_gutenberg_ui( $settings, ) {
		$is_administrator = $this->is_admin();

		if ( ! $is_administrator ) {
			$settings['canLockBlocks']      = false;
			$settings['codeEditingEnabled'] = false;
		}

		return $settings;
	}

	/**
	 * Filters the list of allowed block types in the block editor.
	 *
	 * This function restricts the available block types to Heading, List, Image, and Paragraph only.
	 *
	 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
	 *
	 * @return array|bool The array of allowed block types or boolean to enable/disable all.
	 */
	public function restrict_block_types( array|bool $allowed_block_types ): array|bool {
		$is_administrator = $this->is_admin();
		// Get all registered blocks if $allowed_block_types is not already set.
		if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
			$registered_blocks   = \WP_Block_Type_Registry::get_instance()->get_all_registered();
			$allowed_block_types = array_keys( $registered_blocks );
		}
		// phpcs:disable Squiz.PHP.CommentedOutCode.Found
		if ( $is_administrator ) {
			$disallowed_blocks = array(
				'core/archives',
				'core/avatar',
				'core/calendar',
				'core/categories',
				'core/comments',
				'core/comment-author-name',
				'core/comment-content',
				'core/comment-date',
				'core/comment-edit-link',
				'core/comment-reply-link',
				'core/comment-template',
				'core/comment-pagination-previous',
				'core/comments-author-avatar',
				'core/comments-pagination',
				'core/comments-pagination-next',
				'core/comments-pagination-numbers',
				'core/comments-title',
				'core/gallery',
				'core/home-link',
				'core/file',
				'core/latest-comments',
				'core/latest-posts',
				'core/loginout',
				'core/missing',
				'core/media-text',
				'core/navigation',
				'core/navigation-link',
				'core/navigation-submenu',
				'core/nextpage',
				'core/page-list-item',
				'core/page-list',
				'core/post-author',
				'core/post-author-biography',
				'core/post-author-name',
				'core/post-comment',
				'core/post-comments',
				'core/post-comments-count',
				'core/post-comments-form',
				'core/post-comments-link',
				'core/post-date',
				'core/post-navigation-link',
				'core/post-terms',
				'core/rss',
				'core/search',
				'core/site-logo',
				'core/site-tagline',
				'core/site-title',
				'core/social-link',
				'core/social-links',
				'core/spacer',
				'core/tag-cloud',
				'core/term-description',
				'core/video',
			);

			// Create a new array for the allowed blocks.
			$filtered_blocks = array();

			// Loop through each block in the allowed blocks list.
			foreach ( $allowed_block_types as $block ) {

				// Check if the block is not in the disallowed blocks list.
				if ( ! in_array( $block, $disallowed_blocks, true ) ) {

					// If it's not disallowed, add it to the filtered list.
					$filtered_blocks[] = $block;
				}
			}

			// Return the filtered list of allowed blocks
			return $filtered_blocks;
		}
		// phpcs:enable Squiz.PHP.CommentedOutCode.Found
		if ( ! $is_administrator ) {
			$allowed_block_types = array(
				'core/block',
				'core/gallery',
				'core/freeform',
				'core/group',
				'core/heading',
				'core/image',
				'core/list',
				'core/paragraph',
				'core/pattern',
				'core/quote',
				'core/shortcode',
				'core/table',
				'gravityforms/form',
			);
			return $allowed_block_types;
		}
		return $allowed_block_types;
	}

	/**
	 * Disallows the Block Editor (and editor altogether) for certain post types
	 *
	 * @return bool
	 */
	public function handle_page_templates(): bool {
		if ( ! is_admin() ) {
			return true;
		}
		global $post;
		if ( ! $post ) {
			return true;
		}
		$current_template     = get_page_template_slug( $post );
		$homepage_id          = (int) get_option( 'page_on_front' );
		$is_homepage          = ( $homepage_id && $homepage_id === $post->ID );
		$disallowed_templates = array();
		if ( in_array( $current_template, $disallowed_templates, true ) || $is_homepage ) {
			// Side effect to remove the classic editor on the pages as well
			remove_post_type_support( 'page', 'editor' );
			return false;
		}
		return true;
	}

	/**
	 * Customizes the list of image sizes available in the Block Editor.
	 */
	public function custom_image_sizes( $sizes ) {
		if ( ! $this->is_admin() ) {
			return $sizes;
		}
		// Remove the 'Large' image size from the list of available sizes.
		unset( $sizes['large'] );
		return array_merge(
			$sizes,
			array(
				'4k'                             => '4k',
				'profile-swiper-video-thumbnail' => 'Profile Swiper Video Thumbnail',
			)
		);
	}
}