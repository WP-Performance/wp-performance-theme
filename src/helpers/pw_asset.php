<?php

namespace PressWind\Src\Helpers;

/**
 * Class PwAsset
 * @package PressWind\Src\Helpers
 */
class PwAsset {

  /**
   * handle of file
   * @var string
   */
  private string $handle;

  /**
   * path to file
   * @var string
   */
  private string $src;

  /**
   * dependencies of file
   * @var array
   */
  private array $deps = [];

  /**
   * version of file
   * @var string
   */
  private string $ver;

  /**
   * move script to footer
   * @var bool
   */
  private bool $in_footer = false;

  /**
   * attribute defer or async
   * @var string
   */
  private string $strategy = '';

  /**
   * attribute module
   * @var bool
   */
  private bool $is_module = false;

  /**
   * attribute nomodule
   * @var bool
   */
  private bool $is_nomodule = false;

  /**
   * for css only
   * @var string
   */
  private string $media = 'all';

  /**
   * @param $handle
   * @param $src
   *
   * @throws \Exception
   */
  private function __construct($handle, $src) {
    if(!is_string($handle)) {
      throw new \Exception('handle must be a string');
    }
    if (!is_string($src)) {
      throw new \Exception('src must be a string');
    }
    $this->handle = $handle;
    $this->src = $src;
  }

  /**
   * Create new asset instance
   *
   * @param $handle
   * @param $src
   *
   * @return PwAsset
   * @throws \Exception
   */
  public static function add( $handle, $src ) {
    try {
      $asset = new PwAsset( $handle, $src );
    } catch ( \Exception $e ) {
      throw new \Exception( $e->getMessage() );
    }
    return $asset;
  }

  /**
   * define dependencies for asset
   *
   * @param array $deps
   *
   * @return PwAsset object
   */
  public function dependencies(array $deps ): PwAsset {
    $this->deps = $deps;
    return $this;
  }


  /**
   * define version for asset
   * if not defined, get filemtime
   *
   * @param string $ver
   *
   * @return PwAsset object
   */
  public function version(string $ver): PwAsset {
    $this->ver = $ver;
    return $this;
  }

  /**
   * define if asset is in footer
   *
   * @return PwAsset object
   */
  public function inFooter(): PwAsset {
    $this->in_footer = true;
    return $this;
  }

  public function media(string $media): PwAsset {
    $this->media = $media;
    return $this;
  }

  /**
   * define if asset has module attribute
   *
   * @return PwAsset object
   */
  public function module(): PwAsset {
    $this->is_module = true;
    $this->is_nomodule = false;
    return $this;
  }

  /**
   * define if asset has nomodule attribute
   *
   * @return PwAsset object
   */
  public function noModule(): PwAsset {
    $this->is_nomodule = true;
    $this->is_module = false;
    return $this;
  }

  /**
   * define if script is defer
   *
   * @return PwAsset object
   */
  public function defer(): PwAsset {
    $this->strategy = 'defer';
    return $this;
  }

  /**
   * define if script is async
   *
   * @return PwAsset object
   */
  public function async(): PwAsset {
    $this->strategy = 'async';
    return $this;
  }

  /**
   * get version of file
   *
   * @return string
   */
  public function getVersion(): string {
    $dir = get_template_directory();
    // determine path to file in server
    $path = str_replace(get_template_directory_uri(), '', $this->src);
    // get file path
    $file = $dir . $path;
    return $this->ver ?? filemtime($file);
  }

  private function isCss(): bool {
    return str_contains($this->src, '.css');
  }

  /**
   * enqueue asset
   */
  private function enqueue(): void {
    $arg = [
      'in_footer' => $this->in_footer,
    ];
    if ( $this->strategy !== '' ) {
      $arg['strategy'] = $this->strategy;
    }
    $handle = $this->handle;
    $src    = $this->src;
    $deps   = $this->deps;
    $ver    = $this->getVersion();
    $media  = $this->media;

    if ( $this->isCss() ) {
      wp_enqueue_style(
        $handle,
        $src,
        $deps,
        $ver,
        $media
      );
      return;
    }

    wp_enqueue_script(
      $handle,
      $src,
      $deps,
      $ver,
      $arg
    );

    if ( $this->is_module || $this->is_nomodule ) {
      $this->addAttributes();
    }
  }

  private function addAttributes(): void {
    $handle = $this->handle;
    add_filter('script_loader_tag', function ($tag, $_handle) use ($handle) {

      if ( ! str_contains( $_handle, $handle ) ) {
        return $tag;
      }
      $type = $this->is_module ? 'module' : 'nomodule';
      return str_replace( ' src', ' type="' . $type . '" src', $tag );
    }, 10, 3);
  }

  /**
   * enqueue asset in front
   */
  public function toFront(): void {
    $enqueue = function () {
      $this->enqueue();
    };
    add_action('wp_enqueue_scripts', $enqueue);
  }

  /**
   * enqueue asset in back
   */
  public function toBack(): void {
    $enqueue = function () {
      $this->enqueue();
    };
    add_action('admin_enqueue_scripts', $enqueue);
  }

  /**
   * enqueue asset in block editor
   */
  public function toBlock(): void {
    $enqueue = function () {
      $this->enqueue();
    };
    add_action('enqueue_block_editor_assets', $enqueue);
  }

  /**
   * enqueue asset in login
   */
  public function toLogin(): void {
    $enqueue = function () {
      $this->enqueue();
    };
    add_action('login_enqueue_scripts', $enqueue);
  }


}
