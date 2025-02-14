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
 * @package emThemeWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants.
define( 'EMTHEME_THEME_DIR', get_template_directory() );
define( 'EMTHEME_THEME_URI', get_template_directory_uri() );

/**
 * emThemeWP theme class
 */
final class EMTHEME_Theme_Class {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
	
		// Define theme constants.
		$this->emTheme_constants();

		// Load framework classes.
		add_action( 'after_setup_theme', array( 'EMTHEME_Theme_Class', 'classes' ), 4 );

		// Setup theme => add_theme_support, register_nav_menus, load_theme_textdomain, etc.
		add_action( 'after_setup_theme', array( 'EMTHEME_Theme_Class', 'theme_setup' ), 10 );

		// register sidebar widget areas.
		add_action( 'widgets_init', array( 'EMTHEME_Theme_Class', 'register_sidebars' ) );


		/** Admin only actions */
		if ( is_admin() ) {


			/** Non Admin actions */
		} else {
			// Load theme js.
			add_action( 'wp_enqueue_scripts',  [$this, 'theme_js' ]  );

			// Load theme CSS.
			add_action( 'wp_enqueue_scripts',  [$this, 'theme_css' ] );

		
			// Add a pingback url auto-discovery header for singularly identifiable articles.
			add_action( 'wp_head',  [$this, 'pingback_header' ] , 1 );
			// Add meta viewport tag to header.
			add_action( 'wp_head',   [$this, 'meta_viewport' ] , 1 );

			// Add an X-UA-Compatible header.
			add_filter( 'wp_headers',  [$this, 'x_ua_compatible_headers' ] );




			add_filter( 'emTheme_enqueue_generated_files', '__return_false' );
		}
	}



	/**
	 * Define Constants
	 *
	 * @since   1.0.0
	 */
	public static function emTheme_constants() {

		// Theme version.
		define( 'EMTHEME_THEME_VERSION', '3.6.0' );

		define( 'EMTHEME_LIB_DIR_URI', EMTHEME_THEME_DIR .'/lib/');

		// Javascript and CSS Paths.
		define( 'EMTHEME_JS_DIR_URI', EMTHEME_THEME_URI . '/assets/js/' );
		define( 'EMTHEME_CSS_DIR_URI', EMTHEME_THEME_URI . '/assets/css/' );

		// Include Paths.
		define( 'EMTHEME_INC_DIR', EMTHEME_THEME_DIR . '/inc/' );

	}


	/**
	 * Load theme classes
	 *
	 * @since   1.0.0
	 */
	public static function classes() {



	}

	/**
	 * Theme Setup
	 *
	 * @since   1.0.0
	 */
	public static function theme_setup() {
		$dir_include = EMTHEME_INC_DIR;
		$dir_lib = EMTHEME_LIB_DIR_URI;
		// Load text domain.
		load_theme_textdomain( 'emTheme', EMTHEME_THEME_DIR . '/languages' );

		// Get globals.
		global $content_width;

		// Set content width based on theme's default design.
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary_menu' => esc_html__( 'Primary', 'emTheme' ),
				'topbar_menu' => esc_html__( 'Top Bar', 'emTheme' ),
				'main_menu'   => esc_html__( 'Main', 'emTheme' ),
				'footer_menu' => esc_html__( 'Footer', 'emTheme' ),
				'mobile_menu' => esc_html__( 'Mobile (optional)', 'emTheme' ),
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
				'emTheme_custom_header_args',
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
				'emTheme_custom_logo_args',
				array(
					'height'      => 45,
					'width'       => 164,
					'flex-height' => true,
					'flex-width'  => true,
				)
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

		/**
		 * Implement the Custom Header feature.
		 */
		require $dir_include . 'custom-header.php';

		/**
		 * Custom template tags for this theme.
		 */
		require $dir_include . 'template-tags.php';

		/**
		 * Customizer additions.
		 */
		require $dir_include . 'customizer.php';


		/**
		 * Custom post types.
		 */
		require_once $dir_lib . 'EMTHEME_class_custom_post_types.php';
		require_once $dir_lib . 'EMTHEME_class_custom_post_meta.php';
		//require_once __DIR__ . '/lib/custom-taxonomies.php';
		//require_once __DIR__ . '/lib/custom-post-meta.php';


		/**
		 * Load Jetpack compatibility file.
		 */
		if ( defined( 'JETPACK__VERSION' ) ) {
			require $dir_include . 'jetpack.php';
		}

		/**
		 * Load WooCommerce compatibility file.
		 */
		if ( class_exists( 'WooCommerce' ) ) {
			require $dir_include . 'woocommerce.php';
		}


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
		echo apply_filters( 'emTheme_meta_viewport', $viewport ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}


	/**
	 * Load front-end scripts
	 *
	 * @since   1.0.0
	 */
	public static function theme_css() {

		// Define dir.
		$dir           = EMTHEME_CSS_DIR_URI;
		$theme_version = EMTHEME_THEME_VERSION;
		$nonCache_version = rand( 1, 99999999999 );
		// Enqueue Main style.
		//wp_enqueue_style( 'emTheme-style', $dir . 'style.min.css', false, $theme_version );
		wp_enqueue_style( 'emThemestyle', get_stylesheet_uri(), array(), $nonCache_version );
		wp_enqueue_style( 'animatecss', get_stylesheet_directory_uri() ."/assets/css/animate.css", array(), $theme_version );
		wp_enqueue_style( 'gfont-css', get_stylesheet_directory_uri() ."/assets/css/g-fonts.css", array(), $theme_version );
		wp_style_add_data( 'emThemestyle', 'rtl', 'replace' );
		wp_enqueue_style('font-awesome-official-css', 'https://use.fontawesome.com/releases/v5.14.0/css/all.css');
		wp_enqueue_style('font-awesome-official-v4shim-css', 'https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css');
			
		if (is_page(128)) {
			wp_enqueue_style( 'test-css', $dir . 'test-css.css' , array(), $nonCache_version );
		}
	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since 1.0.0
	 */
	public static function theme_js() {

		// Get js directory uri.
		$dir = EMTHEME_JS_DIR_URI;

		// Get current theme version.
		$theme_version = EMTHEME_THEME_VERSION;

		// Main script dependencies.
		$main_script_dependencies = array( 'jquery' );

		// Comment reply.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**
		 * Load Theme Scripts.
		 */

		$nonCache_version = rand( 1, 99999999999 );

		wp_enqueue_script( 'emTheme-general', $dir . 'general.js', array(), $nonCache_version, true );
		wp_enqueue_script( 'mixitup', $dir . 'mixitup.min.js', array(), $theme_version, true );

		array_push( $main_script_dependencies, 'emTheme-main' );
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

		$heading = get_theme_mod( 'emTheme_sidebar_widget_heading_tag', 'h4' );
		$heading = apply_filters( 'emTheme_sidebar_widget_heading_tag', $heading );

		$foo_heading = get_theme_mod( 'emTheme_footer_widget_heading_tag', 'h4' );
		$foo_heading = apply_filters( 'emTheme_footer_widget_heading_tag', $foo_heading );

		// Default Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'emTheme' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Widgets in this area will be displayed in the left or right sidebar area if you choose the Left or Right Sidebar layout.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Left Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Left Sidebar', 'emTheme' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Widgets in this area are used in the left sidebar region if you use the Both Sidebars layout.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Search Results Sidebar.
		if ( get_theme_mod( 'emTheme_search_custom_sidebar', true ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Search Results Sidebar', 'emTheme' ),
					'id'            => 'search_sidebar',
					'description'   => esc_html__( 'Widgets in this area are used in the search result page.', 'emTheme' ),
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
				'name'          => esc_html__( 'Footer 1', 'emTheme' ),
				'id'            => 'footer-one',
				'description'   => esc_html__( 'Widgets in this area are used in the first footer region.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 2.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'emTheme' ),
				'id'            => 'footer-two',
				'description'   => esc_html__( 'Widgets in this area are used in the second footer region.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 3.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'emTheme' ),
				'id'            => 'footer-three',
				'description'   => esc_html__( 'Widgets in this area are used in the third footer region.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 4.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 4', 'emTheme' ),
				'id'            => 'footer-four',
				'description'   => esc_html__( 'Widgets in this area are used in the fourth footer region.', 'emTheme' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

	}
}

new EMTHEME_Theme_Class();
