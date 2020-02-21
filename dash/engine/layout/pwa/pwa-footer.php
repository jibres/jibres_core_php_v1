<?php
if(\dash\engine\layout\pwa\pwa_menu::get())
{
  echo "\n   <nav class='f'>";
  foreach (\dash\engine\layout\pwa\pwa_menu::get() as $item)
  {
    echo "\n    <div class='c'>";
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