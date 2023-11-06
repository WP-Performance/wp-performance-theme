<?php

namespace PressWind\src\helpers\base;

class Asset
{
    /**
     * handle of file
     */
    protected string $handle;

    /**
     * path to file
     */
    protected string $src;

    /**
     * dependencies of file
     */
    protected array $deps = [];

    /**
     * version of file
     */
    protected string $ver;

    /**
     * @throws \Exception
     */
    public function __construct($handle, $src)
    {
        if (! is_string($handle)) {
            throw new \Exception('handle must be a string');
        }
        if (! is_string($src)) {
            throw new \Exception('src must be a string');
        }
        $this->handle = $handle;
        $this->src = $src;
    }

    /**
     * define dependencies for asset
     *
     *
     * @return Asset object
     */
    public function dependencies(array $deps): Asset
    {
        $this->deps = $deps;

        return $this;
    }

    /**
     * define version for asset
     * if not defined, get filemtime
     *
     *
     * @return Asset object
     */
    public function version(string $ver): Asset
    {
        $this->ver = $ver;

        return $this;
    }

    /**
     * get version of file
     */
    protected function getVersion(): string
    {
        $dir = get_template_directory();
        // determine path to file in server
        $path = str_replace(get_template_directory_uri(), '', $this->src);
        // get file path
        $file = $dir.$path;

        return $this->ver ?? filemtime($file);
    }

    /**
     * enqueue asset in front
     */
    public function toFront(): void
    {
        $enqueue = function () {
            $this->enqueue();
        };
        add_action('wp_enqueue_scripts', $enqueue);
    }

    protected function enqueue(): void
    {
    }

    /**
     * enqueue asset in back
     */
    public function toBack(): void
    {
        $enqueue = function () {
            $this->enqueue();
        };
        add_action('admin_enqueue_scripts', $enqueue);
    }

    /**
     * enqueue asset in block editor
     */
    public function toBlock(): void
    {
        $enqueue = function () {
            $this->enqueue();
        };
        add_action('enqueue_block_editor_assets', $enqueue);
    }

    /**
     * enqueue asset in login
     */
    public function toLogin(): void
    {
        $enqueue = function () {
            $this->enqueue();
        };
        add_action('login_enqueue_scripts', $enqueue);
    }
}
