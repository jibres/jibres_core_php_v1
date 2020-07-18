<?php
if(\dash\layout\pwa\pwa_menu::get())
{
  echo "\n   <nav class='f'>";
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
        echo "<div class='icon'><i class='sf-". $item['icon']. "'></i></div>";
      }
      if(isset($item['title']) && $item['title'])
      {
        echo "<div class='title'>". $item['title']. "</div>";
      }
      echo "</a>";
    }
    echo "</div>";
  }
  echo "\n  </nav>\n ";
}
?>