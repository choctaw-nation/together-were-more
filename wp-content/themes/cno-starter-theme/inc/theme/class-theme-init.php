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
			'generator',
			'image',
			// 'hero',
		);
		foreach ( $acf_classes as $acf_class ) {
			require_once $base_path . "/acf/acf-classes/class-{$acf_class}.php";
		}
		/** Sets up Initial ACF Fields for global Hero Sections */
		// require_once $base_path . '/acf/acf-fields/initial-acf-fields.php'; phpcs:ignore Squiz.PHP.CommentedOutCode.Found

		$asset_loaders = array(
			'enum-enqueue-type',
			'class-asset-loader',
		);
		foreach ( $asset_loaders as $asset_loader ) {
			require_once $base_path . "/theme/asset-loader/{$asset_loader}.php";
		}

		$navwalkers = array(
			'navwalker',
			// 'mega-menu',
		);
		foreach ( $navwalkers as $navwalker ) {
			require_once $base_path . "/theme/navwalkers/class-{$navwalker}.php";
		}

		$utility_files = array(
			'allow-svg'   => 'Allow_SVG',
			'role-editor' => 'Role_Editor',
		);
		foreach ( $utility_files as $utility_file => $class_name ) {
			require_once $base_path . "/theme/{$utility_file}.php";
			$class = __NAMESPACE__ . '\\' . $class_name;
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
		wp_enqueue_style(
			'typekit',
			'https://use.typekit.net/jky5sek.css',
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
