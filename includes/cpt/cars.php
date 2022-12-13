<?php
function theme_setup(){

	add_theme_support( 'post-thumbnails', array( 'car' ) );
}

add_action('after_setup_theme','theme_setup');

function register_car_post_type() {

	register_post_type( 'car',
		array(
			'labels' => array(
				'name'          => __( 'Cars', 'wltesttheme' ),
				'singular_name' => __( 'Car', 'wltesttheme' ),
			),
			'public'      => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-car',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
		)
	);

}

add_action( 'init', 'register_car_post_type' );

function create_marks_taxonomy() {

	$labels = array(
		'name'              => _x( 'Marks', 'taxonomy general name' ),
		'singular_name'     => _x( 'Mark', 'taxonomy general name' ),
		'search_items'      => __( 'Search Marks' ),
		'all_items'         => __( 'All Marks' ),
		'parent_item'       => __( 'Parent Mark' ),
		'parent_item_colon' => __( 'Parent Mark:' ),
		'edit_item'         => __( 'Edit Mark' ),
		'update_item'       => __( 'Update Mark' ),
		'add_new_item'      => __( 'Add New Mark' ),
		'new_item_name'     => __( 'New Mark Name' ),
		'menu_name'         => __( 'Marks' ),
	);

	register_taxonomy( 'marks', 'car', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'mark' ),
	) );

}

add_action( 'init', 'create_marks_taxonomy', 0 );

function create_countries_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Countries', 'taxonomy general name' ),
		'singular_name'              => _x( 'Country', 'taxonomy general name' ),
		'search_items'               =>  __( 'Search Countries' ),
		'popular_items'              => __( 'Popular Countries' ),
		'all_items'                  => __( 'All Countries' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Country' ),
		'update_item'                => __( 'Update Country' ),
		'add_new_item'               => __( 'Add New Country' ),
		'new_item_name'              => __( 'New Country Name' ),
		'separate_items_with_commas' => __( 'Separate countries with commas' ),
		'add_or_remove_items'        => __( 'Add or remove countries' ),
		'choose_from_most_used'      => __( 'Choose from the most used countries' ),
		'menu_name'                  => __( 'Countries' ),
	);

	register_taxonomy('countries','car',array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'country' ),
	));
}

add_action( 'init', 'create_countries_taxonomy', 0 );
