<?php
$html = '';
$html .= '<nav class="sections items">';
{
  $html .= '<ul>';
  {
    $sitemap = \dash\url::here(). '/sitemap';

    $html .= '<li>';
    {
      $html .= "<a class='item f' href='". $sitemap. "'>";
      {
        $html .= '<div class="key">'. T_("Sitemap"). '</div>';
        {
          $html .= '<img class="p-4" src="'. \dash\utility\icon::url('Domains'). '">';
        }
        $html .= '</a>';
      }
    }
    $html .= '</li>';
  }
  $html .= '</ul>';
}
$html .= '</nav>';


$html .= '<nav class="sections items">';
{
  $html .= '<ul>';
  {
    $staticfile = \dash\url::here(). '/staticfile';

    $html .= '<li>';
    {
      $html .= "<a class='item f' href='". $staticfile. "'>";
      {
        $html .= '<div class="key">'. T_("Static file"). '</div>';
        {
          $html .= '<img class="p-4" src="'. \dash\utility\icon::url('Tools'). '">';
        }
        $html .= '</a>';
      }
    }
    $html .= '</li>';
  }
  $html .= '</ul>';
}
$html .= '</nav>';



echo $html;
?>
