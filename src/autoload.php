<?php

namespace PressWind\Src;

class Autoloader
{
  public static function register() : void
  {
    spl_autoload_register(function ($class): bool {

      // PressWind namespace only
      if( ! str_contains( $class, 'PressWind' ) ) {
        return false;
      }

      // clean namespace
      $path = str_replace(
        ['PressWind', 'Src\\', '\\'], ['', '', DIRECTORY_SEPARATOR], $class).'.php';

      // get last string of path
      $file = substr($path, strrpos($path, DIRECTORY_SEPARATOR));
      // in $end remove DIRECTORY_SEPARATOR and .php
      $file_cleaned = str_replace([DIRECTORY_SEPARATOR, '.php'], '', $file);
      // transform PascalCase to snake_case
      $file_snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0',
        $file_cleaned));

      // construct final path
      $path = str_replace($file_cleaned, $file_snake, $path);
      $final_path = dirname(__FILE__) . strtolower($path);

      if (file_exists($final_path)) {
        require $final_path;
        return true;
      }
      return false;
    });
  }
}

Autoloader::register();
