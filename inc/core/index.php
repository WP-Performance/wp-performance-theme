<?php

// no namespace here, it's voluntary
/**
 * return config global
 *
 * @return array
 */
function get_config()
{
    // default values
    $default = file_get_contents(dirname(__FILE__) . '/default.json');
    // theme values
    $global = file_get_contents(dirname(__FILE__) . '/../../config/global.json');

    // convert to array
    $default = json_decode($default, true);
    $global = json_decode($global, true);

    // override default value
    return array_replace_recursive($default, $global);
}
