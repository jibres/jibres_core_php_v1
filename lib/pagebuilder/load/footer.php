<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

$website_list = \dash\data::website_list();

if(!is_array($website_list))
{
	$website_list = [];
}

$footer = [];

foreach ($website_list as $key => $value)
{
	if(a($value, 'mode') === 'footer')
	{
		$footer[] = $value;
	}
}

if(!empty($footer))
{
	foreach ($footer as $key => $value)
	{
		$footer[$key] = \lib\pagebuilder\tools\tools::global_ready_show('footer', $value['type'], $value);
		# code...
	}

	foreach ($footer as $key => $value)
	{
		$footer_addr = root. 'lib/pagebuilder/footer/'. $value['type']. '/website.php';
		if(is_file($footer_addr))
		{
			require_once($footer_addr);
		}
	}
}
?>