<?php

namespace  PressWind\postType\Snippet;

function register_custom_post_type()
{
  $labels = array(
    'name' => _x('Snippets', 'Post Type General Name', 'wp-performance'),
    'singular_name' => _x('Snippet', 'Post Type Singular Name', 'wp-performance'),
    'menu_name' => __('Snippets', 'wp-performance'),
    'name_admin_bar' => __('Snippets', 'wp-performance'),
    'archives' => __('Snippets Archives', 'wp-performance'),
    'attributes' => __('Snippets Attributes', 'wp-performance'),
    'parent_snippet_colon' => __('Parent Snippet:', 'wp-performance'),
    'all_snippets' => __('All Snippets', 'wp-performance'),
    'add_new_snippet' => __('Add New Snippet', 'wp-performance'),
    'add_new' => __('Add New', 'wp-performance'),
    'new_snippet' => __('New Snippet', 'wp-performance'),
    'edit_snippet' => __('Edit Snippet', 'wp-performance'),
    'update_snippet' => __('Update Snippet', 'wp-performance'),
    'view_snippet' => __('View Snippet', 'wp-performance'),
    'view_snippets' => __('View Snippets', 'wp-performance'),
    'search_snippets' => __('Search Snippets', 'wp-performance'),
    'not_found' => __('Snippet Not Found', 'wp-performance'),
    'not_found_in_trash' => __('Snippet Not Found in Trash', 'wp-performance'),
    'featured_image' => __('Featured Image', 'wp-performance'),
    'set_featured_image' => __('Set Featured Image', 'wp-performance'),
    'remove_featured_image' => __('Remove Featured Image', 'wp-performance'),
    'use_featured_image' => __('Use as Featured Image', 'wp-performance'),
    'insert_into_snippet' => __('Insert into Snippet', 'wp-performance'),
    'uploaded_to_this_snippet' => __('Uploaded to this Snippet', 'wp-performance'),
    'snippets_list' => __('Snippets list', 'wp-performance'),
    'snippets_list_navigation' => __('Snippets list navigation', 'wp-performance'),
    'filter_snippets_list' => __('Filter snippets list', 'wp-performance'),
  );

  $args = array(
    'label' => __('Snippet', 'wp-performance'),
    'description' => __('Snippet code', 'wp-performance'),
    'labels' => $labels,
    'supports' => array(
      'title',
      'editor',
    ),
    'taxonomies' => array(
      'snippet-category'
    ),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-editor-code',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'can_export' => true,
    'capability_type' => 'post',
  );

  register_taxonomy('snippet-category', 'snippet', [
    'public' => true,
    'show_ui' => true,
    'hierarchical' => true,
    'show_tagcloud' => false,
    'show_admin_column' => true,
    'show_in_rest' => true,
  ]);


  register_post_type('snippet', $args);
}


add_action('init', __NAMESPACE__ . '\register_custom_post_type', 0);
