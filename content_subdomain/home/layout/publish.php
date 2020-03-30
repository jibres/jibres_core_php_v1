<?php
$website = \dash\data::website();

if(isset($website['header']['active']))
{
  $addr = root. 'content_subdomain/home/layout/header/'. $website['header']['active']. '.php';
  if(is_file($addr))
  {
    require_once($addr);
  }
}

?>