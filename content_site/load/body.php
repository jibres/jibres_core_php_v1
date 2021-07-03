<?php

$website_body = \dash\data::website_body();

if(is_array($website_body))
{
	foreach ($website_body as $key => $value)
	{
		echo a($value, 'body_layout');
	}
}

?>