<?php
$previewSectionList = \dash\data::previewSectionList();
if(!is_array($previewSectionList))
{
	$previewSectionList = [];
}


$html = '';
$html .= '<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">';
foreach ($previewSectionList as $value)
{
	$html .= '<figure class="group relative bg-white rounded-lg shadow-sm overflow-hidden ring-1 ring-black ring-opacity-5">';
	{
		$html .= '<div class="relative bg-gray-100 border-b overflow-hidden">';
		{
			$html .= '<img src="'. a($value, 'preview_image'). '" alt="'.a($value, 'key').'">';
		}
		$html .= '</div>';

		// variables
		$select_preview =
		[
			'section'     => 'preview',
			'key'         => a($value, 'key'),
			'opt_type'    => a($value, 'opt_type'),
			'type'        => a($value, 'opt_type'),
			'preview_key' => a($value, 'preview_key'),
		];
		$html .= '<figcaption class="p-5">';
		{
			$html .= '<a class="" href="'. a($value, 'demo_url'). '" target="_blank">'. T_("Live Preview").'</a>';
		}
		$html .= '</figcaption>';


		$html .= "<div data-ajaxify data-data='".json_encode($select_preview)."'>";
		{

			$html .= implode(' ', [a($value, 'key'), a($value, 'opt_type'), a($value, 'preview_key')]);

			// $html .= '<img src="'. a($value, 'preview_image'). '" alt="'.a($value, 'key').'">';
		}
		$html .= "</div>";
	}
	$html .= '</figure>';
}
$html .= '</div>';


echo $html;
?>