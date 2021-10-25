<?php
namespace dash\layout\panelBuilder;

class sidebar
{
  public static function html()
  {
    // generate html of sidebar
    $myMenu = sidebarMenu::list0();

    if(!is_array($myMenu))
    {
      return null;
    }

    $html = '';

    foreach ($myMenu as $index => $group)
    {
      $html .= '<nav';
      if(a($group, 'group'))
      {
        $html .= ' data-group="'. a($group, 'group'). '"';
      }
      $html .= '>';
      $groupItems = a($group, 'items');
      if(is_array($groupItems))
      {
        foreach ($groupItems as $key => $value)
        {
          if(a($value, 'title'))
          {
            if(a($value, 'link'))
            {
              $html .= '<a href="'. a($value, 'link'). '"';
            }
            else
            {
              $html .= '<div';
            }

            $itemClass = 'block';
            if(a($value, 'class'))
            {
              $itemClass .= ' '. a($value, 'class');
            }
            $html .= ' class="'. $itemClass. '"';


            if(a($group, 'level') !== null)
            {
              $html .= ' data-level="'. a($group, 'level'). '"';
            }
            $html .= '>';

            if(a($value, 'icon'))
            {
              if(a($value, 'iconGroup'))
              {
                $html .= \dash\utility\icon::svg(a($value, 'icon'), a($value, 'iconGroup'));
              }
              else
              {
                $html .= \dash\utility\icon::svg(a($value, 'icon'));
              }
            }

            // add title
            $html .= '<span>';
            $html .= a($value, 'title');
            $html .= '</span>';

            if(a($value, 'link'))
            {
              $html .= '</a>';
            }
            else
            {
              $html .= '</div>';
            }
          }
        }
      }
      $html .= '</nav>';
    }

    return $html;
  }
}
?>