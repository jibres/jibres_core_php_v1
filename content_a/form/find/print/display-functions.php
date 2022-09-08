<?php

function HTMLDetectData()
{

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

	return $data;
}



function HTMLWinnerMessage(object $data)
{
	$html = '';
	$html .= '<div class="alert-success">';
	{
		$html .= 'winner';
	}
	$html .= '</div>';
	return $html;
}


function HTMLPaAblePrice(object $data)
{
	$html = '';
	$html .= '<div class="alert-info">';
	{
		$html .= 'Your price is '. $data->payablePrice;
	}
	$html .= '</div>';
	return $html;
}


function HTMLPrintBefore(object $data)
{
	$html = '';
	$html .= '<div class="alert-info">';
	{
		$html .= 'Print before '. date("Y-m-d H:i:s");
	}
	$html .= '</div>';
	return $html;
}



?>