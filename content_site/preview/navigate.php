<?php

if(\dash\request::key_exists('lock', 'get'))
{
	// nothing
	return;
}

$back_url = \dash\data::previewBackUrl();

if($back_url)
{
	$html .= '<div>';
	{
		$html .= '<a href="'. $back_url. '" >';
		{
			$html .= T_("Back");
		}
		$html .= '</a>';
	}
	$html .= '</div>';
}

?>