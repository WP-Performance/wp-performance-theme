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
require_once dirname(__FILE__) . '/inc/blocks.php';

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

function add_img_size($content){
  $pattern = '/<img [^>]*?src="(https?:\/\/[^"]+?)"[^>]*?>/iu';
  preg_match_all($pattern, $content, $imgs);
  foreach ( $imgs[0] as $i => $img ) {
    if ( str_contains( $img, 'width=' ) && str_contains( $img, 'height=' ) ) {
      continue;
    }
    $img_url = $imgs[1][$i];
    $img_size = @getimagesize( $img_url );

    if ( false === $img_size ) {
      continue;
    }
    $replaced_img = str_replace( '<img ', '<img ' . $img_size[3] . ' ', $imgs[0][$i] );
    $content = str_replace( $img, $replaced_img, $content );
  }
  return $content;
}
add_filter('the_content',__NAMESPACE__ . '\add_img_size');
