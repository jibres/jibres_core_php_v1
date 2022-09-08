<?php

require_once 'display-functions.php';

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

	$tagWinner      = false;
	$tagRemain      = false;
	$eastProvince   = false;
	$westProvince   = false;
	$tagPrintBefore = false;

	$tagWinner      = true;
	$tagRemain      = true;
	$eastProvince   = true;
	$westProvince   = true;
	$tagPrintBefore = true;



	if($tagWinner)
	{
		$payablePrice = 2000000;

		if($eastProvince)
		{
			$payablePrice = 2500000;
		}

	}
	elseif($tagRemain)
	{
		$payablePrice = 500000;
	}
	else
	{
		$payablePrice = 0;
	}

	$currency = T_("Toman");

	$data = (object)
	[
		'tagPrintBefore' => $tagPrintBefore,
		'westProvince'   => $westProvince,
		'tagWinner'      => $tagWinner,
		'eastProvince'   => $eastProvince,
		'tagRemain'      => $tagRemain,
		'payablePrice'   => $payablePrice,
		'currency'       => $currency,
	];


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

	if($tagWinner)
	{
		$html .= HTMLWinnerMessage($data);
	}

	if($payablePrice)
	{
		$html .= HTMLPaAblePrice($data);
	}

	if($tagPrintBefore)
	{
		$html .= HTMLPrintBefore($data);
	}


}
$html .= '</div>';

$html .= \dash\utility\pagination::html(true);


echo $html;

?>