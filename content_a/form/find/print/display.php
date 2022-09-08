<?php

require_once 'display-functions.php';


$data = HTMLDetectData();
$html = '';

$html .= '<div class="print:hidden avand">';
{
	$html .= '<div class="box">';
	{
		$html .= '<div class="pad">';
		{
			if(HTMLIsPrintBefore())
			{
				$html .= '<div class="alert-danger">';
				{
					$html .= 'این فرم قبلا چاپ شده است و هدیه تحویل داده شده است';
				}
				$html     .= '</div>';
				$printUrl = \dash\url::current() . \dash\request::full_get(['print' => 'auto']);
				$html     .= '<a class="btn-link" href="' . $printUrl . '">چاپ مجدد</a>';
			}
			else
			{
				if(!$data->payablePrice)
				{
					$html .= '<div class="alert-danger">';
					{
						$html .= 'هدیه به ایشان تعلق نگرفته است';
					}
					$html .= '</div>';
				}
				else
				{
					$html .= '<div class="text-xl">';
					{
						$html .= 'به ایشان هدیه تعلق گرفته است';
						$html .= '<br>';
						$html .= 'برای چاپ و تایید تحویل مبلغ هدیه روی دکه تایید کلیک کنید';
						$html .= '<br>';
						$html .= ' مبلغ هدیه ';
						$html .= '<span class="text-red-600 font-bold">';
						{
							$html .= \dash\fit::number($data->payablePrice);
						}
						$html .= '</span>';
						$html .= ' تومان می باشد';

						$html .= '<div class="txtRa">';
						{
							$html .= '<div class="btn-success" data-ajaxify data-data=\'{"print":"print"}\'>';
							{
								$html .= 'ثبت پرداخت و تحویل هدیه';
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
			}
		}
		$html .= '</div>';

	}
	$html .= '</div>';
}
$html .= '</div>';


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

	$allowItem = \dash\data::allowItem();

	$html .= '<div class="row">';
	{
		$html .= '<div class="c-xs-6 c-sm-6">';
		{
			$html .= '<table class="tbl2 v6 responsive">';
			{

				$html .= '<tbody class="text-sm">';
				{
					foreach (\dash\data::dataTable() as $key => $value)
					{
						if(!in_array($value['item_id'], $allowItem))
						{
							continue;
						}
						if(a($value, 'item_type') === 'file')
						{
							continue;
						}
						if(a($value, 'item_type') === 'province_city')
						{
							\dash\data::provinceCode(a($value, 'province'));
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

		}
		$html .= '</div>';

		$html .= '<div class="c-xs-6 c-sm-6">';
		{

			$html .= '<div class="flex mb-4">';
			{
				foreach (\dash\data::dataTable() as $key => $value)
				{
					if(a($value, 'item_type') !== 'file')
					{
						continue;
					}

					if(!in_array($value['item_id'], $allowItem))
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
		}
		$html .= '</div>';
	}
	$html .= '</div>';

	$html .= '<div class="p-6">';
	{
		if($data->tagWinner || $data->tagRemain)
		{
			$html .= HTMLWinnerMessage($data);
		}
		else
		{
			$html .= HTMLOtherMessage($data);
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


}
$html .= '</div>';

$html .= \dash\utility\pagination::html(true);


echo $html;

?>