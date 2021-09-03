<?php

\content_site\load\load::detect_header();

$website_header = \dash\data::website_header();

if(is_array($website_header))
{
	foreach ($website_header as $key => $value)
	{
		echo a($value, 'body_layout');
	}
}

?>