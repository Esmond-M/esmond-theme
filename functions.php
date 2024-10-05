<?php

/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants.
define( 'OCEANWP_THEME_DIR', get_template_directory() );
define( 'OCEANWP_THEME_URI', get_template_directory_uri() );

/**
 * OceanWP theme class
 */
final class OCEANWP_Theme_Class {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
	
		// Define theme constants.
		$this->oceanwp_constants();

		// Load required files.
		$this->oceanwp_has_setup();

		// Load framework classes.
		add_action( 'after_setup_theme', array( 'OCEANWP_Theme_Class', 'classes' ), 4 );

		// Setup theme => add_theme_support, register_nav_menus, load_theme_textdomain, etc.
		add_action( 'after_setup_theme', array( 'OCEANWP_Theme_Class', 'theme_setup' ), 10 );

		// register sidebar widget areas.
		add_action( 'widgets_init', array( 'OCEANWP_Theme_Class', 'register_sidebars' ) );


		/** Admin only actions */
		if ( is_admin() ) {

			// Load scripts in the WP admin.
			add_action( 'admin_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'admin_scripts' ) );

			/** Non Admin actions */
		} else {
			// Load theme js.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'theme_js' ) );

			// Load theme CSS.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'theme_css' ) );

			// Load his file in last.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'custom_style_css' ), 9999 );

			// Add a pingback url auto-discovery header for singularly identifiable articles.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'pingback_header' ), 1 );

			// Add meta viewport tag to header.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'meta_viewport' ), 1 );

			// Add an X-UA-Compatible header.
			add_filter( 'wp_headers', array( 'OCEANWP_Theme_Class', 'x_ua_compatible_headers' ) );

			// Outputs custom CSS to the head.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'custom_css' ), 9999 );


			add_filter( 'ocean_enqueue_generated_files', '__return_false' );
		}
	}



