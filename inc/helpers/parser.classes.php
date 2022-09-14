<?php
// base code from https://dev.to/techmesh/wordpress-minify-css-html-js-files-using-php-2pb9
// #TODO move this class in plugin soon
namespace PressWind\inc\parser;

/**
 * Parser html string class
 */
class HTML_Parser
{
  /**
   * compress the css
   */
  protected bool $compress_css = true;

  /**
   * compress the js
   */
  protected bool $compress_js = true;

  /**
   * display info compression at the end of file
   */
  protected bool $info_comment = true;

  /**
   * remove the comment
   */
  protected bool $remove_comments = true;

  /**
   * remove the comment
   */
  protected bool $compress_html = true;

  /**
   * raw html page
   */
  protected string $raw = '';

  /**
   * html !
   */
  protected string $html = '';

  /**
   * construct
   * @param $html {string}
   */
  public function __construct(string $html)
  {
    $this->raw = $html;
    $this->parseHTML();
  }

  public function __toString(): string
  {
    return $this->html;
  }

  /** find image with classes nolazy for replace lazy to eager */
  public function eagerImage()
  {
    $content = mb_convert_encoding($this->raw, 'HTML-ENTITIES', "UTF-8");
    $document = new \DOMDocument();
    libxml_use_internal_errors(true);
    if (!$content) {
      return $content;
    }
    $document->loadHTML(utf8_decode($content));
    $xpath = new \DOMXpath($document);

    $lazyImgs = $xpath->query("//*[contains(@class,'nolazy')]/img");

    foreach ($lazyImgs as $key => $value) {
      $value->setAttribute('loading', 'eager');
    }

    return $document->saveHTML();
  }

  /**
   * add bottom comment
   */
  protected function bottomComment(string $raw, string $compressed): string
  {
    $raw = strlen($raw);
    $compressed = strlen($compressed);
    $savings = ($raw - $compressed) / $raw * 100;
    $savings = round($savings, 2);
    return '<!--HTML compressed, size saved ' . $savings . '%. From ' . $raw . ' bytes, now ' . $compressed . ' bytes-->';
  }


  /**
   * parse and compress string
   */
  protected function compressHTML(): string
  {
    $raw = $this->raw;
    // explode to fragment with tag type
    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
    preg_match_all($pattern, $raw, $matches, PREG_SET_ORDER);

    // init var
    $overriding = false;
    $raw_tag = false;
    $html = '';

    foreach ($matches as $token) {
      // keep tag type name
      $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
      // content tag
      $content = $token[0];
      // no tag type
      if (is_null($tag)) {
        // is script
        if (!empty($token['script'])) {
          $strip = $this->compress_js;
          // is style
        } else if (!empty($token['style'])) {
          $strip = $this->compress_css;
          // is comment for no compress
        } else if ($content == '<!--wp-html-compression no compression-->') {
          $overriding = !$overriding;
          continue;
          // comment
        } else if ($this->remove_comments) {
          if (!$overriding && $raw_tag != 'textarea') {
            $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
          }
        }
      } else {
        // if pre or textarea
        if ($tag == 'pre' || $tag == 'textarea') {
          $raw_tag = $tag;
        } else if ($tag == '/pre' || $tag == '/textarea') {
          $raw_tag = false;
        } else {
          if ($tag == 'body') {
            $in_body = true;
          }
          if ($raw_tag || $overriding) {
            $strip = false;
          } else {
            $strip = true;
            $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
            $content = str_replace(' />', '/>', $content);
          }
        }
      }
      // if strip => clean
      if ($strip) {
        $content = $this->removeWhiteSpace($content);
      }
      // add to html
      $html .= $content;
    }
    return $html;
  }


  /**
   * handler html
   * @param $html {string}
   */
  public function parseHTML(): void
  {
    // eager img with nolazy classes
    $this->raw = $this->eagerImage();
    // compress
    $this->html = $this->compress_html ? $this->compressHTML() : $this->raw;
    // add comment result of compression
    $this->html = $this->info_comment ?  $this->html . "\n" . $this->bottomComment($this->raw, $this->html) : $this->html;
  }

  /**
   * clean whitespace
   */
  protected function removeWhiteSpace(string $str): string
  {
    $str = str_replace("\t", ' ', $str);
    $str = str_replace("\n",  '', $str);
    $str = str_replace("\r",  '', $str);
    $str = str_replace(" This function requires postMessage and CORS (if the site is cross domain).", '', $str);
    while (stristr($str, '  ')) {
      $str = str_replace('  ', ' ', $str);
    }
    return $str;
  }
}


function parsing_end(string $html): string
{
  do_action('qm/debug', 'end parsing');
  return new HTML_Parser($html);
}


function parsing_start(): void
{
  if (!is_admin()) {
    do_action('qm/debug', 'start parsing');
    ob_start(__NAMESPACE__ . '\parsing_end');
  }
}
