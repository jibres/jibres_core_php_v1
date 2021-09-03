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
    if(\dash\layout\pwa\pwa_menu::get())
    {

      $footer .= "<div class='pwa'>";
      $footer .= "<nav class='flex'>";
      foreach (\dash\layout\pwa\pwa_menu::get() as $key => $item)
      {
        $myClass = '';
        if(isset($item['class']) && $item['class'])
        {
          $myClass = ' '. $item['class'];
        }
        $footer .= "<div class='flex-grow". $myClass. "' data-key='". $key. "'>";
        if(isset($item['href']))
        {
          $footer .= "<a href='". $item['href']. "'";
          if(isset($item['selected']) && $item['selected'])
          {
            $footer .= " class='selected'";
          }
          $footer .= ">";
          if(isset($item['icon']) && $item['icon'])
          {
            // $footer .= "<div class='icon'><i class='sf-". $item['icon']. "'></i></div>";
            $footer .= "<div class='icon'>";
            $footer .= "<i class='sf-". $item['icon'];
            if(isset($item['iconPulse']) && $item['iconPulse'])
            {
              $footer .= " pulse";
            }
            $footer .= "'";
            if(isset($item['cartItem']) && $item['cartItem'])
            {
              $footer .= ' data-item="'. $item['cartItem']. '"';
            }
            $footer .= ">";
            $footer .= "</i>";
            $footer .= "</div>";

          }
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
    echo $footer;
  }
}
?>