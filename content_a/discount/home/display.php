<?php


$html = '';
$html .= '<nav class="items">';
$html .= '<ul>';
foreach (\dash\data::dataTable() as $key => $value)
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
    $html .= '<a class="item f align-center" href="'. \dash\url::this(). '/edit?id='.  a($value, 'id'). '">';

    $html .= '<div class="key">'.  a($value, 'code'). '</div>';
    $html .= '<time class="value" datatime="'. $date_title. '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
    $html .= '<div class="value">'. a($value, 'status'). '</div>';
    $html .= '<div class="go"></div>';
    $html .= '</a>';
    $html .= '</li>';

}
$html .= '</ul>';
$html .= '</nav>';

echo $html;

\dash\utility\pagination::html();
?>