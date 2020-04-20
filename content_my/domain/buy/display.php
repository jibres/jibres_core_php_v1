<?php
if(\dash\data::myDomain())
{
  require_once ('display-settings.php');
}
else
{
  require_once ('display-search.php');
}
?>
