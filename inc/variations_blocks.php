<?php

namespace WP_Performance\Inc;

function related_posts_query($query)
{
    global $post;

    $query['post_type'] = 'post';
    $query['posts_per_page'] = 7;
    $query['post__not_in'] = [$post->ID];

    // random
    $query['orderby'] = 'rand';

    remove_filter('query_loop_block_query_vars',
        'my_filter_page_query', 10, 1);

    return $query;
}

add_filter('pre_render_block',
    function ($prerender, $block) {
        // filter block with name Projects-list
        if ($block['attrs'] && array_key_exists('namespace', $block['attrs']) &&
            $block['attrs']['namespace'] === 'wp-performance/related-post') {

            add_filter('query_loop_block_query_vars',
                __NAMESPACE__.'\related_posts_query', 10, 1
            );

        }
    }, 1, 2);
