<?php

namespace  PressWind;

if (!defined('WP_ENV')) {
  define('WP_ENV', 'development');
}

require_once dirname(__FILE__) . '/inc/assets.php';
require_once dirname(__FILE__) . '/inc/disable.php';
require_once dirname(__FILE__) . '/inc/gutenberg/index.php';

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

  // add_theme_support('html5', [
  //   'comment-form',
  //   'comment-list',
  //   'gallery',
  //   'caption',
  // ]);

  // add_theme_support('post-formats', [
  //   'aside',
  //   'image',
  //   'video',
  //   'quote',
  //   'link',
  //   'gallery',
  //   'audio',
  // ]);

  // yes we can use register menu with FSE :)
  // register_nav_menus(array(
  //   'primary'   => __('Primary Menu', 'press-wind'),
  //   // 'secondary' => __('Secondary Menu', 'press-wind')
  // ));


  load_theme_textdomain('press-wind', get_template_directory() . '/languages');
}

add_action('after_setup_theme', __NAMESPACE__ . '\setup');


/** limit excerpt */
function excerpt_length($length)
{
  return 40;
}

add_filter('excerpt_length', __NAMESPACE__ . '\excerpt_length', 999);


/** define text for excerpt more */
function excerpt_more($more)
{
  return '...';
}

add_filter('excerpt_more', __NAMESPACE__ . '\excerpt_more');




add_action('wp_head', function () {
  echo "<!-- Google Tag Manager -->
<script type=\"text/partytown\">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NSHVBFH');</script>
<!-- End Google Tag Manager -->";
});
