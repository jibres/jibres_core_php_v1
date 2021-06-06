<?php
$sidebarFile = \dash\layout\func::display_addr(). '-sidebar.php';
if(is_file($sidebarFile))
{
  require_once $sidebarFile;
}
else if(\dash\data::include_adminPanelBuilder() === 'siteLiveOptions')
{
  require_once(core. 'layout/panelBuilder/panelBuilder-sidebar-options.php');
}
else
{
  /* we don't have footer*/
}
?>