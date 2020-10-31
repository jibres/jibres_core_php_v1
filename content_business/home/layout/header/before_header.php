<?php
$header = \dash\data::website_header();

if(\dash\get::index($header, 'topline', 'status') && \dash\get::index($header, 'topline', 'text'))
{
	echo '<div class="topLine">';
	if(\dash\get::index($header, 'topline', 'url'))
	{
		echo '<a ';
		if(\dash\get::index($header, 'topline', 'target'))
		{
			echo 'target="_blank" ';
		}
		echo 'href="'. \dash\get::index($header, 'topline', 'url'). '" >';
	}
	echo \dash\get::index($header, 'topline', 'text');

	if(\dash\get::index($header, 'topline', 'url'))
	{
		echo '</a>';
	}

	echo '</div>';
}


?>
