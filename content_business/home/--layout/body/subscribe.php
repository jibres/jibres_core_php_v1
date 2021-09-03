<?php
if(isset($line_detail['value']['publish']) && $line_detail['value']['publish'])
{
	$result = '';
	$result .= '<div class="avand-sm mTB50-f">';
	$result .= '<form method="post" autocomplete="off" action="'. \dash\url::herer(). '/subscribe">';
	$result .= '<label for="subscribe">'. T_("Subscribe").'</label>';
	$result .= '<div class="input">';
	$result .= '<input type="tel" name="mobile" placeholder="09123456789">';
	$result .= '<button class="btn addon master">'. T_("Send") . '</button>';
	$result .= '</div>';
	$result .= '</form>';
	$result .= '</div>';

	echo $result;

	unset($result); // to use in other moduel!
}
?>