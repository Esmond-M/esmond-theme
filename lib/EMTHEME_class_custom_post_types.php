<?php
declare(strict_types=1);
namespace inc\EMTHEME_class_custom_post_types;

if (!class_exists('EMTHEME_theme_custom_post_types_Class')) {

    class EMTHEME_theme_custom_post_types_Class
    {

        /** Declaring constructor
         */
        public function __construct()
        {

			add_action( 'init', [$this, 'EMTHEME_theme_register_cpts' ]  );

        }

		public static function EMTHEME_theme_register_cpts() {

			/**
			 * Post Type: portfolio.
			 */
		
			$labels = array(
				'name'          => esc_html__( 'esmond-portfolio', 'esmond-portfolio' ),
				'singular_name' => esc_html__( 'esmond-portfolio', 'esmond-portfolio' ),
			);
		
			$args = array(
				'label'                 => esc_html__( 'esmond-portfolio', 'esmond-portfolio' ),
				'labels'                => $labels,
				'description'           => '',
				'public'                => true,
				'publicly_queryable'    => true,
				'show_ui'               => true,
				'show_in_rest'          => true,
				'rest_base'             => '',
				'rest_controller_class' => 'WP_REST_Posts_Controller',
				'rest_namespace'        => 'wp/v2',
				'has_archive'           => 'esmond-portfolio',
				'show_in_menu'          => true,
				'show_in_nav_menus'     => true,
				'delete_with_user'      => false,
				'exclude_from_search'   => false,
				'capability_type'       => 'post',
				'map_meta_cap'          => true,
				'hierarchical'          => false,
				'can_export'            => true,
				'rewrite'               => array(
					'slug'       => 'esmond-portfolio',
					'with_front' => true,
				),
				'query_var'             => true,
				'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'taxonomies'            => array( 'category' ),
				'show_in_graphql'       => false,
			);
		
			register_post_type( 'esmond-portfolio', $args );
	
			/**
			 * Post Type: Services.
			 */
		
			 $labels = array(
				'name'          => esc_html__( 'EM Services', 'esmond-services' ),
				'singular_name' => esc_html__( 'esmond-services', 'esmond-services' ),
			);
		
			$args = array(
				'label'                 => esc_html__( 'esmond-services', 'esmond-services' ),
				'labels'                => $labels,
				'description'           => '',
				'public'                => true,
				'publicly_queryable'    => true,
				'show_ui'               => true,
				'show_in_rest'          => true,
				'rest_base'             => '',
				'rest_controller_class' => 'WP_REST_Posts_Controller',
				'rest_namespace'        => 'wp/v2',
				'has_archive'           => 'esmond-services',
				'show_in_menu'          => true,
				'show_in_nav_menus'     => true,
				'delete_with_user'      => false,
				'exclude_from_search'   => false,
				'capability_type'       => 'post',
				'map_meta_cap'          => true,
				'hierarchical'          => false,
				'can_export'            => true,
				'rewrite'               => array(
					'slug'       => 'esmond-services',
					'with_front' => true,
				),
				'query_var'             => true,
				'supports'              => array( 'title', 'excerpt' ),
				'taxonomies'            => array( 'category' ),
				'show_in_graphql'       => false,
			);
		
			register_post_type( 'esmond-services', $args );
		} // end of function

	} // Closing bracket for classes

}

use inc\EMTHEME_class_custom_post_types;
new EMTHEME_theme_custom_post_types_Class;