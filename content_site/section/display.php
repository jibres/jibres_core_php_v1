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

    $result .= '<li>';
    $result .= '<a class="item f" href="<?php echo \dash\url::here() ?>/section/image">';
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