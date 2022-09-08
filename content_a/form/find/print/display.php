<?php

require_once 'display-functions.php';

$data = HTMLDetectData();
$html = '';


$html .= '<div class="printArea" data-size="A4">';


{
	$html .= '<div class="row">';
	{
		$html .= '<div class="c-auto mb-1">';
		{
			$html .= '<img class="inline-block w-16 h-16 rounded" src="' . \lib\store::logo() . '">';
		}
		$html .= '</div>';
		$html .= '<div class="c">';
		{
			$html .= '<div class="inline-block px-2 text-2xl font-bold mt-4">' . \lib\store::title() . '</div>';
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
				if(a($value, 'item_type') === 'file')
				{
					continue;
				}
				$html .= '<tr>';
				{
					$html .= '<th class="">';
					{
						$html .= a($value, 'item_title');
					}
					$html .= '</th>';

					$html .= '<td class="">';
					{
						$html .= \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
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

	$html .= '<div class="flex mb-4">';
	{
		foreach (\dash\data::dataTable() as $key => $value)
		{
			if(a($value, 'item_type') !== 'file')
			{
				continue;
			}

			$html .= '<div>';
			{
				$html  .= a($value, 'item_title');
				$image = \lib\filepath::fix(a($value, 'answer'));
				$html  .= '<img class="w-96" src="' . $image . '">';

			}
			$html .= '</div>';
		}
	}
	$html .= '</div>';

	if($data->tagWinner)
	{
		$html .= HTMLWinnerMessage($data);
	}

	if($data->payablePrice)
	{
		$html .= HTMLPaAblePrice($data);
	}

	if($data->tagPrintBefore)
	{
		$html .= HTMLPrintBefore($data);
	}


}
$html .= '</div>';

$html .= \dash\utility\pagination::html(true);


echo $html;

?>