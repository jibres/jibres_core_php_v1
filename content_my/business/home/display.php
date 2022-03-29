<?php

$listStore_owner = \dash\data::listStore_owner();
if(!is_array($listStore_owner))
{
  $listStore_owner = [];
}


  require_once('display_pwa.php');
// if(\dash\detect\device::detectPWA())
// {
// }
// else
// {
//   require_once('display_site.php');
// }
?>
