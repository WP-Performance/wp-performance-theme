<?php

namespace WP_Performance\Inc;


function get_hero_category($args)
{
    global $post;

    $post_type = $post->post_type;

    switch ($post_type) {
        case 'post':
            return __('Articles, archives et categories', 'press-wind');
            break;
        case 'snippet':
            return __('Snippets, archives et categories', 'press-wind');
            break;
        default:
            return __('Archives et categories', 'press-wind');
            break;
    }
}




function register_block_bindings()
{
    register_meta(
        'post',
        'wp_performance-page-thematic',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'sanitize_callback' => 'wp_strip_all_tags',
            'default'           => 'Totalement open-source',
        )
    );

    register_block_bindings_source('wpperformance/hero-category', array(
        'label'              => __('Hero theme category', 'press-wind'),
        'get_value_callback' =>  __NAMESPACE__ . '\get_hero_category',
    ));
}

add_action('init', __NAMESPACE__ . '\register_block_bindings');