	/**
	 * Define Constants
	 *
	 * @since   1.0.0
	 */
	public static function oceanwp_constants() {

		$version = self::theme_version();

		// Theme version.
		define( 'OCEANWP_THEME_VERSION', $version );

		// Javascript and CSS Paths.
		define( 'OCEANWP_JS_DIR_URI', OCEANWP_THEME_URI . '/assets/js/' );
		define( 'OCEANWP_CSS_DIR_URI', OCEANWP_THEME_URI . '/assets/css/' );

		// Include Paths.
		define( 'OCEANWP_INC_DIR', OCEANWP_THEME_DIR . '/inc/' );
		define( 'OCEANWP_INC_DIR_URI', OCEANWP_THEME_URI . '/inc/' );

		// Check if plugins are active.
		define( 'OCEAN_EXTRA_ACTIVE', class_exists( 'Ocean_Extra' ) );
		define( 'OCEANWP_ELEMENTOR_ACTIVE', class_exists( 'Elementor\Plugin' ) );
		define( 'OCEANWP_BEAVER_BUILDER_ACTIVE', class_exists( 'FLBuilder' ) );
		define( 'OCEANWP_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		define( 'OCEANWP_EDD_ACTIVE', class_exists( 'Easy_Digital_Downloads' ) );
		define( 'OCEANWP_LIFTERLMS_ACTIVE', class_exists( 'LifterLMS' ) );
		define( 'OCEANWP_ALNP_ACTIVE', class_exists( 'Auto_Load_Next_Post' ) );
		define( 'OCEANWP_LEARNDASH_ACTIVE', class_exists( 'SFWD_LMS' ) );
	}

	/*
	 * Load all core theme function files
	 *
	 * @since 1.0.0oceanwp_has_setup
	
	public static function oceanwp_has_setup() {

		$dir = OCEANWP_INC_DIR;

		require_once $dir . 'helpers.php';
		require_once $dir . 'header-content.php';
		require_once $dir . 'oceanwp-strings.php';
		require_once $dir . 'oceanwp-svg.php';
		require_once $dir . 'oceanwp-theme-icons.php';
		require_once $dir . 'template-helpers.php';
		require_once $dir . 'customizer/controls/typography/webfonts.php';
		require_once $dir . 'walker/init.php';
		require_once $dir . 'walker/menu-walker.php';
		require_once $dir . 'third/class-gutenberg.php';
		require_once $dir . 'third/class-elementor.php';
		require_once $dir . 'third/class-beaver-themer.php';
		require_once $dir . 'third/class-bbpress.php';
		require_once $dir . 'third/class-buddypress.php';
		require_once $dir . 'third/class-lifterlms.php';
		require_once $dir . 'third/class-learndash.php';
		require_once $dir . 'third/class-sensei.php';
		require_once $dir . 'third/class-social-login.php';
		require_once $dir . 'third/class-amp.php';
		require_once $dir . 'third/class-pwa.php';

		// WooCommerce.
		if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {
			require_once $dir . 'woocommerce/woocommerce-config.php';
		}

		// Easy Digital Downloads.
		if ( OCEANWP_EDD_ACTIVE ) {
			require_once $dir . 'edd/edd-config.php';
		}

	}

 */
	/**
	 * Load theme classes
	 *
	 * @since   1.0.0
	 */
	public static function classes() {

		// Admin only classes.
		if ( is_admin() ) {

			// Recommend plugins.
			require_once OCEANWP_INC_DIR . 'activation-notice/class-oceanwp-plugin-manager.php';
			require_once OCEANWP_INC_DIR . 'activation-notice/template.php';

			// Ajax Actions
			if (defined('DOING_AJAX') && DOING_AJAX) {
				require OCEANWP_INC_DIR . 'activation-notice/api.php';
			}

			// Front-end classes.
		}

		// Breadcrumbs class.
		require_once OCEANWP_INC_DIR . 'breadcrumbs.php';

		// Customizer class.
		require_once OCEANWP_INC_DIR . 'customizer/library/customizer-custom-controls/functions.php';
		require_once OCEANWP_INC_DIR . 'customizer/customizer.php';

	}

	/**
	 * Theme Setup
	 *
	 * @since   1.0.0
	 */
	public static function theme_setup() {

		// Load text domain.
		load_theme_textdomain( 'oceanwp', OCEANWP_THEME_DIR . '/languages' );

		// Get globals.
		global $content_width;

		// Set content width based on theme's default design.
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		// Register navigation menus.
		register_nav_menus(
			array(
				'topbar_menu' => esc_html__( 'Top Bar', 'oceanwp' ),
				'main_menu'   => esc_html__( 'Main', 'oceanwp' ),
				'footer_menu' => esc_html__( 'Footer', 'oceanwp' ),
				'mobile_menu' => esc_html__( 'Mobile (optional)', 'oceanwp' ),
			)
		);

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

		// Enable support for <title> tag.
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for header image
		 */
		add_theme_support(
			'custom-header',
			apply_filters(
				'ocean_custom_header_args',
				array(
					'width'       => 2000,
					'height'      => 1200,
					'flex-height' => true,
					'video'       => true,
					'video-active-callback' => '__return_true'
				)
			)
		);

		/**
		 * Enable support for site logo
		 */
		add_theme_support(
			'custom-logo',
			apply_filters(
				'ocean_custom_logo_args',
				array(
					'height'      => 45,
					'width'       => 164,
					'flex-height' => true,
					'flex-width'  => true,
				)
			)
		);

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'widgets',
			)
		);

		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add editor style.
		add_editor_style( 'assets/css/editor-style.min.css' );

