<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

$website_header = \dash\data::website_header();

if(!is_array($website_header))
{
	$website_header = [];
}

if(!empty($website_header))
{
	foreach ($website_header as $key => $value)
	{
		$header_addr = root. 'lib/pagebuilder/header/'. $value['type']. '/website.php';
		if(is_file($header_addr))
		{
			require_once($header_addr);
		}
	}
}

?>