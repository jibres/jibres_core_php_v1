<?php

$text = [];

if(isset($line_detail['value']['text']) && is_array($line_detail['value']['text']))
{
	$text = $line_detail['value']['text'];
}

if($text)
{
	echo '<div class="fit">';
	echo \dash\get::index($text, 'text');
	echo '</div>';
}

?>
