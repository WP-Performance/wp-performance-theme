<?php

namespace PressWind\postType\Training;

function register_custom_post_type()
{
    $labels = [
        'name' => _x('Trainings', 'Post Type General Name', 'wp-performance'),
        'singular_name' => _x('Training', 'Post Type Singular Name', 'wp-performance'),
        'menu_name' => __('Trainings', 'wp-performance'),
        'name_admin_bar' => __('Trainings', 'wp-performance'),
        'archives' => __('Trainings Archives', 'wp-performance'),
        'attributes' => __('Trainings Attributes', 'wp-performance'),
        'parent_item_colon' => __('Parent Training:', 'wp-performance'),
        'all_items' => __('All Trainings', 'wp-performance'),
        'add_new_item' => __('Add New Training', 'wp-performance'),
        'add_new' => __('Add New', 'wp-performance'),
        'new_item' => __('New Training', 'wp-performance'),
        'edit_item' => __('Edit Training', 'wp-performance'),
        'update_item' => __('Update Training', 'wp-performance'),
        'view_item' => __('View Training', 'wp-performance'),
        'view_items' => __('View Trainings', 'wp-performance'),
        'search_items' => __('Search Trainings', 'wp-performance'),
        'not_found' => __('Training Not Found', 'wp-performance'),
        'not_found_in_trash' => __('Training Not Found in Trash', 'wp-performance'),
        'featured_image' => __('Featured Image', 'wp-performance'),
        'set_featured_image' => __('Set Featured Image', 'wp-performance'),
        'remove_featured_image' => __('Remove Featured Image', 'wp-performance'),
        'use_featured_image' => __('Use as Featured Image', 'wp-performance'),
        'insert_into_item' => __('Insert into Training', 'wp-performance'),
        'uploaded_to_this_item' => __('Uploaded to this Training', 'wp-performance'),
        'items_list' => __('Trainings list', 'wp-performance'),
        'items_list_navigation' => __('Trainings list navigation', 'wp-performance'),
        'filter_items_list' => __('Filter trainings list', 'wp-performance'),
    ];

    $args = [
        'label' => __('Training', 'wp-performance'),
        'description' => __('Training code', 'wp-performance'),
        'labels' => $labels,
        'supports' => [
            'title',
            'editor',
            'custom-fields',
            //            'author',
        ],
        'taxonomies' => [
            'training-theme',
            'training-section',
        ],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'can_export' => true,
        'capability_type' => 'post',
    ];

    register_taxonomy('training-theme', 'training', [
        'public' => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'label' => 'Theme',
    ]);

    register_taxonomy('training-section', 'training', [
        'public' => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'label' => 'Section',
    ]);

    register_post_type('training', $args);
}

add_action('init', __NAMESPACE__.'\register_custom_post_type', 0);
