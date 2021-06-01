<?php

if(\dash\data::include_adminPanelBuilder() === 'siteLivePreview')
{
  require_once \dash\layout\func::display();
}
else
{
  // we don't have sidebar on another modes
}

?>