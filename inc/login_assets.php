<?php

namespace WP_Performance\Inc;

use PressWind\Helpers\PWAsset;

function login_assets(): void
{
    if (file_exists(dirname(__FILE__).'/../../admin/assets/css/custom-login.css')) {
        PWAsset::add('custom-login', get_template_directory_uri().'/admin/assets/css/custom-login.css')->toLogin();
    }
}
add_action('login_enqueue_scripts', __NAMESPACE__.'\login_assets');
