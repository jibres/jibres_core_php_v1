<?php

$result     = '';
$last_group = null;

foreach (\dash\data::sectionList() as $group => $items)
{
  $result .= '<label>'. $group. '</label>';
  $result .= '<nav class="sections items">';
  $result .= '<ul>';
  foreach ($items as $item)
  {
    $data = json_encode(['key' => a($item, 'key'), 'section' => 'preview']);
    $result .= '<li>';
    $result .= "<a class='item f' data-ajaxify data-data='". $data. "'>";
    $result .= '<img src="'. a($item, 'icon'). '">';
    $result .= '<div class="key">'. a($item, 'title'). '</div>';
    $result .= '</a>';
    $result .= '</li>';
  }
  $result .= '</ul>';
  $result .= '</nav>';

}


echo $result;
?>