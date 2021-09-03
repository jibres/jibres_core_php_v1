<?php
$header = \dash\data::website_header();

if(a($header, 'topline', 'status') && a($header, 'topline', 'text'))
{
	echo '<div class="topLine">';
	if(a($header, 'topline', 'url'))
	{
		echo '<a ';
		if(a($header, 'topline', 'target'))
		{
			echo 'target="_blank" ';
		}
		echo 'href="'. a($header, 'topline', 'url'). '" >';
	}
	echo a($header, 'topline', 'text');

	if(a($header, 'topline', 'url'))
	{
		echo '</a>';
	}

	echo '</div>';
}
?>