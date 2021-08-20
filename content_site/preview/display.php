<?php
$html = '';

if(\dash\data::myPreviewDisplayType() === 'preview_list')
{
	$previewSectionList = \dash\data::previewSectionList();
	if(!is_array($previewSectionList))
	{
		$previewSectionList = [];
	}

	$html .= '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 pb-10">';
	foreach ($previewSectionList as $value)
	{
		$url = \dash\url::that(). '/'. a($value, 'opt_type'). '/'. a($value, 'preview_key');

		$html .= '<a href="'.$url.'" class="group relative bg-white rounded-lg shadow-sm overflow-hidden transition hover:shadow-md focus:shadow-lg ring-1 ring-black ring-opacity-5">';
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
					$html .= a($value, 'preview_title');
				}
				$html .= '</p>';
			}
			$html .= '</div>';
		}
		$html .= '</a>';
	}
	$html .= '</div>';

}
else
{

	$preview  = \dash\data::myPreviewDetail();

	$html .= a($preview, 'preview_html');

}

echo $html;

?>