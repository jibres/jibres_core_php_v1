<?php
if(isset($line_detail['value']['publish']) && $line_detail['value']['publish'])
{
	$result = '';
	$result .= '<div class="avand-sm mTB50-f">';
	$result .= '<h1>'. T_("Download application"). '</h1>';
	$result .= '</div>';

	echo $result;

	unset($result); // to use in other moduel!
}
?>