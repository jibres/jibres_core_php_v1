<?php

$pluginList = \dash\data::pluginList();

if(!is_array($pluginList))
{
  $pluginList = [];
}

$html = '';
$html .= '<div class="row">';
{
  foreach ($pluginList as $key => $value)
  {
    $html .= '<div class="c-3">';
    {
      $html .= '<a class="" href="'. \dash\url::this(). '/view/'.  a($value, 'plugin_key'). '">';
      {
        $html .= '<div class="box">';
        {
          $html .= '<div class="body">';
          {
              $html .= '<div class="">'.  a($value, 'title'). '</div>';
              $html .= '<div class="">'.  \dash\fit::number(a($value, 'price')). '</div>';
          }
          $html .= '</div>';
        }
        $html .= '</div>';
      }
      $html .= '</a>';

    }
    $html .= '</div>';
  }


}
$html .= '</div>';


echo $html;

\dash\utility\pagination::html();
?>