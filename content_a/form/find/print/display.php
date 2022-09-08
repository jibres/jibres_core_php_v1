<?php
$html = '';


$html .= '<div class="printArea" data-size="A4">';
{
	$html .= '<div class="row">';
	{
		$html .= '<div class="c-auto mb-1">';
		{
			$html .= '<img class="inline-block w-16 h-16 rounded" src="'.\lib\store::logo().'">';
		}
		$html .= '</div>';
		$html .= '<div class="c">';
		{
			$html .= '<div class="inline-block px-2 text-2xl font-bold mt-4">'. \lib\store::title(). '</div>';
		}
		$html .= '</div>';
	}
	$html .= '</div>';



	$html .= '<table class="tbl1 v6 responsive">';
	{

		$html .= '<tbody class="text-sm">';
		{
			foreach (\dash\data::dataTable() as $key => $value)
			{
				$html .= '<tr>';
				{
					$html .= '<th class="">';
					{
						$html .= a($value, 'item_title');
					}
					$html .= '</th>';

					$html .= '<td class="">';
					{
						$html .=  \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
					}
					$html .= '</td>';
				}
				$html .= '</tr>';
			}
		}
		$html .= '</tbody>';
	}
	$html .= '</table>';
	$html .= \dash\utility\pagination::html(true);



}
$html .= '</div>';

$html .= \dash\utility\pagination::html(true);


echo $html;
?>