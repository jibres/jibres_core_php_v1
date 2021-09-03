<?php

\content_site\load\load::detect_footer();

$website_footer = \dash\data::website_footer();

if(is_array($website_footer))
{
	foreach ($website_footer as $key => $value)
	{
		echo a($value, 'body_layout');
	}
}

?>