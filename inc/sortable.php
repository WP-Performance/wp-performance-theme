<?php

namespace WP_Performance\Inc;

/** others settings */
$sortable_type = ['training'];

/**
 * sortable plugin
 */
add_filter(
    'simple_page_ordering_is_sortable',
    function ($sortable, $post_type) use ($sortable_type) {
        if (in_array($post_type, $sortable_type)) {
            return true;
        }

        return $sortable;
    },
    10,
    2
);

add_filter('simple_page_ordering_is_sortable', function ($sortable, $post_type) {
    if ($post_type === 'page') {
        return false;
    }

    return $sortable;
}, 10, 2);
