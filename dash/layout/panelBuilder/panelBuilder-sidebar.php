<?php
$sidebarFile = \dash\layout\func::display_addr(). '-sidebar.php';
if(is_file($sidebarFile))
{
  require_once $sidebarFile;
}
?>