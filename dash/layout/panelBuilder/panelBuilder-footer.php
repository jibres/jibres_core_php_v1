<?php
$myFooterFile = \dash\layout\func::display_addr(). '-footer.php';
if(is_file($myFooterFile))
{
  require_once $myFooterFile;
}
else if(\dash\data::include_adminPanelBuilder() === 'siteLiveOptions')
{
  require_once(core. 'layout/panelBuilder/panelBuilder-footer-options.php');
}
else
{
  // we don't have footer
}
?>