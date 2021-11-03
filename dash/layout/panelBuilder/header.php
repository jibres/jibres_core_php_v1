<?php
namespace dash\layout\panelBuilder;

class header
{
  public static function html()
  {
    $html = '';

    $masterUrl  = \dash\url::kingdom();
    $targetLink = '';
    if(\dash\engine\store::inStore())
    {
      $masterUrl  = \lib\store::url();
      $targetLink = ' target="_blank"';
    }

    $html .= '<div class="h-full flex flex-wrap content-center px-3">';

    $html .= '123';
    $html .= '</div>';




    return $html;
  }
}
?>