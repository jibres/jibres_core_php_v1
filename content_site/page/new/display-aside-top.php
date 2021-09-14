<?php
$html = '';
if(\dash\data::templateList_category())
{

  $html .= '<nav class="sections items">';
  {
    $html .= '<ul>';
    {
      $show_preview_link = \dash\url::that(). \dash\request::full_get(['category' => 'all']);

      $html .= '<li>';
      {
        $html .= "<a class='item f' href='". $show_preview_link. "'>";
        {
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
        foreach (\dash\data::templateList_category() as $key => $value)
        {
            $show_preview_link = \dash\url::that(). \dash\request::full_get(['category' => $key]);
            $html .= '<li>';
            {
                $html .= "<a class='item f' href='". $show_preview_link. "'>";
                {
                  $html .= '<div class="key">'. a($value, 'title'). '</div>';
                  if(\dash\request::get('category') === $key) // selected
                  {
                    $html .= '<img class="p-4" src="'. \dash\utility\icon::url('EnableSelection', 'minor'). '">';
                  }
                  $html .= '</a>';
                }
            }
            $html .= '</li>';
        }

    }
    $html .= '</ul>';
  }
  $html .= '</nav>';


}

echo $html;
?>
