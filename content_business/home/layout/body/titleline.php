<?php

$titleline = [];

if(isset($line_detail['value']['titleline']) && is_array($line_detail['value']['titleline']))
{
	$titleline = $line_detail['value']['titleline'];
}

if($titleline)
{
	echo '<h2 class="jTitle1">';
	echo \dash\get::index($titleline, 'titleline');
	echo '</h2>';
}

?>
