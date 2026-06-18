<?php
/**
 * Initializes the Theme
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

use ChoctawNation\Utils\Asset_Loader;
use ChoctawNation\Utils\Enqueue_Type;

/** Builds the Theme */
class Theme_Init {
	/** The type of site
	 *
	 * @var 'nation'|'commerce' $theme_type
	 */
	private string $theme_type;

	/** Constructor Function that also loads the proper favicon package
	 *
	 * @param 'nation'|'commerce' $type the type of site to load favicons for.
	 */
	public function __construct( string $type = 'nation' ) {
		$this->theme_type = $type;
	}

	/**
	 * Bootstrap theme
	 */
	public function setup_theme() {
		$this->load_required_files();
		$this->disable_discussion();
		$this->load_favicons();
		$this->edit_roles();
		$this->allow_svg();
		$this->handle_plugins();
		$this->handle_gutenberg();
		$this->override_posts();
		$this->load_features();
		$this->cno_theme_support();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cno_scripts' ) );
		add_action( 'init', array( $this, 'alter_post_types' ) );
		add_action( 'init', array( $this, 'remove_editor_capabilities' ) );
		add_action( 'init', array( $this, 'alter_categories' ) );
		add_filter( 'oembed_response_data', array( $this, 'disable_embeds_filter_oembed_response_data' ) );
		add_filter( 'allowed_redirect_hosts', array( $this, 'add_allowed_redirect_hosts' ) );
		add_filter( 'wp_speculation_rules_configuration', array( $this, 'handle_speculative_loading' ) );
		add_filter( 'wp_resource_hints', array( $this, 'add_resource_hints' ), 10, 2 );
		add_filter( 'style_loader_tag', array( $this, 'preload_stylesheets' ), 10, 3 );
	}

	/**
	 * Disable embeds filter oembed response data
	 *
	 * @param array $data the oembed response data.
	 */
	public function disable_embeds_filter_oembed_response_data( $data ) {
		unset( $data['author_url'] );
		unset( $data['author_name'] );
		return $data;
	}

	/**
	 * Load favicons based on the type of site
	 */
	private function load_favicons() {
		add_action(
			'wp_head',
			function () {
				$href = get_stylesheet_directory_uri() . '/img/favicons';
				switch ( $this->theme_type ) {
					case 'commerce':
						$href .= '/commerce';
						break;
					case 'nation':
						$href .= '/nation';
						break;
					default:
				}
				echo "<link rel='apple-touch-icon' sizes='180x180' href='{$href}/apple-touch-icon.png'>
				<link rel='icon' type='image/png' sizes='192x192' href='{$href}/android-chrome-192x192.png'>
				<link rel='icon' type='image/png' sizes='512x512' href='{$href}/android-chrome-512x512.png'>
				<link rel='icon' type='image/png' sizes='32x32' href='{$href}/favicon-32x32.png'>
				<link rel='icon' type='image/png' sizes='16x16' href='{$href}/favicon-16x16.png'>
				<link rel='mask-icon' href='{$href}/safari-pinned-tab.svg' color='#000000'>";
			}
		);
	}

	/** Load required files. */
	private function load_required_files() {
		$base_path = get_template_directory() . '/inc';
		/** Loads the Theme Functions File (to keep the actual functions.php file clean) */
		require_once $base_path . '/theme/theme-functions.php';
	}

	/**
	 * Edit user roles and capabilities
	 */
	private function edit_roles() {
		$role_editor = new Admin\Role_Editor();
		add_action( 'admin_init', array( $role_editor, 'add_editor_caps' ) );
	}

	/**
	 * Allow SVG uploads
	 */
	private function allow_svg() {
		$svg = new Admin\Allow_SVG();
		add_filter( 'upload_mimes', array( $svg, 'cc_mime_types' ) );
		add_action( 'admin_head', array( $svg, 'fix_svg' ) );
	}

