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
				$html .= "<div data-ajaxify data-data='".json_encode($select_preview)."'>HiM</div>";
				$html .='<iframe  data-ajaxify data-data="'.json_encode($select_preview).'" class="flex-grow w-full h-full" src="'. a($preview, 'iframe_url'). '" style="zoom:0.75"></iframe>';

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