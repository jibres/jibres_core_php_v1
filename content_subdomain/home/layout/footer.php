<?php
$website = \dash\data::website();
if(isset($website['footer']['active']))
{
  $addr = root. 'content_subdomain/home/layout/footer/'. $website['footer']['active']. '.php';
  if(is_file($addr))
  {
    require_once($addr);
  }
}
?>