<?php

require_once (root. 'lib/pagebuilder/load/header.php');

if(\dash\url::module() === 'app')
{
	// nothing
}
else
{
	$website = \dash\data::website();
	$headerAddr = root. 'content_business/home/layout/header/';

	// load announcement if exist
	if(isset($website['header']['topline']['status']) && $website['header']['topline']['status'])
	{
		require_once($headerAddr. 'announcement.php');
	}

	// load header
	if(isset($website['header']['active']))
	{
	  $addr = $headerAddr. $website['header']['active']. '.php';
	  if(is_file($addr))
	  {
	    require_once($addr);
	  }
	}
}
?>