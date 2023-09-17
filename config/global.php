<?php

// convert to json
return [
  // directory target for assets generated
  'iconsDir' => 'public',
  // logo source for generate icons
  'source' => './assets/media/icon.svg',
  'manifest' => [
    'appName' => 'Trio',
    'appShortName' => 'Trio',
    'appDescription' => 'Doyenne des agences de communication en Suisse',
    'background' => '#fff',
    'theme_color' => '#C31622',
    'lang' => 'fr-CH',
    // see settings https://www.npmjs.com/package/favicons#usage
    'preferRelatedApplications' => false,
    'pixel_art' => false,
    'loadManifestWithCredentials' => false,
    'manifestMaskable' => false,
    'icons' => [
      'favicons' => true,
      'android' => true,
      'appleIcon' => true,
      'appleStartup' => false,
      'coast' => false,
      'yandex' => false,
      'windows' => false,
    ],
  ],
   'disable' => [
     // disable rss links
     'rss' => true,
     // remove all comments views
     'comment' => true,
     // disable emojis
     'emoji' => true,
     // media page
     'media' => true,
     // disable oembed
     'oembed' => true,
     // disable xmlrpc
     'xmlrpc' => true,
     // disble rest user endpoint
     'rest_user' => true,
     // disable jquery
     'jquery' => false
   ]
];
