<?php
/**
 * Initializes the Theme
 *
 * @package ChoctawNation
 */

namespace ChoctawNation;

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
		$this->load_required_files();
		$this->disable_discussion();
		$this->load_favicons( 'nation' );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cno_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'cno_theme_support' ) );
		add_action( 'init', array( $this, 'alter_post_types' ) );
		add_action( 'init', array( $this, 'remove_editor_capabilities' ) );
		add_action( 'init', array( $this, 'alter_categories' ) );
		add_action( 'pre_get_posts', array( $this, 'modify_category_query' ) );

		/**
		 * Filter the priority of the Yoast SEO metabox
		 */
		add_filter(
			'wpseo_metabox_prio',
			function (): string {
				return 'low';
			}
		);
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
				<link rel='icon' type'='image/png' sizes='192x192' href='{$href}/android-chrome-192x192.png'>
				<link rel='icon' type'='image/png' sizes='512x512' href='{$href}/android-chrome-512x512.png'>
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

		$acf_classes = array(
			'video-details'             => null,
			'media-and-text'            => 'flexible-content',
			'full-width-media-and-text' => 'flexible-content',
		);
		foreach ( $acf_classes as $acf_class => $folder ) {
			if ( ! is_null( $folder ) ) {
				require_once $base_path . "/acf/acf-classes/{$folder}/class-{$acf_class}.php";
				continue;
			}
			require_once $base_path . "/acf/acf-classes/class-{$acf_class}.php";
		}

		$asset_loaders = array(
			'enum-enqueue-type',
			'class-asset-loader',
		);
		foreach ( $asset_loaders as $asset_loader ) {
			require_once $base_path . "/theme/asset-loader/{$asset_loader}.php";
		}

		$navwalkers = array(
			'navwalker',
		);
		foreach ( $navwalkers as $navwalker ) {
			require_once $base_path . "/theme/navwalkers/class-{$navwalker}.php";
		}

		$utility_files = array(
			'allow-svg'     => 'Allow_SVG',
			'role-editor'   => 'Role_Editor',
			'post-override' => 'Post_Override',
			'site-search'   => 'Site_Search',
		);
		foreach ( $utility_files as $utility_file => $class_name ) {
			require_once $base_path . "/theme/class-{$utility_file}.php";
			$class = __NAMESPACE__ . '\\' . $class_name;
			new $class();
		}

		$plugin_files = array(
			'gravity-forms-handler' => 'Gravity_Forms_Handler',
		);
		foreach ( $plugin_files as $plugin_file => $class_name ) {
			require_once $base_path . "/plugins/class-{$plugin_file}.php";
			$class = __NAMESPACE__ . '\\Plugins\\' . $class_name;
			new $class();
		}
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
				'wp-block-library',
				'dashicons',
				'global-styles',
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
			'4k'                   => array( 3840, 2160 ), // hero
			'profile-preview'      => array( 1982, 1115 ), // 991 x 557
			'category-card'        => array( 1392, 783 ), // 696 x 392
			'profile-preview-card' => array( 1008, 568 ), // 504 x 284
		);
		foreach ( $image_sizes as $name => $size ) {
			add_image_size( $name, $size[0], $size[1], );
		}

		register_nav_menus(
			array(
				'primary_menu' => __( 'Primary Menu', 'cno' ),
				'footer_menu'  => __( 'Footer Menu', 'cno' ),
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
	 * Modify the category query
	 *
	 * @param WP_Query $query the query object.
	 */
	public function modify_category_query( $query ) {
		if ( $query->is_category() ) {
			$query->set( 'post_status', array( 'publish', 'future' ) );
		}
	}

	/**
	 * Disable post-type-supports from posts
	 *
	 * @param string $post_type the post type to remove supports from.
	 */
	private function disable_post_type_support( string $post_type ) {
		$supports = array(
			'editor',
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
}