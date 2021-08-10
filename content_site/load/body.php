<?php

$website_body = \dash\data::website_body();

if(is_array($website_body))
{
	foreach ($website_body as $key => $value)
	{
		echo a($value, 'body_layout');
	}
}

if(\dash\data::emptySectionList())
{
	$html = '';

	$html .= '<div class="flex h-screen">';
	{
	  $html .= '<div class="m-auto">';
	  {
		$html .='<h1 class="text-4xl font-normal leading-normal mt-0 mb-2 italic">';
		{
			$html .= T_('Please complete your page by adding new sections');
		}
		$html .= '</h1>';
	  }
	  $html .= '</div>';
	}
	$html .= '</div>';

	echo $html;
}

?>