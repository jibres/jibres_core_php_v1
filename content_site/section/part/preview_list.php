<?php 

 /**
   * Load section list to choose it
   */
  $sectionRequestedDetail = \dash\data::sectionRequestedDetail();

  $html .= '<label>'. T_("Plese choose one preview"). '</label>';
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
          $html .= '<div class="key">'. T_("All"). '</div>';
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

  $sectionRequestedDetail = \dash\data::sectionRequestedDetail();

  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      foreach (\dash\data::sidebarSectionList() as $key => $item)
      {
        $show_preview_link = \dash\url::current(). \dash\request::full_get(['category' => a($item, 'model')]);

        $html .= '<li>';
        {
          $html .= "<a class='item f' href='". $show_preview_link. "'>";
          {
            // $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-4" src="'. a($sectionRequestedDetail, 'icon'). '">';
            $html .= '<div class="key">'. a($sectionRequestedDetail, 'title'). ' - '. a($item, 'title'). '</div>';
            if(\dash\request::get('category') === a($item, 'model'))
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

?>