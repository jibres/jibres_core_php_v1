<?php

if(\dash\data::include_adminPanelBuilder() === 'siteLivePreview')
{
  require_once \dash\layout\func::display();
}
else if(\dash\data::include_adminPanelBuilder() === 'siteLiveOptions')
{
  require_once(core. 'layout/panelBuilder/panelBuilder-sidebar-options.php');
}
else
{

  // we don't have sidebar on another modes
}

?>