<?php
namespace dash\layout\pwa;
/**
 * dash main configure
 */
class footer2
{
  public static function html()
  {
    $footer = null;
    $load_footer = \dash\layout\pwa\pwa_menu::get();
    if($load_footer)
    {
      $footer .= "<div class='pwa'>";
      $footer .= "<nav class='flex'>";
      foreach ($load_footer as $key => $item)
      {
        $myClass = '';
        if(isset($item['class']) && $item['class'])
        {
          $myClass = ' '. $item['class'];
        }
        $footer .= "<div class='flex-1". $myClass. "' data-key='". $key. "'>";
        if(isset($item['href']))
        {
          $footer .= "<a href='". $item['href']. "'";
          if(isset($item['selected']) && $item['selected'])
          {
            $footer .= " class='selected'";
          }
          $footer .= ">";

          // add icon
          if(isset($item['icon']) && $item['icon'])
          {
            $footer .= "<div class='icon'";
            if(isset($item['cartItem']) && $item['cartItem'])
            {
              $footer .= ' data-item="'. $item['cartItem']. '"';
            }
            if(isset($item['iconPulse']) && $item['iconPulse'])
            {
              $itemClass = ' data-pulse';
            }
            $footer .= ">";

            $itemClass = null;
            if(isset($item['iconGroup']))
            {
              $footer .= \dash\utility\icon::svg($item['icon'], $item['iconGroup'], $itemClass);
            }
            else
            {
              $footer .= \dash\utility\icon::bootstrap($item['icon'], $itemClass);
            }
            $footer .= "</div>";
          }


          // // add img
          // if(isset($item['img']) && $item['img'])
          // {
          //   $footer .= "<div class='icon'>";
          //   $footer .= "<img src='". \dash\utility\icon::src(a($item, 'img')). "' alt ='". a($item, 'title') ."'>";
          //   if(isset($item['iconPulse']) && $item['iconPulse'])
          //   {
          //     $footer .= " class'pulse'";
          //   }
          //   $footer .= "'";
          //   if(isset($item['cartItem']) && $item['cartItem'])
          //   {
          //     $footer .= ' data-item="'. $item['cartItem']. '"';
          //   }
          //   $footer .= ">";
          //   // $footer .= "</i>";
          //   $footer .= "</div>";
          // }


          // add title
          if(isset($item['title']) && $item['title'])
          {
            $footer .= "<div class='title'>". $item['title']. "</div>";
          }
          $footer .= "</a>";
        }
        if(isset($item['form']))
        {
          $footer .= "<button form='". $item['form']. "'>";
          if(isset($item['title']) && $item['title'])
          {
            $footer .= $item['title'];
          }
          $footer .= "</button>";
        }
        $footer .= "</div>";
      }
      $footer .= "</nav>";
      $footer .= "</div>";

    }
    return $footer;
  }
}
?>