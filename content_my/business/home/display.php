<?php

$listStore_owner = \dash\data::listStore_owner();
if(!is_array($listStore_owner))
{
  $listStore_owner = [];
}


if(\dash\detect\device::detectPWA())
{
  require_once('display_pwa.php');
}
else
{
  require_once('display_site.php');
}
?>
