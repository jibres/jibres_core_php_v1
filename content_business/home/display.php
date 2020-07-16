<?php
if(\dash\data::website_template())
{
	$addr = root. 'content_business/home/layout/template/'. \dash\data::website_template(). '.php';
	if(is_file($addr))
	{

		require_once($addr);
	}
	else
	{
		require_once ('layout/template/visitcard.php');
	}
}
else
{
	require_once ('layout/template/visitcard.php');
}
?>
