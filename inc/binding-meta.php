<?php

namespace WP_Performance\Inc;

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
}

add_action('init', __NAMESPACE__ . '\register_block_bindings');
