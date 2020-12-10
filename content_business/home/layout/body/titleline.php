<?php

$titleline = [];

if(isset($line_detail['value']['titleline']) && is_array($line_detail['value']['titleline']))
{
	$titleline = $line_detail['value']['titleline'];
}

if($titleline)
{
	echo '<h2 class="jTitle1">';
	echo a($titleline, 'titleline');
	echo '</h2>';
}

?>
