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
				$html .= '<div class="box">';
				{
					$html .= '<div class="pad">';
					{
						$html .= a($preview, 'preview_html');
					}
					$html .= '</div>';

					$html .= '<footer class="txtRa">';
					{
						$select_preview =
						[
							'section'     => 'preview',
							'key'         => a($value, 'key'),
							'type'       => a($preview, 'preview_default', 'type'),
							'preview_key' => a($preview, 'preview_key'),
						];

						$html .= "<div class='btn master' data-ajaxify data-data='".json_encode($select_preview)."'>";
						$html .= T_("Select");
						$html .= "</div>";
					}
					$html .= '</footer>';


				}
				$html .= '</div>';
			}
		}

	}
}

echo $html;
?>