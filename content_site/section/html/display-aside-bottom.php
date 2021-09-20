<?php

$html = '';

if(\dash\request::get('sid'))
{
	$delete_json    = json_encode(['delete' => 'section']);

	$remove_title = T_("Are you sure to remove this section?");

	$html .= '<div class="flex w-full">';
	{
		$html .= '<div class="cauto">';
		{
			$html .= "<div class='inline-block flex align-center bg-gray-50 transition p-2 rounded-lg cursor-pointer' data-confirm data-title='$remove_title' data-data='$delete_json'>";
			{
				$html .= '<img class="w-5" src="'. \dash\utility\icon::url('Delete', 'minor'). '" alt="Delete">';
				$html .= '<span class="px-2">'. T_("Remove section").'</span>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
	}
	$html .= '</div>';

}
echo $html;

?>