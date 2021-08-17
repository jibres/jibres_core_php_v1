<?php
$previewSectionList = \dash\data::previewSectionList();
if(!is_array($previewSectionList))
{
	$previewSectionList = [];
}


$html = '';
$html .= '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 pb-10">';
foreach ($previewSectionList as $value)
{
	// variables
	$select_preview =
	[
		'section'     => 'preview',
		'key'         => a($value, 'key'),
		'opt_type'    => a($value, 'opt_type'),
		'type'        => a($value, 'opt_type'),
		'preview_key' => a($value, 'preview_key'),
	];
	$ajaxify = "data-ajaxify data-data='".json_encode($select_preview)."'";

	$html .= '<button class="group relative bg-white rounded-lg shadow-sm overflow-hidden transition hover:shadow-md focus:shadow-lg ring-1 ring-black ring-opacity-5"'. $ajaxify. '>';
	{
		$html .= '<div class="relative bg-gray-100 border-b overflow-hidden">';
		{
			$html .= '<img src="'. a($value, 'preview_image'). '" alt="'.a($value, 'key').'">';
		}
		$html .= '</div>';

		$html .= '<div class="p-5">';
		{
			$html .= '<p class="text-sm font-medium text-gray-900 text-justify">';
			{
				// $html .= T_('Sample'). ' '. implode(' ', [a($value, 'key'), a($value, 'opt_type'), a($value, 'preview_key')]);
				$html .= a($value, 'preview_title');

			}
			$html .= '</p>';
			// $html .= '<p class="text-xs font-medium text-gray-500">';
			// {
			// 	$html .= a($value, 'desc');
			// 	$html .= 'lorem desc';
			// }
			// $html .= '</p>';
		}
		$html .= '</div>';
	}
	$html .= '</button>';
}
$html .= '</div>';


echo $html;
?>