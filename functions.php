<?php

namespace WP_Performance;

if (! defined('WP_ENV')) {
    define('WP_ENV', 'development');
}

// inc, you can modify this files like you want
require_once dirname(__FILE__).'/inc/gutenberg.php';
require_once dirname(__FILE__).'/inc/acf_blocks.php';
require_once dirname(__FILE__).'/inc/login_assets.php';

// post type
require_once dirname(__FILE__).'/post-type/snippet.php';

// pwa icons
if (file_exists(dirname(__FILE__).'/inc/pwa_head.php')) {
    include dirname(__FILE__).'/inc/pwa_head.php';
}

/**
 * Theme setup.
 */
function setup()
{
    add_theme_support('automatic-feed-links');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    load_theme_textdomain('press-wind', get_template_directory().'/languages');
}

add_action('after_setup_theme', __NAMESPACE__.'\setup');

/**
 * init assets front
 */
if (class_exists('PressWind\PWVite')) {

    \PressWind\PWVite::init(port: 3000, path: '');
    /**
     * init assets admin
     */
    \PressWind\PWVite::init(
        port: 4444,
        path: '/admin',
        position: 'editor',
        is_ts: false
    );
}
/** disable caching wp query */
function disable_caching($wp_query)
{
    if (WP_ENV === 'development') {
        $wp_query->query_vars['cache_results'] = false;
    }
}

add_action('parse_query', __NAMESPACE__.'\disable_caching');

add_action('init', function () {
    add_filter('jpeg_quality', function () {
        return 100;
    }, 10, 2);
});

register_block_style(
    'core/image',
    [
        'name' => 'img-dropshadow',
        'label' => __('Drop Shadow', 'press-wind'),
    ]
);

register_block_style(
    'core/image',
    [
        'name' => 'img-dropshadow-rounded',
        'label' => __('Drop Shadow Rounded', 'press-wind'),
    ]
);

register_block_style(
    'core/heading',
    [
        'name' => 'text-gradient',
        'label' => __('Text Gradient', 'press-wind'),
    ]
);

register_block_style(
    'core/heading',
    [
        'name' => 'text-effect',
        'label' => __('Text Effect', 'press-wind'),
    ]
);

function add_img_size($content)
{
    $pattern = '/<img [^>]*?src="(https?:\/\/[^"]+?)"[^>]*?>/iu';
    preg_match_all($pattern, $content, $imgs);
    foreach ($imgs[0] as $i => $img) {
        if (str_contains($img, 'width=') && str_contains($img, 'height=')) {
            continue;
        }
        $img_url = $imgs[1][$i];
        $img_size = @getimagesize($img_url);

        if ($img_size === false) {
            continue;
        }
        $replaced_img = str_replace('<img ', '<img '.$img_size[3].' ', $imgs[0][$i]);
        $content = str_replace($img, $replaced_img, $content);
    }

    return $content;
}
//add_filter('the_content', __NAMESPACE__.'\add_img_size');
