<?php

function esmond_portfolio_register_cpts() {

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
}
	add_action( 'init', 'esmond_portfolio_register_cpts' );
