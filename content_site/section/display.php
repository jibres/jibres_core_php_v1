<?php
$previewSectionList = \dash\data::previewSectionList();
if(!is_array($previewSectionList))
{
	$previewSectionList = [];
}


$html = '';

foreach ($previewSectionList as $value)
{
	$select_preview =
	[
		'section'     => 'preview',
		'key'         => a($value, 'key'),
		'opt_type'    => a($value, 'opt_type'),
		'type'        => a($value, 'opt_type'),
		'preview_key' => a($value, 'preview_key'),
	];

	$version = a($value, 'version');

	$html .= '<a class="jbtn btn-primary" href="'. a($value, 'demo_url'). '" target="_blank">Show in Demo</a>';

	$html .= "<div data-ajaxify data-data='".json_encode($select_preview)."'>";
	{

		$html .= implode(' ', [a($value, 'key'), a($value, 'opt_type'), a($value, 'preview_key')]);

		$html .= '<img src="'. a($value, 'preview_image'). '" alt="'.a($value, 'key').'">';
	}
	$html .= "</div>";
}

echo $html;
?>