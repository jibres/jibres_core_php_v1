<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

$website = \dash\data::website();

$header = [];

foreach ($website as $key => $value)
{
	if(a($value, 'mode') === 'header')
	{
		$header[] = $value;
	}
}

if(!empty($header))
{
	foreach ($header as $key => $value)
	{
		$header[$key] = \lib\pagebuilder\tools\tools::global_ready_show('header', $value['type'], $value);
		# code...
	}

	foreach ($header as $key => $value)
	{
		$header_addr = root. 'lib/pagebuilder/header/'. $value['type']. '/website.php';
		if(is_file($header_addr))
		{
			require_once($header_addr);
		}
	}
}

?>