<?php
$section_list = \dash\data::sectionList();
if(!is_array($section_list))
{
	$section_list = [];
}

$html = '';

foreach ($section_list as $group)
{
	foreach ($group as $key => $value)
	{
		if(is_array(a($value, 'preview_list')))
		{
			foreach ($value['preview_list'] as  $preview)
			{
				$select_preview =
				[
					'section'     => 'preview',
					'key'         => a($value, 'key'),
					'opt_type'    => a($preview, 'opt_type'),
					'type'        => a($preview, 'opt_type'),
					'preview_key' => a($preview, 'preview_key'),
				];

				$version = a($preview, 'version');

				$preview_image = \dash\url::cdn(). sprintf('/img/%s/%s/%s.jpg?v=%s', 'sitebuilder', a($value, 'key'), a($preview, 'preview_key'), $version);

				$html .= "<div data-ajaxify data-data='".json_encode($select_preview)."'>";
				{
					$html .= '<img src="'. $preview_image. '" alt="'.a($preview, 'key').'">';
				}
				$html .= "</div>";

				// $html .= "<div data-ajaxify data-data='".json_encode($select_preview)."'>HiM</div>";
				// $html .= "<div class='bg-white rounded-lg overflow-hidden mb-10 max-h-screen h-4/6 w-full'>";
				// $html .='<iframe data-ajaxify data-data="'.json_encode($select_preview).'" class="flex-grow1 w-full h-full" src="'. a($preview, 'iframe_url'). '" style="zoom:0.75"></iframe>';
				// $html .= "</div>";

				// $html .= '<div class="box">';
				// {
				// 	$html .= '<div class="pad">';
				// 	{
				// 		$html .= a($preview, 'preview_html');
				// 	}
				// 	$html .= '</div>';

				// 	$html .= '<footer class="txtRa">';
				// 	{

				// 		$html .= "<div class='btn master' data-ajaxify data-data='".json_encode($select_preview)."'>";
				// 		$html .= T_("Select");
				// 		$html .= "</div>";
				// 	}
				// 	$html .= '</footer>';


				// }
				// $html .= '</div>';
			}
		}

	}
}

echo $html;
?>