		// Declare support for selective refreshing of widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.1.0
	 */
	public static function pingback_header() {

		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.0.0
	 */
	public static function meta_viewport() {

		// Meta viewport.
		$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';

		// Apply filters for child theme tweaking.
		echo apply_filters( 'ocean_meta_viewport', $viewport ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}

	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0.0
	 */
	public static function admin_scripts() {
		global $pagenow;
		if ( 'nav-menus.php' === $pagenow ) {
			wp_enqueue_style( 'oceanwp-menus', OCEANWP_INC_DIR_URI . 'walker/assets/menus.css', false, OCEANWP_THEME_VERSION );
		}
	}

	/**
	 * Load front-end scripts
	 *
	 * @since   1.0.0
	 */
	public static function theme_css() {

		// Define dir.
		$dir           = OCEANWP_CSS_DIR_URI;
		$theme_version = OCEANWP_THEME_VERSION;

		// Remove font awesome style from plugins.
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );

		// Enqueue font awesome style.
		if ( get_theme_mod( 'ocean_performance_fontawesome', 'enabled' ) === 'enabled' ) {
			wp_enqueue_style( 'font-awesome', OCEANWP_THEME_URI . '/assets/fonts/fontawesome/css/all.min.css', false, '6.4.2' );
		}

		// Enqueue simple line icons style.
		if ( get_theme_mod( 'ocean_performance_simple_line_icons', 'enabled' ) === 'enabled' ) {
			wp_enqueue_style( 'simple-line-icons', $dir . 'third/simple-line-icons.min.css', false, '2.4.0' );
		}

		// Enqueue Main style.
		wp_enqueue_style( 'oceanwp-style', $dir . 'style.min.css', false, $theme_version );

		// Blog Header styles.
		if ( 'default' !== get_theme_mod( 'oceanwp_single_post_header_style', 'default' )
			&& is_single() && 'post' === get_post_type() ) {
			wp_enqueue_style( 'oceanwp-blog-headers', $dir . 'blog/blog-post-headers.css', false, $theme_version );
		}

		// Register perfect-scrollbar plugin style.
		wp_register_style( 'ow-perfect-scrollbar', $dir . 'third/perfect-scrollbar.css', false, '1.5.0' );

		// Register hamburgers buttons to easily use them.
		wp_register_style( 'oceanwp-hamburgers', $dir . 'third/hamburgers/hamburgers.min.css', false, $theme_version );
		// Register hamburgers buttons styles.
		$hamburgers = oceanwp_hamburgers_styles();
		foreach ( $hamburgers as $class => $name ) {
			wp_register_style( 'oceanwp-' . $class . '', $dir . 'third/hamburgers/types/' . $class . '.css', false, $theme_version );
		}

		// Get mobile menu icon style.
		$mobile_menu = get_theme_mod( 'ocean_mobile_menu_open_hamburger', 'default' );
		// Enqueue mobile menu icon style.
		if ( ! empty( $mobile_menu ) && 'default' !== $mobile_menu ) {
			wp_enqueue_style( 'oceanwp-hamburgers' );
			wp_enqueue_style( 'oceanwp-' . $mobile_menu . '' );
		}

		// If Vertical header style.
		if ( 'vertical' === oceanwp_header_style() ) {
			wp_enqueue_style( 'oceanwp-hamburgers' );
			wp_enqueue_style( 'oceanwp-spin' );
			wp_enqueue_style( 'ow-perfect-scrollbar' );
		}
	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since 1.0.0
	 */
	public static function theme_js() {

		if ( self::oceanwp_is_amp() ) {
			return;
		}

		// Get js directory uri.
		$dir = OCEANWP_JS_DIR_URI;

		// Get current theme version.
		$theme_version = OCEANWP_THEME_VERSION;

		// Get localized array.
		$localize_array = self::localize_array();

		// Main script dependencies.
		$main_script_dependencies = array( 'jquery' );

		// Comment reply.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Add images loaded.
		wp_enqueue_script( 'imagesloaded' );

		/**
		 * Load Venors Scripts.
		 */

		// Isotop.
		wp_register_script( 'ow-isotop', $dir . 'vendors/isotope.pkgd.min.js', array(), '3.0.6', true );

		// Flickity.
		wp_register_script( 'ow-flickity', $dir . 'vendors/flickity.pkgd.min.js', array(), $theme_version, true );

		// Magnific Popup.
		wp_register_script( 'ow-magnific-popup', $dir . 'vendors/magnific-popup.min.js', array( 'jquery' ), $theme_version, true );

		// Sidr Mobile Menu.
		wp_register_script( 'ow-sidr', $dir . 'vendors/sidr.js', array(), $theme_version, true );

		// Perfect Scrollbar.
		wp_register_script( 'ow-perfect-scrollbar', $dir . 'vendors/perfect-scrollbar.min.js', array(), $theme_version, true );

		// Smooth Scroll.
		wp_register_script( 'ow-smoothscroll', $dir . 'vendors/smoothscroll.min.js', array(), $theme_version, false );

		/**
		 * Load Theme Scripts.
		 */

		// Theme script.
		wp_enqueue_script( 'oceanwp-main', $dir . 'theme.min.js', $main_script_dependencies, $theme_version, true );
		wp_localize_script( 'oceanwp-main', 'oceanwpLocalize', $localize_array );
		array_push( $main_script_dependencies, 'oceanwp-main' );

		// Blog Masonry script.
		if ( 'masonry' === oceanwp_blog_grid_style() ) {
			array_push( $main_script_dependencies, 'ow-isotop' );
			wp_enqueue_script( 'ow-isotop' );
			wp_enqueue_script( 'oceanwp-blog-masonry', $dir . 'blog-masonry.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Menu script.
		switch ( oceanwp_header_style() ) {
			case 'full_screen':
				wp_enqueue_script( 'oceanwp-full-screen-menu', $dir . 'full-screen-menu.min.js', $main_script_dependencies, $theme_version, true );
				break;
			case 'vertical':
				array_push( $main_script_dependencies, 'ow-perfect-scrollbar' );
				wp_enqueue_script( 'ow-perfect-scrollbar' );
				wp_enqueue_script( 'oceanwp-vertical-header', $dir . 'vertical-header.min.js', $main_script_dependencies, $theme_version, true );
				break;
		}

		// Mobile Menu script.
		switch ( oceanwp_mobile_menu_style() ) {
			case 'dropdown':
				wp_enqueue_script( 'oceanwp-drop-down-mobile-menu', $dir . 'drop-down-mobile-menu.min.js', $main_script_dependencies, $theme_version, true );
				break;
			case 'fullscreen':
				wp_enqueue_script( 'oceanwp-full-screen-mobile-menu', $dir . 'full-screen-mobile-menu.min.js', $main_script_dependencies, $theme_version, true );
				break;
			case 'sidebar':
				array_push( $main_script_dependencies, 'ow-sidr' );
				wp_enqueue_script( 'ow-sidr' );
				wp_enqueue_script( 'oceanwp-sidebar-mobile-menu', $dir . 'sidebar-mobile-menu.min.js', $main_script_dependencies, $theme_version, true );
				break;
		}

		// Search script.
		switch ( oceanwp_menu_search_style() ) {
			case 'drop_down':
				wp_enqueue_script( 'oceanwp-drop-down-search', $dir . 'drop-down-search.min.js', $main_script_dependencies, $theme_version, true );
				break;
			case 'header_replace':
				wp_enqueue_script( 'oceanwp-header-replace-search', $dir . 'header-replace-search.min.js', $main_script_dependencies, $theme_version, true );
				break;
			case 'overlay':
				wp_enqueue_script( 'oceanwp-overlay-search', $dir . 'overlay-search.min.js', $main_script_dependencies, $theme_version, true );
				break;
		}

		// Mobile Search Icon Style.
		if ( oceanwp_mobile_menu_search_style() !== 'disabled' ) {
			wp_enqueue_script( 'oceanwp-mobile-search-icon', $dir . 'mobile-search-icon.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Equal Height Elements script.
		if ( oceanwp_blog_entry_equal_heights() ) {
			wp_enqueue_script( 'oceanwp-equal-height-elements', $dir . 'equal-height-elements.min.js', $main_script_dependencies, $theme_version, true );
		}

		$perf_lightbox = get_theme_mod( 'ocean_performance_lightbox', 'enabled' );

		// Lightbox script.
		if ( oceanwp_gallery_is_lightbox_enabled() || $perf_lightbox === 'enabled' ) {
			array_push( $main_script_dependencies, 'ow-magnific-popup' );
			wp_enqueue_script( 'ow-magnific-popup' );
			wp_enqueue_script( 'oceanwp-lightbox', $dir . 'ow-lightbox.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Slider script.
		array_push( $main_script_dependencies, 'ow-flickity' );
		wp_enqueue_script( 'ow-flickity' );
		wp_enqueue_script( 'oceanwp-slider', $dir . 'ow-slider.min.js', $main_script_dependencies, $theme_version, true );

		// Scroll Effect script.
		if ( get_theme_mod( 'ocean_performance_scroll_effect', 'enabled' ) === 'enabled' ) {
			wp_enqueue_script( 'oceanwp-scroll-effect', $dir . 'scroll-effect.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Scroll to Top script.
		if ( oceanwp_display_scroll_up_button() ) {
			wp_enqueue_script( 'oceanwp-scroll-top', $dir . 'scroll-top.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Custom Select script.
		if ( get_theme_mod( 'ocean_performance_custom_select', 'enabled' ) === 'enabled' ) {
			wp_enqueue_script( 'oceanwp-select', $dir . 'select.min.js', $main_script_dependencies, $theme_version, true );
		}

		// Infinite Scroll script.
		if ( 'infinite_scroll' === get_theme_mod( 'ocean_blog_pagination_style', 'standard' ) || 'infinite_scroll' === get_theme_mod( 'ocean_woo_pagination_style', 'standard' ) ) {
			wp_enqueue_script( 'oceanwp-infinite-scroll', $dir . 'ow-infinite-scroll.min.js', $main_script_dependencies, $theme_version, true );
		}

		// WooCommerce scripts.
		if ( OCEANWP_WOOCOMMERCE_ACTIVE
		&& 'yes' !== get_theme_mod( 'ocean_woo_remove_custom_features', 'no' ) ) {
			wp_enqueue_script( 'oceanwp-woocommerce-custom-features', $dir . 'wp-plugins/woocommerce/woo-custom-features.min.js', array( 'jquery' ), $theme_version, true );
			wp_localize_script( 'oceanwp-woocommerce-custom-features', 'oceanwpLocalize', $localize_array );
		}

		// Register scripts for old addons.
		wp_register_script( 'nicescroll', $dir . 'vendors/support-old-oceanwp-addons/jquery.nicescroll.min.js', array( 'jquery' ), $theme_version, true );
	}


	/**
	 * Add headers for IE to override IE's Compatibility View Settings
	 *
	 * @param obj $headers   header settings.
	 * @since 1.0.0
	 */
	public static function x_ua_compatible_headers( $headers ) {
		$headers['X-UA-Compatible'] = 'IE=edge';
		return $headers;
	}

	/**
	 * Registers sidebars
	 *
	 * @since   1.0.0
	 */
	public static function register_sidebars() {

		$heading = get_theme_mod( 'ocean_sidebar_widget_heading_tag', 'h4' );
		$heading = apply_filters( 'ocean_sidebar_widget_heading_tag', $heading );

		$foo_heading = get_theme_mod( 'ocean_footer_widget_heading_tag', 'h4' );
		$foo_heading = apply_filters( 'ocean_footer_widget_heading_tag', $foo_heading );

		// Default Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'oceanwp' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Widgets in this area will be displayed in the left or right sidebar area if you choose the Left or Right Sidebar layout.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Left Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Left Sidebar', 'oceanwp' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Widgets in this area are used in the left sidebar region if you use the Both Sidebars layout.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Search Results Sidebar.
		if ( get_theme_mod( 'ocean_search_custom_sidebar', true ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Search Results Sidebar', 'oceanwp' ),
					'id'            => 'search_sidebar',
					'description'   => esc_html__( 'Widgets in this area are used in the search result page.', 'oceanwp' ),
					'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<' . $heading . ' class="widget-title">',
					'after_title'   => '</' . $heading . '>',
				)
			);
		}

		// Footer 1.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'oceanwp' ),
				'id'            => 'footer-one',
				'description'   => esc_html__( 'Widgets in this area are used in the first footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 2.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'oceanwp' ),
				'id'            => 'footer-two',
				'description'   => esc_html__( 'Widgets in this area are used in the second footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 3.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'oceanwp' ),
				'id'            => 'footer-three',
				'description'   => esc_html__( 'Widgets in this area are used in the third footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 4.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 4', 'oceanwp' ),
				'id'            => 'footer-four',
				'description'   => esc_html__( 'Widgets in this area are used in the fourth footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

	}
}







new OCEANWP_Theme_Class();


/**
 * website-theme-name functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package website-theme-name
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'emTheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function emTheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on website-theme-name, use a find and replace
		 * to change 'website-theme-name' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'website-theme-name', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'website-theme-name' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'emTheme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'emTheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emTheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'emTheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'emTheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emTheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'website-theme-name' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'website-theme-name' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'emTheme_widgets_init' );

function emTheme_google_tag_manager() {
    echo '';
 
}
add_action( 'wp_head', 'emTheme_google_tag_manager', 1 );

/**
 * Enqueue scripts and styles.
 */
function emTheme_scripts() {
    $ss_version = rand( 1, 99999999999 );
	$stable_version = '1.20';
	wp_enqueue_style( 'emThemestyle', get_stylesheet_uri(), array(), $ss_version );
	wp_style_add_data( 'emThemestyle', 'rtl', 'replace' );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' , array(), $stable_version);
	wp_enqueue_style('font-awesome-official-css', 'https://use.fontawesome.com/releases/v5.14.0/css/all.css');
	wp_enqueue_style('font-awesome-official-v4shim-css', 'https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css');
    wp_enqueue_style( 'emTheme-slider-css', get_template_directory_uri() . '/css/emTheme-slider.css' , array(), $ss_version );
	wp_enqueue_script( 'emTheme-general-js', get_template_directory_uri() . '/js/general.min.js', array(), $stable_version, true );
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), $stable_version, true);

	if (is_page(128)) {
		wp_enqueue_style( 'test-css', get_template_directory_uri() . '/css/test-css.css' , array(), $ss_version );
	}
}
add_action( 'wp_enqueue_scripts', 'emTheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