	/**
	 * Handle Plugins
	 */
	private function handle_plugins() {
		$handler = new Plugins\Plugins_Handler();
		$handler->handle_acf();
		$handler->handle_yoast();
		$handler->handle_gravity_forms();
		$handler->handle_mediapress();
		add_action( 'init', array( $handler, 'disable_plugins_per_environment' ) );
		add_filter( 'auto_update_plugin', array( $handler, 'handle_auto_update_plugin' ) );
	}

	/**
	 * Handle the block editor
	 */
	private function handle_gutenberg() {
		$gutenberg_handler = new Admin\Gutenberg_Handler();
		$gutenberg_handler->cno_block_theme_support();
		add_action( 'enqueue_block_editor_assets', array( $gutenberg_handler, 'enqueue_block_assets' ), 30 );
		add_action( 'init', array( $gutenberg_handler, 'register_block_assets' ) );
		add_filter( 'block_editor_settings_all', array( $gutenberg_handler, 'restrict_gutenberg_ui' ), 10, 1 );
		add_filter( 'allowed_block_types_all', array( $gutenberg_handler, 'restrict_block_types' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $gutenberg_handler, 'handle_page_templates' ) );
		add_filter( 'image_size_names_choose', array( $gutenberg_handler, 'custom_image_sizes' ), );
		add_filter( 'should_load_remote_block_patterns', '__return_false' );
	}

	/**
	 * Override default posts with custom names/slugs
	 */
	public function override_posts() {
		$post_override = new Admin\Post_Override();
		add_action( 'init', array( $post_override, 'alter_post_types' ) );
	}

	/**
	 * Load Site Features
	 */
	private function load_features() {
		add_action(
			'rest_api_init',
			function () {
				$current_feature_federation_router = new Features\Current_Feature_Federation_Router();
				$site_search_router                = new Features\Site_Search_Router();
				$current_feature_federation_router->register_routes();
				$site_search_router->register_routes();
			}
		);
	}

