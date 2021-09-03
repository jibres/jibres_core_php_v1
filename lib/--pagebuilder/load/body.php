<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

if(\lib\pagebuilder\load\page::$comingsoon_visitcad_template)
{
	require_once('template/'. \lib\pagebuilder\load\page::$comingsoon_visitcad_template. '.php');
	return;
}

$website_body = \dash\data::website_body();

if(!is_array($website_body))
{
	$website_body = [];
}



if(!empty($website_body))
{
	foreach ($website_body as $key => $value)
	{
		$html = \lib\pagebuilder\draw\body_item::get_html($value);

		echo $html;
	}
}

?>