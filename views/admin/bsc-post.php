<?php 

$labels = array(
    'name'                  => _x( 'Button ShortCode Cretors', 'Post Type General Name', 'bsc' ),
    'singular_name'         => _x( 'Button ShortCode Cretor', 'Post Type Singular Name', 'bsc' ),
    'menu_name'             => __( 'BSC', 'bsc' ),
    'name_admin_bar'        => __( 'BSC', 'bsc' ),
    'archives'              => __( 'Item Archives', 'bsc' ),
    'attributes'            => __( 'Item Attributes', 'bsc' ),
    'parent_item_colon'     => __( 'Parent Item:', 'bsc' ),
    'all_items'             => __( 'Button Lists', 'bsc' ),
    'add_new_item'          => __( 'Add New Button', 'bsc' ),
    'add_new'               => __( 'Add New Button', 'bsc' ),
    'new_item'              => __( 'New Button', 'bsc' ),
    'edit_item'             => __( 'Edit Button', 'bsc' ),
    'update_item'           => __( 'Update Button', 'bsc' ),
    'view_item'             => __( 'View Button', 'bsc' ),
    'view_items'            => __( 'View Buttons', 'bsc' ),
    'search_items'          => __( 'Search Button', 'bsc' ),
    'not_found'             => __( 'Not found', 'bsc' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'bsc' ),
    'featured_image'        => __( 'Featured Image', 'bsc' ),
    'set_featured_image'    => __( 'Set featured image', 'bsc' ),
    'remove_featured_image' => __( 'Remove featured image', 'bsc' ),
    'use_featured_image'    => __( 'Use as featured image', 'bsc' ),
    'insert_into_item'      => __( 'Insert into Button', 'bsc' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Button', 'bsc' ),
    'items_list'            => __( 'Buttons list', 'bsc' ),
    'items_list_navigation' => __( 'Buttons list navigation', 'bsc' ),
    'filter_items_list'     => __( 'Filter Buttons list', 'bsc' ),
);
$args = array(
    'label'                 => __( 'Custom Post', 'bsc' ),
    'description'           => __( 'Custom Post Type Description', 'bsc' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'hierarchical'          => false,
    'public'                => false,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-button',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => false,
    'show_in_rest'          => true,
    'capability_type'       => 'post',
);

register_post_type( 'bs_creator', $args );