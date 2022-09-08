<?php


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