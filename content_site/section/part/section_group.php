<?php 
 /**
  * Load section list to choose it
  */
$last_group = null;

foreach (\dash\data::groupSectionList() as $group => $items)
{
  $html .= '<label>'. $group. '</label>';
  $html .= '<nav class="sections items">';
  $html .= '<ul>';
  foreach ($items as $item)
  {
    $show_preview_link = \dash\url::this(). \dash\request::full_get(['section' => a($item, 'section')]);

    if(a($item, 'section') === 'html')
    {
      $show_preview_link = \dash\url::this().'/html'. \dash\request::full_get();
    }

    $html .= '<li>';
    // $html .= "<a class='item f' data-ajaxify data-data='". $data. "'>";
    $html .= "<a class='item f' href='". $show_preview_link. "'>";
    $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. a($item, 'icon'). '">';
    $html .= '<div class="key">'. a($item, 'title'). '</div>';

    $html .= '</a>';
    $html .= '</li>';
  }
  $html .= '</ul>';
  $html .= '</nav>';
}
 ?>