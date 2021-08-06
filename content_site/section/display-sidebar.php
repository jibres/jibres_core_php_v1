<?php


$html     = '';

$html .= '<div data-xhr="sitebuilderOptionXhr">';

if(\dash\data::sectionList())
{
  if(\dash\data::changeSectionTypeMode())
  {
    // nothing
  }
  else
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

}
else
{
  /**
   * Load options of one section
   */

  $currentSectionDetail = \dash\data::currentSectionDetail();

  if(a($currentSectionDetail, 'status_preview') === 'deleted')
  {
      /**
       * btn restore
       */
      $restore_json    = json_encode(['restore' => 'section']);

      $html .= '<p class="msg">';
      $html .= T_("This setting was removed. But you can restore it. If you save page, this section completely removed and can not be restore");
      $html .= '</p>';
      $restore_title = T_("Are you sure to restore this section?");

      $html .= '<div class="row w-full">';
      {
        $html .= "<div tabindex=0 class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 hover:text-red-500 focus:text-red-600 active:text-red-700 transition p-3 rounded-lg' data-confirm data-title='$restore_title' data-data='$restore_json'>";
        {
          $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Redo', 'major'). '" alt="Delete">';
          $html .= '<span class="inline-block align-middle ps-2">'. T_("Restore section").'</span>';
        }
        $html .= '</div>';

      }
      $html .= '</div>';

  }
  else
  {

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
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
          break;
        }
        else
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);

        }
      }
    }
    elseif(is_array($options_list))
    {
      foreach ($options_list as $key => $option)
      {
        if(is_string($option))
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
        }
        elseif(is_array($option))
        {
          $html .= \content_site\call_function::option_admin_html($key, $currentSectionDetail);
        }
      }

    }
  }

  if(isset($currentSectionDetail['discardable']) && $currentSectionDetail['discardable'] && \dash\url::subchild())
  {
    $html .= '<nav class="items long mT20">';
    {
        $html .= '<ul>';
        {
          $html .= '<li>';
          {
              $html .= "<div class='item f' data-confirm data-data='{\"discard\": \"discard\"}'>";
              {
                $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Undo'). '">';
                $html .= '<div class="key">'. T_("Discard change"). '</div>';
                $html .= '<div class="go"></div>';
              }
              $html .= '</div>';
          }
          $html .= '</li>';
        }
        $html .= '</ul>';
    }
    $html .= '</nav>';
  }
}

$html .= '</div>';

echo $html;
?>