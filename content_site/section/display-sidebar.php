<?php
if(\dash\data::sectionList())
{
  /**
   * Load section list to choose it
   */
  $result     = '';
  $last_group = null;

  $adding_detail = \dash\data::addingDetail();
  $adding_key    = a($adding_detail, 'preview', 'key');
  $adding_style  = a($adding_detail, 'preview', 'style');


  foreach (\dash\data::sectionList() as $group => $items)
  {
    $result .= '<label>'. $group. '</label>';
    $result .= '<nav class="sections items">';
    $result .= '<ul>';
    foreach ($items as $item)
    {
      $adding_this = false;
      if(a($item, 'key') === $adding_key && a($item, 'style') === $adding_style)
      {
        $adding_this = true;
      }

      $show_preview_link = \dash\url::this(). \dash\request::full_get(['section' => a($item, 'key')]);

      // $data = json_encode(['key' => a($item, 'key'), 'style' => a($item, 'style'), 'section' => 'preview']);
      $result .= '<li>';
      // $result .= "<a class='item f' data-ajaxify data-data='". $data. "'>";
      $result .= "<a class='item f' href='". $show_preview_link. "'>";
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

  echo $result;
}
else
{
  /**
   * Load options of one section
   */
  $html = '';

  $options_list = \dash\data::currentOptionList();
  $child        = \dash\url::child();
  $subchild     = \dash\url::subchild();
  $folder       = \dash\data::currentSectionDetail_mode();

  if($subchild && isset($options_list[$subchild]) && is_array($options_list[$subchild]))
  {
    foreach ($options_list[$subchild] as $key => $option)
    {
      $html .= \content_site\call_function::option_admin_html($option, \dash\data::currentSectionDetail());
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

  echo $html;

}

?>