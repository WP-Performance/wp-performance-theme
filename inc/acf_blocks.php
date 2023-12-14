<?php

namespace WP_Performance\Inc;

/**
 * for ACF blocks if you use that
 */
add_action(
    'init',
    function () {
        // scan blocks folder and register all folder found
        $blocks = scandir(dirname(__FILE__).'/../blocks');
        foreach ($blocks as $block) {
            if (is_dir(dirname(__FILE__).'/../blocks/'.$block) && $block !== '.' && $block !== '..') {
                register_block_type_from_metadata(dirname(__FILE__).'/../blocks/'.$block);
            }
        }
    }
);
