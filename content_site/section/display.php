<?php

$result     = '';
$last_group = null;

$adding_detail = \dash\data::addingDetail();
$adding_key = a($adding_detail, 'preview', 'key');

foreach (\dash\data::sectionList() as $group => $items)
{
  $result .= '<label>'. $group. '</label>';
  $result .= '<nav class="sections items">';
  $result .= '<ul>';
  foreach ($items as $item)
  {
    $adding_this = false;
    if(a($item, 'key') === $adding_key)
    {
      $adding_this = true;
    }

    $data = json_encode(['key' => a($item, 'key'), 'section' => 'preview']);
    $result .= '<li>';
    $result .= "<a class='item f' data-ajaxify data-data='". $data. "'>";
    $result .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($item, 'icon'). '">';
    $result .= '<div class="key">'. a($item, 'title'). '</div>';
    if($adding_this)
    {
      $result .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
    }
    $result .= '</a>';
    $result .= '</li>';
  }
  $result .= '</ul>';
  $result .= '</nav>';

}

if(\dash\data::adding())
{
  $data = json_encode(['select' => 'adding']);
  $result .= "<div class='btn master' data-ajaxify data-data='".$data."'>";
  $result .= T_("Select");
  $result .= '</div>';
}


echo $result;
?>