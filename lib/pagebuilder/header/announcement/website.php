<?php
$header = \dash\data::currentHeader();

if(a($header, 'detail', 'announcement', 'status') && a($header, 'detail', 'announcement', 'text'))
{
	echo '<div class="topLine">';
	if(a($header, 'detail', 'announcement', 'url'))
	{
		echo '<a ';
		if(a($header, 'detail', 'announcement', 'target'))
		{
			echo 'target="_blank" ';
		}
		echo 'href="'. a($header, 'detail', 'announcement', 'url'). '" >';
	}
	echo a($header, 'detail', 'announcement', 'text');

	if(a($header, 'detail', 'announcement', 'url'))
	{
		echo '</a>';
	}

	echo '</div>';
}
?>