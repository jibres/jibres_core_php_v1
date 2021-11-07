<?php
if(\dash\layout\pwa\pwa_menu::get())
{
  echo "\n <div class='pwa'>";
  echo "\n  <nav class='f'>";
  foreach (\dash\layout\pwa\pwa_menu::get() as $key => $item)
  {
    $myClass = '';
    if(isset($item['class']) && $item['class'])
    {
      $myClass = ' '. $item['class'];
    }
    echo "\n    <div class='c". $myClass. "' data-key='". $key. "'>";
    if(isset($item['href']))
    {
      echo "<a href='". $item['href']. "'";
      if(isset($item['selected']) && $item['selected'])
      {
        echo " class='selected'";
      }
      echo ">";
      if(isset($item['icon']) && $item['icon'])
      {
        echo "<div class='icon'";
        if(isset($item['cartItem']) && $item['cartItem'])
        {
          echo ' data-item="'. $item['cartItem']. '"';
        }
        echo ">";

        $itemClass = '';
        if(isset($item['iconPulse']) && $item['iconPulse'])
        {
          $itemClass = 'pulse';
        }
        if(isset($item['iconGroup']))
        {
          echo \dash\utility\icon::svg($item['icon'], $item['iconGroup'], $itemClass);
        }
        else
        {
          echo \dash\utility\icon::bootstrap($item['icon'], $itemClass);
        }
        echo "</div>";
      }
      if(isset($item['title']) && $item['title'])
      {
        echo "<div class='title'>". $item['title']. "</div>";
      }
      echo "</a>";
    }
    if(isset($item['form']))
    {
      echo "<button form='". $item['form']. "'>";
      if(isset($item['title']) && $item['title'])
      {
        echo $item['title'];
      }
      echo "</button>";
    }
    echo "</div>";
  }
  echo "\n  </nav>\n ";
  echo "\n </div>\n ";
}
?>