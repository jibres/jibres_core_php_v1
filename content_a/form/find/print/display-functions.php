<?php

function HTMLDetectData()
{

	$tagWinner    = false;
	$tagRemain    = false;
	$eastProvince = false;

	$tagPrintBefore = false;

	$tagWinner    = true;
	$tagRemain    = true;
	$province     = null;
	$eastProvince = isEastProvince($province);

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
		'tagWinner'      => $tagWinner,
		'eastProvince'   => $eastProvince,
		'tagRemain'      => $tagRemain,
		'payablePrice'   => $payablePrice,
		'currency'       => $currency,
	];

	return $data;
}

function isEastProvince($_province)
{
	// مبلغ هدیه برای ساکنین استان‌های شرقی شامل سیستان، کرمان، خراسان‌ها و گلستان معادل ۲.۵ میلیون تومان و برای سایر استان‌ها ۲ میلیون تومان می‌باشد
	$eastProvince =
		[
			'IR-13', // systan
			'IR-15', // kerman
			'IR-29', // khorasan
			'IR-30', // khorasan
			'IR-31', // khorasan
			'IR-27', // golestan

		];

	if(in_array($_province, $eastProvince))
	{
		return true;
	}
	else
	{
		return false;
	}
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
		$html .= 'Your price is ' . $data->payablePrice;
	}
	$html .= '</div>';
	return $html;
}


function HTMLPrintBefore(object $data)
{
	$html = '';
	$html .= '<div class="alert-info">';
	{
		$html .= 'Print before ' . date("Y-m-d H:i:s");
	}
	$html .= '</div>';
	return $html;
}


?>