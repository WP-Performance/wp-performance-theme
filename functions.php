<?php

namespace  PressWind;

use function PressWind\Inc\Core\load_assets;

if (!defined('WP_ENV')) {
  define('WP_ENV', 'development');
}

// include core files (don't touch this files !)
require_once dirname(__FILE__) . '/inc/core/core.php';

// inc, you can modify this files like you want
require_once dirname(__FILE__) . '/inc/disable.php';
require_once dirname(__FILE__) . '/inc/gutenberg.php';

// post type
require_once dirname(__FILE__) . '/post-type/snippet.php';

// pwa icons
if (file_exists(dirname(__FILE__) . '/inc/pwa_head.php')) {
  include dirname(__FILE__) . '/inc/pwa_head.php';
}

/**
 * Theme setup.
 */
function setup()
{
  add_theme_support('automatic-feed-links');

  add_theme_support('title-tag');

  add_theme_support('post-thumbnails');

  load_theme_textdomain('press-wind', get_template_directory() . '/languages');
}

add_action('after_setup_theme', __NAMESPACE__ . '\setup');

/**
 * init assets front
 */
load_assets('press-wind', dirname(__FILE__) . '', '3000');
/**
 * init assets admin
 */
load_assets('press-wind-admin', dirname(__FILE__) . '/admin', '4444', true);


/** disable caching wp query */
function disable_caching($wp_query)
{
  if (WP_ENV === 'development') {
    $wp_query->query_vars['cache_results'] = false;
  }
}
add_action('parse_query', __NAMESPACE__ . '\disable_caching');


register_block_style(
  'core/image',
  array(
    'name'         => 'img-dropshadow',
    'label'        => __('Drop Shadow', 'press-wind'),
  )
);

register_block_style(
  'core/image',
  array(
    'name'         => 'img-dropshadow-rounded',
    'label'        => __('Drop Shadow Rounded', 'press-wind'),
  )
);

register_block_style(
  'core/heading',
  array(
    'name'         => 'text-gradient',
    'label'        => __('Text Gradient', 'press-wind'),
  )
);

register_block_style(
  'core/heading',
  array(
    'name'         => 'text-effect',
    'label'        => __('Text Effect', 'press-wind'),
  )
);
