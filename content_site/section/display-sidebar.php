<?php


$html     = '';

$html .= '<div data-xhr="sitebuilderOptionXhr">';

if(\dash\data::sectionList())
{
  /**
   * Load section list to choose it
   */
  $last_group = null;

  $adding_detail = \dash\data::addingDetail();
  $adding_key    = a($adding_detail, 'preview', 'key');
  $adding_type  = a($adding_detail, 'preview', 'type');


  foreach (\dash\data::sectionList() as $group => $items)
  {
    $html .= '<label>'. $group. '</label>';
    $html .= '<nav class="sections items">';
    $html .= '<ul>';
    foreach ($items as $item)
    {
      $adding_this = false;
      if(a($item, 'key') === $adding_key && a($item, 'type') === $adding_type)
      {
        $adding_this = true;
      }

      $show_preview_link = \dash\url::this(). \dash\request::full_get(['section' => a($item, 'key')]);

      // $data = json_encode(['key' => a($item, 'key'), 'type' => a($item, 'type'), 'section' => 'preview']);
      $html .= '<li>';
      // $html .= "<a class='item f' data-ajaxify data-data='". $data. "'>";
      $html .= "<a class='item f' href='". $show_preview_link. "'>";
      $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($item, 'icon'). '">';
      $html .= '<div class="key">'. a($item, 'title'). '</div>';
      if($adding_this)
      {
        $html .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
      }
      $html .= '</a>';
      $html .= '</li>';
    }
    $html .= '</ul>';
    $html .= '</nav>';

  }

}
else
{
  /**
   * Load options of one section
   */


  $options_list = \dash\data::currentOptionList();
  $child        = \dash\url::child();
  $subchild     = \dash\url::subchild();
  $folder       = \dash\data::currentSectionDetail_mode();

  if($subchild && isset($options_list[$subchild]) && is_array($options_list[$subchild]))
  {
    foreach ($options_list[$subchild] as $key => $option)
    {
      if($option === 'background_pack')
      {
        $html .= \content_site\call_function::option_admin_html($option, \dash\data::currentSectionDetail());
        break;
      }
      else
      {
        $html .= \content_site\call_function::option_admin_html($option, \dash\data::currentSectionDetail());

      }
    }
  }
  elseif(is_array($options_list))
  {
    foreach ($options_list as $key => $option)
    {
      if(is_string($option))
      {
        $html .= \content_site\call_function::option_admin_html($option, \dash\data::currentSectionDetail());
      }
      elseif(is_array($option))
      {
        $html .= \content_site\call_function::option_admin_html($key, \dash\data::currentSectionDetail());
      }
    }

  }


}

$html .= '</div>';

echo $html;
?>