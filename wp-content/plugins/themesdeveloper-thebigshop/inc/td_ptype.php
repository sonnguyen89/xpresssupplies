<?php
add_action( 'init', 'td_cpt_slider_manager' );
add_action( 'init', 'td_cpt_portfolio_manager' );
/**
 * Register a Slider post type.
 */
function td_cpt_slider_manager() {
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name', 'thebigshop' ),
		'singular_name'      => _x( 'slider', 'post type singular name', 'thebigshop' ),
		'menu_name'          => _x( 'Slider', 'admin menu', 'thebigshop' ),
		'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'thebigshop' ),
		'add_new'            => _x( 'Add New', 'slider', 'thebigshop' ),
		'add_new_item'       => esc_html__( 'Add New Slider', 'thebigshop' ),
		'new_item'           => esc_html__( 'New Slider', 'thebigshop' ),
		'edit_item'          => esc_html__( 'Edit Slider', 'thebigshop' ),
		'view_item'          => esc_html__( 'View Slider', 'thebigshop' ),
		'all_items'          => esc_html__( 'All Slider', 'thebigshop' ),
		'search_items'       => esc_html__( 'Search Slider', 'thebigshop' ),
		'parent_item_colon'  => esc_html__( 'Parent Slider:', 'thebigshop' ),
		'not_found'          => esc_html__( 'No Slider found.', 'thebigshop' ),
		'not_found_in_trash' => esc_html__( 'No Slider found in Trash.', 'thebigshop' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail')
	);

	register_post_type( 'td_slider', $args );
}

/**
 * Register a Portfolio post type.
 */
function td_cpt_portfolio_manager() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name', 'thebigshop' ),
		'singular_name'      => _x( 'portfolio', 'post type singular name', 'thebigshop' ),
		'menu_name'          => _x( 'Portfolio', 'admin menu', 'thebigshop' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'thebigshop' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'thebigshop' ),
		'add_new_item'       => esc_html__( 'Add New Portfolio', 'thebigshop' ),
		'new_item'           => esc_html__( 'New Portfolio', 'thebigshop' ),
		'edit_item'          => esc_html__( 'Edit Portfolio', 'thebigshop' ),
		'view_item'          => esc_html__( 'View Portfolio', 'thebigshop' ),
		'all_items'          => esc_html__( 'All Portfolio', 'thebigshop' ),
		'search_items'       => esc_html__( 'Search Portfolio', 'thebigshop' ),
		'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'thebigshop' ),
		'not_found'          => esc_html__( 'No Portfolio found.', 'thebigshop' ),
		'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash.', 'thebigshop' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor','post-formats', 'thumbnail','comments')
	);

	register_post_type( 'td_portfolio', $args );
}