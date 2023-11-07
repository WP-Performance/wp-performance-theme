<?php

namespace PressWind\src\helpers;

class PWVite
{
    private int $port = 3000;

    private string $slug = 'presswind-script';

    private string $path = '';

    private $is_ts = false;

    private static $dist_path = '/dist/';

    private function __construct(int $port, string $path, bool $is_admin =
    false, bool $is_ts = false)
    {
        $this->port = $port;
        $this->path = $path;
        $this->is_ts = $is_ts;
        if ($is_admin) {
            $this->set_script_admin();
        } else {
            $this->set_script_front();
        }
    }

    public static function init($port = 3000, $path = '')
    {
        return new self($port, $path);
    }

    private function set_script_front()
    {
        if (PWApp::isDev()) {
            $this->set_script_dev();
        } else {
            $this->set_script_prod();
        }
    }

    private function set_script_dev()
    {
        PWAsset::add('presswind-script-dev', 'https://localhost:'.$this->port
                                             .'/'
                                             .$this->get_relative_path_from_wp_content().$this->path.'/main'.($this->is_ts ? '.ts' : '.js'))
            ->inFooter()->module()->toFront();
    }

    private function set_script_prod()
    {
        // get manifest files list by order
        $ordered = PWManifest::get($this->path);
        foreach ($ordered as $key => $value) {
            // if is css
            if (property_exists($value, 'css') === true || strpos($value->src, '.css') !== false) {
                if (strpos($value->src, '.css') > 0) {
                    $css = [$value->file];
                } else {
                    $css = $value->css;
                }
                PWAsset::add($this->slug.'-'.$key, get_template_directory_uri().self::$dist_path.$value->file)
                    ->version($key)
                    ->setOnLoad()
                    ->toFront();

                // if is js
            } else {
                if (str_contains($value->file, 'polyfills-legacy')) {
                    // Legacy nomodule polyfills for dynamic imports for older browsers
                    PWAsset::add($this->slug.'-'.$key, get_template_directory_uri().self::$dist_path.$value->file)
                        ->version($key)
                        ->inFooter()
                        ->nomodule()->toFront();

                    // Safari 10.1 nomodule fix script
                    PWAsset::add($this->slug.'-'.$key, '')->inline('
                      !function () {
                          var e = document, t = e.createElement("script");
                          if (!("noModule" in t) && "onbeforeload" in t) {
                            var n = !1;
                            e.addEventListener("beforeload", function (e) {
                              if (e.target === t) n = !0; else if (!e.target.hasAttribute("nomodule") || !n) return;
                              e.preventDefault()
                            }, !0), t.type = "module", t.src = ".", e.head.appendChild(t), t.remove()
                          }
                      }();', 'before');

                } elseif (str_contains($value->file, 'legacy')) {
                    // Legacy app.js script for legacy browsers
                    PWAsset::add($this->slug.'-'.$key, get_template_directory_uri().self::$dist_path.$value->file)
                        ->version($key)
                        ->inFooter()
                        ->nomodule()->toFront();

                } else {
                    // Modern app.js module for modern browsers
                    PWAsset::add($this->slug.'-'.$key, get_template_directory_uri().self::$dist_path.$value->file)
                        ->version($key)
                        ->inFooter()
                        ->module()->toFront();
                }
            }
        }
    }

    /**
     * get path after wp-content
     */
    public function get_relative_path_from_wp_content()
    {
        // get content dir name
        $content_dir = explode('/', WP_CONTENT_DIR);
        $content_dir = end($content_dir);
        // split path from content dir name
        $_path_ = explode($content_dir, get_template_directory().$this->path);

        return count($_path_) > 0 ? $content_dir.$_path_[1] : '';
    }

    // legacy

}
