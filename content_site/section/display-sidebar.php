<?php


$html     = '';

$html .= '<div data-xhr="sitebuilderOptionXhr">';

if(\dash\data::sidebarSectionList())
{
  /**
   * Load section list to choose it
   */
  $sectionRequestedDetail = \dash\data::sectionRequestedDetail();

  $html .= '<label>'. T_("Plese choose one preview"). '</label>';
  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      $show_preview_link = \dash\url::current(). \dash\request::full_get(['category' => 'all']);

      $html .= '<li>';
      {
        $html .= "<a class='item f' href='". $show_preview_link. "'>";
        {
          // $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($sectionRequestedDetail, 'icon'). '">';
          $html .= '<div class="key">'. T_("All"). '</div>';
          if(\dash\request::get('category') === 'all') // selected
          {
            $html .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
          }
          $html .= '</a>';
        }
      }
      $html .= '</li>';
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';

  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      $show_preview_link = \dash\url::current(). \dash\request::full_get(['category' => 'popular']);

      $html .= '<li>';
      {
        $html .= "<a class='item f' href='". $show_preview_link. "'>";
        {
          // $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($sectionRequestedDetail, 'icon'). '">';
          $html .= '<div class="key">'. T_("Popular"). '</div>';
          if(\dash\request::get('category') === 'popular' || !\dash\request::get('category')) // selected
          {
            $html .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
          }
          $html .= '</a>';
        }
      }
      $html .= '</li>';
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';


  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      foreach (\dash\data::sidebarSectionList() as $key => $item)
      {
        $show_preview_link = \dash\url::current(). \dash\request::full_get(['category' => a($item, 'default', 'type')]);

        $html .= '<li>';
        {
          $html .= "<a class='item f' href='". $show_preview_link. "'>";
          {
            // $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($sectionRequestedDetail, 'icon'). '">';
            $html .= '<div class="key">'. a($item, 'title'). '</div>';
            if(\dash\request::get('category') === a($item, 'default', 'type'))
            {
              $html .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
            }
            $html .= '</a>';
          }
        }
        $html .= '</li>';
      } // endfor
    }
    $html .= '</ul>';
  }
  $html .= '</nav>';

}
elseif(\dash\data::groupSectionList())
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

    foreach (\dash\data::groupSectionList() as $group => $items)
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


      $html .= '<nav class="items long mT20">';
      {
          $html .= '<ul>';
          {
            $html .= '<li>';
            {
                $html .= "<div class='item f' data-confirm data-title='$restore_title' data-data='$restore_json'>";
                {
                  $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Undo'). '">';
                  $html .= '<div class="key">'. T_("Restore section"). '</div>';
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
                $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="Undo" src="'. \dash\utility\icon::url('Undo'). '">';
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


if(\dash\permission::supervisor() && !\dash\url::subchild())
{

  $htmlSupervisor = '';

  $htmlSupervisor .= '<nav class="items long mT20">';
  {
      $htmlSupervisor .= '<ul>';
      {
        $htmlSupervisor .= '<li>';
        {
            $downloadJsonSupervisor = \dash\url::current(). \dash\request::full_get(['downloadjson' => 1]);

            $myFile = \dash\request::get('sid'). '.php';
            $htmlSupervisor .= "<a href='$downloadJsonSupervisor' class='item f' download='$myFile' target='_blank'>";
            {
              $htmlSupervisor .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="code" src="'. \dash\utility\icon::url('Code'). '">';
              $htmlSupervisor .= '<div class="key">'. T_("Download Json"). '</div>';
              $htmlSupervisor .= '<div class="go"></div>';
            }
            $htmlSupervisor .= '</a>';
        }
        $htmlSupervisor .= '</li>';
      }
      $htmlSupervisor .= '</ul>';
  }
  $htmlSupervisor .= '</nav>';

  echo $htmlSupervisor;

}
?>