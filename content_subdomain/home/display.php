<?php

if(\dash\data::website_template())
{
	$addr = root. 'content_subdomain/home/layout/'. \dash\data::website_template(). '.php';
	if(is_file($addr))
	{

		require_once($addr);
	}
	else
	{
		require_once ('layout/visitcard.php');
	}
}
else
{
	require_once ('layout/visitcard.php');
}
?>
