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

$body = [];

foreach ($website_list as $key => $value)
{
	if(a($value, 'mode') === 'body')
	{
		$body[] = $value;
	}
}

if(!empty($body))
{
	foreach ($body as $key => $value)
	{
		$html = \lib\pagebuilder\draw\body_item::get_html($value);

		echo $html;
	}
}

?>