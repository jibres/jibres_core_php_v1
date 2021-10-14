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
          $html .= '<img class="p-2.5" src="'. \dash\utility\icon::url('Domains'). '">';
        }
        $html .= '</a>';
      }
    }
    $html .= '</li>';
  }
  $html .= '</ul>';
}
$html .= '</nav>';

if(\dash\permission::check('staticFileVerify'))
{
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
            $html .= '<img class="p-2.5" src="'. \dash\utility\icon::url('Tools'). '">';
          }
          $html .= '</a>';
        }
      }
      $html .= '</li>';
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';

}

if(\dash\permission::check('_group_cms'))
{
  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      $cms = \dash\url::kingdom(). '/cms';

      $html .= '<li>';
      {
        $html .= "<a class='item f' href='". $cms. "' data-direct>";
        {
          $html .= '<div class="key">'. T_("Content Management"). T_(" & "). T_("Blog"). '</div>';
          {
            $html .= '<img class="p-2.5" src="'. \dash\utility\icon::url('Note'). '">';
          }
          $html .= '</a>';
        }
      }
      $html .= '</li>';
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';

}


echo $html;
?>
