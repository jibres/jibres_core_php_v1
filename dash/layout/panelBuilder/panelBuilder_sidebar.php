<?php

$sideNavTop = \dash\layout\func::display_addr(). '-aside-top.php';
if(is_file($sideNavTop))
{
  echo '<div class="h-full flex flex-col p-2 md:p-4">';
  {
    echo '<div class="flex-1">';
    require_once $sideNavTop;
    echo '</div>';

    // add footer if exist
    $sideNavBottom = \dash\layout\func::display_addr(). '-aside-bottom.php';
    if(is_file($sideNavBottom))
    {
      echo '<div>';
      require_once $sideNavBottom;
      echo '</div>';
    }
  }
  echo '</div>';
}
else
{
  $sidebarFile = \dash\layout\func::display_addr(). '-sidebar.php';
  if(is_file($sidebarFile))
  {
    require_once $sidebarFile;
  }
}

?>