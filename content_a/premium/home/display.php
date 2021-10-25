<?php

$premiumList = \dash\data::premiumList();

if(!is_array($premiumList))
{
  $premiumList = [];
}

$html = '';
$html .= '<div class="row">';
{
  foreach ($premiumList as $key => $value)
  {
    $html .= '<div class="c-3">';
    {
      $html .= '<a class="" href="'. \dash\url::this(). '/view/'.  a($value, 'premium_key'). '">';
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