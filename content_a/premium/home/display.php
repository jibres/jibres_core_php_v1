<?php

$premiumList = \dash\data::premiumList();

if(!is_array($premiumList))
{
  $premiumList = [];
}

$html = '';
$html .= '<nav class="items">';
$html .= '<ul>';
foreach ($premiumList as $key => $value)
{

  $date_title = '';
  if(a($value, 'datemodified'))
  {
    $date_title .= T_("Date modified"). ': '. \dash\fit::date_time(a($value, 'datemodified')). "\n";
  }
  if(a($value, 'publishdate'))
  {
    $date_title .= T_("Publish date"). ': '. \dash\fit::date_time(a($value, 'publishdate'));
  }

    $html .= '<li>';
    $html .= '<a class="item f align-center" href="'. \dash\url::this(). '/view/'.  a($value, 'premium_key'). '">';

    $html .= '<div class="key">'.  a($value, 'title'). '</div>';
    $html .= '<time class="value" datatime="'. $date_title. '">'. \dash\fit::number(a($value, 'price')). '</time>';
    $html .= '<div class="go"></div>';
    $html .= '</a>';
    $html .= '</li>';

}
$html .= '</ul>';
$html .= '</nav>';

echo $html;

\dash\utility\pagination::html();
?>