	/** Remove comments, pings and trackbacks support from posts types. */
	private function disable_discussion() {
		// Close comments on the front-end
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments.
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments page in menu.
		add_action(
			'admin_menu',
			function () {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Remove comments links from admin bar.
		add_action(
			'init',
			function () {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);
	}

	/**
	 * Adds scripts with the appropriate dependencies
	 */
	public function enqueue_cno_scripts() {
		$this->register_scripts();
		wp_enqueue_style(
			'typekit',
			'https://use.typekit.net/mud5elq.css',
			array(),
			null // phpcs:ignore
		);

		new Asset_Loader(
			'bootstrap',
			Enqueue_Type::both,
			'vendors',
			array(
				'scripts' => array(),
				'styles'  => array(),
			)
		);

		new Asset_Loader(
			'global',
			Enqueue_Type::both,
			null,
			array(
				'scripts' => array( 'bootstrap' ),
				'styles'  => array( 'bootstrap' ),
			)
		);
		wp_localize_script( 'global', 'cnoSiteData', array( 'rootUrl' => home_url() ) );

		// style.css
		wp_enqueue_style(
			'main',
			get_stylesheet_uri(),
			array( 'global' ),
			wp_get_theme()->get( 'Version' )
		);

		$this->remove_wordpress_styles(
			array(
				'classic-theme-styles',
				'dashicons',
			)
		);
	}

	/** Register the scripts and styles required by modules later */
	private function register_scripts() {
		$asset_file_base = get_template_directory() . '/dist';

		$who_we_are = require_once $asset_file_base . '/modules/who-we-are.asset.php';
		wp_register_script(
			'who-we-are',
			get_template_directory_uri() . '/dist/modules/who-we-are.js',
			array( 'global' ),
			$who_we_are['version'],
			array( 'strategy' => 'defer' )
		);
		wp_register_style(
			'who-we-are',
			get_template_directory_uri() . '/dist/modules/who-we-are.css',
			array( 'global' ),
			$who_we_are['version'],
		);

		$current_feature = require_once $asset_file_base . '/modules/current-feature.asset.php';
		wp_register_style(
			'current-feature',
			get_template_directory_uri() . '/dist/modules/current-feature.css',
			array( 'global' ),
			$current_feature['version'],
		);
		$lite_vimeo = require_once $asset_file_base . '/vendors/lite-vimeo.asset.php';
		wp_register_script(
			'lite-vimeo',
			get_template_directory_uri() . '/dist/vendors/lite-vimeo.js',
			array(),
			$lite_vimeo['version'],
			array( 'strategy' => 'async' )
		);
		$video_modal_trigger = require_once $asset_file_base . '/modules/video-modal-trigger.asset.php';
		wp_register_script(
			'video-modal-trigger',
			get_template_directory_uri() . '/dist/modules/video-modal-trigger.js',
			array( 'bootstrap', 'lite-vimeo' ),
			$video_modal_trigger['version'],
			array( 'strategy' => 'defer' )
		);
		wp_register_script(
			'video-modal-trigger-no-lv',
			get_template_directory_uri() . '/dist/modules/video-modal-trigger.js',
			array( 'bootstrap' ),
			$video_modal_trigger['version'],
			array( 'strategy' => 'defer' )
		);
		$category_swiper = require_once $asset_file_base . '/modules/category-swiper.asset.php';
		wp_register_script(
			'category-swiper',
			get_template_directory_uri() . '/dist/modules/category-swiper.js',
			array( 'global' ),
			$category_swiper['version'],
			array( 'strategy' => 'defer' )
		);
		wp_register_style(
			'category-swiper',
			get_template_directory_uri() . '/dist/modules/category-swiper.css',
			array( 'global' ),
			$category_swiper['version'],
		);
	}

	/**
	 * Provide an array of handles to dequeue.
	 *
	 * @param array $handles the script/style handles to dequeue.
	 */
	private function remove_wordpress_styles( array $handles ) {
		foreach ( $handles as $handle ) {
			wp_dequeue_style( $handle );
		}
	}

	/** Registers Theme Supports */
	public function cno_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		$image_sizes = array(
			'4k'                             => array( 3840, 2160 ), // hero
			'profile-preview'                => array( 1982, 1115 ), // 991 x 557
			'category-card'                  => array( 1392, 783 ), // 696 x 392
			'category-archive'               => array( 2000, 1126 ), // 1000 x 563
			'profile-preview-card'           => array( 1008, 568 ), // 504 x 284
			'story-portrait'                 => array( 1392, 2088 ), // 696 x 1044
			'story-landscape'                => array( 1392, 928 ), // 696 x 464
			'profile-swiper-video-thumbnail' => array( 850, 850 ), // 425 x 425
		);
		foreach ( $image_sizes as $name => $size ) {
			add_image_size( $name, $size[0], $size[1], );
		}

		register_nav_menus(
			array(
				'footer_menu' => __( 'Footer Menu', 'cno' ),
			)
		);
	}

	/** Remove post type support from posts types. */
	public function alter_post_types() {
		$post_types = array(
			'post',
			'page',
		);
		foreach ( $post_types as $post_type ) {
			$this->disable_post_type_support( $post_type );
		}

		// Hide tags on posts
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );

		// Hide category metabox for post type 'post'
		add_action(
			'admin_menu',
			function () {
				remove_meta_box( 'categorydiv', 'post', 'side' );
				remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
			}
		);
	}

	/**
	 * Remove manage_categories capability from editor role.
	 */
	public function remove_editor_capabilities() {
		$role = get_role( 'editor' );
		if ( $role ) {
			$role->remove_cap( 'manage_categories' );
		}
	}

	/** Alter the categories */
	public function alter_categories() {
		global $wp_rewrite;
		$wp_rewrite->extra_permastructs['category'][0] = '%category%';

		add_filter( 'category_rewrite_rules', array( $this, 'custom_category_rewrite_rules' ) );
	}

	/**
	 * Custom category rewrite rules
	 *
	 * @param array $category_rewrite the category rewrite rules.
	 */
	public function custom_category_rewrite_rules( $category_rewrite ) {
		$category_rewrite = array();
		$categories       = get_categories( array( 'hide_empty' => false ) );
		foreach ( $categories as $category ) {
			$category_nicename = $category->slug;
			if ( $category->parent === $category->cat_ID ) {
				$category->parent = 0;
			} elseif ( 0 !== $category->parent ) {
				$category_nicename = get_category_parents( $category->parent, false, '/', true ) . $category_nicename;
			}
			$category_rewrite[ '(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
			$category_rewrite[ '(' . $category_nicename . ')/page/?([0-9]{1,})/?$' ]                  = 'index.php?category_name=$matches[1]&paged=$matches[2]';
			$category_rewrite[ '(' . $category_nicename . ')/?$' ]                                    = 'index.php?category_name=$matches[1]';
		}
			return $category_rewrite;
	}

	/**
	 * Disable post-type-supports from posts
	 *
	 * @param string $post_type the post type to remove supports from.
	 */
	private function disable_post_type_support( string $post_type ) {
		$supports = array(
			'comments',
			'trackbacks',
			'revisions',
			'author',
		);
		foreach ( $supports as $support ) {
			if ( post_type_supports( $post_type, $support ) ) {
				remove_post_type_support( $post_type, $support );
			}
		}
	}

	/**
	 * Adds allowed redirect hosts for `wp_safe_redirect`
	 *
	 * @param array $hosts Current allowed hosts.
	 * @return array
	 */
	public function add_allowed_redirect_hosts( array $hosts ): array {
		$allowed_hosts = array(
			'choctawnation.com',
			'www.choctawnation.com',
		);
		return array_merge( $hosts, $allowed_hosts );
	}

	/**
	 * Handle speculative loading
	 *
	 * @since WP 6.8.0
	 * @link https://make.wordpress.org/core/2025/03/06/speculative-loading-in-6-8/
	 *
	 * @param ?array $config the configuration array. Null if user is logged-in.
	 * @return ?array The new config file, or null
	 */
	public function handle_speculative_loading( ?array $config ): ?array {
		if ( is_array( $config ) ) {
			$config['mode']      = 'auto';
			$config['eagerness'] = 'moderate';
		}
		return $config;
	}

	/**
	 * Add resource hints for Typekit
	 *
	 * @param array  $hints         The array of resource hints.
	 * @param string $relation_type The relation type the hints are for.
	 * @return array The modified array of resource hints.
	 */
	public function add_resource_hints( array $hints, string $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			$hints[] = array(
				'href'        => 'https://use.typekit.net',
				'crossorigin' => 'anonymous',
			);
		}
		return $hints;
	}

	/**
	 * Preload specific stylesheets
	 *
	 * @param string $html   The link tag HTML.
	 * @param string $handle The style handle.
	 * @param string $href   The stylesheet URL.
	 * @return string The modified link tag HTML.
	 */
	public function preload_stylesheets( string $html, string $handle, string $href ): string {
		$preload_handles = array(
			'typekit'   => 'external',
			'bootstrap' => null,
		);
		if ( in_array( $handle, array_keys( $preload_handles ), true ) ) {
			$is_crossorigin = 'external' === $preload_handles[ $handle ];
			// Add a preload link before the stylesheet link.
			$preload = sprintf(
				"<link rel='preload' as='style' href='%s' %s />\n",
				$href,
				$is_crossorigin ? 'crossorigin="anonymous"' : ''
			);
			// Add crossorigin attribute if needed.
			if ( $is_crossorigin ) {
				$html = str_replace( "/>\n", ' crossorigin="anonymous" />' . "\n", $html );
			}
			$html = $preload . $html;
		}
		return $html;
	}
}